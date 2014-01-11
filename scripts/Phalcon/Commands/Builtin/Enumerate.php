<?php

/*
  +------------------------------------------------------------------------+
  | Phalcon Developer Tools                                                |
  +------------------------------------------------------------------------+
  | Copyright (c) 2011-2014 Phalcon Team (http://www.phalconphp.com)       |
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
  +------------------------------------------------------------------------+
*/

namespace Phalcon\Commands\Builtin;

use Phalcon\Script\Color;
use Phalcon\Commands\Command;
use Phalcon\Commands\CommandsInterface;

/**
 * Phalcon\Commands\Enumerate
 *
 * List commands loaded in devtools
 */
class Enumerate extends Command implements CommandsInterface
{

    protected $_possibleParameters = array();

    /**
     * @param $parameters
     */
    public function run($parameters)
    {
        print Color::colorize('Available commands:', Color::FG_BROWN) . PHP_EOL ;
        foreach ($this->getScript()->getCommands() as $commands) {
            $providedCommands = $commands->getCommands();
            print '  ' . Color::colorize($providedCommands[0], Color::FG_GREEN);
            unset($providedCommands[0]);
            if (count($providedCommands)) {
                print ' (alias of: ' . Color::colorize(join(', ', $providedCommands)) . ')';
            }
            print PHP_EOL;
        }
        print PHP_EOL;
    }

    /**
     * Returns the commands provided by the command
     *
     * @return string|array
     */
    public function getCommands()
    {
        return array('commands', 'list', 'enumerate');
    }

    /**
     * Checks whether the command can be executed outside a Phalcon project
     */
    public function canBeExternal()
    {
        return true;
    }

    /**
     * Prints help on the usage of the command
     *
     */
    public function getHelp()
    {
        print Color::head('Help:') . PHP_EOL;
        print Color::colorize('  Lists the commands available in Phalcon devtools') . PHP_EOL . PHP_EOL;

        $this->run(array());
    }

    /**
     * Returns number of required parameters for this command
     *
     * @return int
     */
    public function getRequiredParams()
    {
        return 0;
    }

}
