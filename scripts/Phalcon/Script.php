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

use Phalcon\Builder;
use Phalcon\Command\Command;
use Phalcon\Script\Color;

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
class Script {

	const VERSION = '0.5.0a4';

	/**
	 * @var \SplObjectStorage
	 */
	private $_commands;

	public function __construct() {
		$this->_commands = new \SplObjectStorage;
	}

	public function attach(Command $command) {
		$this->_commands->attach($command);
	}

	public function run() {
		if(!isset($_SERVER['argv'][1]) || $_SERVER['argv'][1] == 'commands'){
			print Color::colorize('Available commands:', Color::FG_BROWN) . PHP_EOL ;
			foreach ($this->_commands as $command) {
				print '  ' . Color::colorize($command->getCommand(), Color::FG_GREEN) . PHP_EOL;
			}
			print PHP_EOL;
		} else {
			$input = $_SERVER['argv'][1];

			foreach ($this->_commands as $command) {
				if ($command->getCommand() == $input) {
					return $command->run();
				}
			}

			throw new \Phalcon\Exception($input . ' is not a recognized command');

//			$scriptPath = $phalconToolsPath."scripts".DIRECTORY_SEPARATOR.$command.".php";
//			if(file_exists($scriptPath)){
//			$_SERVER['argv'][] = "--directory";
//			$_SERVER['argv'][] = $path;
//			require $scriptPath;
//			} else {
//				die('Phalcon: '.$command." isn't a recognized command\n");
//			}
		}
	}

}
