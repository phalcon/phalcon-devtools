<?php

/*
  +------------------------------------------------------------------------+
  | Phalcon Developer Tools                                                |
  +------------------------------------------------------------------------+
  | Copyright (c) 2011-2016 Phalcon Team (https://www.phalconphp.com)      |
  +------------------------------------------------------------------------+
  | This source file is subject to the New BSD License that is bundled     |
  | with this package in the file LICENSE.txt.                             |
  |                                                                        |
  | If you did not receive a copy of the license and are unable to         |
  | obtain it through the world-wide-web, please send an email             |
  | to license@phalconphp.com so we can send you a copy immediately.       |
  +------------------------------------------------------------------------+
  | Authors: Andres Gutierrez <andres@phalconphp.com>                      |
  |          Eduar Carvajal <eduar@phalconphp.com>                         |
  |          Serghei Iakovlev <serghei@phalconphp.com>                     |
  +------------------------------------------------------------------------+
*/

namespace Phalcon\Mvc\View\Engine\Volt\Extension;

/**
 * \Phalcon\Mvc\View\Engine\Volt\Extension\Php
 *
 * Allows to use any PHP function in Volt.
 *
 * @package Phalcon\Mvc\View\Engine\Volt\Extension
 */
class Php
{
    /**
     * Tries to compile native PHP function.
     *
     * Invoked before any attempt to compile a function call in any template.
     *
     * @param string $name
     * @param mixed  $arguments
     *
     * @return null|string
     */
    public function compileFunction($name, $arguments = null)
    {
        if (function_exists($name)) {
            if (func_num_args() > 1) {
                $arguments = array_slice(func_get_args(), 1);
                return $name . '(' . $arguments[0] . ')';
            }

            return $name . '()';
        }

        return null;
    }
}
