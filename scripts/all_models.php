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
 * added support for php config file
**/

/**
 * Create all the models related to application by command line.
 *
 * @category 	Phalcon
 * @package 	Scripts
 * @copyright   Copyright (c) 2011-2012 Phalcon Team (team@phalconphp.com)
 * @license		New BSD License
 */
class CreateAllModels extends Phalcon_Script {

	public function run(){

		$posibleParameters = array(
			'config=s' 		=> "--config path \tConfiguration file  ",
			'models=s' 		=> "--models path \tModels directory ",
			'force'				=> "--force \tForce script to rewrite all the models.  ",
			'get-set' 	=> "--get-set \tAttributes will be protected and have setters/getters.  ",
			'doc' 	=> "--doc \t\tHelps to improve code completion on IDEs  ",
			'relations' 	=> "--relations \tPossible relations defined according to convention.  ",
			'fk' 		=> "--fk \t\tDefine any virtual foreign keys.  ",
			'validations' 		=> "--validations \tDefine possible domain validation according to conventions.  ",
			'directory=s' 		=> "--directory \tBase path on which project will be created",
		);

		$this->parseParameters($posibleParameters);

		$parameters = $this->getParameters();
		
		if (isset($parameters[1]) && $parameters[1] == '?'){
			echo 
			"------------------ 
			\r|-- Example\n\r|-- phalcon all-models --schema=my --get-set --doc --relations --trace
			\r|-----------------\r\n|-- Usage \n\r|-- phalcon all-models [options] 
			\r|-----------------\n\r|-- Options:\n\r------------------\n\r
			\r";
			echo join("\n", $posibleParameters) . "\n";
			return;
		}

		$path = '';
		if($this->isReceivedOption('directory')){
			$path = $this->getOption('directory').'/';
		}

		$config = null;
		if(!$this->isReceivedOption('models')){
			$fileType = file_exists($path."app/config/config.ini") ? "ini" : "php";
			
			if($this->isReceivedOption('config')){
				$configPath = $path.$this->getOption('config')."/config.".$fileType;
			}  else {
				$configPath = $path."app/config/config." . $fileType;
			}
			
			if ($fileType == 'ini'){
				$config = new Phalcon_Config_Adapter_Ini($configPath);
			}else{
				include $configPath;
			}
			
			if(file_exists($path.'public')){
				$modelsDir = 'public/'.$config->phalcon->modelsDir;
			} else {
				$modelsDir = $config->phalcon->modelsDir;
			}
		} else {
			$modelsDir = $this->getOption('models');
		}

		$schema = $this->getOption('schema');
		$forceProcess = $this->isReceivedOption('force');
		$defineRelations = $this->isReceivedOption('relations');
		$defineForeignKeys = $this->isReceivedOption('fk');
		$genSettersGetters = $this->isReceivedOption('get-set');
		$genDocMethods = $this->isReceivedOption('doc');

		$modelBuilder = Builder::factory('AllModels', array(
			'force' => $forceProcess,
			'config' => $config,
			'schema' => $schema,
			'directory' => $this->getOption('directory'),
			'foreignKeys' => $defineForeignKeys,
			'defineRelations' => $defineRelations,
			'genSettersGetters' => $genSettersGetters,
			'genDocMethods' => $genDocMethods
		));

		$modelBuilder->build();
	}

}

try {
	$script = new CreateAllModels();
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
