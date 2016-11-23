<?php

/*
  +------------------------------------------------------------------------+
  | Phalcon Developer Tools                                                |
  +------------------------------------------------------------------------+
  | Copyright (c) 2011-2016 Phalcon Team (http://www.phalconphp.com)       |
  +------------------------------------------------------------------------+
  | This source file is subject to the New BSD License that is bundled     |
  | with this package in the file docs/LICENSE.txt.                        |
  |                                                                        |
  | If you did not receive a copy of the license and are unable to         |
  | obtain it through the world-wide-web, please send an email             |
  | to license@phalconphp.com so we can send you a copy immediately.       |
  +------------------------------------------------------------------------+
  | Authors: Ivan Zinovyev <vanyazin@gmail.com>                            |
  +------------------------------------------------------------------------+
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
    protected $_version;

    /**
     * @var boolean
     */
    protected $_isFullVersion;

    /**
     * @var array
     */
    protected $_parts = [];

    /**
     * @param string $version String representation of the version
     * @param array  $options Item specific options
     *
     * @throws \InvalidArgumentException
     */
    public function __construct($version, array $options = [])
    {
        if ((1 !== preg_match('#^[\d]{7,}(?:\_[a-z0-9]+)*$#', $version)) && $version != '000') {
            throw new \InvalidArgumentException('Wrong version number provided');
        }
        $this->_version = $version;

        $this->_parts = explode('_', $version);
        $this->_isFullVersion = isset($this->_parts[1]);
    }

    /**
     * Full version has both parts: number and description
     *
     * @return bool
     */
    public function isFullVersion()
    {
        return !!$this->_isFullVersion;
    }

    /**
     * Get integer payload of the version
     *
     * @return integer
     */
    public function getStamp()
    {
        return (int) $this->_parts[0];
    }

    /**
     * Get version description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->isFullVersion() ? $this->_parts[1] : '';
    }
}
