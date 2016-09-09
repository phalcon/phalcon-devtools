<?php

/*
  +------------------------------------------------------------------------+
  | Phalcon Developer Tools                                                |
  +------------------------------------------------------------------------+
  | Copyright (c) 2011-2016 Phalcon Team (http://www.phalconphp.com)       |
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
  |          Serghei Iakovlev <serghei@phalconphp.com>                     |
  +------------------------------------------------------------------------+
*/

namespace Phalcon\Web\Tools\Traits;

use Phalcon\Web\Tools;

/**
 * \Phalcon\Web\Tools\Traits\DatabaseAware
 *
 * @property \Phalcon\Mvc\View $view
 * @property string|null $migrationsDir
 *
 * @package Phalcon\Web\Tools\Traits
 */
trait DatabaseAware
{
    /**
     * List database tables
     *
     * @param  bool $all
     * @return void
     */
    protected function listTables($all = false)
    {
        $config     = Tools::getConfig();
        $connection = Tools::getConnection();

        $tables = $all ? ['all' => 'All'] : [];

        $dbTables = $connection->listTables();
        foreach ($dbTables as $dbTable) {
            $tables[$dbTable] = $dbTable;
        }

        $this->view->setVars([
            'tables'        => $tables,
            'databaseName'  => $config->get('database')->dbname,
            'migrationsDir' => $this->migrationsDir ? $this->migrationsDir : null
        ]);
    }
}
