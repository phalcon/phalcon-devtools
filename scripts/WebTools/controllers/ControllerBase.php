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

class ControllerBase extends Phalcon_Controller {

	protected $_settings;

	public function initialize(){
		$this->_checkAccess();
		$this->_readConfig();
	}

	/**
	 * Checks remote address ip to disable remote activity
	 */
	protected function _checkAccess(){
		if(isset($_SERVER['REMOTE_ADDR']) && ($_SERVER['REMOTE_ADDR']=='127.0.0.1' || $_SERVER['REMOTE_ADDR'] == '::1')){
			return false;
		} else {
			throw new Phalcon_Exception('WebTools can only be used on the local machine (Your IP: '.$_SERVER['REMOTE_ADDR'].')');
		}
	}

	protected function _readConfig(){
		$configPath = Phalcon_WebTools::getPath("app/config/config.ini");
		if(file_exists($configPath)){
			$this->_settings = new Phalcon_Config_Adapter_Ini($configPath);
		} else {
			$configPath = Phalcon_WebTools::getPath("app/config/config.php");
			if(file_exists($configPath)){
				require $configPath;
				$this->_settings = $config;
			} else {
				throw new Phalcon_Exception('Configuration file could not be loaded');
			}
		}
	}

	/**
	 * Returns connection to DB
	 */
	protected function _getConnection(){
		$connection = Phalcon_Db::factory($this->_settings->database->adapter, $this->_settings->database);
		//$connection->setFetchMode(Phalcon_Db::DB_NUM);
		return $connection;
	}

}