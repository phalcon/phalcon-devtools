<?php

namespace Phalcon\Test;

use Phalcon\Utils\Nullify;
use Phalcon\Test\Module\UnitTest;
use Helper\Utils\NullifyTrait;

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

class NullifyTest extends UnitTest
{
    use NullifyTrait;

    /**
     * Tests Nullify::__invoke
     *
     * @test
     * @issue  988
     * @author Sergii Svyrydenko <sergey.v.sviridenko@gmail.com>
     * @since  2017-09-06
     */
    public function shouldTestInvoke()
    {
        $this->specify(
            '',
            function ($data, $expected) {
                $nullify = new Nullify();
                foreach ($data as $key => $value) {
                    expect($nullify($value))->equals($expected[$key]);
                }
            },
            [
                'examples' => [
                    [$this->getInvokeData(), $this->getInvokeExpected()]
                ]
            ]
        );
    }
}
