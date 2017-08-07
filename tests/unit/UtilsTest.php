<?php

namespace Phalcon\Test;

use Phalcon\Utils;
use Phalcon\Text;
use Phalcon\Test\Module\UnitTest;

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
  | Authors: Paul Scarrone <paul@savvysoftworks.com>                       |
  +------------------------------------------------------------------------+
*/

class UtilsTest extends UnitTest
{
    /**
     * Tests Utils::camelize
     *
     * @test
     * @issue  1056
     * @author Sergii Svyrydenko <sergey.v.sviridenko@gmail.com>
     * @since  2017-08-02
     */
    public function shouldCamelizeString()
    {
        $this->specify(
            "Method Utils::camelize hasn't returned proper string",
            function($string, $expected)
            {
                expect($string)->equals($expected);
            },
            [
                'examples' => [
                    [Utils::camelize('MyFooBar'), 'MyFooBar'],
                    [Utils::camelize('MyFooBar', '_-'), 'MyFooBar'],
                    [Utils::camelize('My-Foo_Bar', '-'), 'MyFoo_Bar'],
                    [Utils::camelize('My-Foo_Bar', '_-'), 'MyFooBar']
                ]
            ]
        );
    }

    /**
     * Tests Utils::lowerCamelizeWithDelimiter
     *
     * @test
     * @issue  1070
     * @author Sergii Svyrydenko <sergey.v.sviridenko@gmail.com>
     * @since  2017-08-07
     */
    public function shouldCamelizeStringWithDelimiter()
    {
        $this->specify(
            "Method Utils::lowerCamelizeWithDelimiter hasn't returned proper string",
            function($string, $expected)
            {
                expect($string)->equals($expected);
            },
            [
                'examples' => [
                    [Utils::lowerCamelizeWithDelimiter('myfoobar'), 'myfoobar'],
                    [Utils::lowerCamelizeWithDelimiter('myfoobar', '_-'), 'Myfoobar'],
                    [Utils::lowerCamelizeWithDelimiter('My-Foo_Bar', '_-'), 'MyFooBar'],
                    [Utils::lowerCamelizeWithDelimiter('my-foo_bar', '_-'), 'MyFooBar'],
                    [Utils::lowerCamelizeWithDelimiter('my-foo_bar', '_-', true), 'myFooBar']
                ]
            ]
        );
    }

    /**
     * Tests Utils::lowerCamelize
     *
     * @test
     * @author Sergii Svyrydenko <sergey.v.sviridenko@gmail.com>
     * @since  2017-08-02
     */
    public function shouldLowercamelizeString()
    {
        $this->specify(
            "Method Utils::lowerCamelize hasn't returned proper string",
            function($string, $expected)
            {
                expect($string)->equals($expected);
            },
            [
                'examples' => [
                    [Utils::lowerCamelize('MyFooBar'), 'myFooBar']
                ]
            ]
        );
    }

    /**
     * Tests Text::uncamelize
     *
     * @test
     * @author Sergii Svyrydenko <sergey.v.sviridenko@gmail.com>
     * @since  2017-08-02
     */
    public function shouldUncamelizeString()
    {
        $this->specify(
            "Method Text::uncamelize hasn't returned proper string",
            function($string, $expected)
            {
                expect($string)->equals($expected);
            },
            [
                'examples' => [
                    [Text::uncamelize('MyFooBar'), 'my_foo_bar'],
                    [Text::uncamelize('MyFooBar', '-'), 'my-foo-bar'],
                    [Text::uncamelize('MyFooBar', '_'), 'my_foo_bar']
                ]
            ]
        );
    }
}
