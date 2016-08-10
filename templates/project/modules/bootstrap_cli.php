<?php

use Phalcon\Di\FactoryDefault\Cli as CliDi;
use Phalcon\Cli\Console as ConsoleApp;

define('APP_PATH', realpath(__DIR__));

/**
 * Read the services
 */
$di = new CliDi();

/**
 * Include general services
 */
include APP_PATH . '/config/services.php';

/**
 * Include general services
 */
include APP_PATH . '/config/services_cli.php';

/**
 * Call the autoloader service.  We don't need to keep the results.
 */
$di->getLoader();

/**
 * Get the configuration
 */
$config = $di->getConfig();

/**
 * Create a console application
 */
$console = new ConsoleApp($di);

/**
 * Register console modules
 */
$console->registerModules([
    'cli' => [
        'className' => '@@namespace@@\Modules\Cli\Module',
        'path' => APP_PATH . '/modules/cli/Module.php'
    ]
]);

/**
 * Setup the arguments to use the 'cli' module
 */
$arguments = ['module' => 'cli'];

/**
 * Process the console arguments
 */
foreach ($argv as $k => $arg) {
    if ($k == 1) {
        $arguments['task'] = $arg;
    } elseif ($k == 2) {
        $arguments['action'] = $arg;
    } elseif ($k >= 3) {
        $arguments['params'][] = $arg;
    }
}

try {

    /**
     * Handle
     */
    $console->handle($arguments);

    /**
     * If configs is set to true, then we print a new line at the end of each execution
     *
     * If we dont print a new line,
     * then the next command prompt will be placed directly on the left of the output
     * and it is less readable.
     *
     * You can disable this behaviour if the output of your application needs to don't have a new line at end
     */
    if (isset($config["printNewLine"]) && $config["printNewLine"]) {
        echo PHP_EOL;
    }

} catch (Exception $e) {
    echo $e->getMessage() . PHP_EOL;
    echo $e->getTraceAsString() . PHP_EOL;
    exit(255);
}
