<?php
declare(strict_types=1);

/**
 * This file is part of the Phalcon Developer Tools.
 *
 * (c) Phalcon Team <team@phalcon.io>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace Phalcon\DevTools\Mvc\View\Engine\Volt\Extension;

/**
 * Allows to use any PHP function in Volt.
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
