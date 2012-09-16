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

namespace Phalcon\Command;

use Phalcon\Builder;
use Phalcon\Command\Command;
use Phalcon\Script\Color;

/**
 * CreateController
 *
 * Create a handler for the command line.
 *
 * @category 	Phalcon
 * @package 	Command
 * @subpackage  Controller
 * @copyright   Copyright (c) 2011-2012 Phalcon Team (team@phalconphp.com)
 * @license 	New BSD License
 */
class Controller extends Command {

	const COMMAND = 'controller';

	public function run() {
		$possibleParameters = array(
			'directory=s'   => "--directory path Directory where the project will be created",
			'force'			=> "--force \t Force to rewrite controller [optional]",
		);

		$this->parseParameters($possibleParameters);
		$parameters = $this->getParameters();
		
		if (!isset($parameters[1]) || $parameters[1] == '?') {
			$this->getHelp();
			return;
		}

		$modelBuilder = Builder::factory('\\Phalcon\\Builder\\Controller', array(
			'name' => $parameters[1],
			'directory' => $this->getOption('directory'),
			'force' => $this->isReceivedOption('force')
		));

		$modelBuilder->build();
	}

	/**
	 * Returns the command identifier
	 *
	 * @return string
	 */
	public function getCommand()
	{
		return static::COMMAND;
	}

	/**
	 * Prints the help for current command.
	 *
	 * @return void
	 */
	public function getHelp()
	{
		print Color::head('Help:') . PHP_EOL;
		print Color::colorize('  Creates a controller') . PHP_EOL . PHP_EOL;

		print Color::head('Usage:') . PHP_EOL;
		print Color::colorize('  controller [name] [directory]', Color::FG_GREEN) . PHP_EOL . PHP_EOL;

		print Color::head('Arguments:') . PHP_EOL;
		print Color::colorize('  ?', Color::FG_GREEN);
		print Color::colorize("\tShows this help text") . PHP_EOL . PHP_EOL;

		print Color::head('Options:') . PHP_EOL;

		print Color::colorize('  --name', Color::FG_GREEN);
		print Color::colorize("             Name of the controller") . PHP_EOL;

		print Color::colorize('  --directory', Color::FG_GREEN);
		print Color::colorize("        Directory where the controller should be created") . PHP_EOL. PHP_EOL;
	}
}