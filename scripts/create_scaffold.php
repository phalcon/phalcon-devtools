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

require 'Script/Script.php';
require 'Script/Color/ScriptColor.php';
require 'Builder/Builder.php';

use Phalcon_Builder as Builder;
use Phalcon_Utils as Utils;

/**
 * ScaffoldScript
 *
 * Make scaffold on application
 *
 * @category 	Phalcon
 * @package 	Scaffold
 * @copyright   Copyright (c) 2011-2012 Phalcon Team (team@phalconphp.com)
 * @license 	New BSD License
 * @version 	$Id: create_scaffold.php,v f5add30bf4ba 2011/10/26 21:05:13 andres $
 */
class CreateScaffold extends Phalcon_Script {

	public function run(){

		$posibleParameters = array(
			'table-name=s' 		=> "--table-name \tTable name of the source model.",
			'schema=s' 			=> "--schema \tName of the schema in where the table is, only if this differs from the default schema. [optional]",
			//'autocomplete=s' 	=> "--autocomplete \tFields relationship that will use AutoComplete lists instead of SELECT.[optional]",
			'theme=s' 			=> "--theme \tTheme to be applied. [optional]",
			'force' 			=> "--force \tForza is rewritten to the model. [optional]",
			'debug' 			=> "--debug \tShows the trace of the framework in case an exception is generated. [optional]",
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

		$scaffoldBuilder = Builder::factory('Scaffold', array(
			'name' 			=> $name,
			'theme' 		=> $this->getOption('theme'),
			'force' 		=> $this->isReceivedOption('force'),
			'schema' 		=> $schema,
			'fileName' 		=> $fileName,
			'className' 	=> $className,
			//'autocomplete' 	=> $this->getOption('autocomplete')

		));

		$scaffoldBuilder->build();

	}

}


try {
	$script = new CreateScaffold();
	$script->run();
}
catch(CoreException $e){
	ScriptColor::lookSupportedShell();
	echo ScriptColor::colorize(get_class($e).' : '.$e->getConsoleMessage()."\n", ScriptColor::LIGHT_RED);
	if($script->getOption('debug')=='yes'){
		echo $e->getTraceAsString()."\n";
	}
}
catch(Exception $e){
	echo 'Exception : '.$e->getMessage()."\n";
}
