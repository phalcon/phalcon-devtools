<?php
declare(strict_types=1);

/**
 * This file is part of the Phalcon Developer Tools.
 *
 * (c) Phalcon Team <team@phalcon.io>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace Phalcon\DevTools\Commands;

/**
 * Commands Interface
 *
 * This interface must be implemented by all commands
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
    public function getCommands(): array;

    /**
     * Checks whether the command can be executed outside a Phalcon project.
     *
     * @return bool
     */
    public function canBeExternal(): bool;

    /**
     * Prints help on the usage of the command.
     *
     * @return void
     */
    public function getHelp(): void;

    /**
     * Return required parameters.
     *
     * @return int
     */
    public function getRequiredParams(): int;

    /**
     * Checks whether the command has identifier.
     *
     * @param string $identifier
     * @return bool
     */
    public function hasIdentifier($identifier): bool;

    /**
     * Gets possible command parameters.
     *
     * This method returns a list of available parameters for the current command.
     * The list must be represented as pairs key-value.
     * Where key is the parameter name and value is the short description.
     *
     * @return array
     */
    public function getPossibleParams(): array;
}
