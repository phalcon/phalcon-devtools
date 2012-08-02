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
			'schema=s' 			=> "--schema \tName of the schema.",
			'get-set' 	=> "--get-set \tAttributes will be protected and have setters/getters. ",
			'theme=s' 			=> "--theme \tTheme to be applied.",
			'directory=s' 		=> "--directory \tBase path on which project was created",
			'force' 			=> "--force \tForces to rewrite generated code if they already exists.",
			'trace' 			=> "--trace \tShows the trace of the framework in case of exception.",
			'autocomplete=s' 	=> "--autocomplete \tFields relationship that will use AutoComplete lists instead of SELECT.",
		);

		$this->parseParameters($posibleParameters);

		$parameters = $this->getParameters();
		
		if (!isset($parameters[1]) || $parameters[1] == '?'){
			echo 
			"------------------ 
			\r|-- Example\n\r|-- phalcon scaffold-bootstrap users --autocomplete=login
			\r|-----------------\r\n|-- Usage \n\r|-- phalcon scaffold-bootstrap [table name] [options] 
			\r|-----------------\n\r|-- Options:\n\r------------------\n\r
			\r";
			echo join("\n\r", $posibleParameters) . "\n";
			return;
		}

		$name = $parameters[1];
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
			'genSettersGetters' => $this->isReceivedOption('get-set'),
			'directory' => $this->getOption('directory'),
			'autocomplete' 	=> $this->getOption('autocomplete')
		));
		
		$path = '/' . basename($this->getOption('directory')) .'/';
		
		$scaffoldBuilder->build();
		
		$head = 
		'<link rel="stylesheet" href="'.$path.'public/css/bootstrap/bootstrap.min.css" type="text/css" />'. "\n".
		'<script type="text/javascript" src="'.$path.'public/javascript/bootstrap/bootstrap.min.js'.'"></script>';
		
		echo 
		"Twitter bootstrap scaffolding generated.
		\rRemember to put the contents of head.remove-me.html file in the <head> of your layout.
		\rhead.html:\r\n\r\n---------------------\r\n" .
		$head .
		"\n\n---------------------\r\n";
		
		file_put_contents($this->getOption('directory') .'/head.remove-me.html', $head);
	}
}

try {
	$script = new ScaffoldBootstrap();
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
