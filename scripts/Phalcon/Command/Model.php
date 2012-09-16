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
use Phalcon\Text as Utils;

/**
 * CreateModel
 *
 * Create a model from command line
 *
 * @category 	Phalcon
 * @package 	Command
 * @subpackage  Model
 * @copyright   Copyright (c) 2011-2012 Phalcon Team (team@phalconphp.com)
 * @license 	New BSD License
 */
class Model extends Command {

	const COMMAND = 'model';

	public function run() {
		$posibleParameters = array(
			'schema=s' 		=> "--schema \t\tName of the schema. [optional]",
			'get-set' 	=> "--get-set \t\tAttributes will be protected and have setters/getters.",
			'doc' 	=> "--doc \t\t\tHelps to improve code completion on IDEs [optional]",
			'directory=s' => "--directory \t\tBase path on which project will be created",
			'force' 		=> "--force \t\tRewrite the model. [optional]",
			'trace' 		=> "--trace \t\tShows the trace of the framework in case of exception.",
		);

		$this->parseParameters($posibleParameters);
	
		$parameters = $this->getParameters();
		
		if (!isset($parameters[1]) || $parameters[1] == '?') {
			$this->getHelp();
			return;
		}
		
		$name = $parameters[1];
		 
		$className = Utils::camelize(isset($parameters[2]) ? $parameters[2] : $name);
		$fileName = Utils::uncamelize($className);
		
		$schema = $this->getOption('schema');

		$modelBuilder = Builder::factory('\\Phalcon\\Builder\\Model', array(
			'name' => $name,
			'schema' => $schema,
			'className' => $className,
			'fileName' => $fileName,
			'genSettersGetters' => $this->isReceivedOption('get-set'),
			'genDocMethods' => $this->isReceivedOption('doc'),
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
		print Color::colorize('  Creates a model') . PHP_EOL . PHP_EOL;

		print Color::head('Usage:') . PHP_EOL;
		print Color::colorize('  model [table-name] [options]', Color::FG_GREEN) . PHP_EOL . PHP_EOL;

		print Color::head('Arguments:') . PHP_EOL;
		print Color::colorize('  ?', Color::FG_GREEN);
		print Color::colorize("\tShows this help text") . PHP_EOL . PHP_EOL;

		print Color::head('Options:') . PHP_EOL;

		print Color::colorize('  --schema', Color::FG_GREEN);
		print Color::colorize("          Name of the schema. [optional]") . PHP_EOL;

		print Color::colorize('  --get-set', Color::FG_GREEN);
		print Color::colorize("         Helps to improve code completion on IDEs [optional]") . PHP_EOL;

		print Color::colorize('  --doc', Color::FG_GREEN);
		print Color::colorize("             Type of the application to be genrated (micro, simple, model)") . PHP_EOL;

		print Color::colorize('  --directory', Color::FG_GREEN);
		print Color::colorize("       Base path on which model will be created") . PHP_EOL;
	}
}
