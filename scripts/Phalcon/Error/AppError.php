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
  |          Nikita Vershinin <endeveit@gmail.com>                         |
  |          Serghei Iakovlev <serghei@phalconphp.com>                     |
  +------------------------------------------------------------------------+
*/

namespace Phalcon\Error;

/**
 * \Phalcon\Error\AppError
 *
 * @method int type()
 * @method string message()
 * @method string file()
 * @method string line()
 * @method \Exception|null exception()
 * @method bool isException()
 * @method bool isError()
 *
 * @package Phalcon\Error
 */
class AppError
{
    protected $attributes = [];

    /**
     * AppError constructor.
     *
     * @param array $options
     */
    public function __construct(array $options = [])
    {
        $defaults = [
            'type'        => -1,
            'message'     => 'No error message',
            'file'        => '',
            'line'        => '',
            'exception'   => null,
            'isException' => false,
            'isError'     => false,
        ];

        $this->attributes = array_merge($defaults, $options);
    }

    /**
     * Magic method to retrieve the attributes.
     *
     * @param string $method
     * @param array $args
     *
     * @return mixed|null
     */
    public function __call($method, $args)
    {
        $attributes = array_keys($this->attributes);

        return in_array($method, $attributes, true) ? $this->attributes[$method] : null;
    }
}
