<?php

$loader = new \Phalcon\Autoload\Loader();
$loader->registerDirs([
    APP_PATH . '/tasks',
    APP_PATH . '/models'
]);
$loader->register();
