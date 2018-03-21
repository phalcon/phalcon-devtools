<?php

/*
  +------------------------------------------------------------------------+
  | Phalcon Developer Tools                                                |
  +------------------------------------------------------------------------+
  | Copyright (c) 2011-present Phalcon Team (https://www.phalconphp.com)   |
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

namespace Phalcon\Devtools\Modules\Core\Options;

/**
 * Phalcon\Devtools\Modules\Core\Options\OptionsRegistryInterface
 *
 * Common interface to use for options or any key/value pairs storage
 *
 * @package Phalcon\Devtools\Modules\Core\Options
 */
interface OptionsRegistryInterface
{
    /**
     * Set all options to option container
     *
     * @param array $options
     */
    public function setOptions(array $options);

    /**
     * Set one option to option container
     *
     * @param string $key
     * @param mixed $option
     */
    public function setOption(string $key, $option);

    /**
     * Get all options from the option container
     *
     * @return array
     */
    public function getAll(): array;

    /**
     * Get valid option or throw exception
     *
     * @param string $key
     * @throw InvalidArgumentException
     *
     * @return mixed
     */
    public function getOption(string $key);

    /**
     * Check whether option container has value with this key
     *
     * @param string $key
     *
     * @return bool
     */
    public function hasOption(string $key): bool;

    /**
     * Return valid option value or default value
     *
     * @param string $key
     * @param mixed $defaultOption
     *
     * @return mixed
     */
    public function getNullCoalescingDefaultOption(string $key, $defaultOption);
}
