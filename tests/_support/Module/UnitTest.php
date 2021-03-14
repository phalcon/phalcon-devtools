<?php

namespace Phalcon\DevTools\Tests\Support\Module;

use Codeception\Specify;
use Codeception\Test\Unit;
use UnitTester;

/**
 * \Phalcon\Test\Module\UnitTest
 * Base class for all Unit tests
 *
 * @copyright (c) 2011-2017 Phalcon Team
 * @link      http://www.phalcon.io
 * @author    Andres Gutierrez <andres@phalcon.io>
 * @author    Nikolaos Dimopoulos <nikos@phalcon.io>
 * @package   Phalcon\Test\Module
 *
 * The contents of this file are subject to the New BSD License that is
 * bundled with this package in the file LICENSE.txt
 *
 * If you did not receive a copy of the license and are unable to obtain it
 * through the world-wide-web, please send an email to license@phalcon.io
 * so that we can send you a copy immediately.
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
