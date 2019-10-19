<?php

/**
 * This file is part of the Phalcon Developer Tools.
 *
 * (c) Phalcon Team <team@phalcon.io>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
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
