<?php

namespace Phalcon\Console;

use Phalcon\Test\Module\UnitTest;
use Phalcon\Console\OptionStack;
use Phalcon\Console\OptionParserTrait;

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

class OptionStackTest extends UnitTest
{
    use OptionParserTrait;

    protected $options;

    public function _before()
    {
        $this->options = new OptionStack();
    }

    /**
     * Tests OptionStack::setOptions, OptionStack::getOptions
     *
     * @test
     * @author Sergii Svyrydenko <sergey.v.sviridenko@gmail.com>
     * @since  2017-09-28
     */
    public function shouldSetOptionsAndGetOptions()
    {
        $this->options->setOptions(['test' => 'foo', 'test2' => 'bar']);

        $this->specify(
            "Options didn't set",
            function($options, $expected)
            {
                expect($options)->equals($expected);
            },
            [
                'examples' => [
                    [$this->options->getOptions(), ['test' => 'foo', 'test2' => 'bar']]
                ]
            ]
        );
    }

    /**
     * Tests OptionStack::setOption, OptionStack::getOption
     *
     * @test
     * @author Sergii Svyrydenko <sergey.v.sviridenko@gmail.com>
     * @since  2017-09-28
     */
    public function shouldSetOptionAndGetOption11()
    {
        $this->specify(
            "Option didn't set",
            function($value, $defaultValue, $expected)
            {
                $this->options->setOption('set-test', $value, $defaultValue);

                expect($this->options->getOption('set-test'))->equals($expected);
            },
            [
                'examples' => [
                    ['foo-bar', 'bar-foo', 'foo-bar'],
                    ['', 'bar-foo', 'bar-foo']
                ]
            ]
        );
    }

    /**
     * Tests OptionStack::setDefaultOption
     *
     * @test
     * @author Sergii Svyrydenko <sergey.v.sviridenko@gmail.com>
     * @since  2017-09-28
     */
    public function shouldSetDefaultOptionIfOptionDidntExist()
    {
        $this->options->setOption('test', 'bar');

        $this->specify(
            "Method setDefaultOption didn't work well",
            function($key, $defaultValue, $expected)
            {
                $this->options->setDefaultOption($key, $defaultValue);

                expect($this->options->getOption($key))->equals($expected);
            },
            [
                'examples' => [
                    ['test', 'foo-bar', 'bar'],
                    ['test2', 'bar-foo', 'bar-foo']
                ]
            ]
        );
    }

    /**
     * Tests OptionStack::isReceivedOption
     *
     * @test
     * @author Sergii Svyrydenko <sergey.v.sviridenko@gmail.com>
     * @since  2017-09-28
     */
    public function shouldCheckingRecievedOption()
    {
        $this->options->setOption('true-option', 'foo-bar');

        $this->specify(
            "Checking option didn't wotk",
            function($option, $expected)
            {
                expect($option)->equals($expected);
            },
            [
                'examples' => [
                    [$this->options->isReceivedOption('true-option', $this->options->getOptions()), true],
                    [$this->options->isReceivedOption('false-option', $this->options->getOptions()), false]
                ]
            ]
        );
    }

    /**
     * Tests OptionStack::getValidOption
     *
     * @test
     * @author Sergii Svyrydenko <sergey.v.sviridenko@gmail.com>
     * @since  2017-09-28
     */
    public function shouldReturnValidOptionOrSetDefault()
    {
        $this->options->setOptions(['test' => 'foo', 'test2' => 'bar']);

        $this->specify(
            "Valid value didn't return",
            function($option, $expected)
            {
                expect($option)->equals($expected);
            },
            [
                'examples' => [
                    [$this->options->getValidOption('test', 'bar'), 'foo'],
                    [$this->options->getValidOption('false-option', 'bar'), 'bar'],
                ]
            ]
        );
    }

    /**
     * Tests OptionParserTrait::getPrefixOption
     *
     * @test
     * @issue  595
     * @author Sergii Svyrydenko <sergey.v.sviridenko@gmail.com>
     * @since  2017-10-06
     */
    public function shouldReturnPrefixFromOptionWithoutSetPrefix()
    {
        $this->options->setOptions(['test' => 'foo', 'test2' => 'bar']);

        $this->specify(
            'Method' . __METHOD__ . 'does not return option prefix',
            function($prefix, $expected) {
                expect($this->getPrefixOption($prefix))->equals($expected);
            },
            [
                'examples' => [
                    ['foo*', 'foo'],
                    ['bar*', 'bar']
                ]
            ]
        );
    }

    /**
     * Tests OptionParserTrait::getPrefixOption
     *
     * @test
     * @issue  595
     * @author Sergii Svyrydenko <sergey.v.sviridenko@gmail.com>
     * @since  2017-10-06
     */
    public function shouldReturnPrefixFromOptionWithSetPrefix()
    {
        $this->options->setOptions(['test' => 'foo', 'test2' => 'bar']);

        $this->specify(
            'Method' . __METHOD__ . 'does not return option prefix',
            function($prefix, $prefixEnd, $expected) {
                expect($this->getPrefixOption($prefix, $prefixEnd))->equals($expected);
            },
            [
                'examples' => [
                    ['foo^', '^', 'foo'],
                    ['bar?', '?', 'bar']
                ]
            ]
        );
    }
}
