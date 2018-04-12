<?php

use Xiapi\ZeroMQ\Logger as ZmqLogger;

/**
 * @var Phalcon\Config $config;
 */
$config = DI('config');

return [
    'logger' => [
        'className' => ZmqLogger::class,
        'shared' => true,
        'arguments' => [
            [
                'type' => 'parameter',
                'value' => $config->path('logger.path')
            ],
            [
                'type' => 'parameter',
                'value' => $config->path('logger.type') === 'queue'
            ],
            [
                'type' => 'parameter',
                'value' => $config->path('logger.host')
            ],
            [
                'type' => 'parameter',
                'value' => $config->path('logger.port')
            ]
        ]
    ]
];