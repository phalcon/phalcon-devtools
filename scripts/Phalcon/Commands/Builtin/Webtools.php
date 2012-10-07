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

namespace Phalcon\Commands\Builtin;

use Phalcon\Script\Color;
use Phalcon\Commands\Command;
use Phalcon\Commands\CommandsInterface;

/**
 * Phalcon\Commands\Webtools
 *
 * Enables/disables webtools in a project
 */
class Webtools extends Command implements CommandsInterface
{

	protected $_posibleParameters = array(
		'action'		=> "Enables/Disables webtools in a project",
		'trace'			=> "--trace \t\tShows the trace of the framework in case of exception.",
		'directory=s' 	=> "--directory path \tBase path on which project will be created",
	);

	public function run($parameters)
	{
		//Phalcon\Web\Tools::install($path);
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

}
