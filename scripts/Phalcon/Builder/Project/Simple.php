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

namespace Phalcon\Builder\Project;

/**
 * Simple
 *
 * Builder to create simple application skeletons
 *
 * @category 	Phalcon
 * @package 	Scripts
 * @copyright   Copyright (c) 2011-2012 Phalcon Team (team@phalconphp.com)
 * @license 	New BSD License
 */
class Simple extends ProjectBuilder
{

	private $_dirs = array(
		'app',
		'app/cache',
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
	);

	/**
	 * Create indexController file
	 *
	 * @return void
	 */
	private function createControllerFile($path)
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
	private function createHtaccessFiles($path, $templatePath)
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
			file_put_contents($path.'public/.htaccess', file_get_contents($templatePath . '/project/simple/htaccess'));
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
	private function createIndexViewFiles($path, $templatePath)
	{

		$file = $path.'app/views/index.volt';
		if (!file_exists($file)) {
			$str = file_get_contents($templatePath . '/project/simple/views/index.volt');
			file_put_contents($file, $str);
		}

		$file = $path.'app/views/index/index.volt';
		if (!file_exists($file)) {
			$str = file_get_contents($templatePath . '/project/simple/views/index/index.volt');
			file_put_contents($file, $str);
		}

		return;

		$file = $path.'app/views/index.phtml';
		if (!file_exists($file)) {
			$str = file_get_contents($templatePath . '/project/simple/views/index.phtml');
			file_put_contents($file, $str);
		}

		$file = $path.'app/views/index/index.phtml';
		if (!file_exists($file)) {
			$str = file_get_contents($templatePath . '/project/simple/views/index/index.phtml');
			file_put_contents($file, $str);
		}
	}

	/**
	 * Creates the configuration
	 *
	 * @param $path
	 * @param $name
	 * @param $type
	 *
	 * @return void
	 */
	private function createConfig($path, $templatePath, $name, $type)
	{
		$file = $path . 'app/config/config.' . $type;
		if (file_exists($file) == false) {
			$str = file_get_contents($templatePath . '/project/simple/config.' . $type);
			$str = preg_replace('/@@name@@/', $name, $str);
			file_put_contents($file, $str);
		}

		$file = $path . 'app/config/loader.php';
		if (file_exists($file) == false) {
			$str = file_get_contents($templatePath . '/project/simple/loader.php');
			file_put_contents($file, $str);
		}

		$file = $path . 'app/config/services.php';
		if (file_exists($file) == false) {
			$str = file_get_contents($templatePath . '/project/simple/services.php');
			file_put_contents($file, $str);
		}
	}

	/**
	 * Create ControllerBase
	 *
	 * @param $path
	 * @param $name
	 *
	 * @return void
	 */
	private function createControllerBase($path, $templatePath, $name)
	{
		if (file_exists($path . 'app/controllers/ControllerBase.php') == false) {
			$str = file_get_contents($templatePath . '/project/simple/ControllerBase.php');
			$str = preg_replace('/@@name@@/', $name, $str);
			file_put_contents($path . 'app/controllers/ControllerBase.php', $str);
		}
	}

	/**
	 * Create Bootstrap file by default of application
	 *
	 * @return void
	 */
	private function createBootstrapFile($path, $templatePath, $useIniConfig)
	{
		if (file_exists($path . 'public/index.php') == false) {
			$config = '$config = include __DIR__ . "/../app/config/config.php";';
			if ($useIniConfig) {
				$config = '$config = new \Phalcon\Config\Adapter\Ini(__DIR__ . "/../app/config/config.ini");';
			}
			$str = file_get_contents($templatePath . '/project/simple/index.php');
			$str = preg_replace('/@@config@@/', $config, $str);
			file_put_contents($path . 'public/index.php', $str);
		}
	}

	public function build($name, $path, $templatePath, $options)
	{

        $this->buildDirectories($this->_dirs,$path);

		if (isset($options['useConfigIni'])) {
			$useIniConfig = $options['useConfigIni'];
		} else {
			$useIniConfig = false;
		}

		if ($useIniConfig) {
			$this->createConfig($path, $templatePath, $name, 'ini');
		} else {
			$this->createConfig($path, $templatePath, $name, 'php');
		}

		$this->createBootstrapFile($path, $templatePath, $useIniConfig);
		$this->createHtaccessFiles($path, $templatePath);
		$this->createControllerBase($path, $templatePath, $name);
		$this->createIndexViewFiles($path, $templatePath);
		$this->createControllerFile($path, $templatePath);

		if ($options['enableWebTools']) {
			\Phalcon\Web\Tools::install($path);
		}

		return true;
	}

}