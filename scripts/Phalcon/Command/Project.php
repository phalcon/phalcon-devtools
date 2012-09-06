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
class Project extends Command {

	const COMMAND = 'project';

	public function run() {
		$posibleParameters = array(
			'directory=s' => '--directory path \tBase path on which project will be created',
			'trace' => '--trace \t\tShows the trace of the framework in case of exception.'
		);

		$this->parseParameters($posibleParameters);
		$parameters = $this->getParameters();
		
		if (!isset($parameters[1]) || $parameters[1] == '?'){
			$this->getHelp();
			return;
		}
		
		$projectName = isset($parameters[1]) ? $parameters[1] : 'default';
		$projectPath = isset($parameters[2]) ? $parameters[2] : $parameters['directory'];
		$enableWebtools = isset($parameters[3]) ? $parameters[3] : false;

		$builder = Builder::factory('\\Phalcon\\Builder\\Project', array(
			'name' => $projectName,
			'directory' => $projectPath,
			'enableWebTools' => $enableWebtools
		));

		return $builder->build();
	}

	public function getCommand() {
		return static::COMMAND;
	}

	public function getHelp() {
		print Color::head('Help:') . PHP_EOL;
		print Color::colorize('  Creates a project') . PHP_EOL . PHP_EOL;

		print Color::head('Usage:') . PHP_EOL;
		print Color::colorize('  project [name] [directory] [enable-webtools]', Color::FG_GREEN) . PHP_EOL . PHP_EOL;

		print Color::head('Arguments:') . PHP_EOL;
		print Color::colorize('  ?', Color::FG_GREEN);
	  	print Color::colorize("\tShows this help text"). PHP_EOL . PHP_EOL;

		print Color::head('Options:') . PHP_EOL;

		print Color::colorize('  --name', Color::FG_GREEN);
		print Color::colorize("             Name of the new project"). PHP_EOL;

		print Color::colorize('  --directory', Color::FG_GREEN);
		print Color::colorize("        Base path on which project will be created"). PHP_EOL;

		print Color::colorize('  --enable-webtools', Color::FG_GREEN);
		print Color::colorize("  Determines if webtools should be enabled"). PHP_EOL . PHP_EOL;
	}
}

