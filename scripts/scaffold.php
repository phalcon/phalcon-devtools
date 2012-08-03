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

$pToolsPath = getenv("PTOOLSPATH");
if($pToolsPath){
	chdir($pToolsPath);
}

require 'Script/Script.php';
require 'Script/Color/ScriptColor.php';
require 'Builder/Builder.php';

use Phalcon_Builder as Builder;
use Phalcon_Utils as Utils;

/**
 * ScaffoldScript
 *
 * Scaffold a controller, model and view for a database table
 *
 * @category 	Phalcon
 * @package 	Scaffold
 * @copyright   Copyright (c) 2011-2012 Phalcon Team (team@phalconphp.com)
 * @license 	New BSD License
 * @version 	$Id: create_scaffold.php,v f5add30bf4ba 2011/10/26 21:05:13 andres $
 */
class Scaffold extends Phalcon_Script {

	public function run(){

		$posibleParameters = array(
			'schema=s' 			=> "--schema \tName of the schema.",
			'autocomplete=s' 	=> "--autocomplete \tFields relationship that will use AutoComplete lists instead of SELECT.",
			'get-set' 	=> "--get-set \tAttributes will be protected and have setters/getters.",
			'theme=s' 			=> "--theme \tTheme to be applied. ",
			'directory=s' 		=> "--directory \tBase path on which project was created",
			'force' 			=> "--force \tForces to rewrite generated code if they already exists.",
			'trace' 			=> "--trace \tShows the trace of the framework in case of exception.",
		);

		$this->parseParameters($posibleParameters);


		$parameters = $this->getParameters();
		
		if (!isset($parameters[1]) || $parameters[1] == '?'){
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

}

try {
	$script = new Scaffold();
	$script->run();
}
catch(Phalcon_Exception $e){
	ScriptColor::lookSupportedShell();
	echo ScriptColor::colorize(get_class($e).' : '.$e->getMessage()."\n", ScriptColor::LIGHT_RED);
	if($script->getOption('trace')){
		echo $e->getTraceAsString()."\n";
	}
}
catch(Exception $e){
	echo 'Exception : '.$e->getMessage()."\n";
}
