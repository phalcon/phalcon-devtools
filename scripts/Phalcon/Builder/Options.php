<?php

/*
  +------------------------------------------------------------------------+
  | Phalcon Developer Tools                                                |
  +------------------------------------------------------------------------+
  | Copyright (c) 2011-2015 Phalcon Team (http://www.phalconphp.com)       |
  +------------------------------------------------------------------------+
  | This source file is subject to the New BSD License that is bundled     |
  | with this package in the file docs/LICENSE.txt.                        |
  |                                                                        |
  | If you did not receive a copy of the license and are unable to         |
  | obtain it through the world-wide-web, please send an email             |
  | to license@phalconphp.com so we can send you a copy immediately.       |
  +------------------------------------------------------------------------+
  | Authors: Serghei Iakovlev <sadhooklay@gmail.com>                       |
  +------------------------------------------------------------------------+
*/

namespace Phalcon\Builder;

use Phalcon\Config;

/**
 * Options Class
 *
 * Extended key => value storage
 *
 * @package     Phalcon\Builder
 * @copyright   Copyright (c) 2011-2015 Phalcon Team (team@phalconphp.com)
 * @license     New BSD License
 */
class Options extends Config
{
    /**
     * Options Constructor
     *
     * @param array $options
     *
     * @throws \InvalidArgumentException If flags is not an integer
     */
    public function __construct(array $options)
    {
        parent::__construct($options);
    }

    /**
     * Checks whether Options has a specific option.
     *
     * @param string $key The offset to check on
     *
     * @return bool
     */
    public function has($key)
    {
        return (isset($this->key) || array_key_exists($key, $this->toArray()));
    }

    /**
     * Check of Options contains positive value
     *
     * Note: not null, empty string, false or 0
     *
     * @param string $key
     *
     * @return bool
     */
    public function contains($key)
    {
        return $this->has($key) && $this->$key;
    }

    /**
     * Get specific option from Options.
     *
     * @param string $key Option name
     * @param mixed $default Default value [Optional]
     *
     * @return mixed
     */
    public function get($key, $default = null)
    {
        return $this->contains($key) ? $this->$key : $default;
    }
}
