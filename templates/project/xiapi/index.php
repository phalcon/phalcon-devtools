<?php

date_default_timezone_set('Asia/Shanghai');
define('APP_NAME', 'baby_plan');
define('BASE_DIR', dirname(__DIR__));
define('APP_DIR', dirname(__DIR__) . '/app');
define('STORAGE_DIR', dirname(__DIR__) . '/storage');

include_once dirname(__DIR__) . '/vendor/autoload.php';

(new Xiapi\Bootstrap())->run();
