<?php

/*
  +------------------------------------------------------------------------+
  | Phalcon Developer Tools                                                |
  +------------------------------------------------------------------------+
  | Copyright (c) 2011-2015 Phalcon Team (http://www.phalconphp.com)       |
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
 * Class ItemCollection.
 * The item collection lets you to work with an abstract ItemInterface.
 *
 * @package     Phalcon\Version
 * @copyright   Copyright (c) 2011-2015 Phalcon Team (team@phalconphp.com)
 * @license     New BSD License
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
    const TYPE_TIMESTAMP = 2;

    /**
     * @var int
     */
    static $type = self::TYPE_INCREMENTAL;

    /**
     * Sort items in the ascending order
     *
     * @param ItemInterface[] $versions
     *
     * @return ItemInterface[]
     */
    public static function sortAsc(array $versions)
    {

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

    }

    /**
     * Get the maximum value from the list of version items
     *
     * @param array $versions
     *
     * @return ItemInterface
     */
    public static function maximum(array $versions)
    {

    }

    /**
     * Get all the versions between two limitary version items
     *
     * @param ItemInterface $initialVersion
     * @param ItemInterface $finalVersion
     * @param array         $versions
     *
     * @return array
     */
    public static function between(
        ItemInterface $initialVersion,
        ItemInterface $finalVersion,
        array $versions
    ) {

    }
}