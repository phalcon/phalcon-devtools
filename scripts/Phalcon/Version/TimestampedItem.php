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
 * Class TimestampedItem.
 *
 * The version prefixed by timestamp value
 *
 * @package   Phalcon\Version
 * @copyright Copyright (c) 2011-2016 Phalcon Team (team@phalconphp.com)
 * @license   New BSD License
 */
class TimestampedItem implements ItemInterface
{
    use VersionAwareTrait;

    /**
     * @var string
     */
    private $path;

    /**
     * @var string
     */
    protected $version;

    /**
     * @var boolean
     */
    protected $isFullVersion;

    /**
     * @var array
     */
    protected $parts = [];

    /**
     * @param string $version String representation of the version
     *
     * @throws \InvalidArgumentException
     */
    public function __construct($version)
    {
        if ((1 !== preg_match('#^[\d]{7,}(?:\_[a-z0-9]+)*$#', $version)) && $version != '000') {
            throw new \InvalidArgumentException('Wrong version number provided');
        }
        $this->version = $version;

        $this->parts         = explode('_', $version);
        $this->isFullVersion = isset($this->parts[1]);
    }

    /**
     * Full version has both parts: number and description
     *
     * @return bool
     */
    public function isFullVersion()
    {
        return !!$this->isFullVersion;
    }

    /**
     * Get integer payload of the version
     *
     * @return integer
     */
    public function getStamp()
    {
        return (int) $this->parts[0];
    }

    /**
     * Get version description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->isFullVersion() ? $this->parts[1] : '';
    }

    /**
     * Set migrations directory of incremental item
     *
     * @param string $path
     */
    public function setPath($path)
    {
        $this->path = $path;
    }


    /**
     * Get migrations directory of incremental item
     *
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }
}
