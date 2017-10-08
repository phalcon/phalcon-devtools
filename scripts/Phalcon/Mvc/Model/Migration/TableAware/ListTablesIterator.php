<?php

/*
  +------------------------------------------------------------------------+
  | Phalcon Developer Tools                                                |
  +------------------------------------------------------------------------+
  | Copyright (c) 2011-2017 Phalcon Team (https://www.phalconphp.com)      |
  +------------------------------------------------------------------------+
  | This source file is subject to the New BSD License that is bundled     |
  | with this package in the file LICENSE.txt.                             |
  |                                                                        |
  | If you did not receive a copy of the license and are unable to         |
  | obtain it through the world-wide-web, please send an email             |
  | to license@phalconphp.com so we can send you a copy immediately.       |
  +------------------------------------------------------------------------+
  | Authors: Sergii Svyrydenko <sergey.v.sviridenko@gmail.com>             |
  +------------------------------------------------------------------------+
*/

namespace Phalcon\Mvc\Model\Migration\TableAware;

use Phalcon\Mvc\Model\Migration\TableAware\ListTablesInterface;
use DirectoryIterator;
use InvalidArgumentException;

/**
 * Phalcon\Mvc\Model\Migration\TableAware\ListTablesIterator
 *
 * @package Phalcon\Mvc\Model\Migration\TableAware
 */
class ListTablesIterator implements ListTablesInterface
{
    /**
     * Get table names with prefix for running migration
     *
     * @param string $tablePrefix
     * @param DirectoryIterator $iterator
     * @return string
     */
    public function listTablesForPrefix($tablePrefix, DirectoryIterator $iterator = null)
    {
        if (empty($tablePrefix) || empty($iterator)) {
            throw new InvalidArgumentException("Parameters weren't defined in " . __METHOD__);
        }

        $strlen = strlen($tablePrefix);
        $fileNames = [];
        foreach ($iterator as $fileInfo) {
            if (substr($fileInfo->getFilename(), 0, $strlen) == $tablePrefix) {
                $file = explode('.', $fileInfo->getFilename());
                $fileNames[] = $file[0];
            }
        }

        $fileNames = array_unique($fileNames);
//        natsort($fileNames);

        return implode(',', $fileNames);
    }
}
