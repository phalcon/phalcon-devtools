<?php

use Phalcon\Mvc\Micro;

error_reporting(E_ALL);

try {

    /**
     * Read the configuration
     */
    $config = @@configLoader@@;

    /**
     * Include Services
     */
    include __DIR__ . '/../config/services.php';

    /**
     * Include Autoloader
     */
    include __DIR__ . '/../config/loader.php';

    /**
     * Starting the application
     * Assign service locator to the application
     */
    $app = new Micro($di);

    /**
     * Incude Application
     */
    include __DIR__ . '/../app.php';

    /**
     * Handle the request
     */
    $app->handle();

} catch (\Exception $e) {
    echo $e->getMessage();
}
