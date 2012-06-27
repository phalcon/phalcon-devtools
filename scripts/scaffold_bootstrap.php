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
require 'TBootstrap/TBootstrap.php';

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
 */
class ScaffoldBootstrap extends Phalcon_Script {

	public function run(){

		$posibleParameters = array(
			'table-name=s' 		=> "--table-name \tName of table",
			'schema=s' 			=> "--schema \tName of the schema where the table is, only if it differs from the default schema. [optional]",
			//'autocomplete=s' 	=> "--autocomplete \tFields relationship that will use AutoComplete lists instead of SELECT.[optional]",
			'gen-setters-getters' 	=> "--gen-setters-getters \tIf this option was given. Attributes will be protected and have setters/getters to access it. [optional]",
			'theme=s' 			=> "--theme \tTheme to be applied. [optional]",
			'directory=s' 		=> "--directory path Base path on which project will be created",
			'force' 			=> "--force \tForces to rewrite generated code if they already exists. [optional]",
			'debug' 			=> "--debug \tShows the trace of the framework in case of an exception is generated. [optional]",
			'help' 				=> "--help \t\tShow help"
		);

		$this->parseParameters($posibleParameters);

		if($this->isReceivedOption('help')){
			$this->showHelp($posibleParameters);
			return;
		}

		$this->checkRequired(array('table-name'));

		$name = $this->getOption('table-name');
		$schema = $this->getOption('schema');

		$className = Utils::camelize($name);
		$fileName = Utils::uncamelize($className);

		$scaffoldBuilder = Builder::factory('TwitterBootstrap', array(
			'name' => $name,
			'theme'	=> $this->getOption('theme'),
			'schema' => $schema,
			'fileName' => $fileName,
			'className'	=> $className,
			'force'	=> $this->isReceivedOption('force'),
			'genSettersGetters' => $this->isReceivedOption('gen-setters-getters'),
			'directory' => $this->getOption('directory'),
			'autocomplete' 	=> $this->getOption('autocomplete')
		));

		$scaffoldBuilder->build();

	}

}


try {
	$script = new ScaffoldBootstrap();
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
