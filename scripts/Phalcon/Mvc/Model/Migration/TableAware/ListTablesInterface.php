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
