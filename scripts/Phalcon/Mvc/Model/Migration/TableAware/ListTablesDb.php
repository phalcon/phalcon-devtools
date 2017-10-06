<?php

/*
  +------------------------------------------------------------------------+
  | Phalcon Developer Tools                                                |
  +------------------------------------------------------------------------+
  | Copyright (c) 2011-2017 Phalcon Team (https://www.phalconphp.com)      |
  +------------------------------------------------------------------------+
  | This source file is subject to the New BSD License that is bundled     |
  | with this package in the file LICENSE.txt.                             |
  |                                                                        |
  | If you did not receive a copy of the license and are unable to         |
  | obtain it through the world-wide-web, please send an email             |
  | to license@phalconphp.com so we can send you a copy immediately.       |
  +------------------------------------------------------------------------+
  | Authors: Sergii Svyrydenko <sergey.v.sviridenko@gmail.com>             |
  +------------------------------------------------------------------------+
*/

namespace Phalcon\Mvc\Model\Migration\TableAware;

use Phalcon\Mvc\Model\Migration\TableAware\ListTablesInterface;
use InvalidArgumentException;
use Phalcon\Mvc\Model\Migration as ModelMigration;
use Phalcon\Db\Exception as DbException;

/**
 * Phalcon\Mvc\Model\Migration\TableAware\ListTablesDb
 *
 * @package Phalcon\Mvc\Model\Migration\TableAware
 */
class ListTablesDb implements ListTablesInterface
{
    /**
     * Get table names with prefix for running migration
     *
     * @param string $tablePrefix
     * @param \DirectoryIterator $iterator
     * @return string
     */
    public function listTablesForPrefix($tablePrefix, \DirectoryIterator $iterator = null)
    {
        if (empty($tablePrefix)) {
            throw new InvalidArgumentException("Parameters weren't defined in " . __METHOD__);
        }

        $modelMigration = new ModelMigration();
        $connection = $modelMigration->getConnection();

        $tablesList = $connection->listTables();
        if (empty($tablesList)) {
            return '';
        }

        $strlen = strlen($tablePrefix);
        foreach ($tablesList as $key => $value) {
            if (substr($value, 0, $strlen) != $tablePrefix) {
                unset($tablesList[$key]);
            }
        }

        if (empty($tablesList)) {
            throw new DbException("Specified table prefix doesn't match with any table name");
        }

        return implode(',', $tablesList);
    }
}
