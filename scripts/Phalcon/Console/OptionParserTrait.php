<?php

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
  | Authors: Sergii Svyrydenko <sergey.v.svyrydenko@gmail.com>             |
  +------------------------------------------------------------------------+
*/

namespace Phalcon\Console;

/**
 * \Phalcon\Utils\OptionParserTrait
 *
 * Parsing CLI options
 *
 * @package   Phalcon\Utils
 * @copyright Copyright (c) 2011-2017 Phalcon Team (team@phalconphp.com)
 * @license   New BSD License
 */
trait OptionParserTrait
{
    /**
     * Get prefix from the option
     *
     * @param  string  $prefix
     * @param  mixed  $prefixEnd
     *
     * @return mixed
     */
    public function getPrefixOption($prefix, $prefixEnd = '*')
    {
        if (substr($prefix, -1) != $prefixEnd) {
            return '';
        }

        return substr($prefix, 0, -1);
    }
}
