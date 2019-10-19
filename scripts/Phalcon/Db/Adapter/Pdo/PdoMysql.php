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

use Phalcon\Db\Dialect\DialectMysql;
use Phalcon\Db\ReferenceInterface;
use Phalcon\Db\Exception;

/**
 * Phalcon\Db\Adapter\Pdo\PdoMysql
 *
 * @package Phalcon\Db\Adapter\Pdo
 */
class PdoMysql extends Mysql
{
    /**
     * Generates SQL to add an index to a table if FOREIGN_KEY_CHECKS=1
     *
     * @param string $tableName
     * @param string $schemaName
     * @param ReferenceInterface $reference
     *
     * @throws \Phalcon\Db\Exception
     */
    public function addForeignKey(string $tableName, string $schemaName, ReferenceInterface $reference): bool
    {
        /** @var DialectMysql $dialect */
        $dialect = $this->getDialect();
        $foreignKeyCheck = $this->{"prepare"}($dialect->getForeignKeyChecks());
        if (!$foreignKeyCheck->execute()) {
            throw new Exception("DATABASE PARAMETER 'FOREIGN_KEY_CHECKS' HAS TO BE 1");
        }

        return $this->{"execute"}($dialect->addForeignKey($tableName, $schemaName, $reference));
    }
}
