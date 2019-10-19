<?php

/**
 * This file is part of the Phalcon Developer Tools.
 *
 * (c) Phalcon Team <team@phalcon.io>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace Phalcon\Db\Adapter\Pdo;

use Phalcon\Db\Enum;
use Phalcon\Db\Reference;
use Phalcon\Db\ReferenceInterface;

/**
 * Phalcon\Db\Adapter\Pdo\PdoPostgresql
 *
 * @package Phalcon\Db\Adapter\Pdo
 */
class PdoPostgresql extends Postgresql
{
    /**
     * Lists table references
     *
     * @param string $table
     * @param string $schema
     * @return ReferenceInterface[]
     *
     */
    public function describeReferences(string $table, string $schema = null): array
    {
        $references = [];

        $rows = $this->fetchAll($this->getDialect()->describeReferences($table, $schema), Enum::FETCH_NUM);
        foreach ($rows as $reference) {
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
