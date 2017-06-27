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
use Phalcon\Db\Exception;

/**
 * Phalcon\Db\Dialect\MysqlExtended
 *
 * @package Phalcon\Db\Adapter\Pdo
 */
class MysqlExtended extends Mysql
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
    public function addForeignKey($tableName, $schemaName, ReferenceInterface $reference)
    {
        $foreignKeyCheck = $this->{"prepare"}($this->_dialect->getForeignKeyChecks());
        if (!$foreignKeyCheck->execute()) {
            throw new Exception("DATABASE PARAMETER 'FOREIGN_KEY_CHECKS' HAS TO BE 1");
        }

        return $this->{"execute"}($this->_dialect->addForeignKey($tableName, $schemaName, $reference));
    }
}
