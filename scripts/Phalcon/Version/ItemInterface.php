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
  | Authors: Ivan Zinovyev <vanyazin@gmail.com>                            |
  +------------------------------------------------------------------------+
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
}
