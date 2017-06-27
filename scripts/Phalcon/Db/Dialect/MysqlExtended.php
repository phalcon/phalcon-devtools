<?php

/*
  +------------------------------------------------------------------------+
  | Phalcon Framework                                                      |
  +------------------------------------------------------------------------+
  | Copyright (c) 2011-2017 Phalcon Team (http://www.phalconphp.com)       |
  +------------------------------------------------------------------------+
  | This source file is subject to the New BSD License that is bundled     |
  | with this package in the file LICENSE.txt.                             |
  |                                                                        |
  | If you did not receive a copy of the license and are unable to         |
  | obtain it through the world-wide-web, please send an email             |
  | to license@phalconphp.com so we can send you a copy immediately.       |
  +------------------------------------------------------------------------+
  | Authors: Sergii Svyrydenko <sergey.v.sviridenko@gmail.com>             |
  |                                                                        |
  +------------------------------------------------------------------------+
*/

namespace Phalcon\Db\Dialect;

use Phalcon\Db\ReferenceInterface;

/**
 * Phalcon\Db\Dialect\MysqlExtended
 *
 * @package Phalcon\Db\Dialect
 */
class MysqlExtended extends Mysql
{
    /**
     * Generates SQL to add an foreign key to a table.
     *
     * @param string $tableName
     * @param string $schemaName
     * @param ReferenceInterface $reference
     * @return string
     */
    public function addForeignKey($tableName, $schemaName, ReferenceInterface $reference)
    {
        $sql = 'ALTER TABLE ' . $this->prepareTable($tableName, $schemaName) . ' ADD';
        if ($reference->getName()) {
            $sql .= ' CONSTRAINT `' . $reference->getName() . '`';
        }
        $sql .= ' FOREIGN KEY (' . $this->getColumnList($reference->getColumns()) . ') REFERENCES ' . $this->prepareTable($reference->getReferencedTable(), $reference->getReferencedSchema()) . '(' . $this->getColumnList($reference->getReferencedColumns()) . ')';

        $onDelete = $reference->getOnDelete();
        if ($onDelete) {
            $sql .= " ON DELETE " . $onDelete;
        }

        $onUpdate = $reference->getOnUpdate();
        if ($onUpdate) {
            $sql .= " ON UPDATE " . $onUpdate;
        }

        return $sql;
    }

    /**
     * Generates SQL to check DB parameter FOREIGN_KEY_CHECKS.
     *
     * @return string
     */
    public function getForeignKeyChecks()
    {
        $sql = 'SELECT @@foreign_key_checks';

        return $sql;
    }
}
