<?php
declare(strict_types=1);

namespace @@FQMN@@;

use Phalcon\Di\DiInterface;
use Phalcon\Loader;
use Phalcon\Mvc\View;
use Phalcon\Mvc\View\Engine\Php as PhpEngine;
use Phalcon\Mvc\ModuleDefinitionInterface;
@@iniConfigImport@@
@@useConfig@@

class Module implements ModuleDefinitionInterface
{
    /**
     * Registers an autoloader related to the module
     *
     * @param DiInterface $container
     */
    public function registerAutoloaders(DiInterface $container = null)
    {
        $loader = new Loader();

        $loader->registerNamespaces([
            '@@FQMN@@\Controllers' => __DIR__ . '/controllers/',
            '@@FQMN@@\Models'      => __DIR__ . '/models/'
        ]);

        $loader->register();
    }

    /**
     * Registers services related to the module
     *
     * @param DiInterface $container
     */
    public function registerServices(DiInterface $container)
    {
        /**
         * Try to load local configuration
         */
        if (file_exists(@@configName@@)) {

            $config = $container['config'];

            $override = @@configLoader@@;

            if ($config instanceof Config) {
                $config->merge($override);
            } else {
                $config = $override;
            }
        }

        /**
         * Setting up the view component
         */
        $container['view'] = function () {
            $config = $this->getConfig();

            $view = new View();
            $view->setViewsDir($config->get('application')->viewsDir);

            $view->registerEngines([
                '.volt'  => 'voltShared',
                '.phtml' => PhpEngine::class
            ]);

            return $view;
        };

        /**
         * Database connection is created based in the parameters defined in the configuration file
         */
        $container['db'] = function () {
            $config = $this->getConfig();

            $dbConfig = $config->database->toArray();

            $dbAdapter = '\Phalcon\Db\Adapter\Pdo\\' . $dbConfig['adapter'];
            unset($config['adapter']);

            return new $dbAdapter($dbConfig);
        };
    }
}
