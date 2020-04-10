<?php

use Phalcon\Config;
use Phalcon\Logger;

return new Config([
    'database' => [
        'adapter'   => 'Mysql',
        'host'      => '127.0.0.1',
        'username'  => 'root',
        'password'  => env('MYSQL_DB_PASSWORD'),
        'dbname'    => 'devtools',
        'port'      => env('MYSQL_DB_PORT')
    ],
    'logger' => [
        'path'     => tests_path('_output/logs/console/mysql/'),
        'format'   => '%date% [%type%] %message%',
        'date'     => 'D j H:i:s',
        'logLevel' => Logger::DEBUG,
        'filename' => 'tests.log',
    ],
    'application' => [
        'controllersDir' => app_path() . '/controllers/',
        'modelsDir'      => app_path() . '/models/',
        'viewsDir'       => app_path() . '/views/',
    ],
]);
