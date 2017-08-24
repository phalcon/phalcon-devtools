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
  | Authors: Paul Scarrone <paul@savvysoftworks.com>                       |
  +------------------------------------------------------------------------+
*/

namespace Phalcon\Commands;

use Phalcon\Exception;
use Phalcon\Generator\Stub;
use Phalcon\Script\Color;

/**
 * .phalcon is missing Exception
 *  This is thrown when a CLI command is run without a .phalcon file
 *  In the CWD
 * @package Phalcon\Commands
 */
class DotPhalconMissingException extends CommandsException implements iSelfHealingException
{
    const DEFAULT_MESSAGE = "This command must be run inside a Phalcon project with a .phalcon directory.";
    const RESOLUTION_PROMPT = "Shall I create the .phalcon directory now? (y/n)";

    public function __construct (string $message = self::DEFAULT_MESSAGE , $code = 0)
    {
        $this->message = $message;
        $this->code = $code;
    }

    public function scanPathMessage()
    {
        return "One was not found at " . getcwd();
    }

    public function promptResolution() {
        fwrite(STDOUT, Color::info(self::RESOLUTION_PROMPT));
        $handle = fopen ("php://stdin","r");
        $line = fgets($handle);
        if(trim($line) != 'y'){
            echo "ABORTING!\n";
            return false;
        }
        fclose($handle);
        echo "\n";
        echo "Retrying command...\n";
        $this->resolve();
        return true;
    }

    public function resolve() {
        return mkdir(getcwd() . "/.phalcon");
    }
}
