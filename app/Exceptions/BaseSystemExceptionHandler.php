<?php

declare(strict_types=1);

namespace App\Exceptions;

use App\Services\ElasticSearchService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Throwable;

abstract class BaseSystemExceptionHandler
{
    public function __construct(protected ElasticSearchService $elasticsearchService) {}

    /**
     * Log exception to Elasticsearch with comprehensive data.
     */
    final public function logToElasticsearch(Throwable $e, Request $request, array $additionalData = []): void
    {
        $this->buildErrorDocument($e, $request, $additionalData);

        try {
            $this->elasticsearchService->logError();
        } catch (Throwable $loggingError) {
            Log::error('Failed to log error to Elasticsearch', [
                'elasticsearch_error' => $loggingError->getMessage(),
                'original_error' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);
        }
    }

    /**
     * Build comprehensive error document for Elasticsearch.
     */
    private function buildErrorDocument(Throwable $e, Request $request, array $additionalData = []): array
    {
        $responseTime = (microtime(true) - (defined('LARAVEL_START') ? LARAVEL_START : microtime(true))) * 1000; // ms

        return array_merge([
            'id' => $this->generateErrorId($e, $request),
            'type' => $this->getExceptionType($e),
            'message' => $e->getMessage(),
            'status' => $this->getStatusCode($e),
            'uri' => $request->getRequestUri(),
            'method' => $request->getMethod(),
            'user' => $this->getUserContext(),
            'ip' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'trace' => $this->getFilteredTrace($e),
            'timestamp' => now()->toISOString(),
            'environment' => config('app.env'),
            'file' => $this->sanitizeFilePath($e->getFile()),
            'line' => $e->getLine(),
            'context' => rescue(fn (): array => $this->getRequestContext($request), []),
            'request_data' => $this->sanitizeRequestData($request),
            'headers' => $this->sanitizeHeaders($request),
            'response_time' => round($responseTime, 2),
            'memory_usage' => memory_get_peak_usage(true),
            'tags' => $this->generateTags($e, $request),
        ], $additionalData);
    }

    /**
     * Generate unique error ID for tracking.
     */
    private function generateErrorId(Throwable $e, Request $request): string
    {
        return md5(
            $e->getFile().
            $e->getLine().
            $e->getMessage().
            $request->getMethod().
            $request->getRequestUri().
            now()->format('Y-m-d-H')
        );
    }

    /**
     * Get exception type name.
     */
    private function getExceptionType(Throwable $e): string
    {
        return class_basename($e);
    }

    /**
     * Get HTTP status code from exception.
     */
    private function getStatusCode(Throwable $e): int
    {
        if (method_exists($e, 'getStatusCode')) {
            return $e->getStatusCode();
        }

        return $e->getCode() > 0 ? $e->getCode() : 500;
    }

    /**
     * Retrieve user context from authentication guards.
     */
    private function getUserContext(): ?array
    {
        try {
            if (auth()->check()) {
                return $this->mapUserContext(auth()->user(), 'user');
            }
        } catch (Throwable) {
            return null;
        }

        return null;
    }

    /**
     * Map the user object to a context array.
     */
    private function mapUserContext($user, string $type): array
    {
        return [
            'id' => (string) $user->id,
            'type' => $type,
            'name' => $user->name ?? 'Unknown',
            'email' => $user->email ?? null,
        ];
    }

    /**
     * Get filtered stack trace (first 10 frames).
     */
    private function getFilteredTrace(Throwable $e): string
    {
        $trace = array_slice($e->getTrace(), 0, 10);

        return json_encode(array_map(fn (array $frame): array => $this->sanitizeTraceFrame($frame), $trace), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    }

    /**
     * Sanitize individual trace frame by removing sensitive information.
     */
    private function sanitizeTraceFrame(array $frame): array
    {
        unset($frame['args']);

        return $frame;
    }

    /**
     * Sanitize file path to remove sensitive system information.
     */
    private function sanitizeFilePath(string $filePath): string
    {
        return str_replace(base_path(), '', $filePath);
    }

    /**
     * Get request context for tracking.
     */
    private function getRequestContext(Request $request): array
    {
        return [
            'request_id' => $request->header('X-Request-ID') ?? Str::uuid()->toString(),
            'session_id' => $request->hasSession() ? $request->session()->getId() : null,
            'correlation_id' => $request->header('X-Correlation-ID'),
        ];
    }

    /**
     * Sanitize request data by removing sensitive information.
     */
    private function sanitizeRequestData(Request $request): array
    {
        $sensitiveFields = [
            'password', 'password_confirmation', 'token', 'api_key', 'secret', 'private_key',
            'credit_card', 'ssn', 'social_security',
        ];

        $input = $request->except($sensitiveFields);
        array_walk_recursive($input, fn (&$value, $key) => $this->sanitizeSensitiveData($key, $value, $sensitiveFields));

        return [
            'input' => $input,
            'query' => $request->query(),
            'files' => $request->hasFile('*') ? array_keys($request->allFiles()) : [],
        ];
    }

    /**
     * Sanitize sensitive data in the input.
     */
    private function sanitizeSensitiveData(string $key, &$value, array $sensitiveFields): void
    {
        if (in_array(mb_strtolower($key), $sensitiveFields)) {
            $value = '[REDACTED]';
        }
    }

    /**
     * Sanitize headers by removing sensitive information.
     */
    private function sanitizeHeaders(Request $request): array
    {
        $sensitiveHeaders = ['authorization', 'cookie', 'x-api-key', 'x-auth-token'];
        $headers = $request->headers->all();

        foreach ($sensitiveHeaders as $header) {
            if (isset($headers[$header])) {
                $headers[$header] = ['[REDACTED]'];
            }
        }

        return $headers;
    }

    /**
     * Generate tags for easier filtering and categorization.
     */
    private function generateTags(Throwable $e, Request $request): array
    {
        $tags = [
            config('app.env'),
            mb_strtolower($this->getExceptionType($e)),
            mb_strtolower($request->getMethod()),
        ];

        // Status code category
        $statusCode = $this->getStatusCode($e);
        if ($statusCode >= 400 && $statusCode < 500) {
            $tags[] = 'client_error';
        } elseif ($statusCode >= 500) {
            $tags[] = 'server_error';
        }

        // API vs Web request
        $tags[] = $request->expectsJson() || $request->is('api/*') ? 'api' : 'web';

        // Authentication status
        $tags[] = auth()->check() ? 'authenticated' : 'guest';

        return $tags;
    }
}
