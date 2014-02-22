<?php

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
    */
    $app = new \Phalcon\Mvc\Micro();

    /**
     * Assign service locator to the application
     */
    $app->setDi($di);

    /**
     * Incude Application
     */
    include __DIR__ . '/../app.php';

    /**
     * Handle the request
     */
    $app->handle();

} catch (Phalcon\Exception $e) {
    echo $e->getMessage();
} catch (PDOException $e) {
    echo $e->getMessage();
}
