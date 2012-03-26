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

use Phalcon_Builder as Builder;
use Phalcon_BuilderException as BuilderException;
use Phalcon_Utils as Utils;

/**
 * TwitterBootstrapComponent
 *
 * Build Twitter-Bootstrap CRUDs using Phalcon
 *
 * @category 	Phalcon
 * @package 	Scripts
 * @copyright   Copyright (c) 2011-2012 Phalcon Team (team@phalconphp.com)
 * @license 	New BSD License
 * @version 	$Id: Scaffold.php,v 5f278793c1ae 2011/10/27 02:50:13 andres $
 */
class TwitterBootstrapComponent {

	private $_options;

	public function __construct($options){
		$this->_options = $options;
	}

	private function _getConfig($path){
		return new Phalcon_Config_Adapter_Ini($path."app/config/config.ini");
	}
	
	public function build(){
		if(file_exists('public/bootstrap')){
			throw new BuilderException("Twitter Bootstrap isn't installed");
		}
	}	

}