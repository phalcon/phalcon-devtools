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

use Phalcon_Builder as Builder;
use Phalcon_Utils as Utils;

/**
 * Create all the models related to application by command line.
 *
 * @category	Kumbia
 * @package		Scripts
 * @copyright   Copyright (c) 2011-2012 Phalcon Team (team@phalconphp.com)
 * @license		New BSD License
 */
class CreateAllModels extends Phalcon_Script {

	public function run(){

		$posibleParameters = array(
			'force'				=> "--force \t\tForce script to rewrite all the models if the already exists. [optional]",
			'define-relations' 	=> "--define-relations \tPossible relations defined according to convention. [optional]",
			'foreign-keys' 		=> "--foreign-keys \t\tDefine any virtual foreign keys. [optional]",
			'validations' 		=> "--validations \t\tDefine possible domain validation according to conventions. [optional]",
			'help' 				=> "--help \t\t\tShow help"
		);

		$this->parseParameters($posibleParameters);

		if($this->isReceivedOption('help')){
			$this->showHelp($posibleParameters);
			return;
		}

		$config = Phalcon_Script::getConfigPaths();
		$modelsDir = 'public/'.$config->phalcon->modelsDir;

		$forceProcess = $this->isReceivedOption('force');
		$defineRelations = $this->isReceivedOption('define-relations');
		$defineForeignKeys = $this->isReceivedOption('foreign-keys');

		try{
			Phalcon_Db_Pool::setDefaultDescriptor($config->database);
			$db = Phalcon_Db_Pool::getConnection();
		}
		catch(Phalcon_Db_Exception $e){
			throw new ScriptException('Phalcon_Db_Exception: '.$e->getMessage());
		}
		$schema = $this->getOption('schema');
		if(!$schema){
			$schema = $db->getDatabaseName();
		}

		$hasMany = array();
		$belongsTo = array();
		$foreignKeys = array();
		if($defineRelations||$defineForeignKeys){
			foreach($db->listTables($schema) as $name){
				if($db->tableExists($name, $schema)){
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
					foreach($db->describeTable($name, $schema) as $field){
						if(preg_match('/([a-z_]+)_id$/', $field['Field'], $matches)){
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
					/*foreach($db->describeReferences($name, $schema) as $reference){
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
								} else {

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
					}*/
				} else {
					throw new ScriptException("Table '$name' not exists");
				}
			}
		} else {
			foreach($db->listTables($schema) as $name){
				if($defineRelations){
					$hasMany[$name] = array();
					$belongsTo[$name] = array();
					$foreignKeys[$name] = array();
				}
			}
		}

		foreach($db->listTables($schema) as $name){
			$className = Utils::camelize($name);
			if(!file_exists($modelsDir.'/'.$className.'.php')||$forceProcess){

				$hasManyModel = array();
				if(isset($hasMany[$className])){
					$hasManyModel = $hasMany[$className];
				}

				$belongsToModel = array();
				if(isset($belongsTo[$className])){
					$belongsToModel = $belongsTo[$className];
				}

				$foreignKeysModel = array();
				if(isset($foreignKeys[$className])){
					$foreignKeysModel = $foreignKeys[$className];
				}

				$modelBuilder = Builder::factory('Model', array(
					'name' => $name,
					'schema' => $schema,
					'force' => $forceProcess,
					'hasMany' => $hasManyModel,
					'belongsTo' => $belongsToModel,
					'foreignKeys' => $foreignKeysModel
				));
				$modelBuilder->build();
			} else {
				echo "INFO: Skip model \"$name\" because already exists\n";
			}
		}

	}

}

try {
	$script = new CreateAllModels();
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
	echo "Exception : ".$e->getMessage()."\n";
}
