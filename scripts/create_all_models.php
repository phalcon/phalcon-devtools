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

		$forceProcess = $this->isReceivedOption('force');
		$defineRelations = $this->isReceivedOption('define-relations');
		$defineForeignKeys = $this->isReceivedOption('foreign-keys');

		Phalcon_Db_Pool::setDefaultDescriptor($config->database);
		$connection = Phalcon_Db_Pool::getConnection();

		$schema = $this->getOption('schema');
		if(!$schema){
			$schema = $connection->getDatabaseName();
		}

		$hasMany = array();
		$belongsTo = array();
		$foreignKeys = array();
		if($defineRelations||$defineForeignKeys){
			foreach($connection->listTables($schema) as $name){
				if($defineRelations){
					if(!isset($hasMany[$name])){
						$hasMany[$name] = array();
					}
					if(!isset($belongsTo[$name])){
						$belongsTo[$name] = array();
					}
				}
				if($defineForeignKeys){
					$foreignKeys[$name] = array();
				}
				foreach($connection->describeTable($name, $schema) as $field){
					if(preg_match('/([a-z0-9_]+)_id$/', $field['Field'], $matches)){
						if($defineRelations){
							$hasMany[$matches[1]][Utils::camelize($name)] = array(
								'fields' => 'id',
								'relationFields' => $field['Field']
							);
							$belongsTo[$name][Utils::camelize($matches[1])] = array(
								'fields' => $field['Field'],
								'relationFields' => 'id'
							);
						}
						if($defineForeignKeys){
							$foreignKeys[$name][] = array(
								'fields' => $field['Field'],
								'entity' => Utils::camelize($matches[1]),
								'referencedFields' => 'id'
							);
						}
					}
				}
				foreach($connection->describeReferences($name, $schema) as $reference){
					if($defineRelations){
						if($reference['referencedSchema']==$schema){
							if(count($reference['columns'])==1){
								$belongsTo[$name][Utils::camelize($reference['referencedTable'])] = array(
									'fields' => $reference['columns'][0],
									'relationFields' => $reference['referencedColumns'][0]
								);
								$hasMany[$reference['referencedTable']][$name] = array(
									'fields' => $reference['columns'][0],
									'relationFields' => $reference['referencedColumns'][0]
								);
							}
						}
					}
					if($defineForeignKeys){
						if($reference['referencedSchema']==$schema){
							if(count($reference['columns'])==1){
								$foreignKeys[$name][] = array(
									'fields' => $reference['columns'][0],
									'entity' => Utils::camelize($reference['referencedTable']),
									'referencedFields' => $reference['referencedColumns'][0]
								);
							}
						}
					}
				}
			}
		} else {
			foreach($connection->listTables($schema) as $name){
				if($defineRelations){
					$hasMany[$name] = array();
					$belongsTo[$name] = array();
					$foreignKeys[$name] = array();
				}
			}
		}

		foreach($connection->listTables($schema) as $name){
			$className = Utils::camelize($name);
			if(!file_exists($modelsDir.'/'.$className.'.php')||$forceProcess){

				if(isset($hasMany[$className])){
					$hasManyModel = $hasMany[$className];
				} else {
					$hasManyModel = array();
				}

				if(isset($belongsTo[$className])){
					$belongsToModel = $belongsTo[$className];
				} else {
					$belongsToModel = array();
				}

				if(isset($foreignKeys[$className])){
					$foreignKeysModel = $foreignKeys[$className];
				} else {
					$foreignKeysModel = array();
				}

				$modelBuilder = Builder::factory('Model', array(
					'name' => $name,
					'schema' => $schema,
					'force' => $forceProcess,
					'hasMany' => $hasManyModel,
					'belongsTo' => $belongsToModel,
					'foreignKeys' => $foreignKeysModel,
					'genSettersGetters' => $this->isReceivedOption('gen-setters-getters'),
					'directory' => $this->getOption('directory'),
				));

				$modelBuilder->build();
			} else {
				echo "INFO: Skip model \"$name\" because it already exist\n";
			}
		}

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
