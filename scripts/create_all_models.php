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
			'config-ini=s' 		=> "--config-ini path \tConfiguration file [optional]",
			'models-dir=s' 		=> "--models-dir path \tModels directory [optional]",
			'force'				=> "--force \t\tForce script to rewrite all the models if the already exists. [optional]",
			'gen-setters-getters' 	=> "--gen-setters-getters \tIf this option was given. Attributes will be protected and have setters/getters to access it. [optional]",
			'gen-doc-methods' 	=> "--gen-doc-methods \tHelps to improve code completion on IDEs [optional]",
			'define-relations' 	=> "--define-relations \tPossible relations defined according to convention. [optional]",
			'foreign-keys' 		=> "--foreign-keys \t\tDefine any virtual foreign keys. [optional]",
			'validations' 		=> "--validations \t\tDefine possible domain validation according to conventions. [optional]",
			'directory=s' 		=> "--directory path \tBase path on which project will be created",
			'help' 				=> "--help \t\t\tShow help"
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

		$config = null;
		if(!$this->isReceivedOption('models-dir')){
			if($this->isReceivedOption('config-dir')){
				$config = new Phalcon_Config_Adapter_Ini($path.$this->getOption('config-dir'));
			}  else {
				$config = new Phalcon_Config_Adapter_Ini($path."app/config/config.ini");
			}
			if(file_exists($path.'public')){
				$modelsDir = 'public/'.$config->phalcon->modelsDir;
			} else {
				$modelsDir = $config->phalcon->modelsDir;
			}
		} else {
			$modelsDir = $this->getOption('models-dir');
		}

		$schema = $this->getOption('schema');
		$forceProcess = $this->isReceivedOption('force');
		$defineRelations = $this->isReceivedOption('define-relations');
		$defineForeignKeys = $this->isReceivedOption('foreign-keys');
		$genSettersGetters = $this->isReceivedOption('gen-setters-getters');
		$genDocMethods = $this->isReceivedOption('gen-doc-methods');

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
	if($script->getOption('debug')=='yes'){
		echo $e->getTraceAsString()."\n";
	}
}
catch(Exception $e){
	echo 'Exception : '.$e->getMessage()."\n";
}
