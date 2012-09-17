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
use Phalcon\Commands\CommandInterface;

/**
 * CreateProject
 *
 * Creates project skeletons
 *
 * @category 	Phalcon
 * @package		Command
 * @subpackage  Project
 * @copyright	Copyright (c) 2011-2012 Phalcon Team (team@phalconphp.com)
 * @license		New BSD License
*/
class Project extends Command implements CommandInterface
{

	/**
	 * Executes the current command
	 *
	 * @return mixed
	 */
	public function run()
	{
		$possibleParameters = array(
			'directory=s' => '--directory path \tBase path on which project will be created',
			'type=s' => '--directory path \tBase path on which project will be created',
			'trace' => '--trace \t\tShows the trace of the framework in case of exception.'
		);

		$this->parseParameters($possibleParameters);
		$parameters = $this->getParameters();

		if (!isset($parameters[1]) || $parameters[1] == '?') {
			$this->getHelp();
			return;
		}

		$projectName = isset($parameters[1]) ? $parameters[1] : 'default';
		$projectType = isset($parameters[2]) ? $parameters[2] : \Phalcon\Builder\Project::TYPE_SIMPLE;
		$projectPath = isset($parameters[3]) ? $parameters[3] : '';
		$enableWebtools = isset($parameters[4]) ? $parameters[4] : false;

		$builder = Builder::factory('\Phalcon\Builder\Project', array(
			'name' => $projectName,
			'type' => $projectType,
			'directory' => $projectPath,
			'enableWebTools' => $enableWebtools,
		));

		return $builder->build();
	}

	/**
	 * Returns the command identifier
	 *
	 * @return array
	 */
	public function getCommands()
	{
		return array('project', 'create-project');
	}

	/**
	 * Prints the help for current command.
	 *
	 * @return void
	 */
	public function getHelp()
	{
		print Color::head('Help:') . PHP_EOL;
		print Color::colorize('  Creates a project') . PHP_EOL . PHP_EOL;

		print Color::head('Usage:') . PHP_EOL;
		print Color::colorize('  project [name] [type] [directory] [enable-webtools]', Color::FG_GREEN) . PHP_EOL . PHP_EOL;

		print Color::head('Arguments:') . PHP_EOL;
		print Color::colorize('  ?', Color::FG_GREEN);
	  	print Color::colorize("\tShows this help text") . PHP_EOL . PHP_EOL;

		print Color::head('Options:') . PHP_EOL;

		print Color::colorize('  --name', Color::FG_GREEN);
		print Color::colorize("             Name of the new project") . PHP_EOL;

		print Color::colorize('  --type', Color::FG_GREEN);
		print Color::colorize("             Type of the application to be genrated (micro, simple, model)") . PHP_EOL;

		print Color::colorize('  --directory', Color::FG_GREEN);
		print Color::colorize("        Base path on which project will be created") . PHP_EOL;

		print Color::colorize('  --enable-webtools', Color::FG_GREEN);
		print Color::colorize("  Determines if webtools should be enabled") . PHP_EOL . PHP_EOL;
	}
}

