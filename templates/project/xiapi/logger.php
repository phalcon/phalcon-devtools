<?php

return [
    'logger' => [
        'type' => env('LOGGER_TYPE', 'file'),
        'path' => env('LOGGER_PATH', storage_path('log')),
        'host' => env('LOGGER_HOST', 'localhost'),
        'port' => env('LOGGER_PORT', 7676),
    ]
];