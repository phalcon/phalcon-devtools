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

use Phalcon\Script\Color;
use Phalcon\Builder\BuilderException;

/**
 * \Phalcon\Builder\Component
 *
 * Base class for builder components
 *
 * @category 	Phalcon
 * @package 	Builder
 * @subpackage  Component
 * @copyright   Copyright (c) 2011-2012 Phalcon Team (team@phalconphp.com)
 * @license 	New BSD License
 */
abstract class Component
{

	protected $_options = array();

	public function __construct($options)
	{
		$this->_options = $options;
	}

	protected function _getConfig($path)
	{
		foreach (array('app/config/', 'config/') as $configPath) {
			if (file_exists($path . $configPath. "config.ini")) {
				return new \Phalcon\Config\Adapter\Ini($path . $configPath. "/config.ini");
			} else {
				if (file_exists($path . $configPath. "/config.php")) {
					$config = include($path . $configPath. "/config.php");
					return $config;
				}
			}
		}

		$directory = new \RecursiveDirectoryIterator('.');
		$iterator = new \RecursiveIteratorIterator($directory);
		foreach($iterator as $f){
			if (preg_match('/config\.php$/', $f->getPathName())) {
				$config = include($f->getPathName());
				return $config;
			} else {
				if (preg_match('/config\.ini$/', $f->getPathName())) {
					return new \Phalcon\Config\Adapter\Ini($f->getPathName());
				}
			}
		}
		throw new BuilderException('Builder can\'t locate the configuration file');
	}

	public function isAbsolutePath($path)
	{
		if (PHP_OS == "WINNT") {
			if(preg_match('/^[A-Z]:\\\\/', $path)){
				return true;
			}
		} else {
			if (substr($path, 0, 1) == DIRECTORY_SEPARATOR) {
				return true;
			}
		}
		return false;
	}

	public function isSupportedAdapter($adapter)
	{
		if (!class_exists('\Phalcon\Db\Adapter\Pdo\\'.$adapter)) {
			throw new BuilderException("Adapter $adapter is not supported");
		}
	}

	protected function _notifySuccess($message)
	{
		print Color::success($message);
	}

	abstract public function build();

}
