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
use Phalcon\Web\Tools;
use Phalcon\Commands\CommandsException;

/**
 * Webtools Command
 *
 * Enables/disables webtools in a project
 *
 * @package Phalcon\Commands\Builtin
 */
class Webtools extends Command
{
    /**
     * {@inheritdoc}
     *
     * @return array
     */
    public function getPossibleParams()
    {
        return [
            'action=s' => 'Enables/Disables webtools in a project [enable|disable]',
            'help'     => 'Shows this help [optional]',
        ];
    }

    /**
     * {@inheritdoc}
     *
     * @param array $parameters
     * @return mixed
     * @throws CommandsException
     */
    public function run(array $parameters)
    {
        $action = $this->getOption(['action', 1]);
        $directory = './';

        if ($action == 'enable') {
            if (file_exists($directory . 'public/webtools.php')) {
                throw new CommandsException('Webtools are already enabled!');
            }

            Tools::install($directory);

            echo Color::success('Webtools successfully enabled!');
        } elseif ($action == 'disable') {
            if (!file_exists($directory . 'public/webtools.php')) {
                throw new CommandsException('Webtools are already disabled!');
            }

            Tools::uninstall($directory);

            echo Color::success('Webtools successfully disabled!');
        } else {
            throw new CommandsException('Invalid action!');
        }
    }

    /**
     * {@inheritdoc}
     *
     * @return array
     */
    public function getCommands()
    {
        return ['webtools', 'create-webtools'];
    }

    /**
     * {@inheritdoc}
     *
     * @return void
     */
    public function getHelp()
    {
        echo Color::head('Help:') . PHP_EOL;
        echo Color::colorize('  Enables/disables webtools in a project') . PHP_EOL . PHP_EOL;

        print Color::head('Usage: Enable webtools') . PHP_EOL;
        print Color::colorize('  webtools enable', Color::FG_GREEN) . PHP_EOL . PHP_EOL;

        print Color::head('Usage: Disable webtools') . PHP_EOL;
        print Color::colorize('  webtools disable', Color::FG_GREEN) . PHP_EOL . PHP_EOL;

        echo Color::head('Arguments:') . PHP_EOL;
        echo Color::colorize('  help', Color::FG_GREEN);
        echo Color::colorize("\tShows this help text") . PHP_EOL . PHP_EOL;

        $this->printParameters($this->getPossibleParams());
    }

    /**
     * {@inheritdoc}
     *
     * @return integer
     */
    public function getRequiredParams()
    {
        return 1;
    }
}
