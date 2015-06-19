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

use Phalcon\Db\Column;
use Phalcon\Text as Utils;
use ReflectionException;
use Phalcon\Generator\Snippet;
use ReflectionClass;

/**
 * ModelBuilderComponent
 *
 * Builder to generate models
 *
 * @package     Phalcon\Builder
 * @copyright   Copyright (c) 2011-2015 Phalcon Team (team@phalconphp.com)
 * @license     New BSD License
 */
class Model extends Component
{
    /**
     * Map of scalar data objects
     * @var array
     */
    private $_typeMap = array(
        //'Date' => 'Date',
        //'Decimal' => 'Decimal'
    );

    /**
     * Snippet component
     * @var Snippet
     */
    protected $snippet;

    /**
     * Create Builder object
     *
     * @param array $options Builder options
     * @throws BuilderException
     */
    public function __construct(array $options = array())
    {
        if (!isset($options['name'])) {
            throw new BuilderException("Please, specify the model name");
        }

        if (!isset($options['force'])) {
            $options['force'] = false;
        }

        if (!isset($options['className'])) {
            $options['className'] = Utils::camelize($options['name']);
        }

        if (!isset($options['fileName'])) {
            $options['fileName'] = $options['name'];
        }

        if (!isset($options['abstract'])) {
            $options['abstract'] = false;
        }

        if ($options['abstract']) {
            $options['className'] = 'Abstract' . $options['className'];
        }

        parent::__construct($options);

        $this->snippet = new Snippet();
    }

    /**
     * Returns the associated PHP type
     *
     * @param  string $type
     * @return string
     */
    public function getPHPType($type)
    {
        switch ($type) {
            case Column::TYPE_INTEGER:
                return 'integer';
                break;
            case Column::TYPE_DECIMAL:
            case Column::TYPE_FLOAT:
                return 'double';
                break;
            case Column::TYPE_DATE:
            case Column::TYPE_VARCHAR:
            case Column::TYPE_DATETIME:
            case Column::TYPE_CHAR:
            case Column::TYPE_TEXT:
                return 'string';
                break;
            default:
                return 'string';
                break;
        }
    }

