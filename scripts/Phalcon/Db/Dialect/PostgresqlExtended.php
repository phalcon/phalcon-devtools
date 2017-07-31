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
 * Phalcon\Db\Dialect\PostgresqlExtended
 *
 * @package Phalcon\Db\Dialect
 */
class PostgresqlExtended extends Postgresql
{
    /**
     * Generates SQL to query foreign keys on a table
     *
     * @param string $table
     * @param string $schema
     * @return string
     */
    public function describeReferences($table, $schema = NULL)
    {
        $sql = "
            SELECT DISTINCT
              tc.table_name as TABLE_NAME,
              kcu.column_name as COLUMN_NAME,
              tc.constraint_name as CONSTRAINT_NAME,
              tc.table_schema as REFERENCED_TABLE_SCHEMA,
              ccu.table_name AS REFERENCED_TABLE_NAME,
              ccu.column_name AS REFERENCED_COLUMN_NAME,
              rc.update_rule AS UPDATE_RULE,
              rc.delete_rule AS DELETE_RULE
            FROM information_schema.table_constraints AS tc
              JOIN information_schema.key_column_usage AS kcu
                ON tc.constraint_name = kcu.constraint_name
              JOIN information_schema.constraint_column_usage AS ccu
                ON ccu.constraint_name = tc.constraint_name
              JOIN information_schema.referential_constraints rc
                ON tc.constraint_catalog = rc.constraint_catalog
                AND tc.constraint_schema = rc.constraint_schema
                AND tc.constraint_name = rc.constraint_name
                AND  tc.constraint_type = 'FOREIGN KEY'
            WHERE constraint_type = 'FOREIGN KEY'
                AND ";

        if ($schema) {
            $sql .= "tc.table_schema = '" . $schema . "' AND tc.table_name='" . $table . "'";
		} else {
            $sql .= "tc.table_schema = 'public' AND tc.table_name='" . $table . "'";
		}

        return $sql;
    }
}
