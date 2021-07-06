<?php

/*
  +------------------------------------------------------------------------+
  | Phalcon Developer Tools                                                |
  +------------------------------------------------------------------------+
  | Copyright (c) 2011-present Phalcon Team (https://www.phalconphp.com)   |
  +------------------------------------------------------------------------+
  | This source file is subject to the New BSD License that is bundled     |
  | with this package in the file LICENSE.txt.                             |
  |                                                                        |
  | If you did not receive a copy of the license and are unable to         |
  | obtain it through the world-wide-web, please send an email             |
  | to license@phalconphp.com so we can send you a copy immediately.       |
  +------------------------------------------------------------------------+
  | Authors: Kevin Yarmak <ultimater@gmail.com>                            |
  +------------------------------------------------------------------------+
*/

namespace Phalcon\Exception\Db;

use PDOException;
use Phalcon\Script\Color;
use PDO;

class PDODriverNotFoundException extends PDOException
{
    protected $adapter = '';

    public function __construct($message, $adapter = '')
    {
        parent::__construct($message);
        $this->adapter = $adapter;
    }

    public function getAdapter()
    {
        return $this->adapter;
    }

    public function writeNicelyFormattedErrorOutput()
    {
        fwrite(STDERR, Color::error($this->getMessage()) . PHP_EOL);

        if (!extension_loaded('PDO')) {
            fwrite(STDERR, Color::error('PDO extension is not loaded') . PHP_EOL);
        } else {
            $loadedDrivers = PDO::getAvailableDrivers();
            fwrite(STDERR, 'PDO Drivers loaded:' . PHP_EOL);
            fwrite(STDERR, print_r($loadedDrivers, true). PHP_EOL);
        }
    }
}
