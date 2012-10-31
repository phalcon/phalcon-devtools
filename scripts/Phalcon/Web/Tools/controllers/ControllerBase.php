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

use Phalcon\Web\Tools;

class ControllerBase extends \Phalcon\Mvc\Controller
{

	public function initialize()
	{
		$this->_checkAccess();
	}

	/**
	 * Checks remote address ip to disable remote activity
	 */
	protected function _checkAccess()
	{
		if (isset($_SERVER['REMOTE_ADDR']) && ($_SERVER['REMOTE_ADDR']=='127.0.0.1' || $_SERVER['REMOTE_ADDR'] == '::1')) {
			return false;
		} else {
			throw new Phalcon\Exception('WebTools can only be used on the local machine (Your IP: '.$_SERVER['REMOTE_ADDR'].')');
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