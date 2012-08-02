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
require 'WebTools/WebTools.php';

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
		$helpText = 
		"------------------
			\r|-- Usage \n\r|-- phalcon project ? \t\t\t\t\t Shows this help text\r
			\r|-- phalcon project [name] [directory] [enable-webtools] Creates a project
			\r|-----------------\n\r
		";
		
		
		$posibleParameters = array(
			'directory=s' => '--directory path \tBase path on which project will be created',
			'trace' => '--trace \t\tShows the trace of the framework in case of exception.'
		);

		$this->parseParameters($posibleParameters);
		$parameters = $this->getParameters();
		
		if (!isset($parameters[1]) || $parameters[1] == '?'){
			echo $helpText;
			return;
		}
		
		$projectName = isset($parameters[1]) ? $parameters[1] : 'default';
		$projectPath = isset($parameters[2]) ? $parameters[2] : $parameters['directory'];
		$enableWebtools = isset($parameters[3]) ? $parameters[3] : false;

		$builder = Builder::factory('Project', array(
			'name' => $projectName,
			'directory' => $projectPath,
			'enableWebTools' => $enableWebtools
		));

		$builder->build();
	}
}

try {
	$script = new CreateProject();
	$script->run();
}
catch(Phalcon_Exception $e) {
	ScriptColor::lookSupportedShell();
	echo ScriptColor::colorize(get_class($e).' : '.$e->getMessage()."\n", ScriptColor::LIGHT_RED);
	if($script->getOption('trace')){
		echo $e->getTraceAsString()."\n";
	}
}
catch(Exception $e){
	echo 'Exception : '.$e->getMessage()."\n";
}

