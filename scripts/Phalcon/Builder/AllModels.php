<?php

/*
  +------------------------------------------------------------------------+
  | Phalcon Developer Tools                                                |
  +------------------------------------------------------------------------+
  | Copyright (c) 2011-2014 Phalcon Team (http://www.phalconphp.com)       |
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
 * @category    Phalcon
 * @package    Scripts
 * @copyright   Copyright (c) 2011-2014 Phalcon Team (team@phalconphp.com)
 * @license    New BSD License
 */
class AllModels extends Component
{

    public $exist = array();

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
        if (isset($this->_options['directory'])) {
            $path = $this->_options['directory'];
        }

        $config = $this->_getConfig($path . '/');
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

        if (isset($config->database->adapter)) {
            $adapter = $config->database->adapter;
        } else {
            $adapter = 'Mysql';
        }

        if (is_object($config->database)) {
            $configArray = $config->database->toArray();
        } else {
            $configArray = $config->database;
        }

        $adapterName = 'Phalcon\Db\Adapter\Pdo\\' . $adapter;
        unset($configArray['adapter']);

        /**
         * @var $db \Phalcon\Db\Adapter\Pdo
         */
        $db = new $adapterName($configArray);

        if (isset($this->_options['schema'])) {
            $schema = $this->_options['schema'];
        } elseif ($adapter == 'Postgresql') {
            $schema = 'public';
        } else {
            $schema = isset($config->database->schema)?$config->database->schema:$config->database->dbname;
        }

        $hasMany = array();
        $belongsTo = array();
        $foreignKeys = array();
        if ($defineRelations || $defineForeignKeys) {
            foreach ($db->listTables($schema) as $name) {
                if ($defineRelations) {
                    if (!isset($hasMany[$name])) {
                        $hasMany[$name] = array();
                    }
                    if (!isset($belongsTo[$name])) {
                        $belongsTo[$name] = array();
                    }
                }
                if ($defineForeignKeys) {
                    $foreignKeys[$name] = array();
                }

                $camelCaseName = Utils::camelize($name);
                $refSchema = ($adapter != 'Postgresql') ? $schema : $config->database->dbname;

                foreach ($db->describeReferences($name, $schema) as $reference) {
                    $columns = $reference->getColumns();
                    $referencedColumns = $reference->getReferencedColumns();
                    $referencedModel = Utils::camelize($reference->getReferencedTable());
                    if ($defineRelations) {
                        if ($reference->getReferencedSchema() == $refSchema) {
                            if (count($columns) == 1) {
                                $belongsTo[$name][] = array(
                                    'referencedModel' => $referencedModel,
                                    'fields' => $columns[0],
                                    'relationFields' => $referencedColumns[0],
                                    'options' => $defineForeignKeys ? array('foreignKey'=>true) : NULL
                                );
                                $hasMany[$reference->getReferencedTable()][] = array(
                                    'camelizedName' => $camelCaseName,
                                    'fields' => $referencedColumns[0],
                                    'relationFields' => $columns[0]
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
            if (!file_exists($modelsDir . '/' . $className . '.php') || $forceProcess) {

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
                    'extends' => isset($this->_options['extends']) ? $this->_options['extends'] : null,
                    'namespace' => $this->_options['namespace'],
                    'force' => $forceProcess,
                    'hasMany' => $hasManyModel,
                    'belongsTo' => $belongsToModel,
                    'foreignKeys' => $foreignKeysModel,
                    'genSettersGetters' => $genSettersGetters,
                    'directory' => $this->_options['directory'],
                ));

                $modelBuilder->build();
            } else {
                if ( $this->isConsole() ) {

                    print Color::info("Skipping model \"$name\" because it already exist");
                } else {
                    $this->exist[] = $name;
                }
            }
        }

    }
}
