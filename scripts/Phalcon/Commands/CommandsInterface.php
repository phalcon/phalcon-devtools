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
  |          Serghei Iakovlev <sadhooklay@gmail.com>                       |
  +------------------------------------------------------------------------+
*/

namespace Phalcon\Commands;

/**
 * Commands Interface
 *
 * This interface must be implemented by all commands
 *
 * @package     Phalcon\Commands
 * @copyright   Copyright (c) 2011-2015 Phalcon Team (team@phalconphp.com)
 * @license     New BSD License
 */
interface CommandsInterface
{
    /**
     * Executes the command
     *
     * @param $parameters
     * @return mixed
     */
    public function run($parameters);

    /**
     * Returns the command identifier
     *
     * @return array
     */
    public function getCommands();

    /**
     * Checks whether the command can be executed outside a Phalcon project
     *
     * @return boolean
     */
    public function canBeExternal();

    /**
     * Prints help on the usage of the command
     *
     * @return void
     */
    public function getHelp();

    /**
     * Return required parameters
     *
     * @return integer
     */
    public function getRequiredParams();

    /**
     * Checks whether the command has identifier
     *
     * @param string $identifier
     *
     * @return boolean
     */
    public function hasIdentifier($identifier);
}
