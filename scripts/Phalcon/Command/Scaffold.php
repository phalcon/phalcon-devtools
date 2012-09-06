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
use Phalcon_Utils as Utils;

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
 * @version 	$Id: create_scaffold.php,v f5add30bf4ba 2011/10/26 21:05:13 andres $
 */
class Scaffold extends Command {

	const COMMAND = 'scaffold';

	public function run() {

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
			echo join(PHP_EOL, $posibleParameters) . PHP_EOL;
			return;
		}

		$name = $parameters[1];
		$schema = $this->getOption('schema');

		$scaffoldBuilder = Builder::factory('Scaffold', array(
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

	public function getCommand() {
		return static::COMMAND;
	}

	public function getHelp() {
		echo
			"------------------ " . PHP_EOL .
			"|-- Example" . PHP_EOL .
			"|-- phalcon scaffold users --autocomplete=login" . PHP_EOL .
			"|-----------------" . PHP_EOL .
			"|-- Usage" . PHP_EOL .
			"|-- phalcon scaffold [table name] [options]" . PHP_EOL .
			"|-----------------" . PHP_EOL .
			"|-- Options:" . PHP_EOL .
			"------------------" . PHP_EOL . PHP_EOL;
	}

}

//try {
//	$script = new Scaffold();
//	$script->run();
//}
//catch(\Phalcon\Exception $e){
//	Color::lookSupportedShell();
//	print Color::colorize(get_class($e).' : '.$e->getMessage()."\n", Color::COLOR_LIGHT_RED);
//	if($script->getOption('trace')) {
//		print $e->getTraceAsString()."\n";
//	}
//}
//catch(\Exception $e){
//	print 'Exception : '.$e->getMessage()."\n";
//}
