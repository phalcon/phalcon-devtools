<?php

/**
 * This file is part of the Phalcon Developer Tools.
 *
 * (c) Phalcon Team <team@phalcon.io>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace Phalcon\Commands;

/**
 * Commands Interface
 *
 * This interface must be implemented by all commands
 *
 * @package Phalcon\Commands
 */
interface CommandsInterface
{
    /**
     * Executes the command.
     *
     * @param array $parameters
     * @return mixed
     */
    public function run(array $parameters);

    /**
     * Returns the command identifier.
     *
     * @return array
     */
    public function getCommands();

    /**
     * Checks whether the command can be executed outside a Phalcon project.
     *
     * @return boolean
     */
    public function canBeExternal();

    /**
     * Prints help on the usage of the command.
     *
     * @return void
     */
    public function getHelp();

    /**
     * Return required parameters.
     *
     * @return integer
     */
    public function getRequiredParams();

    /**
     * Checks whether the command has identifier.
     *
     * @param string $identifier
     *
     * @return boolean
     */
    public function hasIdentifier($identifier);

    /**
     * Gets possible command parameters.
     *
     * This method returns a list of available parameters for the current command.
     * The list must be represented as pairs key-value.
     * Where key is the parameter name and value is the short description.
     *
     * @return array
     */
    public function getPossibleParams();
}
