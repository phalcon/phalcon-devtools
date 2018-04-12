<?php


return [
    'app' => [
        'env' => env('APP_ENV', 'dev'),
        'debug' => env('APP_DEBUG', false),
    ],
    'api' => [
        'statusKey' => 'status',
        'successStatus' => 'success',
        'failStatus' => 'error',
        'codeKey' => 'code',
        'successCode' => 0,
        'messageKey' => 'message',
        'returnKey' => 'data'
    ],
];