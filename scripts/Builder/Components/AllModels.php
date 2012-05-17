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

use Phalcon_BuilderException as BuilderException;
use Phalcon_Utils as Utils;

/**
 * AllModelsBuilderComponent
 *
 * Builder to generate all models
 *
 * @category 	Phalcon
 * @package 	Scripts
 * @copyright   Copyright (c) 2011-2012 Phalcon Team (team@phalconphp.com)
 * @license 	New BSD License
 */
class AllModelsBuilderComponent {

	public function __construct($options){
		$this->_options = $options;
	}

	private function _getConfig($path){
		if(isset($this->_options['config']) && $this->_options['config']){
			return $this->_options['config'];
		} else {
			return new Phalcon_Config_Adapter_Ini($path."app/config/config.ini");
		}
	}

	public function build(){

		$config = $this->_getConfig('');
		$modelsDir = $this->_options['modelsDir'];
		$schema = $this->_options['schema'];
		$forceProcess = $this->_options['force'];
		$defineRelations = $this->_options['define-relations'];
		$defineForeignKeys = $this->_options['foreign-keys'];
		$genSettersGetters = $this->_options['gen-setters-getters'];
		var_dump($config->database);
		Phalcon_Db_Pool::setDefaultDescriptor($config->database);
		$connection = Phalcon_Db_Pool::getConnection();

		if(isset($this->_options['schema']) && $this->_options['schema']){
			$schema = $this->_options['schema'];
		} else {
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