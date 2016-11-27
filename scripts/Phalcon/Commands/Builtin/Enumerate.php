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
  +------------------------------------------------------------------------+
*/

namespace Phalcon\Commands\Builtin;

use Phalcon\Script\Color;
use Phalcon\Commands\Command;

/**
 * Enumerate Command
 *
 * @package Phalcon\Commands\Builtin
 */
class Enumerate extends Command
{
    const COMMAND_COLUMN_LEN = 16;

    /**
     * {@inheritdoc}
     *
     * @return array
     */
    public function getPossibleParams()
    {
        return [
            'help' => 'Shows this help [optional]',
        ];
    }

    /**
     * {@inheritdoc}
     *
     * @param array $parameters
     * @return mixed
     */
    public function run(array $parameters)
    {
        print Color::colorize('Available commands:', Color::FG_BROWN) . PHP_EOL;
        foreach ($this->getScript()->getCommands() as $commands) {
            $providedCommands = $commands->getCommands();
            $commandLen = strlen($providedCommands[0]);

            print '  ' . Color::colorize($providedCommands[0], Color::FG_GREEN);
            unset($providedCommands[0]);
            if (count($providedCommands)) {
                $spacer = str_repeat(' ', self::COMMAND_COLUMN_LEN - $commandLen);
                print $spacer.' (alias of: ' . Color::colorize(join(', ', $providedCommands)) . ')';
            }
            print PHP_EOL;
        }
        print PHP_EOL;
    }

    /**
     * {@inheritdoc}
     *
     * @return array
     */
    public function getCommands()
    {
        return ['commands', 'list', 'enumerate'];
    }

    /**
     * {@inheritdoc}
     *
     * @return boolean
     */
    public function canBeExternal()
    {
        return true;
    }

    /**
     * {@inheritdoc}
     *
     * @return void
     */
    public function getHelp()
    {
        print Color::head('Help:') . PHP_EOL;
        print Color::colorize('  Lists the commands available in Phalcon DevTools') . PHP_EOL . PHP_EOL;

        $this->run([]);
    }

    /**
     * {@inheritdoc}
     *
     * @return integer
     */
    public function getRequiredParams()
    {
        return 0;
    }
}
