<?php

namespace Helper\Utils;

/**
 * Helper\Utils
 *
 * @copyright (c) 2011-2017 Phalcon Team
 * @link      https://phalconphp.com
 * @author    Sergii Svyrydenko <sergey.v.sviridenko@gmail.com>
 * @package   Helper\Utils
 *
 * The contents of this file are subject to the New BSD License that is
 * bundled with this package in the file LICENSE.txt
 *
 * If you did not receive a copy of the license and are unable to obtain it
 * through the world-wide-web, please send an email to license@phalconphp.com
 * so that we can send you a copy immediately.
 */

trait NullifyTrait
{
    protected function getInvokeData()
    {
        return [
            0 => [1, 'test' , 'NULL', null],
            1 => ['foo', 'bar', 'null', NULL],
            2 => [1, 'foo', 'Null']
        ];
    }

    protected function getInvokeExpected ()
    {
        return [
            0 => [1, 'test', null, null],
            1 => ['foo', 'bar', null, null],
            2 => [1, 'foo', null]
        ];
    }
}
