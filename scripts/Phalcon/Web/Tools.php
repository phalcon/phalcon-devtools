<?php

/*
  +------------------------------------------------------------------------+
  | Phalcon Framework                                                      |
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

use Phalcon\Version,
	Phalcon\Script,
	Phalcon\Script\Color,
	Phalcon\Commands\CommandsListener,
	Phalcon\Di\FactoryDefault,
	Phalcon\Mvc\View;

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
    private static $_di;

	private static $_path = '..';

    private static $_admin_ip;

	private static $_options = array(
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
     * @param $controllerName
     */
    public static function getNavMenu($controllerName)
	{
		$uri = self::getUrl()->get();
		foreach (self::$_options as $controller => $option) {
			if ($controllerName == $controller) {
				echo '<li class="active">';
			} else {
				echo '<li>';
			}
			echo '<a href="'.$uri.'webtools.php?_url=/'.$controller.'">'.$option['caption'].'</a></li>'.PHP_EOL;
		}
	}

    /**
     * @param $controllerName
     * @param $actionName
     */
    public static function getMenu($controllerName, $actionName)
	{
		$uri = self::getUrl()->get();
		foreach (self::$_options[$controllerName]['options'] as $action => $option) {
			if ($actionName == $action) {
				echo '<li class="active">';
			} else {
				echo '<li>';
			}
			echo '<a href="' . $uri . 'webtools.php?_url=/' . $controllerName . '/' . $action . '">' . $option['caption'] . '</a></li>' . PHP_EOL;
		}
	}

	/**
	 * Returns the config object in the services container
	 *
	 * @return \Phalcon\Config
	 */
	public static function getConfig()
	{
		return self::$_di->getShared('config');
	}

	/**
	 * Returns the config object in the services container
	 *
	 * @return \Phalcon\Mvc\Url
	 */
	public static function getUrl()
	{
		return self::$_di->getShared('url');
	}

	/**
	 * Returns the config object in the services container
	 *
	 * @return \Phalcon\Mvc\Url
	 */
	public static function getConnection()
	{
		return self::$_di->getShared('db');
	}

    /**
     * Returns a local path
     *
     * @param string $path
     *
     * @return string
     */
    public static function getPath($path='')
	{
		if ($path) {
			return self::$_path.'/'.$path;
		} else {
			return self::$_path;
		}
	}

    /**
     * Executes the web tool application
     *
     * @param        $path
     * @param string $admin_ip
     *
     * @throws \Phalcon\Exception
     * @throws \Exception
     */
    public static function main($path,$admin_ip='')
	{

        self::$_admin_ip=$admin_ip;

		chdir('..');

		if (!extension_loaded('phalcon')) {
			throw new \Exception('Phalcon extension isn\'t installed, follow these instructions to install it: http://phalconphp.com/documentation/install');
		}

		//Read configuration
		$configPaths = array(
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
			throw new \Phalcon\Exception('Configuration file could not be loaded');

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
			throw new \Exception('Your Phalcon version isn\'t compatible with Developer Tools, download the latest at: http://phalconphp.com/download');
		}

		if (!defined('TEMPLATE_PATH')) {
			define('TEMPLATE_PATH', $path . '/templates');
		}

		try {

			$di = new FactoryDefault();

			$di->set('view', function() use ($path) {
				$view = new View();
				$view->setViewsDir($path . '/scripts/Phalcon/Web/Tools/views/');
				return $view;
			});

			$di->set('config', $config);

			$di->set('url', function() use ($config) {
				$url = new \Phalcon\Mvc\Url();
				$url->setBaseUri($config->application->baseUri);
				return $url;
			});

			$di->set('flash', function(){
				return new \Phalcon\Flash\Direct(array(
					'error' => 'alert alert-error',
					'success' => 'alert alert-success',
					'notice' => 'alert alert-info',
				));
			});

			$di->set('db', function() use ($config) {

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

			self::$_di = $di;

			$app = new \Phalcon\Mvc\Application();

			$app->setDi($di);

			echo $app->handle()->getContent();
		}
		catch(\Phalcon\Exception $e){
			echo get_class($e), ': ', $e->getMessage(), "<br>";
			echo nl2br($e->getTraceAsString());
		}
		catch(\PDOException $e){
			echo get_class($e), ': ', $e->getMessage(), "<br>";
			echo nl2br($e->getTraceAsString());
		}
	}

	/**
	 * Installs webtools
	 *
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
			$code = "<?php\ndefine('PTOOLSPATH', '{$tools}');\n/* you can set ADMINIP as IP 192.168.0.1 or SUBNET 192. or 10.0.2. or 86.84.124. */\ndefine('ADMINIP', '192.168.');\n";
			file_put_contents($configPath, $code);
		}
	}

    /**
     * Returns ADMINIP config object from the webtools.config.php
     *
     * @return string $_admin_ip
     */
    public static function getAdminIP()
    {
            return self::$_admin_ip;
    }

}
