<?php

/*
  +------------------------------------------------------------------------+
  | Phalcon Developer Tools                                                |
  +------------------------------------------------------------------------+
  | Copyright (c) 2011-2015 Phalcon Team (http://www.phalconphp.com)       |
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

use Phalcon\Text as Utils;
use Phalcon\Script\Color;

/**
 * AllModels Class
 *
 * Builder to generate all models
 *
 * @package     Phalcon\Builder
 * @copyright   Copyright (c) 2011-2015 Phalcon Team (team@phalconphp.com)
 * @license     New BSD License
 */
class AllModels extends Component
{
    public $exist = array();

    /**
     * Create Builder object
     *
     * @param array $options Builder options
     * @throws BuilderException
     */
    public function __construct(array $options = array())
    {
        if (!isset($options['force'])) {
            $options['force'] = false;
        }

        if (!isset($options['abstract'])) {
            $options['abstract'] = false;
        }

        parent::__construct($options);
    }

    public function build()
    {
        if ($this->options->contains('directory')) {
            $this->path->setRootPath($this->options->get('directory'));
        }

        $this->options->offsetSet('directory', $this->path->getRootPath());

        $config = $this->getConfig();

        if (!$modelsDir = $this->options->get('modelsDir')) {
            if (!isset($config->application->modelsDir)) {
                throw new BuilderException("Builder doesn't know where is the models directory.");
            }
            $modelsDir = $config->application->modelsDir;
        }

        $modelsDir = rtrim($modelsDir, '/\\') . DIRECTORY_SEPARATOR;
        $modelPath = $modelsDir;
        if (false == $this->isAbsolutePath($modelsDir)) {
            $modelPath = $this->path->getRootPath($modelsDir);
        }

        $this->options->offsetSet('modelsDir', $modelPath);

        $forceProcess = $this->options->get('force');

        $defineRelations = $this->options->get('defineRelations', false);
        $defineForeignKeys = $this->options->get('foreignKeys', false);
        $genSettersGetters = $this->options->get('genSettersGetters', false);
        $mapColumn = $this->options->get('mapColumn', null);

        $adapter = $config->database->adapter;
        $this->isSupportedAdapter($adapter);

        $adapter = 'Mysql';
        if (isset($config->database->adapter)) {
            $adapter = $config->database->adapter;
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

        if ($this->options->contains('schema')) {
            $schema = $this->options->get('schema');
        } elseif ($adapter == 'Postgresql') {
            $schema = 'public';
        } else {
            $schema = isset($config->database->schema) ? $config->database->schema : $config->database->dbname;
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
                                    'options' => $defineForeignKeys ? array('foreignKey'=>true) : null
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
            $className = ($this->options->contains('abstract') ? 'Abstract' : '');
            $className .= Utils::camelize($name);

            if (!file_exists($modelPath . $className . '.php') || $forceProcess) {
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

                $modelBuilder = new Model(array(
                    'name' => $name,
                    'schema' => $schema,
                    'extends' => $this->options->get('extends'),
                    'namespace' => $this->options->get('namespace'),
                    'force' => $forceProcess,
                    'hasMany' => $hasManyModel,
                    'belongsTo' => $belongsToModel,
                    'foreignKeys' => $foreignKeysModel,
                    'genSettersGetters' => $genSettersGetters,
                    'directory' => $this->options->get('directory'),
                    'modelsDir' => $this->options->get('modelsDir'),
                    'mapColumn' => $mapColumn,
                    'abstract' => $this->options->get('abstract')
                ));

                $modelBuilder->build();
            } else {
                if ($this->isConsole()) {
                    print Color::info(sprintf('Skipping model "%s" because it already exist', Utils::camelize($name)));
                } else {
                    $this->exist[] = $name;
                }
            }
        }
    }
}
