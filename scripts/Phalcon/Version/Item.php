<?php

/*
  +------------------------------------------------------------------------+
  | Phalcon Developer Tools                                                |
  +------------------------------------------------------------------------+
  | Copyright (c) 2011-2014 Phalcon Team (http://www.phalconphp.com)       |
  +------------------------------------------------------------------------+
  | This source file is subject to the New BSD License that is bundled     |
  | with this package in the file docs/LICENSE.txt.                        |
  |                                                                        |
  | If you did not receive a copy of the license and are unable to         |
  | obtain it through the world-wide-web, please send an email             |
  | to license@phalconphp.com so we can send you a copy immediately.       |
  +------------------------------------------------------------------------+
  | Authors: Andres Gutierrez <andres@phalconphp.com>                      |
  |          Eduar Carvajal <eduar@phalconphp.com>                         |
  +------------------------------------------------------------------------+
*/

namespace Phalcon\Version;

/**
 * Phalcon\Version\Item
 *
 * Allows to manipulate version texts
 *
 * @category 	Phalcon
 * @package 	Scripts
 * @copyright   Copyright (c) 2011-2014 Phalcon Team (team@phalconphp.com)
 * @license 	New BSD License
 */
class Item
{

    /**
     * @var string
     */
    private $_version;

    /**
     * @var int|string
     */
    private $_versionStamp = 0;

    /**
     * @var array
     */
    private $_parts = array();

    /**
     * @param     $version
     * @param int $numberParts
     */
    public function __construct($version, $numberParts=3)
    {
        $n = 9;
        $versionStamp = 0;
        $this->_parts = explode('.', $version);
        $nParts = count($this->_parts);
        if ($nParts < $numberParts) {
            for ($i = $numberParts; $i>=$nParts; $i--) {
                $this->_parts[] = '0';
                $version.='.0';
            }
        } else {
            if ($nParts > $numberParts) {
                for ($i = $nParts; $i <= $numberParts; $i++) {
                    if (isset($this->_parts[$i-1])) {
                        unset($this->_parts[$i-1]);
                    }
                }
                $version = join('.', $this->_parts);
            }
        }
        foreach ($this->_parts as $part) {
            if (is_numeric($part)) {
                $versionStamp += $part*pow(10, $n);
            } else {
                $versionStamp += ord($part)*pow(10, $n);
            }
            $n-=3;
        }
        $this->_versionStamp = $versionStamp;
        $this->_version = $version;
    }

    /**
     * @param $versions Item[]
     *
     * @return array Item[]
     */
    public static function sortAsc($versions)
    {
        $sortData = array();
        foreach ($versions as $version) {
            $sortData[$version->getStamp()] = $version;
        }
        ksort($sortData);

        return array_values($sortData);
    }

    /**
     * @param $versions Item[]
     *
     * @return array
     */
    public static function sortDesc($versions)
    {
        $sortData = array();
        foreach ($versions as $version) {
            $sortData[$version->getStamp()] = $version;
        }
        krsort($sortData);

        return array_values($sortData);
    }

    /**
     * @param $versions Item[]
     *
     * @return \Phalcon\Version\Item
     */
    public static function maximum($versions)
    {
        if (count($versions) == 0) {
            return null;
        } else {
            $versions = self::sortDesc($versions);

            return $versions[0];
        }
    }

    /**
     * Allows to check whether a version is in a range between two values.
     *
     * @param  string  $initialVersion
     * @param  string  $finalVersion
     * @param  array   $versions       Item[]
     * @return boolean
     */
    public static function between($initialVersion, $finalVersion, $versions)
    {
        if (!is_object($initialVersion)) {
            $initialVersion = new self($initialVersion);
        }
        if ( !is_object($finalVersion)) {
            $finalVersion = new self($finalVersion);
        }
        if ($initialVersion->getStamp() > $finalVersion->getStamp()) {
            list($initialVersion, $finalVersion) = array($finalVersion, $initialVersion);
        }
        $betweenVersions = array();
        foreach ($versions as $version) {
            /**
             * @var $version Item
             */
            if (($version->getStamp() >= $initialVersion->getStamp()) && ($version->getStamp() <= $finalVersion->getStamp())) {
                $betweenVersions[] = $version;
            }
        }

        return self::sortAsc($betweenVersions);
    }

    /**
     * @return int|string
     */
    public function getStamp()
    {
        return $this->_versionStamp;
    }

    /**
     * @param $number
     *
     * @return string
     */
    public function addMinor($number)
    {
        $parts = array_reverse($this->_parts);
        if (isset($parts[0])) {
            if (is_numeric($parts[0])) {
                $parts[0]+=$number;
            } else {
                $parts[0] = ord($parts[0])+$number;
            }
        }

        return join('.', array_reverse($parts));
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->_version;
    }

}
