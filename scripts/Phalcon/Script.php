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
use Phalcon\Script\ScriptException;
use Phalcon\Events\Manager as EventsManager;

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

	const COMPATIBLE_VERSION = '0060011';

	/**
	 * Events Manager
	 *
	 * @var \Phalcon\Events\Manager
	 */
	protected $_eventsManager;

	/**
	 * Commands attached to the Script
	 *
	 * @var array
	 */
	protected $_commands;

	/**
	 * \Phalcon\Script constructor
	 *
	 * @param \Phalcon\Events\Manager $eventsManager
	 */
	public function __construct(EventsManager $eventsManager)
	{
		$this->_commands = array();
		$this->_eventsManager = $eventsManager;
	}

	/**
	 * Events Manager
	 *
	 * @param \Phalcon\Events\Manager $eventsManager
	 */
	public function setEventsManager(EventsManager $eventsManager)
	{
		$this->_eventsManager = $eventsManager;
	}

	/**
	 * Returns the events manager
	 *
	 * @return \Phalcon\Events\Manager
	 */
	public function getEventsManager()
	{
		return $this->_eventsManager;
	}

	/**
	 * Adds commands to the Script
	 *
	 * @param Phalcon\Commands\Command $command
	 */
	public function attach(Command $command)
	{
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

	public function dispatch(Command $command)
	{
		//If beforeCommand fails abort
		if ($this->_eventsManager->fire('command:beforeCommand', $command) === false) {
			return false;
		}

		//If run the commands fails abort too
		if ($command->run($command->getParameters()) === false){
			return false;
		}

		$this->_eventsManager->fire('command:afterCommand', $command);
	}

	/**
	 * Run the scripts
	 */
	public function run()
	{

		if (!isset($_SERVER['argv'][1])) {
			throw new ScriptException('Incorrect usage');
		}

		$input = $_SERVER['argv'][1];

		//Try to dispatch the command
		foreach ($this->_commands as $command) {
			$providedCommands = $command->getCommands();
			if (in_array($input, $providedCommands)) {
				return $this->dispatch($command);
			}
		}

		//Check for alternatives
		$available = array();
		foreach ($this->_commands as $command) {
			$providedCommands = $command->getCommands();
			foreach ($providedCommands as $command) {
				$soundex = soundex($command);
				if(!isset($available[$soundex])){
					$available[$soundex] = array();
				}
				$available[$soundex][] = $command;
			}
		}

		//Show exception with/without alternatives
		$soundex = soundex($input);
		if (isset($available[$soundex])) {
			throw new ScriptException('"'. $input . '" is not a recognized command. Did you mean: '.join(' or ', $available[$soundex]).'?');
		} else {
			throw new ScriptException('"'. $input . '" is not a recognized command');
		}

	}

}
