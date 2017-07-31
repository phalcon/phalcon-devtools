<?php

namespace Helper\Db\Dialect;

use Phalcon\Db\Reference;
use Phalcon\Db\ReferenceInterface;

/**
 * \Helper\Db\Dialect
 *
 * @copyright (c) 2011-2017 Phalcon Team
 * @link      https://phalconphp.com
 * @author    Sergii Svyrydenko <sergey.v.sviridenko@gmail.com>
 * @package   Helper\Db\Dialect
 *
 * The contents of this file are subject to the New BSD License that is
 * bundled with this package in the file LICENSE.txt
 *
 * If you did not receive a copy of the license and are unable to obtain it
 * through the world-wide-web, please send an email to license@phalconphp.com
 * so that we can send you a copy immediately.
 */
trait PostgresqlTrait
{
    protected function addTestForeignKey()
    {
        $sql = 'ALTER TABLE foreign_key_child ADD CONSTRAINT test_describeReferences FOREIGN KEY (child_int) REFERENCES foreign_key_parent (refer_int) ON UPDATE CASCADE ON DELETE RESTRICT;';

        return $sql;
    }

    protected function dropTestForeignKey()
    {
        $sql = 'ALTER TABLE foreign_key_child DROP CONSTRAINT test_describeReferences;';

        return $sql;
    }

    protected function getReferenceObject()
    {
        return
            ['test_describereferences' => new Reference('test_describereferences', [
                'referencedTable'   => 'foreign_key_parent',
                'referencedSchema' => 'public',
                'columns'           => ['child_int'],
                'referencedColumns' => ['refer_int'],
                'onUpdate'          => 'CASCADE',
                'onDelete'          => 'RESTRICT',
                ])
            ];

    }
}
