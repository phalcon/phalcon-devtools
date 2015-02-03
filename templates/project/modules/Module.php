<?php

namespace @@namespace@@\Frontend;

use Phalcon\Loader;
use Phalcon\Mvc\View;
use Phalcon\Mvc\ModuleDefinitionInterface;
@@iniConfigImport@@

class Module implements ModuleDefinitionInterface
{

    /**
     * Registers the module auto-loader
     */
    public function registerAutoloaders()
    {

        $loader = new Loader();

        $loader->registerNamespaces(array(
            '@@namespace@@\Frontend\Controllers' => __DIR__ . '/controllers/',
            '@@namespace@@\Frontend\Models' => __DIR__ . '/models/',
        ));

        $loader->register();
    }

    /**
     * Registers the module-only services
     *
     * @param Phalcon\DI $di
     */
    public function registerServices($di)
    {

        /**
         * Read configuration
         */
        $config = @@configLoader@@;

        /**
         * Setting up the view component
         */
        $di['view'] = function () {
            $view = new View();
            $view->setViewsDir(__DIR__ . '/views/');

            return $view;
        };

        /**
         * Database connection is created based in the parameters defined in the configuration file
         */
        $di['db'] = function () use ($config) {
            $dbClass = 'Phalcon\Db\Adapter\Pdo\\' . $config->database->adapter;
            return new $dbClass($config->database->toArray());
        };
    }

}
