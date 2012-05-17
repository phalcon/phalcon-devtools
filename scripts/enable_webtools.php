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
			'debug'	=> "--debug \t\tShows the trace of the framework in case of an exception is generated. [optional]",
			'directory=s' => "--directory path \tBase path on which project will be created",
			'help' 	=> "--help \t\t\tShow help"
		);

		$this->parseParameters($posibleParameters);
		if($this->isReceivedOption('help')){
			$this->showHelp($posibleParameters);
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
	if($script->getOption('debug')=='yes'){
		echo $e->getTraceAsString()."\n";
	}
}
catch(Exception $e){
	echo 'Exception : '.$e->getMessage()."\n";
}

