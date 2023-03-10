<?php
declare(strict_types=1);

use Phalcon\Di\FactoryDefault\Cli as FactoryDefault;
use Phalcon\Cli\Console as ConsoleApp;

define('BASE_PATH', dirname(__DIR__));
define('APP_PATH', BASE_PATH . '/app');

/**
 * The FactoryDefault Dependency Injector automatically registers the services that
 * provide a full stack framework. These default services can be overidden with custom ones.
 */
$di = new FactoryDefault();

/**
 * Include general services
 */
include APP_PATH . '/config/services.php';

/**
 * Include cli environment specific services
 */
include APP_PATH . '/config/services_cli.php';

/**
 * Include Autoloader
 */
include APP_PATH . '/config/loader.php';

/**
 * Get config service for use in inline setup below
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
    'cli' => ['className' => '@@namespace@@\Modules\Cli\Module']
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
