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
  |          Serghei Iakovlev <serghei@phalconphp.com>                     |
  +------------------------------------------------------------------------+
*/

namespace Phalcon\Utils;

use Phalcon\Text;
use DirectoryIterator;
use Phalcon\Exception\InvalidArgumentException;
use SplFileInfo;
use ArrayIterator;
use Iterator;
use RuntimeException;

/**
 * \Phalcon\Utils\FsUtils
 *
 * @package Phalcon\Utils
 */
class FsUtils
{
    /**
     * Normalize file path.
     *
     * - Convert all slashes depending on the operating system
     * - Get rid of '..', '.'
     * - Remove self referring paths ('/./')
     * - Remove any kind of funky unicode whitespace
     * - Reduce slashes
     *
     * @param string $path Path to normalize
     *
     * @return mixed
     * @throws InvalidArgumentException
     */
    public function normalize($path)
    {
        if (!is_string($path)) {
            throw new InvalidArgumentException('The $path parameter must be an string. Got: ' . gettype($path));
        }

        if (empty($path = trim($path))) {
            return '';
        }

        $normalized = preg_replace('#\p{C}+|^\./#u', '', $path);
        $normalized = preg_replace('#/\.(?=/)|^\./|(/|^)\./?$#', '', $normalized);
        $normalized = str_replace(['\\', '/'], DS, $normalized);

        return Text::reduceSlashes($normalized);
    }

    /**
     * Checks whether the path is absolute or not.
     *
     * @param string $path Path to check
     *
     * @return bool
     * @throws InvalidArgumentException
     */
    public function isAbsolute($path)
    {
        if (!is_string($path)) {
            throw new InvalidArgumentException('The $path parameter must be an string. Got: ' . gettype($path));
        }

        if (empty($path = trim($path))) {
            return false;
        }

        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            return boolval(preg_match('/^[A-Z]:\\\\/', $path));
        }

        return substr($path, 0, 1) === DS;
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
        if (!function_exists('posix_getpwuid')) {
            // Windows, fallback, etc.
            return getenv('USERNAME') ?: getenv('USER');
        }

        $user  = posix_getpwuid($file->getOwner());
        $group = posix_getgrgid($file->getGroup());

        $userName  = !empty($user['name'])  ? $user['name'] : '-?-';
        $groupName = !empty($group['name']) ? $group['name'] : '-?-';

        return $userName . ' / ' . $groupName;
    }

    /**
     * Set permission to public folder
     *
     * @param SplFileInfo $root
     * @param array $dir
     */
    public function setDirectoryPermission(SplFileInfo $root, $dir)
    {
        $this->createRecursiveDirectory($root);
        $iterator = new ArrayIterator($dir);
        $cb = function (Iterator $iterator, $basePath) {
            while($iterator->valid()) {
                $desiredPath = $basePath . DS . $iterator->key() . DS;
                if (!file_exists($desiredPath)) {
                    $this->createRecursiveDirectory(new SplFileInfo($desiredPath));
                }
                chmod($desiredPath . DS, $iterator->current());

                $iterator->next();
            }
        };

        $this->applyWithCallback($iterator, $cb, [$iterator, $root->getRealPath()]);
    }

    /**
     * Callback function
     *
     * @param callable $cb
     * @param array $rights
     */
    protected function applyWithCallback($iterator, $cb, $params)
    {
        iterator_apply($iterator, $cb, $params);
    }

    /**
     * Create directory
     *
     * @param SplFileInfo $path
     */
    protected function createRecursiveDirectory(SplFileInfo $root)
    {
        if ($root->isDir()) {
            return;
        }

        if ($root->isFile()) {
            throw new RuntimeException("A {$root} can't be a file");
        }

        if (!mkdir($root, 0777, true)) {
            throw new RuntimeException("Unable to create {$root} path");
        }
    }

    /**
     * Delete files from directory
     *
     * @param SplFileInfo $path
     * @param array $files
     */
    public function deleteFilesFromDirectory(SplFileInfo $root, $files)
    {
        $iterator = new ArrayIterator($files);
        $cb = function (Iterator $iterator, $basePath) {
            while($iterator->valid()) {
                $desiredPath = $basePath . DS . $iterator->current();
                if (file_exists($desiredPath)) {
                    unlink($desiredPath);
                }

                $iterator->next();
            }
        };

        $this->applyWithCallback($iterator, $cb, [$iterator, $root->getRealPath()]);
    }
}
