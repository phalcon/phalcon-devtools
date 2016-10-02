<?php

/*
  +------------------------------------------------------------------------+
  | Phalcon Developer Tools                                                |
  +------------------------------------------------------------------------+
  | Copyright (c) 2011-2016 Phalcon Team (https://www.phalconphp.com)      |
  +------------------------------------------------------------------------+
  | This source file is subject to the New BSD License that is bundled     |
  | with this package in the file LICENSE.txt.                             |
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


namespace Phalcon\Utils;

use Phalcon\Mvc\User\Component;

/**
 * \Phalcon\Utils\DbUtils
 *
 * @property \Phalcon\Config $config
 *
 * @package Phalcon\Utils
 */
class DbUtils extends Component
{
    /**
     * List database tables
     *
     * @param  bool   $all
     * @param  string $connection
     * @return array
     */
    public function listTables($all = false, $connection = 'db')
    {
        $tables = $all ? ['@' => 'all'] : [];

        if ($this->getDI()->has($connection)) {
            $connection = $this->getDI()->getShared($connection);

            $dbTables = $connection->listTables();
            foreach ($dbTables as $dbTable) {
                $tables[$dbTable] = $dbTable;
            }
        }

        return $tables;
    }

    /**
     * Resolves the DB Schema
     *
     * @return null|string
     */
    public function resolveDbSchema()
    {
        if (!$this->config->offsetExists('database')) {
            return null;
        }

        $config = $this->config->get('database');

        if ($config->offsetExists('schema')) {
            return $config->get('schema');
        }

        if ('Postgresql' == $config->get('adapter')) {
            return 'public';
        }

        if ('Sqlite' == $config->get('adapter')) {
            // SQLite only supports the current database, unless one is
            // attached. This is not the case, so don't return a schema.
            return null;
        }

        if ($config->offsetExists('dbname')) {
            return $config->get('dbname');
        }

        return null;
    }
}