    public function build()
    {
        if (!$this->options->contains('name')) {
            throw new BuilderException('You must specify the table name');
        }

        if ($this->options->contains('directory')) {
            $this->path->setRootPath($this->options->get('directory'));
        }

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

        $methodRawCode = array();
        $className = $this->options->get('className');
        $modelPath .= $className . '.php';

        if (file_exists($modelPath) && !$this->options->contains('force')) {
            throw new BuilderException(sprintf(
                'The model file "%s.php" already exists in models dir',
                $className
            ));
        }

        if (!isset($config->database)) {
            throw new BuilderException('Database configuration cannot be loaded from your config file.');
        }

        if (!isset($config->database->adapter)) {
            throw new BuilderException(
                "Adapter was not found in the config. " .
                "Please specify a config variable [database][adapter]"
            );
        }

        $namespace = '';
        if ($this->options->contains('namespace') && $this->checkNamespace($this->options->get('namespace'))) {
            $namespace = 'namespace '.$this->options->get('namespace').';'.PHP_EOL.PHP_EOL;
        }

        $genDocMethods = $this->options->get('genDocMethods', false);
        $useSettersGetters = $this->options->get('genSettersGetters', false);

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

        // An array for use statements
        $uses = array();

        $adapterName = 'Phalcon\Db\Adapter\Pdo\\' . $adapter;
        unset($configArray['adapter']);
        /** @var \Phalcon\Db\Adapter\Pdo $db */
        $db = new $adapterName($configArray);

        $initialize = array();
        if ($this->options->contains('schema')) {
            $schema = $this->options->get('schema');
            if ($schema != $config->database->dbname) {
                $initialize[] = $this->snippet->getThisMethod('setSchema', $schema);
            }
        } elseif ($adapter == 'Postgresql') {
            $schema = 'public';
            $initialize[] = $initialize[] = $this->snippet->getThisMethod('setSchema', $schema);
        } else {
            $schema = $config->database->dbname;
        }

        $table = $this->options->get('name');
        if ($this->options->get('fileName') != $this->options->get('name')) {
            $initialize[] = $this->snippet->getThisMethod('setSource', '\'' . $table . '\'');
        }

        if (!$db->tableExists($table, $schema)) {
            throw new BuilderException(sprintf('Table "%s" does not exist.', $table));
        }
        $fields = $db->describeColumns($table, $schema);

        foreach ($db->listTables() as $tableName) {
            foreach ($db->describeReferences($tableName, $schema) as $reference) {
                if ($reference->getReferencedTable() != $this->options->get('name')) {
                    continue;
                }

                $entityNamespace = '';
                if ($this->options->contains('namespace')) {
                    $entityNamespace = $this->options->get('namespace')."\\";
                }

                $refColumns = $reference->getReferencedColumns();
                $columns = $reference->getColumns();
                $initialize[] = $this->snippet->getRelation(
                    'hasMany',
                    $refColumns[0],
                    $entityNamespace . Utils::camelize($tableName),
                    $columns[0],
                    "array('alias' => '" . Utils::camelize($tableName) . "')"
                );
            }
        }

        foreach ($db->describeReferences($this->options->get('name'), $schema) as $reference) {
            $entityNamespace = '';
            if ($this->options->contains('namespace')) {
                $entityNamespace = $this->options->get('namespace')."\\";
            }

            $refColumns = $reference->getReferencedColumns();
            $columns = $reference->getColumns();
            $initialize[] = $this->snippet->getRelation(
                'belongsTo',
                $columns[0],
                $entityNamespace . Utils::camelize($reference->getReferencedTable()),
                $refColumns[0],
                "array('alias' => '" . Utils::camelize($reference->getReferencedTable()) . "')"
            );
        }

        if ($this->options->has('hasMany')) {
            if (count($this->options->get('hasMany'))) {
                foreach ($this->options->get('hasMany') as $relation) {
                    if (!is_string($relation['fields'])) {
                        continue;
                    }

                    $entityName = $relation['camelizedName'];
                    $entityNamespace = '';
                    if ($this->options->contains('namespace')) {
                        $entityNamespace = $this->options->get('namespace')."\\";
                        $relation['options']['alias'] = $entityName;
                    }

                    $initialize[] = $this->snippet->getRelation(
                        'hasMany',
                        $relation['fields'],
                        $entityNamespace . $entityName,
                        $relation['relationFields'],
                        $this->snippet->getRelationOptions(isset($relation['options']) ? $relation["options"]->toArray() : null)
                    );
                }
            }
        }

        if ($this->options->has('belongsTo')) {
            if (count($this->options->get('belongsTo'))) {
                foreach ($this->options->get('belongsTo') as $relation) {
                    if (!is_string($relation['fields'])) {
                        continue;
                    }

                    $entityName = Utils::camelize($relation['referencedModel']);
                    $entityNamespace = '';
                    if ($this->options->contains('namespace')) {
                        $entityNamespace = $this->options->get('namespace')."\\";
                        $relation['options']['alias'] = $entityName;
                    }

                    $initialize[] = $this->snippet->getRelation(
                        'belongsTo',
                        $relation['fields'],
                        $entityNamespace . $entityName,
                        $relation['relationFields'],
                        $this->snippet->getRelationOptions(isset($relation['options']) ? $relation["options"]->toArray() : null)
                    );
                }
            }
        }

        $alreadyInitialized  = false;
        $alreadyValidations  = false;
        $alreadyFind         = false;
        $alreadyFindFirst    = false;
        $alreadyColumnMapped = false;
        $alreadyGetSourced   = false;

        if (file_exists($modelPath)) {
            try {
                $possibleMethods = array();
                if ($useSettersGetters) {
                    foreach ($fields as $field) {
                        /** @var \Phalcon\Db\Column $field */
                        $methodName = Utils::camelize($field->getName());
                        $possibleMethods['set' . $methodName] = true;
                        $possibleMethods['get' . $methodName] = true;
                    }
                }

                $possibleMethods['getSource'] = true;

                require $modelPath;

                $linesCode = file($modelPath);
                $fullClassName = $this->options->get('className');
                if ($this->options->contains('namespace')) {
                    $fullClassName = $this->options->get('namespace').'\\'.$fullClassName;
                }
                $reflection = new ReflectionClass($fullClassName);
                foreach ($reflection->getMethods() as $method) {
                    if ($method->getDeclaringClass()->getName() != $fullClassName) {
                        continue;
                    }

                    $methodName = $method->getName();
                    if (isset($possibleMethods[$methodName])) {
                        continue;
                    }

                    $indent = PHP_EOL;
                    if ($method->getDocComment()) {
                        $firstLine = $linesCode[$method->getStartLine()-1];
                        preg_match('#^\s+#', $firstLine, $matches);
                        if (isset($matches[0])) {
                            $indent .= $matches[0];
                        }
                    }

                    $methodDeclaration = join(
                        '',
                        array_slice(
                            $linesCode,
                            $method->getStartLine() - 1,
                            $method->getEndLine() - $method->getStartLine() + 1
                        )
                    );

                    $methodRawCode[$methodName] = $indent . $method->getDocComment() . PHP_EOL . $methodDeclaration;

                    switch ($methodName) {
                        case 'initialize':
                            $alreadyInitialized = true;
                            break;
                        case 'validation':
                            $alreadyValidations = true;
                            break;
                        case 'find':
                            $alreadyFind = true;
                            break;
                        case 'findFirst':
                            $alreadyFindFirst = true;
                            break;
                        case 'columnMap':
                            $alreadyColumnMapped = true;
                            break;
                        case 'getSource':
                            $alreadyGetSourced = true;
                            break;
                    }
                }
            } catch (ReflectionException $e) {
            }
        }

        $validations = array();
        foreach ($fields as $field) {
            if ($field->getType() === Column::TYPE_CHAR) {
                $domain = array();
                if (preg_match('/\((.*)\)/', $field->getType(), $matches)) {
                    foreach (explode(',', $matches[1]) as $item) {
                        $domain[] = $item;
                    }
                }
                if (count($domain)) {
                    $varItems = join(', ', $domain);
                    $validations[] = $this->snippet->getValidateInclusion($field->getName(), $varItems);
                }
            }
            if ($field->getName() == 'email') {
                $validations[] = $this->snippet->getValidateEmail($field->getName());
                $uses[] = $this->snippet->getUseAs('Phalcon\Mvc\Model\Validator\Email', 'Email');
            }
        }
        if (count($validations)) {
            $validations[] = $this->snippet->getValidationFailed();
        }

        // Check if there has been an extender class
        $extends = $this->options->get('extends', '\Phalcon\Mvc\Model');

        // Check if there have been any excluded fields
        $exclude = array();
        if ($this->options->contains('excludeFields')) {
            $keys = explode(',', $this->options->get('excludeFields'));
            if (count($keys) > 0) {
                foreach ($keys as $key) {
                    $exclude[trim($key)] = '';
                }
            }
        }

        $attributes = array();
        $setters = array();
        $getters = array();
        foreach ($fields as $field) {
            $type = $this->getPHPType($field->getType());
            if (!array_key_exists(strtolower($field->getName()), $exclude)) {
                if ($useSettersGetters) {
                    $attributes[] = $this->snippet->getAttributes($type, 'protected', $field->getName());
                    $setterName = Utils::camelize($field->getName());
                    $setters[] = $this->snippet->getSetter($field->getName(), $type, $setterName);

                    if (isset($this->_typeMap[$type])) {
                        $getters[] = $this->snippet->getGetterMap($field->getName(), $type, $setterName, $this->_typeMap[$type]);
                    } else {
                        $getters[] = $this->snippet->getGetter($field->getName(), $type, $setterName);
                    }
                } else {
                    $attributes[] = $this->snippet->getAttributes($type, 'public', $field->getName());
                }
            }
        }

        $validationsCode = '';
        if ($alreadyValidations == false && count($validations) > 0) {
            $validationsCode = $this->snippet->getValidationsMethod($validations);
        }

        $initCode = '';
        if ($alreadyInitialized == false && count($initialize) > 0) {
            $initCode = $this->snippet->getInitialize($initialize);
        }

        $license = '';
        if (file_exists('license.txt')) {
            $license = trim(file_get_contents('license.txt')) . PHP_EOL . PHP_EOL;
        }

        if (false == $alreadyGetSourced) {
            $methodRawCode[] = $this->snippet->getModelSource($this->options->get('name'));
        }

        if (false == $alreadyFind) {
            $methodRawCode[] = $this->snippet->getModelFind($className);
        }

        if (false == $alreadyFindFirst) {
            $methodRawCode[] = $this->snippet->getModelFindFirst($className);
        }

        $content = join('', $attributes);

        if ($useSettersGetters) {
            $content .= join('', $setters) . join('', $getters);
        }

        $content .= $validationsCode . $initCode;
        foreach ($methodRawCode as $methodCode) {
            $content .= $methodCode;
        }

        $classDoc = '';
        if ($genDocMethods) {
            $classDoc = $this->snippet->getClassDoc($className, $namespace);
        }

        if ($this->options->contains('mapColumn') && false == $alreadyColumnMapped) {
            $content .= $this->snippet->getColumnMap($fields);
        }

        $useDefinition = '';
        if (!empty($uses)) {
            $useDefinition = join('', $uses) . PHP_EOL . PHP_EOL;
        }

        $abstract = ($this->options->contains('abstract') ? 'abstract ' : '');

        $code = $this->snippet->getClass($namespace, $useDefinition, $classDoc, $abstract, $className, $extends, $content, $license);

        if (file_exists($modelPath) && !is_writable($modelPath)) {
            throw new BuilderException(sprintf('Unable to write to %s. Check write-access of a file.', $modelPath));
        }

        if (!file_put_contents($modelPath, $code)) {
            throw new BuilderException(sprintf('Unable to write to %s', $modelPath));
        }

        if ($this->isConsole()) {
            $msgSuccess = ($this->options->contains('abstract') ? 'Abstract ' : '') . 'Model "%s" was successfully created.';
            $this->_notifySuccess(sprintf($msgSuccess, Utils::camelize($this->options->get('name'))));
        }
    }
}
