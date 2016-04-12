<?php

$loader = new \Phalcon\Loader();
$loader->registerDirs([
    __DIR__ . '/../tasks'
]);
$loader->register();
