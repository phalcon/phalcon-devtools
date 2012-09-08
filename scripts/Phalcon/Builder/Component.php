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

use Phalcon\Builder\Exception as BuilderException;

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
abstract class Component {

	protected $_options = array();

	public function __construct($options) {
		$this->_options = $options;
	}

	protected function _getConfig($path) {
		if (file_exists($path . "app/config/config.ini")) {
			return new \Phalcon\Config\Adapter\Ini($path . "app/config/config.ini");
		} else {
			if (file_exists($path . "app/config/config.php")) {
				$config = include($path . "app/config/config.php");
				return $config;
			} else {
				throw new BuilderException('Builder can\'t locate the configuration file');
			}
		}
	}

	abstract public function build();

}
