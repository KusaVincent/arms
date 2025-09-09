<?php

declare(strict_types=1);

namespace App\Helpers;

use App\Facades\ElasticSearch;
use Illuminate\Http\Request;
use Throwable;

final class LogHelper
{
    public static function error(string $message, int $status = 500, ?Request $request = null, array $additionalData = []): array
    {
        return self::log('error', 'Exception', $message, $status, $request, $additionalData);
    }

    public static function success(string $message, int $status = 200, ?Request $request = null, array $additionalData = []): array
    {
        return self::log('success', 'Message', $message, $status, $request, $additionalData);
    }

    public static function warning(string $message, int $status = 400, ?Request $request = null, array $additionalData = []): array
    {
        return self::log('warning', 'Warning', $message, $status, $request, $additionalData);
    }

    public static function debug(string $message, int $status = 200, ?Request $request = null, array $additionalData = []): array
    {
        return self::log('debug', 'Debug', $message, $status, $request, $additionalData);
    }

    public static function info(string $message, int $status = 100, ?Request $request = null, array $additionalData = []): array
    {
        return self::log('info', 'Info', $message, $status, $request, $additionalData);
    }

    public static function exception(Throwable $e, int $status = 500, ?Request $request = null, array $additionalData = []): array
    {
        $trace = collect($e->getTrace())->take(10)->map(function (array $frame): array {
            unset($frame['args']);

            return $frame;
        });

        $log = [
            'type' => class_basename($e),
            'message' => $e->getMessage(),
            'status' => $status,
            'file' => str_replace(base_path(), '', $e->getFile()),
            'line' => $e->getLine(),
            'trace' => $trace,
            'timestamp' => now()->toIso8601String(),
        ];

        $log = self::getArr($request, $log, $additionalData);

        return ElasticSearch::populateIndex('admin_error_log', $log);
    }

    private static function getArr(?Request $request, array $log, array $additionalData): array
    {
        if ($request instanceof Request) {
            $log['uri'] = $request->getRequestUri();
            $log['method'] = $request->getMethod();
            $log['ip'] = $request->ip();
            $log['user_agent'] = $request->userAgent();
            $log['user'] = auth()->check() ? [
                'id' => (string) auth()->id(),
                'email' => auth()->user()->email ?? null,
            ] : null;
        }

        return array_merge($log, $additionalData);
    }

    private static function log(
        string $index,
        string $type,
        string $message,
        int $status,
        ?Request $request = null,
        array $additionalData = []
    ): array {
        $log = [
            'type' => $type,
            'message' => $message,
            'status' => $status,
            'timestamp' => now()->toIso8601String(),
        ];

        $log = self::getArr($request, $log, $additionalData);

        return ElasticSearch::populateIndex('admin_'.$index.'_log', $log);
    }
}
