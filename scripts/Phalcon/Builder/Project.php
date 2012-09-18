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

namespace Phalcon\Builder;

use Phalcon\Builder;
use Phalcon\Builder\Component;
use Phalcon\Script\Color;

/**
 * ProjectBuilderComponent
 *
 * Builder to create application skeletons
 *
 * @category 	Phalcon
 * @package 	Scripts
 * @copyright   Copyright (c) 2011-2012 Phalcon Team (team@phalconphp.com)
 * @license 	New BSD License
 * @version 	$Id: Application.php,v 7a54c57f039b 2011/10/19 23:41:19 andres $
 */
class Project extends Component {

	const TYPE_MICRO = 'micro';
	const TYPE_SIMPLE = 'simple';
	const TYPE_MODULE = 'module';

	private $_types = array(
//		self::TYPE_MICRO,
		self::TYPE_SIMPLE,
//		self::TYPE_MODULE,
	);

	private $_dirs = array(
		self::TYPE_SIMPLE => array(
			'app',
			'app/logs',
			'app/views',
			'app/config',
			'app/models',
			'app/controllers',
			'app/views/index',
			'app/views/layouts',
			'public',
			'public/img',
			'public/css',
			'public/temp',
			'public/files',
			'public/js',
			'.phalcon'
		)
	);

	/**
	 * @static
	 * @param $path
	 * @param $name
	 * @param $type
	 *
	 * @return void
	 */
	private static function createConfig($path, $templatePath, $name, $type)
	{
		if (file_exists($path.'app/config/config.' . $type) == false) {
			$str = file_get_contents($templatePath . '/project/config.' . $type);
			$str = preg_replace('/@@name@@/', $name, $str);
			file_put_contents($path.'app/config/config.' . $type, $str);
		}
	}

	/**
	 * Create ControllerBase
	 *
	 * @static
	 * @param $path
	 * @param $name
	 *
	 * @return void
	 */
	private static function createControllerBase($path, $templatePath, $name)
	{
		if (file_exists($path . 'app/controllers/ControllerBase.php') == false) {
			$str = file_get_contents($templatePath . '/project/controller.php');
			$str = preg_replace('/@@name@@/', $name, $str);
			file_put_contents($path . 'app/controllers/ControllerBase.php', $str);
		}
	}

	/**
	 * Create Bootstrap file by default of application
	 *
	 * @return void
	 */
	private static function createBootstrapFile($path, $templatePath, $useIniConfig)
	{
		if (file_exists($path . 'public/index.php') == false) {
			$config = '$config = include(__DIR__."/../app/config/config.php");';
			if ($useIniConfig) {
				$config = '$config = new \Phalcon\Config\Adapter\Ini(__DIR__."/../app/config/config.ini");';
			}

			$str = file_get_contents($templatePath . '/project/index.php');
			$str = preg_replace('/@@config@@/', $config, $str);
			file_put_contents($path . 'public/index.php', $str);
		}
	}

	/**
	 * Create indexController file
	 *
	 * @return void
	 */
	private static function createControllerFile($path)
	{
		$modelBuilder = new \Phalcon\Builder\Controller(array(
			'name' => 'index',
			'directory' => $path,
			'baseClass' => 'ControllerBase'
		));
		$modelBuilder->build();
	}

	/**
	 * Create .htaccess files by default of application
	 *
	 */
	private static function createHtaccessFiles($path, $templatePath)
	{

		if (file_exists($path . '.htaccess') == false) {
			$code = '<IfModule mod_rewrite.c>'.PHP_EOL.
				"\t".'RewriteEngine on'.PHP_EOL.
				"\t".'RewriteRule  ^$ public/    [L]'.PHP_EOL.
				"\t".'RewriteRule  (.*) public/$1 [L]'.PHP_EOL.
				'</IfModule>';
			file_put_contents($path.'.htaccess', $code);
		}

		if (file_exists($path . 'public/.htaccess') == false) {
			file_put_contents($path.'public/.htaccess', file_get_contents($templatePath . '/project/htaccess'));
		}

		if (file_exists($path.'index.html') == false) {
			$code = '<html><body><h1>Mod-Rewrite is not enabled</h1><p>Please enable rewrite module on your web server to continue</body></html>';
			file_put_contents($path.'index.html', $code);
		}

	}

	/**
	 * Create view files by default
	 *
	 */
	private static function createIndexViewFiles($path)
	{

		$file = $path.'app/views/index.phtml';
		if(!file_exists($file)){
			$str = '<!DOCTYPE html>'.PHP_EOL.
			'<html>'.PHP_EOL.
			"\t".'<head>'.PHP_EOL.
			"\t\t".'<title>Phalcon PHP Framework</title>'.PHP_EOL.
			"\t".'</head>'.PHP_EOL.
			"\t".'<body>'.PHP_EOL.
			"\t\t".'<?php echo $this->getContent(); ?>'.PHP_EOL.
			"\t".'</body>'.PHP_EOL.
			'</html>';
			file_put_contents($file, $str);
		}

		$file = $path.'app/views/index/index.phtml';
		if(!file_exists($file)){
			$str = '<h1>Congratulations!</h1>'.PHP_EOL.'You\'re now flying with Phalcon.';
			file_put_contents($file, $str);
		}
	}

	public function build()
	{
		$path = '';
		if (isset($this->_options['directory'])) {
			if ($this->_options['directory']) {
				$path = $this->_options['directory'] . '/';
			}
		}

		if (isset($this->_options['template-path'])) {
			$templatePath = $this->_options['template-path'];
		} else {
			$templatePath = str_replace('scripts/'.str_replace('\\', DIRECTORY_SEPARATOR, __CLASS__).'.php', '', __FILE__).'templates';
		}

		if (file_exists($path.'.phalcon')) {
			throw new BuilderException("Projects cannot be created inside Phalcon projects");
		}

		$name = null;
		if (isset($this->_options['name'])) {
			if ($this->_options['name']) {
				$name = $this->_options['name'];
				$path .= $this->_options['name'] . '/';
				if (file_exists($path)){
					throw new BuilderException("Directory " . $path . " already exists");
				}
				mkdir($path);
			}
		}

		$type = 'simple';
		if (isset($this->_options['type'])) {
			if (!in_array($this->_options['type'], $this->_types)) {
				throw new BuilderException('Type "' . $this->_options['type'] . '" is not supported yet');
			}
			$type = $this->_options['type'];
		}

		if (!is_writable($path)) {
			throw new BuilderException("Directory " . $path . " is not writable");
		}

		foreach ($this->_dirs[$type] as $dir) {
			@mkdir(rtrim($path, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . $dir);
		}

		if(isset($this->_options['useIniConfig'])){
			$useIniConfig = $this->_options['useIniConfig'];
		} else {
			$useIniConfig = false;
		}

		if ($useIniConfig) {
			self::createConfig($path, $templatePath, $name, 'ini');
		} else {
			self::createConfig($path, $templatePath, $name, 'php');
		}

		self::createBootstrapFile($path, $templatePath, $useIniConfig);
		self::createHtaccessFiles($path, $templatePath);
		self::createControllerBase($path, $templatePath, $name);
		self::createIndexViewFiles($path, $templatePath);
		self::createControllerFile($path, $templatePath);

		if ($this->_options['enableWebTools']) {
			// TODO implement
			// Phalcon_WebTools::install($path);
		}

		print Color::success('Project "' . $this->_options['name'] . '" was successfully created.') . PHP_EOL;

	}


}