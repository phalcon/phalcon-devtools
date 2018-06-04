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
  | Authors: Sergii Svyrydenko <sergey.v.sviridenko@gmail.com              |
  +------------------------------------------------------------------------+
*/

namespace Phalcon;

/**
 * Phalcon\FactoryOptions
 *
 * Interface for options and data that were generated
 *
 * @package Phalcon
 */
interface FactoryOptions
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
     * @param mixed $key
     * @param mixed $option
     */
    public function setOption($key, $option);

    /**
     * Get all options from the option container
     *
     * @return array
     */
    public function getOptions();

    /**
     * Get valid option or throw exception
     *
     * @param mixed $key
     * @throw InvalidArgumentException
     *
     * @return mixed
     */
    public function getOption($key);

    /**
     * Check whether option container has value with this key
     *
     * @param mixed $key
     *
     * @return mixed
     */
    public function hasOption($key);

    /**
     * Return valid option value or default value
     *
     * @param mixed $key
     * @param mixed $defaultOption
     *
     * @return mixed
     */
    public function getValidOptionOrDefault($key, $defaultOption);
}
