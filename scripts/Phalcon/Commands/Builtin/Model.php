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

use Phalcon\Text;
use Phalcon\Builder;
use Phalcon\Script\Color;
use Phalcon\Commands\Command;
use Phalcon\Commands\CommandsInterface;

/**
 * CreateModel
 *
 * Create a model from command line
 *
 * @category 	Phalcon
 * @package 	Commands
 * @subpackage  Builtin
 * @copyright   Copyright (c) 2011-2012 Phalcon Team (team@phalconphp.com)
 * @license 	New BSD License
 */
class Model extends Command implements CommandsInterface
{

	protected $_posibleParameters = array(
		'schema=s' 		=> "Name of the schema. [optional]",
		'get-set' 		=> "Attributes will be protected and have setters/getters.",
		'doc' 			=> "Helps to improve code completion on IDEs [optional]",
		'directory=s' 	=> "Base path on which project will be created",
		'force' 		=> "Rewrite the model. [optional]",
		'trace' 		=> "Shows the trace of the framework in case of exception.",
	);

	public function run($parameters)
	{

		$name = $parameters[1];

		$className = Text::camelize(isset($parameters[2]) ? $parameters[2] : $name);
		$fileName = Text::uncamelize($className);

		$schema = $this->getOption('schema');

		$modelBuilder = new \Phalcon\Builder\Model(array(
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
	 * Returns the commands provided by the command
	 *
	 * @return array
	 */
	public function getCommands()
	{
		return array('model', 'create-model');
	}

	/**
	 * Checks whether the command can be executed outside a Phalcon project
	 */
	public function canBeExternal()
	{
		return false;
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

		$this->printParameters($this->_posibleParameters);

	}
}
