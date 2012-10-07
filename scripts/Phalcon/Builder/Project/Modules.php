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
class Modules
{

	private $_dirs = array(
		'apps/',
		'apps/frontend',
		'apps/frontend/logs',
		'apps/frontend/views',
		'apps/frontend/config',
		'apps/frontend/models',
		'apps/frontend/controllers',
		'apps/frontend/views/index',
		'apps/frontend/views/layouts',
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
	private function createControllerFile($path, $name)
	{
		$modelBuilder = new \Phalcon\Builder\Controller(array(
			'name' => 'index',
			'controllersDir' => '../'.$path.'apps/frontend/controllers/',
			'namespace' => ucfirst($name).'\Frontend\Controllers',
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
			file_put_contents($path.'public/.htaccess', file_get_contents($templatePath . '/project/modules/htaccess'));
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

		$file = $path.'apps/frontend/views/index.phtml';
		if (!file_exists($file)) {
			$str = file_get_contents($templatePath . '/project/modules/views/index.phtml');
			file_put_contents($file, $str);
		}

		$file = $path.'apps/frontend/views/index/index.phtml';
		if (!file_exists($file)) {
			$str = file_get_contents($templatePath . '/project/modules/views/index/index.phtml');
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
		if (file_exists($path.'apps/frontend/config/config.' . $type) == false) {
			$str = file_get_contents($templatePath . '/project/modules/config.' . $type);
			$str = preg_replace('/@@name@@/', $name, $str);
			file_put_contents($path.'apps/frontend/config/config.' . $type, $str);
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
		if (file_exists($path . 'apps/frontend/controllers/ControllerBase.php') == false) {
			$str = file_get_contents($templatePath . '/project/modules/ControllerBase.php');
			$str = preg_replace('/@@namespace@@/', ucfirst($name), $str);
			file_put_contents($path . 'apps/frontend/controllers/ControllerBase.php', $str);
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
	private function createModule($path, $templatePath, $name)
	{
		if (file_exists($path . 'apps/frontend/Module.php') == false) {
			$str = file_get_contents($templatePath . '/project/modules/Module.php');
			$str = preg_replace('/@@namespace@@/', ucfirst($name), $str);
			file_put_contents($path . 'apps/frontend/Module.php', $str);
		}
	}

	/**
	 * Create Bootstrap file by default of application
	 *
	 * @return void
	 */
	private function createBootstrapFile($name, $path, $templatePath)
	{
		if (file_exists($path . 'public/index.php') == false) {
			$str = file_get_contents($templatePath . '/project/modules/index.php');
			$str = preg_replace('/@@namespace@@/', ucfirst($name), $str);
			$str = preg_replace('/@@name@@/', $name, $str);
			file_put_contents($path . 'public/index.php', $str);
		}
	}

	public function build($name, $path, $templatePath, $options)
	{

		foreach ($this->_dirs as $dir) {
			@mkdir(rtrim($path, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . $dir);
		}

		if (isset($options['useIniConfig'])) {
			$useIniConfig = $options['useIniConfig'];
		} else {
			$useIniConfig = false;
		}

		if ($useIniConfig) {
			$this->createConfig($path, $templatePath, $name, 'ini');
		} else {
			$this->createConfig($path, $templatePath, $name, 'php');
		}

		$this->createBootstrapFile($name, $path, $templatePath, $useIniConfig);
		$this->createHtaccessFiles($path, $templatePath);
		$this->createControllerBase($path, $templatePath, $name);
		$this->createModule($path, $templatePath, $name);
		$this->createIndexViewFiles($path, $templatePath);
		$this->createControllerFile($path, $name);

		if ($options['enableWebTools']) {
			// TODO implement
			// Phalcon_WebTools::install($path);
		}

		return true;
	}

}