<?php

declare(strict_types=1);

namespace App\Services;

use App\Exceptions\SystemExceptionHandler;
use Elastic\Elasticsearch\Client;
use Elastic\Elasticsearch\ClientBuilder;
use Elastic\Elasticsearch\Exception\AuthenticationException;
use Elastic\Elasticsearch\Exception\ClientResponseException;
use Elastic\Elasticsearch\Exception\MissingParameterException;
use Elastic\Elasticsearch\Exception\ServerResponseException;
use Exception;
use RuntimeException;
use stdClass;

final readonly class ElasticSearchService
{
    private Client $client;

    /**
     * @throws AuthenticationException
     */
    public function __construct()
    {
        $host = config('services.elk.host_ip');
        $username = config('services.elk.username');
        $password = config('services.elk.password');

        if ($username === null || $password === null) {
            throw new RuntimeException('Missing ELK credentials in config/services.php or .env');
        }

        $this->client = ClientBuilder::create()
            ->setHosts([$host])
            ->setBasicAuthentication($username, $password)
            ->setSSLVerification(false)
            ->build();
    }

    /**
     * Test the connection to the Elasticsearch server.
     */
    public function testConnection(): string|array
    {
        try {
            $response = $this->client->ping();

            return $response ? 'Connection successful' : 'Connection failed';
        } catch (ClientResponseException|ServerResponseException $e) {
            return SystemExceptionHandler::handleElasticsearchException($e);
        }
    }

    public function indexExists(string $indexName): bool
    {
        try {
            return $this->client->indices()->exists(['index' => $indexName])->asBool();
        } catch (ClientResponseException|ServerResponseException|MissingParameterException) {
            return false; // Handled silently, but can be logged as needed
        }
    }

    /**
     * Create an index in Elasticsearch with the given name and default settings.
     */
    public function createIndex(string $indexName, array $settings = [], array $mappings = []): array
    {
        $params = [
            'index' => $indexName,
            'body' => [
                'settings' => $settings !== [] ? $settings : [
                    'number_of_shards' => 1,
                    'number_of_replicas' => 0,
                ],
                'mappings' => $mappings !== [] ? $mappings : [
                    'properties' => [
                        'title' => ['type' => 'text'],
                        'content' => ['type' => 'text'],
                    ],
                ],
            ],
        ];

        try {
            return $this->client->indices()->create($params)->asArray();
        } catch (ClientResponseException|ServerResponseException|MissingParameterException $e) {
            return SystemExceptionHandler::handleElasticsearchException($e); // Use handler for error response
        }
    }

    public function deleteIndex(string $indexName): array
    {
        try {
            return $this->client->indices()->delete(['index' => $indexName])->asArray();
        } catch (ClientResponseException|ServerResponseException $e) {
            return SystemExceptionHandler::handleElasticsearchException($e);
        }
    }

    /**
     * Populate an index with the given data.
     */
    public function populateIndex(string $indexName, array $data): array
    {
        $params = [
            'index' => $indexName,
            'body' => $data,
        ];

        try {
            return $this->client->index($params)->asArray();
        } catch (ClientResponseException|ServerResponseException|MissingParameterException $e) {
            return SystemExceptionHandler::handleElasticsearchException($e);
        }
    }

    /**
     * Perform a bulk index operation with the given data.
     *
     * @throws Exception
     */
    public function bulkIndexData(string $indexName, array $data): array
    {
        $params = ['body' => []];

        foreach ($data as $item) {
            $elastic_prop = $this->verifyExists($indexName, $item['id']);

            if (count($elastic_prop) === 0) {
                $params['body'][] = [
                    'create' => [
                        '_index' => $indexName,
                    ],
                ];
                $params['body'][] = $item;
            } else {
                $params['body'][] = [
                    'update' => [
                        '_index' => $indexName,
                        '_id' => $elastic_prop[0]['_id'],
                    ],
                ];
                $params['body'][] = ['doc' => $item];
            }
        }

        if (isset($params['body']) && $params['body'] !== []) {
            try {
                $response = $this->client->bulk($params);
                if (isset($response['errors']) && $response['errors']) {
                    throw new Exception('Bulk operation failed: '.json_encode($response['items']));
                }
            } catch (Exception $e) {
                return SystemExceptionHandler::handleElasticsearchException($e);
            }
        }

        return ['message' => 'Bulk operation successful'];
    }

    /**
     * Get paginated data from the specified index.
     */
    public function getPaginatedIndexData(string $indexName, int $page = 1, int $pageSize = 10): array|string
    {
        $from = ($page - 1) * $pageSize;

        $params = [
            'index' => $indexName,
            'body' => [
                'from' => $from,
                'size' => $pageSize,
                'query' => ['match_all' => new stdClass],
            ],
        ];

        try {
            $response = $this->client->search($params);
        } catch (ClientResponseException|ServerResponseException $e) {
            return SystemExceptionHandler::handleElasticsearchException($e); // Use handler for error response
        }

        if (isset($response['hits']['hits'])) {
            return [
                'total' => $response['hits']['total']['value'],
                'data' => $response['hits']['hits'],
                'current_page' => $page,
                'per_page' => $pageSize,
            ];
        }

        return 'No documents found';
    }

    /**
     * Get data from the specified index by document ID.
     */
    public function getIndexData(string $indexName, string $id): array|string
    {
        $params = [
            'index' => $indexName,
            'body' => [
                'query' => ['match' => ['_id' => $id]],
            ],
        ];

        try {
            $response = $this->client->search($params);
        } catch (ClientResponseException|ServerResponseException $e) {
            return SystemExceptionHandler::handleElasticsearchException($e); // Use handler for error response
        }

        return $response['hits']['hits'][0] ?? 'Document not found';
    }

    public function logError(): void
    {
        // Assuming logging is handled by a logger service
        // You can log the error details to Elasticsearch, a file, or any logging service
    }

    public function getClient(): Client
    {
        return $this->client;
    }

    /**
     * Verify if a document with the given ID exists in the specified index.
     */
    private function verifyExists(string $index, string $id): array
    {
        try {
            $data = $this->client->search([
                'index' => $index,
                'body' => ['query' => ['bool' => ['must' => ['term' => ['id' => $id]]]]],
            ]);
        } catch (ClientResponseException|ServerResponseException $e) {
            return SystemExceptionHandler::handleElasticsearchException($e); // Use handler for error response
        }

        return $data['hits']['hits'];
    }
}
