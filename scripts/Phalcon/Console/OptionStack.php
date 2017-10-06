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

use Phalcon\Console\OptionParserTrait;

/**
 * Phalcon\Console\OptionStack
 *
 * CLI options
 *
 * @package Phalcon\Console;
 * @copyright Copyright (c) 2011-2017 Phalcon Team (team@phalconphp.com)
 * @license   New BSD License
 */
class OptionStack
{
    use OptionParserTrait;

    /**
     * Parameters received by the script.
     * @var array
     */
    protected $options = [];

    /**
     * Set recieved options
     *
     * @param array $options
     */
    public function setOptions(array $options)
    {
        $this->options = array_merge($this->options, $options);
    }

    /**
     * Add option to array
     *
     * @param mixed $key
     * @param mixed $option
     * @param mixed $defaultValue
     */
    public function setOption($key, $option, $defaultValue = '')
    {
        if (!empty($option)) {
            $this->options[$key] = $option;

            return;
        }

        $this->options[$key] = $defaultValue;
    }

    /**
     * Set option if value isn't exist
     *
     * @param string $key
     * @param mixed $defaultValue
     */
    public function setDefaultOption($key, $defaultValue)
    {
        if (!isset($this->options[$key])) {
            $this->options[$key] = $defaultValue;
        }
    }

    /**
     * Get recieved options
     *
     * @return mixed
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * Get option
     * @param string $key
     *
     * @return mixed
     */
    public function getOption($key)
    {
        if (!isset($this->options[$key])) {
            return '';
        }

        return $this->options[$key];
    }

    /**
     * Get option if existence or get default option
     *
     * @param  string  $key
     * @param  mixed  $defaultOption
     *
     * @return mixed
     */
    public function getValidOption($key, $defaultOption = '')
    {
        if (isset($this->options[$key])) {
            return $this->options[$key];
        }

        return $defaultOption;
    }

    /**
     * Count options
     *
     * @return integer
     */
    public function countOptions()
    {
        return count($this->options);
    }

    /**
     * Indicates whether the script was a particular option.
     *
     * @param  string  $key
     * @return boolean
     */
    public function isReceivedOption($key)
    {
        return isset($this->options[$key]);
    }
}
