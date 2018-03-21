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

use Phalcon\Registry;
use Phalcon\Devtools\Modules\Core\Exceptions\InvalidArgumentException;

/**
 * Phalcon\Devtools\Modules\Core\Options\OptionsRegistry
 *
 * Class that has option container and processing with it
 *
 * @package Phalcon\Devtools\Modules\Core\Options
 * @codeCoverageIgnoreStart
 */
class OptionsRegistry implements OptionsRegistryInterface
{
    /**
     * Option container
     *
     * @var Registry
     */
    private $registry;

    /**
     * @param array $options
     */
    public function __construct(array $options = [])
    {
        $this->registry = new Registry();

        $this->setOptions($options);
    }

    /**
     * Set one option to option container
     *
     * @param string $key
     * @param mixed $option
     */
    public function setOption(string $key, $option)
    {
        $this->registry->offsetSet($key, $option);
    }

    /**
     * Set all options to option container
     *
     * @param array $options
     */
    public function setOptions(array $options)
    {
        foreach ($options as $key => $option) {
            $this->setOption($key, $option);
        }
    }

    /**
     * Set option, if it hasn't been defined before
     *
     * @param string $key
     * @param mixed $option
     */
    public function attemptSet(string $key, $option)
    {
        if (!$this->registry->offsetExists($key)) {
            $this->registry->offsetSet($key, $option);
        }
    }

    /**
     * Set one option or default value to option container
     *
     * @param string $key
     * @param mixed $option
     * @param mixed $defaultValue
     */
    public function setNullCoalescingDefaultOption(string $key, $option, $defaultValue = '')
    {
        if ($option === null) {
            $this->setOption($key, $defaultValue);

            return;
        }

        $this->setOption($key, $option);
    }

    /**
     * Get all options from the option container
     *
     * @return array
     */
    public function getAll(): array
    {
        return iterator_to_array($this->registry);
    }

    /**
     * Get existent option or throw exception
     *
     * @param string $key
     * @throw InvalidArgumentException
     *
     * @return mixed
     */
    public function getOption(string $key)
    {
        if (!$this->hasOption($key)) {
            throw new InvalidArgumentException("Option " . $key . " has't been defined yet");
        }

        return $this->registry->offsetGet($key);
    }

    /**
     * Check whether option container has value with this key
     *
     * @param string $key
     *
     * @return bool
     */
    public function hasOption(string $key): bool
    {
        return $this->registry->offsetExists($key);
    }

    /**
     * Return valid option value or default value
     *
     * @param string $key
     * @param mixed $defaultOption
     *
     * @return mixed
     */
    public function getNullCoalescingDefaultOption(string $key, $defaultOption = '')
    {
        if ($this->hasOption($key)) {
            return $this->registry->offsetGet($key);
        }

        return $defaultOption;
    }
}
/**
 * @codeCoverageIgnoreEnd
 */
