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

namespace Phalcon\DevTools;

/**
 * Interface for options and data that were generated
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
