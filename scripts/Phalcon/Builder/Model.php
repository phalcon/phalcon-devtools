<?php

/*
  +------------------------------------------------------------------------+
  | Phalcon Developer Tools                                                |
  +------------------------------------------------------------------------+
  | Copyright (c) 2011-2016 Phalcon Team (https://www.phalconphp.com)      |
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

use Phalcon\Utils;
use ReflectionClass;
use Phalcon\Db\Column;
use Phalcon\Validation;
use Phalcon\Generator\Snippet;
use Phalcon\Db\ReferenceInterface;
use Phalcon\Validation\Validator\Email as EmailValidator;
use Phalcon\Text;
use \Phalcon\Db\Adapter\Pdo;


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
    private $_typeMap = [
        //'Date' => 'Date',
        //'Decimal' => 'Decimal'
    ];

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
    public function __construct(array $options)
    {
        if (!isset($options['name'])) {
            throw new BuilderException('Please, specify the model name');
        }

        if (!isset($options['camelize'])) {
            $options['camelize'] = false;
        }

        if (!isset($options['force'])) {
            $options['force'] = false;
        }

        if (!isset($options['className'])) {
            $options['className'] = Utils::lowerCamelizeWithDelimiter($options['name'], '_-');
        }

        if (!isset($options['fileName'])) {
            $options['fileName'] = Utils::lowerCamelizeWithDelimiter($options['name'], '_-');
        }

        if (!isset($options['abstract'])) {
            $options['abstract'] = false;
        }

        if (!isset($options['annotate'])) {
            $options['annotate'] = false;
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

    /**
     * Module build
     *
     * @return mixed
     * @throws \Phalcon\Builder\BuilderException
     */
    public function build()
    {
        if (!$this->options->contains('name')) {
            throw new BuilderException('You must specify the table name');
        }

        if ($this->options->contains('directory')) {
            $this->path->setRootPath($this->options->get('directory'));
        }

        if (gettype($this->options->get('config')) == 'object') {
            $config = $this->options->get('config');
        } else {
            $config = $this->getConfig();
        }

        if (!$modelsDir = $this->options->get('modelsDir')) {
            if (!$config->get('application') || !isset($config->get('application')->modelsDir)) {
                throw new BuilderException("Builder doesn't know where is the models directory.");
            }

            $modelsDir = $config->get('application')->modelsDir;
        }

        $modelsDir = rtrim($modelsDir, '/\\') . DIRECTORY_SEPARATOR;
        $modelPath = $modelsDir;
        if (false == $this->isAbsolutePath($modelsDir)) {
            $modelPath = $this->path->getRootPath($modelsDir);
        }

        $methodRawCode = [];
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

        if (isset($config->devtools->loader)) {
            /** @noinspection PhpIncludeInspection */
            require_once $config->devtools->loader;
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
        $uses = [];

        $adapterName = 'Phalcon\Db\Adapter\Pdo\\' . $adapter;
        unset($configArray['adapter']);
        /** @var \Phalcon\Db\Adapter\Pdo $db */
        $db = new $adapterName($configArray);

        $initialize = [];

        if ($this->options->contains('schema')) {
            $schema = $this->options->get('schema');
        } else {
            $schema = Utils::resolveDbSchema($config->database);
        }

        if ($schema) {
            $initialize['schema'] = $this->snippet->getThisMethod('setSchema', $schema);
        }
        $initialize['source'] = $this->snippet->getThisMethod('setSource', $this->options->get('name'));

        $table = $this->options->get('name');

        if (!$db->tableExists($table, $schema)) {
            throw new BuilderException(sprintf('Table "%s" does not exist.', $table));
        }

        $fields = $db->describeColumns($table, $schema);
        $referenceList = $this->getReferenceList($schema, $db);

        foreach ($referenceList as $tableName => $references) {
            foreach ($references as $reference) {
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
                    $this->options->get('camelize') ? Utils::lowerCamelize($refColumns[0]) : $refColumns[0],
                    $entityNamespace . Text::camelize($tableName, '_-'),
                    $this->options->get('camelize') ? Utils::lowerCamelize($columns[0]) : $columns[0],
                    "['alias' => '" . Text::camelize($tableName, '_-') . "']"
                );
            }
        }

        foreach ($db->describeReferences($this->options->get('name'), $schema) as $reference) {
            $entityNamespace = '';
            if ($this->options->contains('namespace')) {
                $entityNamespace = $this->options->get('namespace');
            }

            $refColumns = $reference->getReferencedColumns();
            $columns = $reference->getColumns();
            $initialize[] = $this->snippet->getRelation(
                'belongsTo',
                $this->options->get('camelize') ? Utils::lowerCamelize($columns[0]) : $columns[0],
                $this->getEntityClassName($reference, $entityNamespace),
                $this->options->get('camelize') ? Utils::lowerCamelize($refColumns[0]) : $refColumns[0],
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
                throw new BuilderException(
                    sprintf('Failed to create the model "%s". Error: %s',
                        $this->options->get('className'),
                        $e->getMessage()
                    )
                );
            }
        }

        $validations = [];
        foreach ($fields as $field) {
            if ($field->getType() === Column::TYPE_CHAR) {
                if ($this->options->get('camelize')) {
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
                    $validations[] = $this->snippet->getValidateInclusion($fieldName, $varItems);
                }
            }
            if ($field->getName() == 'email') {
                if ($this->options->get('camelize')) {
                    $fieldName = Utils::lowerCamelize(Utils::camelize($field->getName(), '_-'));
                } else {
                    $fieldName = Utils::lowerCamelize(Utils::camelize($field->getName(), '-'));
                }
                $validations[] = $this->snippet->getValidateEmail($fieldName);
                $uses[] = $this->snippet->getUseAs(EmailValidator::class, 'EmailValidator');
            }
        }
        if (count($validations)) {
            $validations[] = $this->snippet->getValidationEnd();
        }

        // Check if there has been an extender class
        $extends = $this->options->get('extends', '\Phalcon\Mvc\Model');

        // Check if there have been any excluded fields
        $exclude = [];
        if ($this->options->contains('excludeFields')) {
            $keys = explode(',', $this->options->get('excludeFields'));
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
            $fieldName = $this->options->get('camelize') ? Utils::lowerCamelize($fieldName) : $fieldName;
            $attributes[] = $this->snippet->getAttributes($type, $useSettersGetters ? 'protected' : 'public', $field, $this->options->has( 'annotate' ), $fieldName);

            if ($useSettersGetters) {
                $methodName = Utils::camelize($field->getName(), '_-');
                $setters[] = $this->snippet->getSetter($fieldName, $type, $methodName);

                if (isset($this->_typeMap[$type])) {
                    $getters[] = $this->snippet->getGetterMap($fieldName, $type, $methodName, $this->_typeMap[$type]);
                } else {
                    $getters[] = $this->snippet->getGetter($fieldName, $type, $methodName);
                }
            }
        }

        $validationsCode = '';
        if ($alreadyValidations == false && count($validations) > 0) {
            $validationsCode = $this->snippet->getValidationsMethod($validations);
            $uses[] = $this->snippet->getUse(Validation::class);
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
            $content .= $this->snippet->getColumnMap($fields, $this->options->get('camelize'));
        }

        $useDefinition = '';
        if (!empty($uses)) {
            usort($uses, function ($a, $b) {
                return strlen($a) - strlen($b);
            });

            $useDefinition = join("\n", $uses) . PHP_EOL . PHP_EOL;
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
            $this->notifySuccess(sprintf($msgSuccess, Text::camelize($this->options->get('name'), '_-')));
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
        if ($this->options->contains('referenceList')) {
            return $this->options->get('referenceList');
        }

        $referenceList = [];
        foreach ($db->listTables($schema) as $name) {
            $referenceList[$name] = $db->describeReferences($name, $schema);;
        }

        return $referenceList;
    }
}
