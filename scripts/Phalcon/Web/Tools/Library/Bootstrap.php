<?php

/*
  +------------------------------------------------------------------------+
  | Phalcon Developer Tools                                                |
  +------------------------------------------------------------------------+
  | Copyright (c) 2011-2016 Phalcon Team (http://www.phalconphp.com)       |
  +------------------------------------------------------------------------+
  | This source file is subject to the New BSD License that is bundled     |
  | with this package in the file docs/LICENSE.txt.                        |
  |                                                                        |
  | If you did not receive a copy of the license and are unable to         |
  | obtain it through the world-wide-web, please send an email             |
  | to license@phalconphp.com so we can send you a copy immediately.       |
  +------------------------------------------------------------------------+
  | Authors: Andres Gutierrez <andres@phalconphp.com>                      |
  |          Eduar Carvajal <eduar@phalconphp.com>                         |
  |          Serghei Iakovlev <serghei@phalconphp.com>                     |
  +------------------------------------------------------------------------+
*/

namespace Phalcon\Web\Tools\Library;

use Phalcon\Text;
use Phalcon\Config;
use Phalcon\Mvc\View;
use Phalcon\Exception;
use Phalcon\DiInterface;
use Phalcon\Events\Event;
use Phalcon\Db\Adapter\Pdo;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Mvc\Application;
use Phalcon\Di\FactoryDefault;
use Phalcon\Db\AdapterInterface;
use Phalcon\Mvc\View\Engine\Php;
use Phalcon\Flash\Direct as Flash;
use Phalcon\Mvc\Url as UrlResolver;
use Phalcon\Flash\Session as FlashSession;
use Phalcon\Events\Manager as EventsManager;
use Phalcon\Config\Adapter\Ini as IniConfig;
use Phalcon\Config\Adapter\Yaml as YamlConfig;
use Phalcon\Config\Adapter\Json as JsonConfig;
use Phalcon\Mvc\View\Engine\Volt as VoltEngine;
use Phalcon\Application as AbstractApplication;
use Phalcon\Mvc\View\Exception as ViewException;
use Phalcon\Web\Tools\Library\Mvc\View\Engine\Volt\Extension\Php as PhpExt;
use Phalcon\Web\Tools\Library\Mvc\Dispatcher\ErrorHandler as DispatchErrorHandler;

/**
 * \Phalcon\Web\Tools\Library\Bootstrap
 *
 * @package Phalcon\Web\Tools\Library
 */
class Bootstrap
{
    /**
     * Application instance.
     * @var AbstractApplication
     */
    private $app;

    /**
     * The services container.
     * @var FactoryDefault
     */
    private $di;

    /**
     * The path to the Phalcon Developers Tools.
     * @var string
     */
    private $ptoolsPath = '';

    /**
     * The allowed IP for access.
     * @var string
     */
    private $ptoolsIp = '';

    /**
     * The path where the project was created.
     * @var string
     */
    private $basePath = '';

    /**
     * The current application mode.
     * @var string
     */
    private $mode = 'web';

    private $configurable = [
        'ptools_path',
        'ptools_ip',
    ];

    private $loaders = [
        'web' => [
            'eventsManager',
            'config',
            'view',
            'url',
            'dispatcher',
            'flash',
            'database',
        ],
    ];

    /**
     * Bootstrap constructor.
     *
     * @param array $parameters
     */
    public function __construct(array $parameters = [])
    {
        $defines = [
            'PTOOLSPATH' => 'ptoolsPath',
            'PTOOLS_IP'  => 'ptoolsIp',
            'BASE_PATH'  => 'basePath'
        ];

        foreach ($defines as $const => $property) {
            if (defined($const)) {
                $this->{$property} = rtrim(trim(constant($const)), '\\/');
            }
        }

        $this->setParams($parameters);

        $this->di  = new FactoryDefault;
        $this->app = new Application;

        foreach ($this->loaders[$this->mode] as $service) {
            $serviceName = ucfirst($service);
            $this->{'init' . $serviceName}();
        }

        $this->app->setEventsManager($this->di->getShared('eventsManager'));

        $this->di->setShared('application', $this->app);
        $this->app->setDI($this->di);
    }

    /**
     * Runs the Application.
     *
     * @return AbstractApplication|string
     */
    public function run()
    {
        if (ENV_TESTING === APPLICATION_ENV) {
            return $this->app;
        }

        return $this->getOutput();
    }

