<?php
declare(strict_types=1);

/**
 * This file is part of the Phalcon Developer Tools.
 *
 * (c) Phalcon Team <team@phalcon.io>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace Phalcon\DevTools\Builder\Component;

use Phalcon\DevTools\Builder\Exception\BuilderException;
use Phalcon\DevTools\Script\Color;
use Phalcon\DevTools\Utils;

/**
 * Builder to generate all models
 */
class AllModels extends AbstractComponent
{
    /**
     * @var array
     */
    public $exist = [];

    /**
     * Create Builder object
     *
     * @param array $options Builder options
     */
    public function __construct(array $options = [])
    {
        if (!isset($options['force'])) {
            $options['force'] = false;
        }

        if (!isset($options['abstract'])) {
            $options['abstract'] = false;
        }

        parent::__construct($options);
    }

    /**
     * @throws BuilderException
     */
    public function build(): void
    {
        if ($this->options->offsetExists('directory')) {
            $this->path->setRootPath($this->options->get('directory'));
        }

        $this->options->offsetSet('directory', $this->path->getRootPath());

        if (gettype($this->options->get('config')) == 'object') {
            $config = $this->options->get('config');
        } else {
            $config = $this->getConfig();
        }

        if (!$modelsDir = $this->options->get('modelsDir')) {
            if (!isset($config->application->modelsDir)) {
                throw new BuilderException("Builder doesn't know where is the models directory.");
            }

            $modelsDir = $config->application->modelsDir;
        }

        $modelsDir = rtrim($modelsDir, '/\\') . DIRECTORY_SEPARATOR;
        $modelPath = $modelsDir;
        if (!$this->isAbsolutePath($modelsDir)) {
            $modelPath = $this->path->getRootPath($modelsDir);
        }

        $this->options->offsetSet('modelsDir', $modelPath);

        $forceProcess = $this->options->get('force');

        /** @var bool $defineRelations */
        $defineRelations = $this->options->get('defineRelations', false);
        $defineForeignKeys = $this->options->get('foreignKeys', false);
        $genSettersGetters = $this->options->get('genSettersGetters', false);
        $mapColumn = $this->options->get('mapColumn', false);

        $adapter = $config->database->adapter ?? 'Mysql';
        $this->isSupportedAdapter($adapter);

        if (is_object($config->database)) {
            $configArray = $config->database->toArray();
        } else {
            $configArray = $config->database;
        }

        $adapterName = 'Phalcon\Db\Adapter\Pdo\\' . $adapter;
        unset($configArray['adapter']);

        /**
         * @var \Phalcon\Db\Adapter\Pdo\AbstractPdo $db
         */
        $db = new $adapterName($configArray);

        if ($this->options->has('schema')) {
            $schema = $this->options->get('schema');
        } else {
            $schema = Utils::resolveDbSchema($config->database);
        }

        $hasMany = [];
        $belongsTo = [];
        $foreignKeys = [];
        $referenceList = [];
        if ($defineRelations || $defineForeignKeys) {
            foreach ($db->listTables($schema) as $name) {
                if ($defineRelations) {
                    if (!isset($hasMany[$name])) {
                        $hasMany[$name] = [];
                    }

                    if (!isset($belongsTo[$name])) {
                        $belongsTo[$name] = [];
                    }
                }

                if ($defineForeignKeys) {
                    $foreignKeys[$name] = [];
                }

                $camelCaseName = Utils::camelize($name);
                $refSchema = ($adapter != 'Postgresql') ? $schema : $config->database->dbname;
                $referenceList[$name] = $db->describeReferences($name, $schema);

                foreach ($referenceList[$name] as $reference) {
                    $columns = $reference->getColumns();
                    $referencedColumns = $reference->getReferencedColumns();
                    $referencedModel = Utils::camelize($reference->getReferencedTable());

                    if ($defineRelations && $reference->getReferencedSchema() == $refSchema && count($columns) === 1) {
                        $belongsTo[$name][] = [
                            'referencedModel' => $referencedModel,
                            'fields' => $columns[0],
                            'relationFields' => $referencedColumns[0],
                            'options' => $defineForeignKeys ? ['foreignKey'=>true] : null
                        ];
                        $hasMany[$reference->getReferencedTable()][] = [
                            'camelizedName' => $camelCaseName,
                            'fields' => $referencedColumns[0],
                            'relationFields' => $columns[0]
                        ];
                    }
                }
            }
        } else {
            foreach ($db->listTables($schema) as $name) {
                if (true === $defineRelations) {
                    $hasMany[$name] = [];
                    $belongsTo[$name] = [];
                    $foreignKeys[$name] = [];
                }

                $referenceList[$name] = $db->describeReferences($name, $schema);
            }
        }

        foreach ($db->listTables($schema) as $name) {
            $className = ($this->options->has('abstract') ? 'Abstract' : '') . Utils::camelize($name);

            if (file_exists($modelPath . $className . '.php') && !$forceProcess) {
                if ($this->isConsole()) {
                    print Color::info(sprintf('Skipping model "%s" because it already exist', Utils::camelize($name)));
                } else {
                    $this->exist[] = $name;
                }

                continue;
            }

            $modelBuilder = new Model([
                'name' => $name,
                'config' => $config,
                'schema' => $schema,
                'extends' => $this->options->get('extends'),
                'namespace' => $this->options->get('namespace'),
                'force' => $forceProcess,
                'hasMany' => $hasMany[$name] ?? [],
                'belongsTo' => $belongsTo[$name] ?? [],
                'foreignKeys' => $foreignKeys[$name] ?? [],
                'genSettersGetters' => $genSettersGetters,
                'genDocMethods' => $this->options->get('genDocMethods'),
                'directory' => $this->options->get('directory'),
                'modelsDir' => $this->options->get('modelsDir'),
                'mapColumn' => $mapColumn,
                'abstract' => $this->options->get('abstract'),
                'referenceList' => $referenceList,
                'camelize' => $this->options->get('camelize'),
                'annotate' => $this->options->get('annotate'),
            ]);

            $modelBuilder->build();
        }
    }
}
