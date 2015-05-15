<?php

use Phalcon\Mvc\Application;

error_reporting(E_ALL);

define('APP_PATH', realpath('..'));

try {

    /**
     * Read the configuration
     */
    $config = @@configLoader@@;

    /**
     * Include services
     */
    require __DIR__ . '/../config/services.php';

    /**
     * Handle the request
     */
    $application = new Application($di);

    /**
     * Include modules
     */
    require __DIR__ . '/../config/modules.php';

    /**
     * Include routes
     */
    require __DIR__ . '/../config/routes.php';

    echo $application->handle()->getContent();

} catch (Exception $e) {
    echo $e->getMessage();
}

