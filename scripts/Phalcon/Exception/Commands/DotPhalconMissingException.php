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
  | Authors: Paul Scarrone <paul@savvysoftworks.com>                       |
  +------------------------------------------------------------------------+
*/

namespace Phalcon\Exception\Commands;

use Phalcon\Exception;
use Phalcon\Script\Color;

/**
 * Phalcon\Exception\Commands\DotPhalconMissingException
 *
 * .phalcon is missing Exception
 * This is thrown when a CLI command is run without a .phalcon file
 * In the CWD
 *
 * @package Phalcon\Exception\Commands
 */
class DotPhalconMissingException extends CommandsException
{
    const DEFAULT_MESSAGE = "This command must be run inside a Phalcon project with a .phalcon directory.";

    public function __construct ($message = self::DEFAULT_MESSAGE , $code = 0)
    {
        if (!is_string($message)) {
            $message = self::DEFAULT_MESSAGE;
        }

        $this->message = $message;
        $this->code = $code;

        parent::__construct();
    }

    public function scanPathMessage()
    {
        return "One was not found at " . getcwd();
    }
}
