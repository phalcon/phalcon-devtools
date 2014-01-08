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
use Phalcon\Web\Tools;

/**
 * Phalcon\Commands\Webtools
 *
 * Enables/disables webtools in a project
 */
class Webtools extends Command implements CommandsInterface
{
    /**
     * Possible command parameters
     *
     * @var array
     */
    protected $params = array(
        'action=s' => 'Enables/Disables webtools in a project'
    );

    /**
     * Return an array of possible command parameters
     *
     * @return array
     */
    public function getPossibleParams()
    {
        return $this->params;
    }

    /**
     * Run the command
     *
     * @param  array $parameters
     * @return void
     */
    public function run($parameters)
    {
        $action = $this->getOption(array('action', 1));
        $directory = './';

        if ($action == 'enable') {
            if (file_exists($directory . 'public/webtools.php'))
                throw new \Exception('Webtools are already enabled!');

            Tools::install($directory);

            echo Color::success('Webtools successfully enabled!');
        } elseif ($action == 'disable') {
            if ( ! file_exists($directory . 'public/webtools.php'))
                throw new \Exception('Webtools are already disabled!');

            Tools::uninstall($directory);

            echo Color::success('Webtools successfully disabled!');
        } else {
            throw new \Exception('Invalid action!');
        }
    }

    /**
     * Return the commands provided by the command
     *
     * @return array
     */
    public function getCommands()
    {
        return array('webtools');
    }

    /**
     * Check whether the command can be executed outside a Phalcon project
     *
     * @return bool
     */
    public function canBeExternal()
    {
        return false;
    }

    /**
     * Print the help on the usage of the command
     *
     * @return void
     */
    public function getHelp()
    {
        echo Color::head('Help:') . PHP_EOL;
        echo Color::colorize('  Enables/disables webtools in a project') . PHP_EOL . PHP_EOL;

        echo Color::head('Usage:') . PHP_EOL;
        echo Color::colorize('  webtools [action]', Color::FG_GREEN) . PHP_EOL . PHP_EOL;

        echo Color::head('Arguments:') . PHP_EOL;
        echo Color::colorize('  ?', Color::FG_GREEN);
        echo Color::colorize("\tShows this help text") . PHP_EOL . PHP_EOL;

        $this->echoParameters($this->params);
    }

    /**
     * Return the number of required parameters for this command
     *
     * @return int
     */
    public function getRequiredParams()
    {
        return 1;
    }
}
