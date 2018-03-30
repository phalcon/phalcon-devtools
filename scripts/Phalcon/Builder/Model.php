<?php

/*
  +------------------------------------------------------------------------+
  | Phalcon Developer Tools                                                |
  +------------------------------------------------------------------------+
  | Copyright (c) 2011-present Phalcon Team (https://www.phalconphp.com)   |
  +------------------------------------------------------------------------+
  | This source file is subject to the New BSD License that is bundled     |
  | with this package in the file LICENSE.txt.                             |
  |                                                                        |
  | If you did not receive a copy of the license and are unable to         |
  | obtain it through the world-wide-web, please send an email             |
  | to license@phalconphp.com so we can send you a copy immediately.       |
  +------------------------------------------------------------------------+
  | Authors: Andres Gutierrez <andres@phalconphp.com>                      |
  |          Eduar Carvajal <eduar@phalconphp.com>                         |
  |          Serghei Iakovlev <serghei@phalconphp.com>                     |
  +------------------------------------------------------------------------+
*/

namespace Phalcon\Builder;

use Phalcon\Text;
use Phalcon\Utils;
use ReflectionClass;
use Phalcon\Db\Column;
use Phalcon\Validation;
use Phalcon\Db\Adapter\Pdo;
use Phalcon\Generator\Snippet;
use Phalcon\Db\ReferenceInterface;
use Phalcon\Exception\RuntimeException;
use Phalcon\Exception\WriteFileException;
use Phalcon\Exception\InvalidArgumentException;
use Phalcon\Options\OptionsAware as ModelOption;
use Phalcon\Exception\InvalidParameterException;
use Phalcon\Validation\Validator\Email as EmailValidator;

/**
 * ModelBuilderComponent
 *
 * Builder to generate models
 *
 * @package Phalcon\Builder
 */
class Model extends Component
{
    /**
     * Map of scalar data objects
     * @var array
     */
    private $typeMap = [
        //'Date' => 'Date',
        //'Decimal' => 'Decimal'
    ];

    /**
     * Options container
     * @var ModelOption
     */
    protected $modelOptions;

    /**
     * Create Builder object
     *
     * @param array $options
     * @throws InvalidArgumentException
     */
    public function __construct(array $options)
    {
        $this->modelOptions = new ModelOption($options);

        if (!$this->modelOptions->hasOption('name')) {
            throw new InvalidArgumentException('Please, specify the table name');
        }

        $this->modelOptions->setNotDefinedOption('camelize', false);
        $this->modelOptions->setNotDefinedOption('force', false);
        $this->modelOptions->setNotDefinedOption(
            'className',
            Utils::lowerCamelizeWithDelimiter($options['name'], '_-')
        );
        $this->modelOptions->setNotDefinedOption('fileName', Utils::lowerCamelizeWithDelimiter($options['name'], '_-'));
        $this->modelOptions->setNotDefinedOption('abstract', false);
        $this->modelOptions->setNotDefinedOption('annotate', false);
        if ($this->modelOptions->getOption('abstract')) {
            $this->modelOptions->setOption('className', 'Abstract' . $this->modelOptions->getOption('className'));
        }

        parent::__construct($options);
        $this->modelOptions->setOption('config', $this->modelOptions->getOption('config'));

        $this->modelOptions->setOption('snippet', new Snippet());
    }

