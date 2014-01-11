<?php

use Phalcon\DI\FactoryDefault\CLI as CliDI;
use Phalcon\CLI\Console as ConsoleApp;

/**
 * Read auto-loader
 */
include __DIR__ . '/config/loader.php';

/**
 * Read the configuration
 */
$config = include __DIR__ . '/config/config.php';

/**
 * Read the services
 */
$di = new CliDI();
include __DIR__ . '/config/services.php';

/**
 * Create a console application
 */
$console = new ConsoleApp();
$console->setDI($di);

/**
 * Process the console arguments
 */
$arguments = array();
$params = array();

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
    if(isset($config["printNewLine"]) && $config["printNewLine"] )
        echo PHP_EOL;
} catch (\Phalcon\Exception $e) {
    echo $e->getMessage();
    exit(255);
}
