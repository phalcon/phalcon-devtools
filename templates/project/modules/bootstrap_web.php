<?php

use Phalcon\Di\FactoryDefault;
use Phalcon\Mvc\Application;

error_reporting(E_ALL);

define('APP_PATH', realpath(__DIR__));

try {

    /**
     * The FactoryDefault Dependency Injector automatically registers the right services to provide a full stack framework
     */
    $di = new FactoryDefault();

    /**
     * Include general services
     */
    require APP_PATH . '/config/services.php';

    /**
     * Include web specific services
     */
    require APP_PATH . '/config/services_web.php';

    /**
     * Handle the request
     */
    $application = new Application($di);

    /**
     * Register application modules
     */
    $application->registerModules([
        'frontend' => [
            'className' => '@@namespace@@\Modules\Frontend\Module',
            'path' => APP_PATH . '/modules/frontend/Module.php'
        ],
    ]);

    /**
     * Include routes
     */
    require APP_PATH . '/config/routes.php';

    echo $application->handle()->getContent();

} catch (\Exception $e) {
    echo $e->getMessage() . '<br>';
    echo '<pre>' . $e->getTraceAsString() . '</pre>';
}
