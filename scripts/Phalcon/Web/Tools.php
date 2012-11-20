<?php

/*
  +------------------------------------------------------------------------+
  | Phalcon Framework                                                      |
  +------------------------------------------------------------------------+
  | Copyright (c) 2011-2012 Phalcon Team (http://www.phalconphp.com)       |
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
use Phalcon\Script\Color;
use Phalcon\Commands\CommandsListener;


/**
 * Phalcon\Web\Tools
 *
 * Allows to use Phalcon Developer Tools with a web interface
 *
 * @category 	Phalcon
 * @package 	Scripts
 * @copyright   Copyright (c) 2011-2012 Phalcon Team (team@phalconphp.com)
 * @license 	New BSD License
 */
class Tools
{

	private static $_di;

	private static $_path = '..';

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
		),
		/*'config' => array(
			'caption' => 'Configuration',
			'options' => array(
				'index' => array(
					'caption' => 'Edit'
				)
			)
		),*/
	);

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

	public static function getMenu($controllerName, $actionName)
	{
		$uri = self::getUrl()->get();
		foreach (self::$_options[$controllerName]['options'] as $action => $option) {
			if ($actionName == $action) {
				echo '<li class="active">';
			} else {
				echo '<li>';
			}
			echo '<a href="'.$uri.'webtools.php?_url=/'.$controllerName.'/'.$action.'">'.$option['caption'].'</a></li>'.PHP_EOL;
		}
	}

	/**
	 * Returns the config object in the services container
	 *
	 * @return Phalcon\Config
	 */
	public static function getConfig()
	{
		return self::$_di->getShared('config');
	}

	/**
	 * Returns the config object in the services container
	 *
	 * @return Phalcon\Mvc\Url
	 */
	public static function getUrl()
	{
		return self::$_di->getShared('url');
	}

	/**
	 * Returns the config object in the services container
	 *
	 * @return Phalcon\Mvc\Url
	 */
	public static function getConnection()
	{
		return self::$_di->getShared('db');
	}

	/**
	 * Returns a local path
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
	 * @param string $path
	 */
	public static function main($path)
	{

		chdir('..');

		if (!extension_loaded('phalcon')) {
			throw new Exception('Phalcon extension isn\'t installed, follow these instructions to install it: http://phalconphp.com/documentation/install');
		}

		//Read configuration
		$configPath = "app/config/config.ini";
		if (file_exists($configPath)) {
			$config = new \Phalcon\Config\Adapter\Ini($configPath);
		} else {
			$configPath = "app/config/config.php";
			if (file_exists($configPath)) {
				$config = require $configPath;
			} else {
				throw new \Phalcon\Exception('Configuration file could not be loaded');
			}
		}

		$loader = new \Phalcon\Loader();

		$loader->registerDirs(array(
			$path . '/scripts/',
			$path . '/scripts/Phalcon/Web/Tools/controllers/'
		));

		$loader->registerNamespaces(array(
			'Phalcon' => $path.'/scripts/'
		));

		$loader->register();

		if (Version::getId() < Script::COMPATIBLE_VERSION) {
			throw new Exception('Your Phalcon version isn\'t compatible with Developer Tools, download the latest at: http://phalconphp.com/download');
		}

		if (!defined('TEMPLATE_PATH')) {
			define('TEMPLATE_PATH', $path . '/templates');
		}

		try {

			$di = new \Phalcon\Di\FactoryDefault();

			$di->set('view', function() use ($path) {
				$view = new \Phalcon\Mvc\View();
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
				return new \Phalcon\Db\Adapter\Pdo\Mysql(array(
					"host" => $config->database->host,
					"username" => $config->database->username,
					"password" => $config->database->password,
					"dbname" => $config->database->name
				));
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

		if(!is_dir('public/')){
			throw new Exception("Document root cannot be located");
		}

		TBootstrap::install($path);
		CodeMirror::install($path);

		copy($path.'webtools.php', 'public/webtools.php');

		$webToolsConfigPath = "public/webtools.config.php";

		if (PHP_OS == "WINNT") {
			$pToolsPath = str_replace("\\", "/", $path);
		} else {
			$pToolsPath = $path;
		}

		$code = "<?php\n\ndefine(\"PTOOLSPATH\", \"".realpath($pToolsPath)."\");\n\n";
		if(!file_exists($webToolsConfigPath)){
			file_put_contents($webToolsConfigPath, $code);
		}
	}

}
