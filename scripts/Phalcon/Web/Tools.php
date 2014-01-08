<?php

/*
  +------------------------------------------------------------------------+
  | Phalcon Developer Tools                                                |
  +------------------------------------------------------------------------+
  | Copyright (c) 2011-2014 Phalcon Team (http://www.phalconphp.com)       |
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
  +------------------------------------------------------------------------+
*/

namespace Phalcon\Web;

use Phalcon\Version;
use Phalcon\Script;
use Phalcon\Di\FactoryDefault;
use Phalcon\Mvc\View;

/**
 * Phalcon\Web\Tools
 *
 * Allows to use Phalcon Developer Tools with a web interface
 *
 * @category 	Phalcon
 * @package 	Scripts
 * @copyright   Copyright (c) 2011-2014 Phalcon Team (team@phalconphp.com)
 * @license 	New BSD License
 */
class Tools
{
    /**
     * @var \Phalcon\DI
     */
    private static $di;

    /**
     * Optional IP address for securing Phalcon Developers Tools area
     *
     * @var string
     */
    private static $ip = null;

    /**
     * Navigation
     *
     * @var array
     */
    private static $options = array(
        'index' => array(
            'caption' => 'Home',
            'options' => array(
                'index' => array(
                    'caption' => 'Welcome'
                )
            )
        ),
        'controllers' => array(
            'caption' => 'Controllers',
            'options' => array(
                'index' => array(
                    'caption' => 'Generate',
                ),
                'list' => array(
                    'caption' => 'List',
                )
            )
        ),
        'models' => array(
            'caption' => 'Models',
            'options' => array(
                'index' => array(
                    'caption' => 'Generate'
                ),
                'list' => array(
                    'caption' => 'List',
                )
            )
        ),
        'scaffold' => array(
            'caption' => 'Scaffold',
            'options' => array(
                'index' => array(
                    'caption' => 'Generate'
                )
            )
        ),
        'migrations' => array(
            'caption' => 'Migrations',
            'options' => array(
                'index' => array(
                    'caption' => 'Generate'
                ),
                'run' => array(
                    'caption' => 'Run'
                )
            )
        )
    );

    /**
     * Print navigation menu of the given controller
     *
     * @param  string $controllerName
     * @return void
     */
    public static function getNavMenu($controllerName)
    {
        $uri = self::getUrl()->get();

        foreach (self::$options as $controller => $option) {
            if ($controllerName == $controller) {
                echo '<li class="active">';
            } else {
                echo '<li>';
            }

            $ref = $uri . 'webtools.php?_url=/' . $controller;
            echo '<a href="' . $ref . '">' . $option['caption'] . '</a></li>' . PHP_EOL;
        }
    }

    /**
     * Print menu of the given controller action
     *
     * @param  string $controllerName
     * @param  string $actionName
     * @return void
     */
    public static function getMenu($controllerName, $actionName)
    {
        $uri = self::getUrl()->get();

        foreach (self::$options[$controllerName]['options'] as $action => $option) {
            if ($actionName == $action) {
                echo '<li class="active">';
            } else {
                echo '<li>';
            }

            $ref = $uri . 'webtools.php?_url=/' . $controllerName . '/' . $action;
            echo '<a href="' . $ref . '">' . $option['caption'] . '</a></li>' . PHP_EOL;
        }
    }

    /**
     * Return the config object in the services container
     *
     * @return \Phalcon\Config
     */
    public static function getConfig()
    {
        return self::$di->getShared('config');
    }

    /**
     * Return the config object in the services container
     *
     * @return \Phalcon\Mvc\Url
     */
    public static function getUrl()
    {
        return self::$di->getShared('url');
    }

    /**
     * Return the config object in the services container
     *
     * @return \Phalcon\Mvc\Url
     */
    public static function getConnection()
    {
        return self::$di->getShared('db');
    }

    /**
     * Return an optional IP address for securing Phalcon Developers Tools area
     *
     * @return string
     */
    public static function getToolsIp()
    {
        return self::$ip;
    }

