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

use Phalcon\Builder;
use Phalcon\Script\Color;
use Phalcon\Commands\Command;
use Phalcon\Commands\CommandsInterface;

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
class Controller extends Command implements CommandsInterface
{

	protected $_possibleParameters = array(
		'name=s' 		=> "Model name",
		'namespace=s'	=> "Model's namespace [option]",
		'directory=s'   => "Directory where the controller should be created [optional]",
		'base-class=s'	=> "Base class to be inherited by the controller [optional]",
		'force'			=> "Force to rewrite controller [optional]",
	);

	/**
	 * Run the command
	 */
	public function run($parameters)
	{

		$controllerName = $this->getOption(array('name', 1));

		$controllerBuilder = new \Phalcon\Builder\Controller(array(
			'name' => $controllerName,
			'directory' => $this->getOption('directory'),
			'namespace' => $this->getOption('namespace'),
			'baseClass' => $this->getOption('base-class'),
			'force' => $this->isReceivedOption('force')
		));

		return $controllerBuilder->build();
	}

	/**
	 * Returns the command identifier
	 *
	 * @return string
	 */
	public function getCommands()
	{
		return array('controller', 'create-controller');
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
		print Color::colorize('  Creates a controller') . PHP_EOL . PHP_EOL;

		print Color::head('Usage:') . PHP_EOL;
		print Color::colorize('  controller [name] [directory]', Color::FG_GREEN) . PHP_EOL . PHP_EOL;

		print Color::head('Arguments:') . PHP_EOL;
		print Color::colorize('  ?', Color::FG_GREEN);
		print Color::colorize("\tShows this help text") . PHP_EOL . PHP_EOL;

		$this->printParameters($this->_posibleParameters);
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