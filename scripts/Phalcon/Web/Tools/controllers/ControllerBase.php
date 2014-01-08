<?php

/*
  +------------------------------------------------------------------------+
  | Phalcon Developer Tools                                                |
  +------------------------------------------------------------------------+
  | Copyright (c) 2011-2014 Phalcon Team (http://www.phalconphp.com)       |
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
use Phalcon\Mvc\Controller;

class ControllerBase extends Controller
{
    /**
     * Initialize controller
     *
     * @return void
     */
    public function initialize()
    {
        $this->checkAccess();
    }

    /**
     * Check remote IP address to disable remote activity
     *
     * @return void
     * @throws \Phalcon\Exception if connected remotely
     */
    protected function checkAccess()
    {
        $ip = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : false;

        if ($ip && ($ip == '127.0.0.1' || $ip == '::1' || $this->checkToolsIp($ip)))
            return false;

        throw new \Phalcon\Exception('WebTools can only be used on the local machine (Your IP: ' . $ip . ') or you can make changes in webtools.config.php file to allow IP or NET');
    }

    /**
     * List database tables
     *
     * @param  bool $all
     * @return void
     */
    protected function listTables($all = false)
    {
        $config = Tools::getConfig();
        $connection = Tools::getConnection();

        if ($all) {
            $tables = array('all' => 'All');
        } else {
            $tables = array();
        }

        $dbTables = $connection->listTables();
        foreach ($dbTables as $dbTable) {
            $tables[$dbTable] = $dbTable;
        }

        $this->view->tables = $tables;
        if ($config->database->adapter != 'Sqlite') {
            $this->view->databaseName = $config->database->dbname;
        } else {
            $this->view->databaseName = null;
        }
    }

    /**
     * Check if IP address for securing Phalcon Developers Tools area matches
     * the given
     *
     * @param  string $ip
     * @return bool
     */
    private function checkToolsIp($ip)
    {
        return strpos($ip, Tools::getToolsIp()) === 0;
    }
}
