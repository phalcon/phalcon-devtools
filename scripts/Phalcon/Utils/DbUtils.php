<?php
declare(strict_types=1);

/**
 * This file is part of the Phalcon Developer Tools.
 *
 * (c) Phalcon Team <team@phalcon.io>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace Phalcon\Utils;

use Phalcon\Config;
use Phalcon\Di\Injectable;

/**
 * \Phalcon\Utils\DbUtils
 *
 * @property Config $config
 *
 * @package Phalcon\Utils
 */
class DbUtils extends Injectable
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
