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
  | Authors: Andres Gutierrez <andres@phalconphp.com>                      |
  |          Eduar Carvajal <eduar@phalconphp.com>                         |
  |          Serghei Iakovlev <serghei@phalconphp.com>                     |
  +------------------------------------------------------------------------+
*/

namespace Phalcon\Utils;

use Phalcon\Text;
use DirectoryIterator;

/**
 * \Phalcon\Utils\FsUtils
 *
 * @package Phalcon\Utils
 */
class FsUtils
{
    /**
     * Normalize directory separator depending on the operating system.
     *
     * @param string $path Path to normalize
     *
     * @return mixed
     */
    public function normalize($path)
    {
        return str_replace('/', DS, Text::reduceSlashes($path));
    }

    /**
     * Checks whether the path is absolute or not.
     *
     * @param string $path Path to check
     *
     * @return bool
     */
    public function isAbsolute($path)
    {
        if (!is_string($path) || empty($path = trim($path))) {
            return false;
        }

        if ('WIN' === strtoupper(substr(PHP_OS, 0, 3))) {
            return boolval(preg_match('/^[A-Z]:\\\\/', $path));
        }

        return DS === substr($path, 0, 1) || false;
    }

    /**
     * Return info about a user and group file iterator.
     *
     * @param DirectoryIterator $file
     *
     * @return string
     */
    public function getOwner(DirectoryIterator $file)
    {
        // Windows, fallback, etc.
        $owner = getenv('USERNAME') ?: getenv('USER');

        if (function_exists('posix_getpwuid')) {
            $user  = posix_getpwuid($file->getOwner());
            $group = posix_getgrgid($file->getGroup());

            $userName  = !empty($user['name'])  ? $user['name'] : '-?-';
            $groupName = !empty($group['name']) ? $group['name'] : '-?-';

            $owner = $userName . ' / ' . $groupName;
        }

        return $owner ?: '-?- / -?-';
    }
}
