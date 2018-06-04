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

namespace Phalcon\Options;

use Phalcon\FactoryOptions;
use Phalcon\Exception\InvalidArgumentException;

/**
 * Phalcon\Options\OptionsAware
 *
 * Class that has option container and processing with it
 *
 * @package Phalcon\Options
 */
class OptionsAware implements FactoryOptions
{
    /**
     * Option container
     *
     * @var array
     */
    protected $options = [];

    /**
     * @param array $options
     */
    public function __construct(array $options = null)
    {
        if (!empty($options)) {
            $this->options = $options;
        }
    }

    /**
     * Set all options to option container
     *
     * @param array $options
     */
    public function setOptions(array $options)
    {
        $this->options = $options;
    }

    /**
     * Set one option to option container
     *
     * @param mixed $key
     * @param mixed $option
     */
    public function setOption($key, $option)
    {
        $this->options[$key] = $option;
    }

    /**
     * Set option, if it hasn't been defined before
     *
     * @param mixed $key
     * @param mixed $option
     */
    public function setNotDefinedOption($key, $option)
    {
        if (!isset($this->options[$key])) {
            $this->options[$key] = $option;
        }
    }

    /**
     * Set one valid option or default value to option container
     *
     * @param mixed $key
     * @param mixed $option
     * @param mixed $defaultValue
     */
    public function setValidOptionOrDefaultValue($key, $option, $defaultValue = '')
    {
        if (!empty($option)) {
            $this->options[$key] = $option;

            return;
        }

        $this->options[$key] = $defaultValue;
    }

    /**
     * Get all options from the option container
     *
     * @return array
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * Get valid option or throw exception
     *
     * @param mixed $key
     * @throw InvalidArgumentException
     *
     * @return mixed
     */
    public function getOption($key)
    {
        if (!isset($this->options[$key])) {
            throw new InvalidArgumentException("Option " . $key . " has't been defined");
        }

        return $this->options[$key];
    }

    /**
     * Check whether option container has value with this key
     *
     * @param mixed $key
     *
     * @return mixed
     */
    public function hasOption($key)
    {
        return isset($this->options[$key]);
    }

    /**
     * Return valid option value or default value
     *
     * @param mixed $key
     * @param mixed $defaultOption
     *
     * @return mixed
     */
    public function getValidOptionOrDefault($key, $defaultOption = '')
    {
        if (isset($this->options[$key])) {
            return $this->options[$key];
        }

        return $defaultOption;
    }
}
