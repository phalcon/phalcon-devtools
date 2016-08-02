<?php

$loader = new \Phalcon\Loader();
$loader->registerDirs([
    APP_PATH . '/tasks'
]);
$loader->register();
