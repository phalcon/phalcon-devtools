<?php

namespace @@namespace@@\Frontend;

use Phalcon\DiInterface;
use Phalcon\Loader;
use Phalcon\Mvc\View;
use Phalcon\Db\Adapter\Pdo\Mysql as DbAdapter;
use Phalcon\Mvc\ModuleDefinitionInterface;
@@iniConfigImport@@

class Module implements ModuleDefinitionInterface
{
    /**
     * Registers an autoloader related to the module
     *
     * @param DiInterface $dependencyInjector
     */
    public function registerAutoloaders(DiInterface $dependencyInjector = null)
    {

        $loader = new Loader();

        $loader->registerNamespaces(array(
            '@@namespace@@\Frontend\Controllers' => __DIR__ . '/controllers/',
            '@@namespace@@\Frontend\Models' => __DIR__ . '/models/',
        ));

        $loader->register();
    }

    /**
     * Registers services related to the module
     *
     * @param DiInterface $dependencyInjector
     */
    public function registerServices(DiInterface $dependencyInjector)
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
            return new DbAdapter($config->toArray());
        };
    }
}
