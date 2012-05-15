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

require_once 'Script/Script.php';
require_once 'Script/Color/ScriptColor.php';
require_once 'Builder/Builder.php';

use Phalcon_Builder as Builder;

/**
 * CreateProject
 *
  * Creates project skeletons
 *
 * @category 	Phalcon
 * @package		Scripts
 * @copyright	Copyright (c) 2011-2012 Phalcon Team (team@phalconphp.com)
 * @license		New BSD License
*/
class CreateProject extends Phalcon_Script {

	public function __construct(){

	}

	public function run(){

		$posibleParameters = array(
			'directory=s' => "--directory path \tBase path on which project will be created",
			'debug' 		=> "--debug \t\tShows the trace of the framework in case of an exception is generated. [optional]",
			'help' => "--help \t\t\tShow help"
		);

		$this->parseParameters($posibleParameters);
		if($this->isReceivedOption('help')){
			$this->showHelp($posibleParameters);
			return;
		}

		$parameters = $this->getParameters();

		if(isset($parameters[1])){
			$name = $parameters[1];
		} else {
			$name = "";
		}

		print_r($parameters);

		$modelBuilder = Builder::factory('Project', array(
			'name' => $name,
			//'directory' => $this->getOption('directory')
			'PROJECTPATH' => $this->getOption('directory')
		));
		$modelBuilder->build();
	}

}

try {
	$script = new CreateProject();
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

