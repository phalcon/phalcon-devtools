<?php

/**
 * This file is part of the Phalcon Developer Tools.
 *
 * (c) Phalcon Team <team@phalcon.io>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace Phalcon\Version;

/**
 * Interface VersionItemInterface.
 * Common interface to manipulate version items.
 *
 * @package   Phalcon\Version
 * @copyright Copyright (c) 2011-2016 Phalcon Team (team@phalconphp.com)
 * @license   New BSD License
 */
interface ItemInterface
{
    /**
     * Get integer payload of the version
     *
     * @return integer
     */
    public function getStamp();

    /**
     * Get the string representation of the version
     *
     * @return string
     */
    public function getVersion();

    /**
     * Get the string representation of the version
     *
     * @return string
     */
    public function __toString();

    /**
     * Set migrations directory of incremental item
     *
     * @param string $path
     */
    public function setPath($path);


    /**
     * Get migrations directory of incremental item
     *
     * @return string
     */
    public function getPath();
}
