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

use \Phalcon\Builder;
use \Phalcon\Command\Command;
use \Phalcon\Script\Color;

/**
 * \Phalcon\Command\Scaffold
 *
 * Scaffold a controller, model and view for a database table
 *
 * @category 	Phalcon
 * @package 	Command
 * @subpackage  Scaffold
 * @copyright   Copyright (c) 2011-2012 Phalcon Team (team@phalconphp.com)
 * @license 	New BSD License
 */
class Scaffold extends Command {

	const COMMAND = 'scaffold';

	public function run()
	{

		$posibleParameters = array(
			'schema=s'       => "--schema \tName of the schema.",
			'autocomplete=s' => "--autocomplete \tFields relationship that will use AutoComplete lists instead of SELECT.",
			'get-set'        => "--get-set \tAttributes will be protected and have setters/getters.",
			'theme=s'        => "--theme \tTheme to be applied. ",
			'directory=s'    => "--directory \tBase path on which project was created",
			'force'          => "--force \tForces to rewrite generated code if they already exists.",
			'trace'          => "--trace \tShows the trace of the framework in case of exception.",
		);

		$this->parseParameters($posibleParameters);
		$parameters = $this->getParameters();

		if (!isset($parameters[1]) || $parameters[1] == '?') {
			$this->getHelp();
			return;
		}

		$name = $parameters[1];
		$schema = $this->getOption('schema');

		$scaffoldBuilder = Builder::factory('\\Phalcon\\Builder\\Scaffold', array(
			'name' => $name,
			'theme'	=> $this->getOption('theme'),
			'schema' => $schema,
			'force'	=> $this->isReceivedOption('force'),
			'genSettersGetters' => $this->isReceivedOption('get-set'),
			'directory' => $this->getOption('directory'),
			'autocomplete' 	=> $this->getOption('autocomplete')
		));

		$scaffoldBuilder->build();

	}

	public function getCommand()
	{
		return static::COMMAND;
	}

	public function getHelp()
	{
		print Color::head('Help:') . PHP_EOL;
		print Color::colorize('  Creates a scaffold from a database table') . PHP_EOL . PHP_EOL;

		print Color::head('Usage:') . PHP_EOL;
		print Color::colorize('  scaffold [tableName] [options]', Color::FG_GREEN) . PHP_EOL . PHP_EOL;

		print Color::head('Arguments:') . PHP_EOL;
		print Color::colorize('  ?', Color::FG_GREEN);
		print Color::colorize("\tShows this help text") . PHP_EOL . PHP_EOL;

		print Color::head('Options:') . PHP_EOL;

		print Color::colorize('  --schema', Color::FG_GREEN);
		print Color::colorize("        Name of the schema") . PHP_EOL;

		print Color::colorize('  --autocomplete', Color::FG_GREEN);
		print Color::colorize("  Fields relationship that will use AutoComplete lists instead of SELECT") . PHP_EOL;

		print Color::colorize('  --get-set', Color::FG_GREEN);
		print Color::colorize("       Attributes will be protected and have setters/getters") . PHP_EOL;

		print Color::colorize('  --theme', Color::FG_GREEN);
		print Color::colorize("         Theme to be applied") . PHP_EOL;

		print Color::colorize('  --directory', Color::FG_GREEN);
		print Color::colorize("     Base path on which project was created") . PHP_EOL . PHP_EOL;
	}

}