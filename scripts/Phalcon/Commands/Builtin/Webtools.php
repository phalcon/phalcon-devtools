<?php

/*
	+------------------------------------------------------------------------+
	| Phalcon Framework                                                      |
	+------------------------------------------------------------------------+
	| Copyright (c) 2011-2013 Phalcon Team (http://www.phalconphp.com)       |
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

use Phalcon\Script\Color,
	Phalcon\Commands\Command,
	Phalcon\Commands\CommandsInterface,
	Phalcon\Web\Tools;

/**
 * Phalcon\Commands\Webtools
 *
 * Enables/disables webtools in a project
 */
class Webtools extends Command implements CommandsInterface
{

	protected $_possibleParameters = array(
		'action'		=> "Enables/Disables webtools in a project",
		'directory=s' 	=> "Base path on which project will be created",
	);

	public function run($parameters)
	{

		$action = $this->getOption(array('action', 1));
		$directory = $this->getOption(array('directory'));

		if (!$directory) {
			$directory = __DIR__ . '/../../../../';
		}

		if ($action == 'enable') {
			Tools::install($directory);
		} else {
			if ($action == 'disable') {
				Tools::install($directory);
			} else {
				throw new \Exception("Invalid action");
			}
		}

		if ($action == 'enable') {
			print Color::success('Webtools successfully enabled') . PHP_EOL;
		} else {
			if ($action == 'disable') {
				print Color::success('Webtools successfully disabled') . PHP_EOL;
			}
		}
	}

	/**
	 * Returns the commands provided by the command
	 *
	 * @return string|array
	 */
	public function getCommands()
	{
		return array('webtools');
	}

	/**
	 * Checks whether the command can be executed outside a Phalcon project
	 */
	public function canBeExternal()
	{
		return false;
	}

	/**
	 * Prints help on the usage of the command
	 *
	 */
	public function getHelp()
	{
		print Color::head('Help:') . PHP_EOL;
		print Color::colorize('  Enables/disables webtools in a project') . PHP_EOL . PHP_EOL;

		print Color::head('Usage:') . PHP_EOL;
		print Color::colorize('  webtools [action]', Color::FG_GREEN) . PHP_EOL . PHP_EOL;

		print Color::head('Arguments:') . PHP_EOL;
		print Color::colorize('  ?', Color::FG_GREEN);
	  	print Color::colorize("\tShows this help text") . PHP_EOL . PHP_EOL;

		$this->printParameters($this->_possibleParameters);
	}

	/**
	 * Returns number of required parameters for this command
	 *
	 * @return int
	 */
	public function getRequiredParams()
	{
		return 1;
	}

}
