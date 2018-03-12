<?php

/*
  +------------------------------------------------------------------------+
  | Phalcon Developer Tools                                                |
  +------------------------------------------------------------------------+
  | Copyright (c) 2011-present Phalcon Team (https://www.phalconphp.com)   |
  +------------------------------------------------------------------------+
  | This source file is subject to the New BSD License that is bundled     |
  | with this package in the file LICENSE.txt.                             |
  |                                                                        |
  | If you did not receive a copy of the license and are unable to         |
  | obtain it through the world-wide-web, please send an email             |
  | to license@phalconphp.com so we can send you a copy immediately.       |
  +------------------------------------------------------------------------+
  | Authors: Paul Scarrone <paul@savvysoftworks.com>                       |
  +------------------------------------------------------------------------+
*/

namespace Phalcon\Test\Db\Adapter\Pdo;

use Phalcon\Db\Reference;
use Phalcon\Test\Module\UnitTest;
use Phalcon\Db\ReferenceInterface;
use Helper\Db\Dialect\PostgresqlTrait;
use Phalcon\Db\Adapter\Pdo\PdoPostgresql;
use Phalcon\Db\Dialect\DialectPostgresql;

class MigrationTest extends UnitTest
{
    use PostgresqlTrait;

    /**
     * @var PdoPostgresql
     */
    protected $connection;

    public function _before()
    {
        parent::_before();

        try {
            $this->connection = new PdoPostgresql([
                'host'     => TEST_DB_POSTGRESQL_HOST,
                'username' => TEST_DB_POSTGRESQL_USER,
                'password' => TEST_DB_POSTGRESQL_PASSWD,
                'dbname'   => TEST_DB_POSTGRESQL_NAME,
                'port'     => TEST_DB_POSTGRESQL_PORT,
                'schema'   => TEST_DB_POSTGRESQL_SCHEMA
            ]);
        } catch (\PDOException $e) {
            throw new \PHPUnit_Framework_SkippedTestError("Unable to connect to the database: " . $e->getMessage());
        }

        $this->connection->setDialect(new DialectPostgresql);
    }

    /**
     * Tests DialectPostgresql::describeReferences
     *
     * @test
     * @issue  438
     * @author Sergii Svyrydenko <sergey.v.sviridenko@gmail.com>
     * @since  2017-07-27
     */
    public function shouldCreateReferenceObject()
    {
        $this->connection->execute($this->addTestForeignKey());

        $this->specify(
            "Created reference object isn't proper",
            function ($references, $expected) {

                expect($references)->equals($expected);

            },
            [
                'examples' => [
                    [$this->connection->describeReferences('foreign_key_child', 'public'), $this->getReferenceObject()]
                ]
            ]
        );

        $this->connection->execute($this->dropTestForeignKey());
    }
}
