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
  | Authors: Sergii Svyrydenko <sergey.v.sviridenko@gmail.com>             |
  +------------------------------------------------------------------------+
*/

namespace Phalcon\Utils;

class Nullify
{
    public function __invoke($values)
    {
        $vals = array_map(
            function ($value) {
                if (function_exists('mb_strtolower')){
                    return mb_strtolower($value);
                }
            },
            $values
        );

        foreach ($vals as $key => $value) {
            if ($value == 'null'){
                $values[$key] = null;
            }
        }

        return $values;
    }
}
