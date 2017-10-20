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

namespace Phalcon\Db\Adapter\Pdo;

use Phalcon\Db\ReferenceInterface;
use Phalcon\Db\Reference;
use Phalcon\Db\Exception;
use Phalcon\Db;

/**
 * Phalcon\Db\Dialect\Postgresql
 *
 * @package Phalcon\Db\Adapter\Pdo
 */
class PostgresqlExtended extends Postgresql
{
    /**
     * Lists table references
     *
     * @param string $table
     * @param string $schema
     * @return ReferenceInterface[]
     *
     */
    public function describeReferences($table, $schema = NULL)
    {
		$references = [];

        foreach ($this->fetchAll($this->_dialect->describeReferences($table, $schema),Db::FETCH_NUM) as $reference) {
            $constraintName = $reference[2];
            if (!isset($references[$constraintName])) {
                $referencedSchema  = $reference[3];
                $referencedTable   = $reference[4];
                $referenceUpdate   = $reference[6];
                $referenceDelete   = $reference[7];
                $columns           = [];
                $referencedColumns = [];
            } else {
                $referencedSchema  = $references[$constraintName]["referencedSchema"];
                $referencedTable   = $references[$constraintName]["referencedTable"];
                $columns           = $references[$constraintName]["columns"];
                $referencedColumns = $references[$constraintName]["referencedColumns"];
                $referenceUpdate   = $references[$constraintName]["onUpdate"];
                $referenceDelete   = $references[$constraintName]["onDelete"];
            }

            $columns[] = $reference[1];
            $referencedColumns[] = $reference[5];

            $references[$constraintName] = [
                "referencedSchema"  => $referencedSchema,
                "referencedTable"   => $referencedTable,
                "columns"           => $columns,
                "referencedColumns" => $referencedColumns,
                "onUpdate"          => $referenceUpdate,
                "onDelete"          => $referenceDelete
            ];
        }
        
        $referenceObjects = [];

        foreach ($references as $name => $arrayReference) {
            $referenceObjects[$name] = new Reference($name, [
                "referencedSchema"  => $arrayReference["referencedSchema"],
				"referencedTable"   => $arrayReference["referencedTable"],
				"columns"           => $arrayReference["columns"],
				"referencedColumns" => $arrayReference["referencedColumns"],
				"onUpdate"          => $arrayReference["onUpdate"],
				"onDelete"          => $arrayReference["onDelete"]
			]);
        }

		return $referenceObjects;
    }
}
