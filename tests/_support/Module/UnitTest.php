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
  | Authors: Andres Gutierrez <andres@phalconphp.com>                      |
  |          Nikolaos Dimopoulos <nikos@phalconphp.com>                    |
  +------------------------------------------------------------------------+
*/

namespace Phalcon\Test\Module;

use UnitTester;
use Codeception\Specify;
use Codeception\Test\Unit;

/**
 * \Phalcon\Test\Module\UnitTest
 *
 * Base class for all Unit tests
 *
 * @package   Phalcon\Test\Module
 */
class UnitTest extends Unit
{
    use Specify;

    /**
     * UnitTester Object
     * @var UnitTester
     */
    protected $tester;
}
