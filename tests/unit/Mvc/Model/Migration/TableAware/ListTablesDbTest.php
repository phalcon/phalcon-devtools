<?php

namespace Phalcon\Test\Mvc\Model\Migration\TableAware;

use Phalcon\Test\Module\UnitTest;
use Phalcon\Config;
use Phalcon\Mvc\Model\Migration\TableAware\ListTablesDb;
use Phalcon\Mvc\Model\Migration as ModelMigration;

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

class ListTablesDbTest extends UnitTest
{
    public function _before()
    {
        parent::_before();

        try {
            $config = include(app_path('mysql/config.php'));
            if (is_array($config)) {
                $config = new Config($config);
            }

            ModelMigration::setup($config->database);
        } catch (\PDOException $e) {
            throw new \PHPUnit_Framework_SkippedTestError("Unable to connect to the database: " . $e->getMessage());
        }
    }

    /**
     * Tests ListTablesDb::listTablesForPrefix
     *
     * @test
     * @issue  595
     * @author Sergii Svyrydenko <sergey.v.sviridenko@gmail.com>
     * @since  2017-10-06
     */
    public function shouldReturnListTablesFromDb()
    {
        $listTables = new ListTablesDb();

        $this->specify(
            'Method' . __METHOD__ . 'did not return table list',
            function ($tablePrefix, $expected) use ($listTables) {
                expect($listTables->listTablesForPrefix($tablePrefix))->equals($expected);
            },
            [
                'examples' => [
                    ['issue595', 'issue595_1,issue595_2']
                ]
            ]
        );
    }
}
