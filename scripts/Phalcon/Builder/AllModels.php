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

namespace Phalcon\Builder;

use Phalcon\Builder\Component;
use Phalcon\Builder\BuilderException;
use Phalcon\Text as Utils;
use Phalcon\Script\Color;

/**
 * AllModels
 *
 * Builder to generate all models
 *
 * @category 	Phalcon
 * @package 	Scripts
 * @copyright   Copyright (c) 2011-2012 Phalcon Team (team@phalconphp.com)
 * @license 	New BSD License
 */
class AllModels extends Component
{

	public function __construct($options)
	{
		if (!isset($options['force'])) {
			$options['force'] = false;
		}

		$this->_options = $options;
	}

	public function build()
	{

		$path = '.';
		if(isset($this->_options['directory'])){
			$path = $this->_options['directory'];
		}

		$config = $this->_getConfig($path.'/');
		$modelsDir = $config->application->modelsDir;
		$forceProcess = $this->_options['force'];

		if (isset($this->_options['defineRelations'])) {
			$defineRelations = $this->_options['defineRelations'];
		} else {
			$defineRelations = false;
		}

		if (isset($this->_options['foreignKeys'])) {
			$defineForeignKeys = $this->_options['foreignKeys'];
		} else {
			$defineForeignKeys = false;
		}

		if (isset($this->_options['genSettersGetters'])) {
			$genSettersGetters = $this->_options['genSettersGetters'];
		} else {
			$genSettersGetters = false;
		}

		$adapter = $config->database->adapter;
		$this->isSupportedAdapter($adapter);

		$adapter = '\\Phalcon\\Db\\Adapter\\Pdo\\' . $adapter;
		$db = new $adapter(array(
			'host'     => $config->database->host,
			'username' => $config->database->username,
			'password' => $config->database->password,
			'name'     => $config->database->name,
		));

		$initialize = array();
		if (isset($this->_options['schema'])) {
			if ($this->_options['schema'] != $db->getDatabaseName()) {
				$initialize[] = "\t\t\$this->setSchema(\"{$this->_options['schema']}\");";
			}
			$schema = $this->_options['schema'];
		} else {
			$schema = $config->database->name;
		}

		$hasMany = array();
		$belongsTo = array();
		$foreignKeys = array();
		if ($defineRelations || $defineForeignKeys) {
			foreach ($db->listTables($schema) as $name) {
				if ($defineRelations) {
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
				foreach ($db->tableOptions($name, $schema) as $field) {
					if (preg_match('/([a-z0-9_]+)_id$/', $field['Field'], $matches)) {
						if ($defineRelations) {
							$hasMany[$matches[1]][Utils::camelize($name)] = array(
								'fields' => 'id',
								'relationFields' => $field['Field']
							);
							$belongsTo[$name][Utils::camelize($matches[1])] = array(
								'fields' => $field['Field'],
								'relationFields' => 'id'
							);
						}
						if ($defineForeignKeys) {
							$foreignKeys[$name][] = array(
								'fields' => $field['Field'],
								'entity' => Utils::camelize($matches[1]),
								'referencedFields' => 'id'
							);
						}
					}
				}
				$camelizedName = Utils::camelize($name);
				foreach ($db->describeReferences($name, $schema) as $reference) {
					$columns = $reference->getColumns();
					$referencedColumns = $reference->getReferencedColumns();
					$referencedModel = Utils::camelize($reference->getReferencedTable());
					if ($defineRelations) {
						if ($reference->getReferencedSchema() == $schema) {
							if (count($columns) == 1) {
								$belongsTo[$name][$referencedModel] = array(
									'fields' => $columns[0],
									'relationFields' => $referencedColumns[0]
								);
								$hasMany[$reference->getReferencedTable()][$camelizedName] = array(
									'fields' => $referencedColumns[0],
									'relationFields' => $columns[0]
								);
							}
						}
					}
					if ($defineForeignKeys) {
						if ($reference->getReferencedSchema() == $schema) {
							if (count($columns)==1) {
								$foreignKeys[$name][] = array(
									'fields' => $columns[0],
									'entity' => $referencedModel,
									'referencedFields' => $referencedColumns[0]
								);
							}
						}
					}
				}
			}
		} else {
			foreach ($db->listTables($schema) as $name) {
				if ($defineRelations) {
					$hasMany[$name] = array();
					$belongsTo[$name] = array();
					$foreignKeys[$name] = array();
				}
			}
		}

		foreach ($db->listTables($schema) as $name) {
			$className = Utils::camelize($name);
			if (!file_exists($modelsDir.'/'.$className.'.php') || $forceProcess) {

				if (isset($hasMany[$name])) {
					$hasManyModel = $hasMany[$name];
				} else {
					$hasManyModel = array();
				}

				if (isset($belongsTo[$name])) {
					$belongsToModel = $belongsTo[$name];
				} else {
					$belongsToModel = array();
				}

				if (isset($foreignKeys[$name])) {
					$foreignKeysModel = $foreignKeys[$name];
				} else {
					$foreignKeysModel = array();
				}

				$modelBuilder = new \Phalcon\Builder\Model(array(
					'name' => $name,
					'schema' => $schema,
					'force' => $forceProcess,
					'hasMany' => $hasManyModel,
					'belongsTo' => $belongsToModel,
					'foreignKeys' => $foreignKeysModel,
					'genSettersGetters' => $genSettersGetters,
					'directory' => $this->_options['directory'],
				));

				$modelBuilder->build();
			} else {
				echo "INFO: Skip model \"$name\" because it already exist\n";
			}
		}

	}
}
