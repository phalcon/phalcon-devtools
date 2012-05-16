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

require 'scripts/Script/Script.php';
require 'scripts/Script/Color/ScriptColor.php';
require 'scripts/Builder/Builder.php';

use Phalcon_Builder as Builder;
use Phalcon_Utils as Utils;

/**
 * CreateModel
 *
 * Create a model from command line
 *
 * @category 	Phalcon
 * @package 	Scripts
 * @copyright   Copyright (c) 2011-2012 Phalcon Team (team@phalconphp.com)
 * @license 	New BSD License
 * @version 	$Id$
 */
class CreateModel extends Phalcon_Script {

	public function run(){

		$posibleParameters = array(
			'table-name=s' 	=> "--table-name \t\tTable name of the source model.",
			'schema=s' 		=> "--schema \t\tName of the schema where the table if this differs from the default schema. [optional]",
			'class-name=s' 	=> "--class-name \t\tPHP class name to use the model. [optional]",
			'gen-setters-getters' 	=> "--gen-setters-getters \tIf this option was given. Attributes will be protected and have setters/getters to access it. [optional]",
			'directory=s' => "--directory path \tBase path on which project will be created",
			'force' 		=> "--force \t\tRewrite the model. [optional]",
			'debug' 		=> "--debug \t\tShows the trace of the framework in case an exception is generated. [optional]",
			'help' 			=> "--help \t\t\tShows this help"
		);

		$this->parseParameters($posibleParameters);

		if($this->isReceivedOption('help')){
			$this->showHelp($posibleParameters);
			return;
		}

		$this->checkRequired(array('table-name'));

		$name = $this->getOption('table-name');
		$schema = $this->getOption('schema');

		$className = $this->getOption('class-name');
		if(!$className){
			$className = $name;
		}

		$className = Utils::camelize($name);
		$fileName = Utils::uncamelize($className);

		$modelBuilder = Builder::factory('Model', array(
			'name' => $name,
			'schema' => $schema,
			'className' => $className,
			'fileName' => $fileName,
			'genSettersGetters' => $this->isReceivedOption('gen-setters-getters'),
			'directory' => $this->getOption('directory'),
			'force' => $this->isReceivedOption('force')
		));

		$modelBuilder->build();
	}

}

try {
	$script = new CreateModel();
	$script->run();
}
catch(Phalcon_Exception $e){
	ScriptColor::lookSupportedShell();
	echo ScriptColor::colorize(get_class($e).' : '.$e->getMessage()."\n", ScriptColor::LIGHT_RED);
	if($script->getOption('debug')=='yes'){
		echo $e->getTraceAsString()."\n";
	}
}
catch(Exception $e){
	echo 'Exception : '.$e->getMessage()."\n";
}