    /**
     * Execute Phalcon Developer Tools
     *
     * @param  string             $path The path to the Phalcon Developer Tools
     * @param  string             $ip   Optional IP address for securing Developer Tools
     * @return void
     * @throws \Exception         if Phalcon extension is not installed
     * @throws \Exception         if Phalcon version is not compatible Developer Tools
     * @throws \Phalcon\Exception if Application config could not be loaded
     */
    public static function main($path, $ip = null)
    {
        if ( ! extension_loaded('phalcon'))
            throw new \Exception('Phalcon extension is not installed, follow these instructions to install it: http://phalconphp.com/documentation/install');

        if ($ip !== null) {
            self::$ip = $ip;
        }

        if ( ! defined('TEMPLATE_PATH')) {
            define('TEMPLATE_PATH', $path . '/templates');
        }

        chdir('..');

        // Read configuration
        $configPaths = array(
            'config',
            'app/config',
            'apps/frontend/config'
        );

        $readed = false;

        foreach ($configPaths as $configPath) {
            $cpath = $configPath . '/config.ini';

            if (file_exists($cpath)) {
                $config = new \Phalcon\Config\Adapter\Ini($cpath);
                $readed = true;

                break;
            } else {
                $cpath = $configPath . '/config.php';

                if (file_exists($cpath)) {
                    $config = require $cpath;
                    $readed = true;

                    break;
                }
            }
        }

        if ($readed === false)
            throw new \Phalcon\Exception('Configuration file could not be loaded!');

        $loader = new \Phalcon\Loader();

        $loader->registerDirs(array(
            $path . '/scripts/',
            $path . '/scripts/Phalcon/Web/Tools/controllers/'
        ));

        $loader->registerNamespaces(array(
            'Phalcon' => $path . '/scripts/'
        ));

        $loader->register();

        if (Version::getId() < Script::COMPATIBLE_VERSION) {
            throw new \Exception('Your Phalcon version is not compatible with Developer Tools, download the latest at: http://phalconphp.com/download');
        }

        try {

            $di = new FactoryDefault();

            $di->set('view', function () use ($path) {
                $view = new View();
                $view->setViewsDir($path . '/scripts/Phalcon/Web/Tools/views/');

                return $view;
            });

            $di->set('config', $config);

            $di->set('url', function () use ($config) {
                $url = new \Phalcon\Mvc\Url();
                $url->setBaseUri($config->application->baseUri);

                return $url;
            });

            $di->set('flash', function () {
                return new \Phalcon\Flash\Direct(array(
                    'error' => 'alert alert-error',
                    'success' => 'alert alert-success',
                    'notice' => 'alert alert-info',
                ));
            });

            $di->set('db', function () use ($config) {

                if (isset($config->database->adapter)) {
                    $adapter = $config->database->adapter;
                } else {
                    $adapter = 'Mysql';
                }

                if (is_object($config->database)) {
                    $configArray = $config->database->toArray();
                } else {
                    $configArray = $config->database;
                }

                $className = 'Phalcon\Db\Adapter\Pdo\\' . $adapter;
                unset($configArray['adapter']);

                return new $className($configArray);
            });

            self::$di = $di;

            $app = new \Phalcon\Mvc\Application();

            $app->setDi($di);

            echo $app->handle()->getContent();
        } catch (\Phalcon\Exception $e) {
            echo get_class($e), ': ', $e->getMessage(), "<br>";
            echo nl2br($e->getTraceAsString());
        } catch (\PDOException $e) {
            echo get_class($e), ': ', $e->getMessage(), "<br>";
            echo nl2br($e->getTraceAsString());
        }
    }

    /**
     * Install webtools
     *
     * @param  string     $path
     * @return void
     * @throws \Exception if document root cannot be located
     */
    public static function install($path)
    {
        $path = rtrim(realpath($path), '/') . '/';
        $tools = realpath(__DIR__ . '/../../../');

        if (PHP_OS == 'WINNT') {
            $path = str_replace("\\", '/', $path);
            $tools = str_replace("\\", '/', $tools);
        }

        if ( ! is_dir($path . 'public/')) {
            throw new \Exception('Document root cannot be located');
        }

        TBootstrap::install($path);
        CodeMirror::install($path);

        copy($tools . '/webtools.php', $path . 'public/webtools.php');

        if ( ! file_exists($configPath = $path . 'public/webtools.config.php')) {
            $template = file_get_contents(TEMPLATE_PATH . '/webtools.config.php');
            $code = str_replace('@@PATH@@', $tools, $template);

            file_put_contents($configPath, $code);
        }
    }

    /**
     * Uninstall webtools
     *
     * @param  string $path
     * @return void
     */
    public static function uninstall($path)
    {
        $path = rtrim(realpath($path), '/') . '/';
        if (PHP_OS == 'WINNT') {
            $path = str_replace("\\", '/', $path);
        }

        if ( ! is_dir($path . 'public/')) {
            throw new \Exception('Document root cannot be located');
        }

        TBootstrap::uninstall($path);
        CodeMirror::uninstall($path);

        if (is_file($path . 'public/webtools.config.php')) {
            unlink($path . 'public/webtools.config.php');
        }

        if (is_file($path . 'public/webtools.php')) {
            unlink($path . 'public/webtools.php');
        }
    }
}
