<?php

use Phalcon\Config;
use Phalcon\Logger;

return new Config([
    'database' => [
        'adapter'  => 'Postgresql',
        'host'     => env('TEST_DB_POSTGRESQL_HOST', '127.0.0.1'),
        'username' => env('TEST_DB_POSTGRESQL_USER', 'postgres'),
        'password' => env('TEST_DB_POSTGRESQL_PASSWD', ''),
        'dbname'   => env('TEST_DB_POSTGRESQL_NAME', 'devtools'),
        'schema'   => env('TEST_DB_POSTGRESQL_SCHEMA', 'public')
    ],
    'logger' => [
        'path'     => tests_path('_output/logs/console/postgresql/'),
        'format'   => '%date% [%type%] %message%',
        'date'     => 'D j H:i:s',
        'logLevel' => Logger::DEBUG,
        'filename' => 'tests.log',
    ]
]);
