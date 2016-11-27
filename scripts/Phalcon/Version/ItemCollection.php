<?php

/*
  +------------------------------------------------------------------------+
  | Phalcon Developer Tools                                                |
  +------------------------------------------------------------------------+
  | Copyright (c) 2011-2016 Phalcon Team (https://www.phalconphp.com)      |
  +------------------------------------------------------------------------+
  | This source file is subject to the New BSD License that is bundled     |
  | with this package in the file LICENSE.txt.                             |
  |                                                                        |
  | If you did not receive a copy of the license and are unable to         |
  | obtain it through the world-wide-web, please send an email             |
  | to license@phalconphp.com so we can send you a copy immediately.       |
  +------------------------------------------------------------------------+
  | Authors: Andres Gutierrez <andres@phalconphp.com>                      |
  |          Eduar Carvajal <eduar@phalconphp.com>                         |
  |          Ivan Zinovyev <vanyazin@gmail.com>                            |
  +------------------------------------------------------------------------+
*/

namespace Phalcon\Version;

/**
 * Class ItemCollection.
 * The item collection lets you to work with an abstract ItemInterface.
 *
 * @package   Phalcon\Version
 * @copyright Copyright (c) 2011-2016 Phalcon Team (team@phalconphp.com)
 * @license   New BSD License
 */
class ItemCollection
{
    /**
     * Incremental version item
     *
     * @const int
     */
    const TYPE_INCREMENTAL = 1;

    /**
     * Timestamp prefixed version item
     *
     * @const int
     */
    const TYPE_TIMESTAMPED = 2;

    /**
     * @var int
     */
    public static $type = self::TYPE_INCREMENTAL;

    /**
     * Set collection type
     *
     * @param int $type
     */
    public static function setType($type)
    {
        self::$type = $type;
    }

    /**
     * Create new version item
     *
     * @param null|string $version
     * @param array       $options
     *
     * @return ItemInterface
     */
    public static function createItem($version = null, array $options = [])
    {
        if (self::TYPE_INCREMENTAL === self::$type) {
            $version = $version ?: '0.0.0';

            return new IncrementalItem($version);
        } elseif (self::TYPE_TIMESTAMPED === self::$type) {
            $version = $version ?: '0000000_0';

            return new TimestampedItem($version, $options);
        }

        throw new \LogicException('Could not create an item of unknown type.');
    }

    /**
     * Check if provided version is correct
     *
     * @param $version
     *
     * @return bool
     */
    public static function isCorrectVersion($version)
    {
        if (self::TYPE_INCREMENTAL === self::$type) {
            return 1 === preg_match('#[0-9]+(\.[z0-9]+)+#', $version);
        } elseif (self::TYPE_TIMESTAMPED === self::$type) {
            return 1 === preg_match('#^[\d]{7,}(?:\_[a-z0-9]+)*$#', $version);
        }

        return false;
    }

    /**
     * Sort items in the ascending order
     *
     * @param ItemInterface[] $versions
     *
     * @return ItemInterface[]
     */
    public static function sortAsc(array $versions)
    {
        $sortData = array();
        foreach ($versions as $version) {
            $sortData[$version->getStamp()] = $version;
        }
        ksort($sortData);

        return array_values($sortData);
    }

    /**
     * Sort items in the descending order
     *
     * @param ItemInterface[] $versions
     *
     * @return ItemInterface[]
     */
    public static function sortDesc(array $versions)
    {
        $sortData = array();
        foreach ($versions as $version) {
            $sortData[$version->getStamp()] = $version;
        }
        krsort($sortData);

        return array_values($sortData);
    }

    /**
     * Get the maximum value from the list of version items
     *
     * @param array $versions
     *
     * @return null|ItemInterface
     */
    public static function maximum(array $versions)
    {
        if (count($versions) == 0) {
            return null;
        }
        $versions = self::sortDesc($versions);

        return $versions[0];
    }

    /**
     * Get all the versions between two limitary version items
     *
     * @param ItemInterface   $initialVersion
     * @param ItemInterface   $finalVersion
     * @param ItemInterface[] $versions
     *
     * @return ItemInterface[]|array
     */
    public static function between(
        ItemInterface $initialVersion,
        ItemInterface $finalVersion,
        array $versions
    ) {
        $versions = self::sortAsc($versions);

        if (!is_object($initialVersion)) {
            $initialVersion = self::createItem($initialVersion);
        }

        if (!is_object($finalVersion)) {
            $finalVersion = self::createItem($finalVersion);
        }

        $betweenVersions = array();
        if ($initialVersion->getStamp() == $finalVersion->getStamp()) {
            return $betweenVersions; // nothing to do
        }

        if ($initialVersion->getStamp() < $finalVersion->getStamp()) {
            $versions = self::sortAsc($versions);
        } else {
            $versions = self::sortDesc($versions);
            list($initialVersion, $finalVersion) = array($finalVersion, $initialVersion);
        }

        foreach ($versions as $version) {
            if (($version->getStamp() >= $initialVersion->getStamp()) &&
                ($version->getStamp() <= $finalVersion->getStamp())
            ) {
                $betweenVersions[] = $version;
            }
        }

        return $betweenVersions;
    }
}