    /**
     * Get application output.
     *
     * @return string
     */
    public function getOutput()
    {
        /** @var \Phalcon\Mvc\Application $app */
        $app = $this->app;

        return $this->app->handle()->getContent();
    }

    /**
     * Set the WebTools params.
     *
     * @param array $params
     *
     * @return $this
     */
    public function setParams(array $params)
    {
        foreach ($this->configurable as $param) {
            if (!isset($params[$param])) {
                continue;
            }

            $method = 'set' . Text::camelize($param);

            if (method_exists($this, $method)) {
                $this->$method($params[$param]);
            }
        }

        return $this;
    }

    /**
     * Sets the path to the Phalcon Developers Tools.
     *
     * @param string $path
     *
     * @return $this
     */
    public function setPtoolsPath($path)
    {
        $this->ptoolsPath = rtrim($path, '\\/');

        return $this;
    }

    /**
     * Gets the path to the Phalcon Developers Tools.
     *
     * @return string
     */
    public function getPtoolsPath()
    {
        return $this->ptoolsPath;
    }

    /**
     * Sets the allowed IP for access.
     *
     * @param string $ip
     *
     * @return $this
     */
    public function setPtoolsIp($ip)
    {
        $this->ptoolsIp = trim($ip);

        return $this;
    }

    /**
     * Gets the allowed IP for access.
     *
     * @return string
     */
    public function getPtoolsIp()
    {
        return $this->ptoolsIp;
    }

    /**
     * Sets the path where the project was created.
     *
     * @param string $path
     *
     * @return $this
     */
    public function setBasePath($path)
    {
        $this->basePath = rtrim($path, '\\/');

        return $this;
    }

    /**
     * Gets the path where the project was created.
     *
     * @return string
     */
    public function getBasePath()
    {
        return $this->basePath;
    }

    /**
     * Sets the current application mode.
     *
     * @param string $mode
     *
     * @return $this
     */
    public function setMode($mode)
    {
        $mode = strtolower(trim($mode));

        if (isset($this->loaders[$mode])) {
            $mode = 'web'; // @todo
        }

        $this->mode = $mode;

        return $this;
    }

    /**
     * Gets the current application mode.
     *
     * @return string
     */
    public function getMode()
    {
        return $this->mode;
    }

    /**
     * Initialize the Application Events Manager.
     */
    protected function initEventsManager()
    {
        $this->di->setShared(
            'eventsManager',
            function () {
                $em = new EventsManager;
                $em->enablePriorities(true);

                return $em;
            }
        );
    }

    /**
     * Initialize the Application Config.
     */
    protected function initConfig()
    {
        $path = $this->basePath;

        $this->di->setShared(
            'config',
            function () use ($path) {
                $configDirs = [
                    'config',
                    'app/config',
                    'apps/config',
                    'app/frontend/config',
                    'apps/frontend/config',
                    'app/backend/config',
                    'apps/backend/config',
                ];

                $configAdapters = [
                    'ini'  => IniConfig::class,
                    'json' => JsonConfig::class,
                    'php'  => Config::class,
                    'php5' => Config::class,
                    'inc'  => Config::class,
                    'yml'  => YamlConfig::class,
                    'yaml' => YamlConfig::class,
                ];

                $config = null;

                // @todo Add scan for dev config
                foreach ($configDirs as $configPath) {
                    $probablyPath = $path . DS . str_replace('/', DS, $configPath);

                    foreach ($configAdapters as $ext => $adapter) {
                        $probablyConfig = $probablyPath . DS . 'config.' . $ext;

                        if (is_file($probablyConfig) && is_readable($probablyConfig)) {
                            if (in_array($ext, ['php', 'php5', 'inc'])) {
                                /** @noinspection PhpIncludeInspection */
                                $config = include($probablyConfig);
                                if (is_array($config)) {
                                    $config = new Config($config);
                                }
                            } else {
                                $config = new $adapter($probablyConfig);
                            }

                            // @todo Log found config path here
                            break(2);
                        }
                    }
                }

                if (!$config instanceof Config) {
                    trigger_error(
                        sprintf(
                            "Configuration file couldn't be loaded! Scanned dirs: %s",
                            join(', ', array_map(function ($val) use ($path) {
                                return $path . DS . str_replace('/', DS, $val);
                            }, $configDirs))
                        ),
                        E_USER_ERROR
                    );
                }

                return $config;
            }
        );
    }

