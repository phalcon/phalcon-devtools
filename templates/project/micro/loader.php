<?php

/**
 * Registering an autoloader
 */
$loader = new \Phalcon\Autoload\Loader();

$loader->registerDirs(
    [
        $config->application->modelsDir
    ]
)->register();
