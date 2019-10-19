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
 * \Phalcon\Version\VersionAwareTrait
 *
 * @property string $version
 *
 * @package   Phalcon\Version
 * @copyright Copyright (c) 2011-2016 Phalcon Team (team@phalconphp.com)
 * @license   New BSD License
 */
trait VersionAwareTrait
{
    /**
     * Get the string representation of the version
     *
     * @return string
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * Get the string representation of the version
     *
     * @return string
     */
    public function __toString()
    {
        return $this->getVersion();
    }
}