    /**
     * Initialize the View.
     */
    protected function initView()
    {
        $path = $this->ptoolsPath;

        $this->di->setShared(
            'view',
            function () use ($path) {
                $view = new View;
                $view->setViewsDir(
                    $path . DS . str_replace('/', DS, 'scripts/Phalcon/Web/Tools/Views') . DS
                );

                return $view;
            }
        );
    }

    /**
     * Initialize the Url service.
     */
    protected function initUrl()
    {
        $this->di->setShared(
            'url',
            function () {
                /**
                 * @var DiInterface $this
                 * @var Config $config
                 */
                $config = $this->getShared('config');

                $url = new UrlResolver;

                if ($config->get('application', new Config)->get('baseUri')) {
                    $baseUri = $config->get('application', new Config)->get('baseUri');
                } elseif ($config->get('baseUri')) {
                    $baseUri = $config->get('baseUri');
                } else {
                    // @todo Log notice here
                    $baseUri = '/';
                }

                if ($config->get('application', new Config)->get('staticUri')) {
                    $staticUri = $config->get('application', new Config)->get('staticUri');
                } elseif ($config->get('staticUri')) {
                    $staticUri = $config->get('staticUri');
                } else {
                    // @todo Log notice here
                    $staticUri = '/';
                }

                $url->setBaseUri($baseUri);
                $url->setStaticBaseUri($staticUri);

                return $url;
            }
        );
    }

    /**
     * Initialize the Dispatcher.
     */
    protected function initDispatcher()
    {
        $this->di->setShared(
            'dispatcher',
            function () {
                /** @var DiInterface $this */
                $em = $this->get('eventsManager');

                $dispatcher = new Dispatcher;
                $dispatcher->setDefaultNamespace('WebTools\Controllers');

                // @todo Attach access manager to the Events Manager
                $em->attach('dispatch:beforeException', new DispatchErrorHandler, 999);

                $dispatcher->setEventsManager($em);

                return $dispatcher;
            }
        );
    }

    /**
     * Initialize the Flash Service.
     */
    protected function initFlash()
    {
        $this->di->setShared(
            'flash',
            function () {
                return new Flash(
                    [
                        'error'   => 'alert alert-danger fade in',
                        'success' => 'alert alert-success fade in',
                        'notice'  => 'alert alert-info fade in',
                        'warning' => 'alert alert-warning fade in',
                    ]
                );
            }
        );

        $this->di->setShared(
            'flashSession',
            function () {
                return new FlashSession([
                    'error'   => 'alert alert-danger fade in',
                    'success' => 'alert alert-success fade in',
                    'notice'  => 'alert alert-info fade in',
                    'warning' => 'alert alert-warning fade in',
                ]);
            }
        );
    }

    /**
     * Initialize the Database connection.
     */
    protected function initDatabase()
    {
        $this->di->setShared(
            'db',
            function () {
                /** @var DiInterface $this */
                $em   = $this->getShared('eventsManager');
                $that = $this;

                if ($this->getShared('config')->get('database')) {
                    $config = $this->getShared('config')->get('database')->toArray();
                } elseif ($this->getShared('config')->get('db')) {
                    $config = $this->getShared('config')->get('db')->toArray();
                } else {
                    trigger_error('Unable to initialize "db" service. Used default config', E_USER_NOTICE);
                    // @todo
                    $config = [
                        'adapter' => 'Sqlite',
                        'dbname'  => sys_get_temp_dir() . DS . 'phalcon.sqlite',
                    ];
                }

                $adapter = 'Phalcon\Db\Adapter\Pdo\\' . $config;
                unset($config['adapter']);

                /** @var Pdo $connection */
                $connection = new $adapter($config);

                $em->attach(
                    'db',
                    function ($event, $connection) use ($that) {
                        /**
                         * @var Event            $event
                         * @var AdapterInterface $connection
                         * @var DiInterface      $that
                         */
                        if ($that->has('logger') && $event->getType() == 'beforeQuery') {
                            $variables = $connection->getSQLVariables();
                            $string    = $connection->getSQLStatement();

                            if ($variables) {
                                $string .= ' [' . join(', ', $variables) . ']';
                            }

                            // To disable logging change logLevel in config
                            $that->get('logger', ['db.log'])->debug($string);
                        }
                    }
                );

                $connection->setEventsManager($em);

                return $connection;
            }
        );
    }
}
