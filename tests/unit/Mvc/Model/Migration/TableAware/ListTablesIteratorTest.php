<?php

namespace Phalcon\Test\Mvc\Model\Migration\TableAware;

use Phalcon\Test\Module\UnitTest;
use DirectoryIterator;
use Phalcon\Mvc\Model\Migration\TableAware\ListTablesIterator;

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

class ListTablesIteratorTest extends UnitTest
{
    /**
     * Tests ListTablesIterator::listTablesForPrefix
     *
     * @test
     * @issue  595
     * @author Sergii Svyrydenko <sergey.v.sviridenko@gmail.com>
     * @since  2017-10-06
     */
    public function shouldReturnListTablesFromIterator()
    {
        $iterator = new DirectoryIterator(app_path('test_table_prefix/migrations/1.0.0'));
        $listTables = new ListTablesIterator();

        $this->specify(
            'Method' . __METHOD__ . 'did not return table list',
            function($tablePrefix, $expected) use ($iterator, $listTables){
                expect($listTables->listTablesForPrefix($tablePrefix, $iterator))->equals($expected);
            },
            [
                'examples' => [
                    ['issue', 'issue595_1,issue595_2']
                ]
            ]
        );
    }
}
