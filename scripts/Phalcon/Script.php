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

namespace Phalcon;

use Phalcon\Commands\Command;

/**
 * \Phalcon\Script
 *
 * Component that allows you to write scripts to use CLI.
 *
 * @category 	Phalcon
 * @package 	Scripts
 * @copyright   Copyright (c) 2011-2012 Phalcon Team (team@phalconphp.com)
 * @license 	New BSD License
 */
class Script
{

	const COMPATIBLE_VERSION = '';

	/**
	 * Commands attached to the Script
	 *
	 * @var array
	 */
	private $_commands;

	public function __construct()
	{
		$this->_commands = array();
	}

	public function loadBuiltInCommands()
	{
		$this->attach(new \Phalcon\Commands\Builtin\Enumerate());
		$this->attach(new \Phalcon\Commands\Builtin\Controller());
		$this->attach(new \Phalcon\Commands\Builtin\Model());
		$this->attach(new \Phalcon\Commands\Builtin\AllModels());
		$this->attach(new \Phalcon\Commands\Builtin\Project());
		$this->attach(new \Phalcon\Commands\Builtin\Scaffold());
	}

	public function loadUserCommands()
	{

	}

	/**
	 * Adds commands to the Script
	 *
	 * @param Phalcon\Commands\Command $command
	 */
	public function attach(Command $command)
	{
		$command->setScript($this);
		$this->_commands[] = $command;
	}

	/**
	 * Returns the commands registered in the script
	 *
	 * @return Phalcon\Commands\Command[]
	 */
	public function getCommands()
	{
		return $this->_commands;
	}

	/**
	 * Run the scripts
	 */
	public function run()
	{

		$input = $_SERVER['argv'][1];
		foreach ($this->_commands as $command) {
			if (in_array($input, $command->getCommands())) {
				return $command->run();
			}
		}

		throw new \Phalcon\Exception($input . ' is not a recognized command');
	}

}
