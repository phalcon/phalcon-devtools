<?php

/*
  +------------------------------------------------------------------------+
  | Phalcon Developer Tools                                                |
  +------------------------------------------------------------------------+
  | Copyright (c) 2011-2015 Phalcon Team (http://www.phalconphp.com)       |
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

use Phalcon\Commands\Command;

/**
 * Module Command
 *
 * Create a module from command line
 *
 * @package     Phalcon\Commands\Builtin
 * @copyright   Copyright (c) 2011-2015 Phalcon Team (team@phalconphp.com)
 * @license     New BSD License
 */
class Module extends Command
{
    /**
     * {@inheritdoc}
     *
     * @return array
     */
    public function getPossibleParams()
    {
        return array();
    }

    /**
     * Executes the command
     *
     * @param $parameters
     * @return void
     */
    public function run($parameters)
    {

    }

    /**
     * Returns the command identifier
     *
     * @return array
     */
    public function getCommands()
    {
        return array('module', 'create-module');
    }

    /**
     * Prints the help for current command.
     *
     * @return void
     */
    public function getHelp()
    {

    }

    /**
     * Returns number of required parameters for this command
     *
     * @return integer
     */
    public function getRequiredParams()
    {

    }

    /**
     * Checks whether the command can be executed outside a Phalcon project
     *
     * @return boolean
     */
    public function canBeExternal()
    {
        return false;
    }
}
