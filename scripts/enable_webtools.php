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

/**
 * EnableWebTools
 *
 * Copies the web-tools to a Phalcon project and store its configuration
 *
 * @category 	Phalcon
 * @package		Scripts
 * @copyright	Copyright (c) 2011-2012 Phalcon Team (team@phalconphp.com)
 * @license		New BSD License
*/
class EnableWebTools extends Phalcon_Script {

	public function __construct(){

	}

	public function run(){

		$posibleParameters = array(
			'trace'	=> "--trace \t\tShows the trace of the framework in case of exception.",
			'directory=s' => "--directory path \tBase path on which project will be created",
		);

		$this->parseParameters($posibleParameters);
		
		$parameters = $this->getParameters();
		if (isset($parameters[1]) && $parameters[1] == '?'){
			echo 
			"------------------" . PHP_EOL . 
			"|-- Example" . PHP_EOL . 
			"|-- phalcon enable-webtools --trace" . PHP_EOL . 
			"|-----------------" . PHP_EOL . 
			"|-- Usage" . PHP_EOL . 
			"|-- phalcon enable-webtools [options]" . PHP_EOL . 
			"|-----------------" . PHP_EOL . 
			"|-- Options:" . PHP_EOL . 
			"------------------" . PHP_EOL . PHP_EOL ;

			
			echo join(PHP_EOL, $posibleParameters) . PHP_EOL ;
			return;
		}
		

		$path = '';
		if($this->isReceivedOption('directory')){
			$path = $this->getOption('directory').'/';
		}

		if(!extension_loaded('phalcon')){
			throw new ScriptException("Phalcon PHP Framework is not loaded yet!");
		}

		Phalcon_WebTools::install($path);

	}

}

try {
	$script = new EnableWebTools();
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

