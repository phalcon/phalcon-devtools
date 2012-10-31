<?php

/*
	+------------------------------------------------------------------------+
	| Phalcon Framework                                                      |
	+------------------------------------------------------------------------+
	| Copyright (c) 2011-2012 Phalcon Team (http://www.phalconphp.com)       |
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

namespace Phalcon\Commands;

/**
 * Phalcon\Commands\CommandInterface
 *
 * This interface must be implemented by all commands
 */
interface CommandInterface
{

	/**
	 * Executes the command
	 *
	 */
	public function run();

	/**
	 * Returns the command identifier
	 *
	 * @return string
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
	 */
	public function getHelp();

	/**
	 * Returns number of required parameters for this command
	 */
	public function getRequiredParams();

}