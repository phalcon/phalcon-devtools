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
  +------------------------------------------------------------------------+
*/

namespace Phalcon\Web;

use Phalcon\Mvc\Application;
use Phalcon\Flash\Direct as Flash;
use Phalcon\Mvc\Url;
use Phalcon\Loader;
use Phalcon\Exception;
use Phalcon\Version;
use Phalcon\Script;
use Phalcon\Di\FactoryDefault;
use Phalcon\Mvc\View;
use Phalcon\Config;
use Phalcon\Config\Adapter\Ini as ConfigIni;
use Phalcon\Config\Adapter\Yaml as YamlConfig;
use Phalcon\Config\Adapter\Json as JsonConfig;

/**
 * Phalcon\Web\Tools
 *
 * Allows to use Phalcon Developer Tools with a web interface
 *
 * @package Phalcon\Web
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
     * @return string
     */
    public static function getNavMenu($controllerName)
    {
        $uri = self::getUrl()->get();
        $menu = '';

        foreach (self::$options as $controller => $option) {
            if ($controllerName == $controller) {
                $menu .= '<li class="active">';
            } else {
                $menu .= '<li>';
            }

            $ref = $uri . 'webtools.php?_url=/' . $controller;
            $menu .= '<a href="' . $ref . '">' . $option['caption'] . '</a></li>' . PHP_EOL;
        }

        return $menu;
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
     * @return \Phalcon\Db\AdapterInterface
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
        if (!extension_loaded('phalcon')) {
            throw new \Exception(
                "Phalcon extension isn't installed, follow these instructions to install it: " .
                'https://docs.phalconphp.com/en/latest/reference/install.html'
            );
        }

        if ($ip !== null) {
            self::$ip = $ip;
        }

        if (!defined('TEMPLATE_PATH')) {
            define('TEMPLATE_PATH', $path . '/templates');
        }

        $basePath = dirname(getcwd());
        // Dirs for search config file
        $configDirs = array(
            $basePath . '/config/',
            $basePath . '/app/config/',
            $basePath . '/apps/frontend/config/',
            $basePath . '/apps/backend/config/',
        );

        $config = null;

        foreach ($configDirs as $configPath) {
            if (file_exists($configPath . 'config.ini')) {
                $config = new ConfigIni($configPath . 'config.ini');

                break;
            } elseif (file_exists($configPath . 'config.php')) {
                $config = include($configPath . 'config.php');
                if (is_array($config)) {
                    $config = new Config($config);
                }

                break;
            } elseif (file_exists($configPath . 'config.yaml')) {
                $config = new YamlConfig($configPath . 'config.yaml');

                break;
            } elseif (file_exists($configPath . 'config.json')) {
                $config = new JsonConfig($configPath . 'config.json');

                break;
            }
        }

        if (null === $config) {
            throw new Exception(sprintf(
                "Configuration file couldn't be loaded! Scanned dirs: %s",
                implode(', ', $configDirs)
            ));
        }

        $loader = new Loader();

        $loader->registerDirs(array(
            $path . '/scripts/',
            $path . '/scripts/Phalcon/Web/Tools/controllers/'
        ));

        $loader->registerNamespaces(array(
            'Phalcon' => $path . '/scripts/'
        ));

        $loader->register();

        if (Version::getId() < Script::COMPATIBLE_VERSION) {
            throw new \Exception(
                sprintf(
                    "Your Phalcon version isn't compatible with Developer Tools, download the latest at: %s",
                    Script::DOC_DOWNLOAD_URL
                )
            );
        }

        try {
            $di = new FactoryDefault();

            $di->setShared('view', function () use ($path) {
                $view = new View();
                $view->setViewsDir($path . '/scripts/Phalcon/Web/Tools/views/');

                return $view;
            });

            $di->setShared('config', $config);

            $di->setShared('url', function () use ($config) {
                $url = new Url();

                if (isset($config->application->baseUri)) {
                    $baseUri = $config->application->baseUri;
                } elseif (isset($config->baseUri)) {
                    $baseUri = $config->baseUri;
                } else {
                    $baseUri = '/';
                }

                $url->setBaseUri($baseUri);

                return $url;
            });

            $di->setShared('flash', function () {
                return new Flash(array(
                    'error'   => 'alert alert-danger',
                    'success' => 'alert alert-success',
                    'notice'  => 'alert alert-info',
                    'warning' => 'alert alert-warning'
                ));
            });

            $di->setShared('db', function () use ($config) {

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

            $app = new Application();

            $app->setDi($di);

            echo $app->handle()->getContent();
        } catch (Exception $e) {
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
     * @return bool
     * @throws Exception if document root cannot be located
     */
    public static function install($path)
    {
        $path = realpath($path) . DIRECTORY_SEPARATOR;

        if (!$tools = getenv('PTOOLSPATH')) {
            $tools = realpath(__DIR__ . '/../../../');
        }

        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            $path = str_replace("\\", DIRECTORY_SEPARATOR, $path);
            $tools = str_replace("\\", DIRECTORY_SEPARATOR, $tools);
        }

        if (!is_dir($path . 'public' . DIRECTORY_SEPARATOR)) {
            throw new Exception('Document root cannot be located');
        }

        $bootstrap = new Bootstrap();
        $bootstrap->install($path);

        $codeMirror = new CodeMirror();
        $codeMirror->install($path);

        $jQuery = new JQuery();
        $jQuery->install($path);

        copy($tools . '/webtools.php', $path . 'public/webtools.php');

        if (!file_exists($configPath = $path . 'public/webtools.config.php')) {
            $template = file_get_contents(TEMPLATE_PATH . '/webtools.config.php');
            $code = str_replace('@@PATH@@', $tools, $template);

            file_put_contents($configPath, $code);
        }

        return true;
    }

    /**
     * Uninstall webtools
     *
     * @param  string $path
     * @return bool
     *
     * @throws \Exception
     */
    public static function uninstall($path)
    {
        $path = realpath($path) . DIRECTORY_SEPARATOR;
        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            $path = str_replace("\\", '/', $path);
        }

        if (!is_dir($path . 'public/')) {
            throw new \Exception('Document root cannot be located');
        }


        $bootstrap = new Bootstrap();
        $bootstrap->uninstall($path);

        $codeMirror = new CodeMirror();
        $codeMirror->uninstall($path);

        $jQuery = new JQuery();
        $jQuery->uninstall($path);


        if (is_file($path . 'public/webtools.config.php')) {
            unlink($path . 'public/webtools.config.php');
        }

        if (is_file($path . 'public/webtools.php')) {
            unlink($path . 'public/webtools.php');
        }

        return true;
    }
}
