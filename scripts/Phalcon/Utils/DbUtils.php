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

use Phalcon\Mvc\User\Component;

/**
 * \Phalcon\Utils\DbUtils
 *
 * @package Phalcon\Utils
 */
class DbUtils extends Component
{
    /**
     * List database tables
     *
     * @param  bool   $all
     * @param  string $connection
     * @return array
     */
    public function listTables($all = false, $connection = 'db')
    {
        $tables = $all ? ['@' => 'all'] : [];

        if ($this->getDI()->has($connection)) {
            $connection = $this->getDI()->getShared($connection);

            $dbTables = $connection->listTables();
            foreach ($dbTables as $dbTable) {
                $tables[$dbTable] = $dbTable;
            }
        }

        return $tables;
    }
}
