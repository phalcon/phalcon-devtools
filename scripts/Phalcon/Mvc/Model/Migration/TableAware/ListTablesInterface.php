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

/**
 * Phalcon\Mvc\Model\Migration\TableAware\ListTablesInterface
 *
 * @package Phalcon\Mvc\Model\Migration\TableAware
 */
interface ListTablesInterface
{
    /**
     * Get list table from prefix
     *
     * @param string $tablePrefix Table prefix
     * @param \DirectoryIterator $iterator
     * @return string
     */
    public function listTablesForPrefix($tablePrefix, \DirectoryIterator $iterator = null);
}
