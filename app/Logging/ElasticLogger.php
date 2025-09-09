<?php

declare(strict_types=1);

namespace App\Logging;

use App\Facades\ElasticSearch;
use Monolog\Formatter\ElasticsearchFormatter;
use Monolog\Handler\ElasticsearchHandler;
use Monolog\Logger;

final class ElasticLogger
{
    public function __invoke(): Logger
    {
        $client = ElasticSearch::getClient();
        $index = 'admin_system_logs';
        $handler = new ElasticsearchHandler($client, [
            'index' => $index,
            'type' => '_doc',
        ]);
        $handler->setFormatter(new ElasticsearchFormatter($index, '_doc'));

        return new Logger('elasticsearch', [$handler]);
    }
}
