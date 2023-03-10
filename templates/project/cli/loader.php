<?php

$loader = new \Phalcon\Autoload\Loader();
$loader->setDirectories([
    APP_PATH . '/tasks',
    APP_PATH . '/models'
]);
$loader->register();
