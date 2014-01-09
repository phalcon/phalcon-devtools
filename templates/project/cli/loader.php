<?php

$loader = new \Phalcon\Loader();
$loader->registerDirs(
    array(
        __DIR__ . '/../tasks'
    )
);
$loader->register();