    /**
     * Module build
     *
     * @return mixed
     */
    public function build()
    {
        $config = $this->modelOptions->getOption('config');
        $snippet = $this->modelOptions->getOption('snippet');

        if ($this->modelOptions->hasOption('directory')) {
            $this->path->setRootPath($this->modelOptions->getOption('directory'));
        }

        $methodRawCode = [];
        $this->setModelsDir();
        $this->setModelPath();

        $modelPath = $this->modelOptions->getOption('modelPath');

        $this->checkDataBaseParam();

        if (isset($config->devtools->loader)) {
            /** @noinspection PhpIncludeInspection */
            require_once $config->devtools->loader;
        }

        $namespace = '';
        if ($this->modelOptions->hasOption('namespace') &&
            $this->checkNamespace($this->modelOptions->getOption('namespace'))) {
            $namespace = 'namespace ' . $this->modelOptions->getOption('namespace') . ';' . PHP_EOL . PHP_EOL;
        }

        $genDocMethods = $this->modelOptions->getValidOptionOrDefault('genDocMethods', false);
        $useSettersGetters = $this->modelOptions->getValidOptionOrDefault('genSettersGetters', false);

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
        $uses = [];

        $adapterName = 'Phalcon\Db\Adapter\Pdo\\' . $adapter;
        unset($configArray['adapter']);
        /** @var Pdo $db */
        $db = new $adapterName($configArray);

        $initialize = [];

        if ($this->modelOptions->hasOption('schema')) {
            $schema = $this->modelOptions->getOption('schema');
        } else {
            $schema = Utils::resolveDbSchema($config->database);
        }

        if ($schema) {
            $initialize['schema'] = $snippet->getThisMethod('setSchema', $schema);
        }
        $initialize['source'] = $snippet->getThisMethod('setSource', $this->modelOptions->getOption('name'));

        $table = $this->modelOptions->getOption('name');

        if (!$db->tableExists($table, $schema)) {
            throw new InvalidArgumentException(sprintf('Table "%s" does not exist.', $table));
        }

        $fields = $db->describeColumns($table, $schema);
        $referenceList = $this->getReferenceList($schema, $db);

        foreach ($referenceList as $tableName => $references) {
            foreach ($references as $reference) {
                if ($reference->getReferencedTable() != $this->modelOptions->getOption('name')) {
                    continue;
                }

                $entityNamespace = '';
                if ($this->modelOptions->getOption('namespace')) {
                    $entityNamespace = $this->modelOptions->getOption('namespace')."\\";
                }

                $refColumns = $reference->getReferencedColumns();
                $columns = $reference->getColumns();
                $initialize[] = $snippet->getRelation(
                    'hasMany',
                    $this->modelOptions->getOption('camelize') ? Utils::lowerCamelize($refColumns[0]) : $refColumns[0],
                    $entityNamespace . Text::camelize($tableName, '_-'),
                    $this->modelOptions->getOption('camelize') ? Utils::lowerCamelize($columns[0]) : $columns[0],
                    "['alias' => '" . Text::camelize($tableName, '_-') . "']"
                );
            }
        }

        foreach ($db->describeReferences($this->modelOptions->getOption('name'), $schema) as $reference) {
            $entityNamespace = '';
            if ($this->modelOptions->getOption('namespace')) {
                $entityNamespace = $this->modelOptions->getOption('namespace');
            }

            $refColumns = $reference->getReferencedColumns();
            $columns = $reference->getColumns();
            $initialize[] = $snippet->getRelation(
                'belongsTo',
                $this->modelOptions->getOption('camelize') ? Utils::lowerCamelize($columns[0]) : $columns[0],
                $this->getEntityClassName($reference, $entityNamespace),
                $this->modelOptions->getOption('camelize') ? Utils::lowerCamelize($refColumns[0]) : $refColumns[0],
                "['alias' => '" . Text::camelize($reference->getReferencedTable(), '_-') . "']"
            );
        }

        $alreadyInitialized  = false;
        $alreadyValidations  = false;
        $alreadyFind         = false;
        $alreadyFindFirst    = false;
        $alreadyColumnMapped = false;
        $alreadyGetSourced   = false;

        if (file_exists($modelPath)) {
            try {
                $possibleMethods = [];
                if ($useSettersGetters) {
                    foreach ($fields as $field) {
                        /** @var \Phalcon\Db\Column $field */
                        $methodName = Text::camelize($field->getName(), '_-');

                        $possibleMethods['set' . $methodName] = true;
                        $possibleMethods['get' . $methodName] = true;
                    }
                }

                $possibleMethods['getSource'] = true;

                /** @noinspection PhpIncludeInspection */
                require_once $modelPath;

                $linesCode = file($modelPath);
                $fullClassName = $this->modelOptions->getOption('className');
                if ($this->modelOptions->getOption('namespace')) {
                    $fullClassName = $this->modelOptions->getOption('namespace').'\\'.$fullClassName;
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
                        $firstLine = $linesCode[$method->getStartLine() - 1];
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
            } catch (\Exception $e) {
                throw new RuntimeException(
                    sprintf(
                        'Failed to create the model "%s". Error: %s',
                        $this->modelOptions->getOption('className'),
                        $e->getMessage()
                    )
                );
            }
        }

        $validations = [];
        foreach ($fields as $field) {
            if ($field->getType() === Column::TYPE_CHAR) {
                if ($this->modelOptions->getOption('camelize')) {
                    $fieldName = Utils::lowerCamelize(Utils::camelize($field->getName(), '_-'));
                } else {
                    $fieldName = Utils::lowerCamelize(Utils::camelize($field->getName(), '-'));
                }
                $domain = [];
                if (preg_match('/\((.*)\)/', $field->getType(), $matches)) {
                    foreach (explode(',', $matches[1]) as $item) {
                        $domain[] = $item;
                    }
                }
                if (count($domain)) {
                    $varItems = join(', ', $domain);
                    $validations[] = $snippet->getValidateInclusion($fieldName, $varItems);
                }
            }
            if ($field->getName() == 'email') {
                if ($this->modelOptions->getOption('camelize')) {
                    $fieldName = Utils::lowerCamelize(Utils::camelize($field->getName(), '_-'));
                } else {
                    $fieldName = Utils::lowerCamelize(Utils::camelize($field->getName(), '-'));
                }
                $validations[] = $snippet->getValidateEmail($fieldName);
                $uses[] = $snippet->getUseAs(EmailValidator::class, 'EmailValidator');
            }
        }
        if (count($validations)) {
            $validations[] = $snippet->getValidationEnd();
        }

        // Check if there has been an extender class
        $extends = $this->modelOptions->getValidOptionOrDefault('extends', '\Phalcon\Mvc\Model');

        // Check if there have been any excluded fields
        $exclude = [];
        if ($this->modelOptions->hasOption('excludeFields')) {
            $keys = explode(',', $this->modelOptions->getOption('excludeFields'));
            if (count($keys) > 0) {
                foreach ($keys as $key) {
                    $exclude[trim($key)] = '';
                }
            }
        }

        $attributes = [];
        $setters = [];
        $getters = [];
        foreach ($fields as $field) {
            if (array_key_exists(strtolower($field->getName()), $exclude)) {
                continue;
            }
            $type = $this->getPHPType($field->getType());
            $fieldName = Utils::lowerCamelizeWithDelimiter($field->getName(), '-', true);
            $fieldName = $this->modelOptions->getOption('camelize') ? Utils::lowerCamelize($fieldName) : $fieldName;
            $attributes[] = $snippet->getAttributes(
                $type,
                $useSettersGetters ? 'protected' : 'public',
                $field,
                $this->modelOptions->getOption('annotate'),
                $fieldName
            );

            if ($useSettersGetters) {
                $methodName = Utils::camelize($field->getName(), '_-');
                $setters[] = $snippet->getSetter($field->getName(), $fieldName, $type, $methodName);

                if (isset($this->typeMap[$type])) {
                    $getters[] = $snippet->getGetterMap($fieldName, $type, $methodName, $this->typeMap[$type]);
                } else {
                    $getters[] = $snippet->getGetter($fieldName, $type, $methodName);
                }
            }
        }

        $validationsCode = '';
        if ($alreadyValidations == false && count($validations) > 0) {
            $validationsCode = $snippet->getValidationsMethod($validations);
            $uses[] = $snippet->getUse(Validation::class);
        }

        $initCode = '';
        if ($alreadyInitialized == false && count($initialize) > 0) {
            $initCode = $snippet->getInitialize($initialize);
        }

        $license = '';
        if (file_exists('license.txt')) {
            $license = trim(file_get_contents('license.txt')) . PHP_EOL . PHP_EOL;
        }

        if (false == $alreadyGetSourced) {
            $methodRawCode[] = $snippet->getModelSource($this->modelOptions->getOption('name'));
        }

        if (false == $alreadyFind) {
            $methodRawCode[] = $snippet->getModelFind($this->modelOptions->getOption('className'));
        }

        if (false == $alreadyFindFirst) {
            $methodRawCode[] = $snippet->getModelFindFirst($this->modelOptions->getOption('className'));
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
            $classDoc = $snippet->getClassDoc($this->modelOptions->getOption('className'), $namespace);
        }

        if ($this->modelOptions->hasOption('mapColumn') && $this->modelOptions->getOption('mapColumn')
                && false == $alreadyColumnMapped) {
            $content .= $snippet->getColumnMap($fields, $this->modelOptions->getOption('camelize'));
        }

        $useDefinition = '';
        if (!empty($uses)) {
            usort($uses, function ($a, $b) {
                return strlen($a) - strlen($b);
            });

            $useDefinition = join("\n", $uses) . PHP_EOL . PHP_EOL;
        }

        $abstract = ($this->modelOptions->getOption('abstract') ? 'abstract ' : '');

        $code = $snippet->getClass(
            $namespace,
            $useDefinition,
            $classDoc,
            $abstract,
            $this->modelOptions,
            $extends,
            $content,
            $license
        );

        if (file_exists($modelPath) && !is_writable($modelPath)) {
            throw new WriteFileException(sprintf('Unable to write to %s. Check write-access of a file.', $modelPath));
        }

        if (!file_put_contents($modelPath, $code)) {
            throw new WriteFileException(sprintf('Unable to write to %s', $modelPath));
        }

        if ($this->isConsole()) {
            $msgSuccess = ($this->modelOptions->getOption('abstract') ? 'Abstract ' : '');
            $msgSuccess .= 'Model "%s" was successfully created.';
            $this->notifySuccess(sprintf($msgSuccess, Text::camelize($this->modelOptions->getOption('name'), '_-')));
        }
    }

    /**
     * Set path to model
     *
     * @throw WriteFileException
     */
    protected function setModelPath()
    {
        $modelPath = $this->modelOptions->getOption('modelsDir');

        if (false == $this->isAbsolutePath($modelPath)) {
            $modelPath = $this->path->getRootPath($modelPath);
        }

        $modelPath .= $this->modelOptions->getOption('className') . '.php';

        if (file_exists($modelPath) && !$this->modelOptions->getOption('force')) {
            throw new WriteFileException(sprintf(
                'The model file "%s.php" already exists in models dir',
                $this->modelOptions->getOption('className')
            ));
        }

        $this->modelOptions->setOption('modelPath', $modelPath);
    }

    /**
     * @throw InvalidParameterException
     */
    protected function checkDataBaseParam()
    {
        if (!isset($this->modelOptions->getOption('config')->database)) {
            throw new InvalidParameterException('Database configuration cannot be loaded from your config file.');
        }

        if (!isset($this->modelOptions->getOption('config')->database->adapter)) {
            throw new InvalidParameterException(
                "Adapter was not found in the config. " .
                "Please specify a config variable [database][adapter]"
            );
        }
    }

    protected function getEntityClassName(ReferenceInterface $reference, $namespace)
    {
        $referencedTable = Utils::camelize($reference->getReferencedTable());
        $fqcn = "{$namespace}\\{$referencedTable}";

        return $fqcn;
    }

    /**
     * Get reference list from option
     *
     * @param string $schema
     * @param Pdo $db
     * @return array
     */
    protected function getReferenceList($schema, Pdo $db)
    {
        if ($this->modelOptions->hasOption('referenceList')) {
            return $this->modelOptions->getOption('referenceList');
        }

        $referenceList = [];
        foreach ($db->listTables($schema) as $name) {
            $referenceList[$name] = $db->describeReferences($name, $schema);
        }

        return $referenceList;
    }

    /**
     * Set path to folder where models are
     *
     * @throw InvalidParameterException
     */
    protected function setModelsDir()
    {
        if ($this->modelOptions->hasOption('modelsDir')) {
            $this->modelOptions->setOption(
                'modelsDir',
                rtrim($this->modelOptions->getOption('modelsDir'), '/\\') . DIRECTORY_SEPARATOR
            );
            return;
        }

        if ($modelsDir = $this->modelOptions->getOption('config')->path('application.modelsDir')) {
            $this->modelOptions->setOption('modelsDir', rtrim($modelsDir, '/\\') . DIRECTORY_SEPARATOR);
            return;
        }

        throw new InvalidParameterException("Builder doesn't know where is the models directory.");
    }

    /**
     * Returns the associated PHP type
     *
     * @param  string $type
     * @return string
     */
    protected function getPHPType($type)
    {
        switch ($type) {
            case Column::TYPE_INTEGER:
            case Column::TYPE_BIGINTEGER:
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
}
