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

/**
 * BuilderComponent
 *
 * Base class for builder components
 *
 * @category 	Phalcon
 * @package 	Scripts
 * @copyright   Copyright (c) 2011-2012 Phalcon Team (team@phalconphp.com)
 * @license 	New BSD License
 */
class Phalcon_BuilderComponent {

	protected $_options = array();

	public function __construct($options){
		$this->_options = $options;
	}

	protected function _getConfig($path){
		if(file_exists($path."app/config/config.ini")){
			return new Phalcon_Config_Adapter_Ini($path."app/config/config.ini");
		} else {
			if(file_exists($path."app/config/config.php")){
				require $path."app/config/config.php";
				return $config;
			} else {
				throw new Phalcon_BuilderException('Builder can\'t locate the configuration file');
			}
		}
	}

}
