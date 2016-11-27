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

namespace Phalcon\Exception\Db;

use Phalcon\Db\Exception;
use Phalcon\Db\ColumnInterface;

/**
 * \Phalcon\Exception\Db\UnknownColumnTypeException
 *
 * @package Phalcon\Exception
 */
class UnknownColumnTypeException extends Exception
{
    /**
     * @var ColumnInterface
     */
    protected $column;

    public function __construct(ColumnInterface $column)
    {
        $this->column = $column;

        $message = sprintf(
            'Unrecognized data type "%s" for column "%s".',
            $column->getType(),
            $column->getName()
        );

        parent::__construct($message, 0);
    }

    /**
     * @return ColumnInterface
     */
    public function getColumn()
    {
        return $this->column;
    }
}
