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
     * Builder messages
     * @var array
     */
    protected $messages = [];

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
        $getSource = "
    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return '%s';
    }
";
        $templateThis = "        \$this->%s(%s);" . PHP_EOL;
        $templateRelation = "        \$this->%s('%s', '%s', '%s', %s);" . PHP_EOL;
        $templateSetter = "
    /**
     * Method to set the value of field %s
     *
     * @param %s \$%s
     * @return \$this
     */
    public function set%s(\$%s)
    {
        \$this->%s = \$%s;

        return \$this;
    }
";

        $templateValidateInclusion = "
        \$this->validate(
            new InclusionIn(
                array(
                    'field'    => '%s',
                    'domain'   => array(%s),
                    'required' => true,
                )
            )
        );";

        $templateValidateEmail = "
        \$this->validate(
            new Email(
                array(
                    'field'    => '%s',
                    'required' => true,
                )
            )
        );";

        $templateValidationFailed = "
        if (\$this->validationHasFailed() == true) {
            return false;
        }";

        $templateAttributes = "
    /**
     *
     * @var %s
     */
    %s \$%s;
";

        $templateGetterMap = "
    /**
     * Returns the value of field %s
     *
     * @return %s
     */
    public function get%s()
    {
        if (\$this->%s) {
            return new %s(\$this->%s);
        } else {
           return null;
        }
    }
";

        $templateGetter = "
    /**
     * Returns the value of field %s
     *
     * @return %s
     */
    public function get%s()
    {
        return \$this->%s;
    }
";

        $templateValidations = "
    /**
     * Validations and business logic
     */
    public function validation()
    {
%s
    }
";

        $templateInitialize = "
    /**
     * Initialize method for model.
     */
    public function initialize()
    {
%s
    }
";

        $templateFind = "
    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @return %s[]
     * @param mixed \$parameters
     */
    public static function find(\$parameters = null)
    {
        return parent::find(\$parameters);
    }
";

        $templateFindFirst = "
    /**
     * Allows to query the first record that match the specified conditions
     *
     * @return %s
     * @param mixed \$parameters
     */
    public static function findFirst(\$parameters = null)
    {
        return parent::findFirst(\$parameters);
    }
";

        $templateUse = 'use %s;';
        $templateUseAs = 'use %s as %s;';

        $templateCode = "<?php

%s%s%s%s%sclass %s extends %s
{
%s
}
";

        if (!$this->options->contains('name')) {
            throw new BuilderException('You must specify the table name');
        }

        if ($this->options->contains('directory')) {
            $this->currentPath = rtrim($this->options->directory, '\\/') . DIRECTORY_SEPARATOR;
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
            $modelPath = $this->currentPath . $modelsDir;
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
                $initialize[] = sprintf(
                    $templateThis, 'setSchema', '"' . $schema . '"'
                );
            }
        } elseif ($adapter == 'Postgresql') {
            $schema = 'public';
            $initialize[] = sprintf(
                $templateThis, 'setSchema', '"' . $schema . '"'
            );
        } else {
            $schema = $config->database->dbname;
        }

        $table = $this->options->get('name');
        if ($this->options->get('fileName') != $this->options->get('name')) {
            $initialize[] = sprintf(
                $templateThis, 'setSource',
                '\'' . $table . '\''
            );
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
                    $entityNamespace = "{$this->options->namespace}\\";
                }

                $refColumns = $reference->getReferencedColumns();
                $columns = $reference->getColumns();
                $initialize[] = sprintf(
                    $templateRelation,
                    'hasMany',
                    $refColumns[0],
                    $entityNamespace . ucfirst($tableName),
                    $columns[0],
                    "array('alias' => '" . ucfirst($tableName) . "')"
                );
            }
        }

        foreach ($db->describeReferences($this->options->get('name'), $schema) as $reference) {
            $entityNamespace = '';
            if ($this->options->contains('namespace')) {
                $entityNamespace = "{$this->options->namespace}\\";
            }

            $refColumns = $reference->getReferencedColumns();
            $columns = $reference->getColumns();
            $initialize[] = sprintf(
                $templateRelation,
                'belongsTo',
                $columns[0],
                $entityNamespace . ucfirst($reference->getReferencedTable()),
                $refColumns[0],
                "array('alias' => '" . ucfirst($reference->getReferencedTable()) . "')"
            );
        }

        if ($this->options->has('hasMany')) {
            if (count($this->options->hasMany)) {
                foreach ($this->options->hasMany as $relation) {
                    if (!is_string($relation['fields'])) {
                        continue;
                    }

                    $entityName = $relation['camelizedName'];
                    $entityNamespace = '';
                    if ($this->options->contains('namespace')) {
                        $entityNamespace = "{$this->options->namespace}\\";
                        $relation['options']['alias'] = $entityName;
                    }

                    $initialize[] = sprintf(
                        $templateRelation,
                        'hasMany',
                        $relation['fields'],
                        $entityNamespace . $entityName,
                        $relation['relationFields'],
                        $this->_buildRelationOptions(isset($relation['options']) ? $relation["options"] : null)
                    );
                }
            }
        }

        if ($this->options->has('belongsTo')) {
            if (count($this->options->belongsTo)) {
                foreach ($this->options->belongsTo as $relation) {
                    if (!is_string($relation['fields'])) {
                        continue;
                    }

                    $entityName = $relation['referencedModel'];
                    $entityNamespace = '';
                    if ($this->options->contains('namespace')) {
                        $entityNamespace = "{$this->options->namespace}\\";
                        $relation['options']['alias'] = $entityName;
                    }

                    $initialize[] = sprintf(
                        $templateRelation,
                        'belongsTo',
                        $relation['fields'],
                        $entityNamespace . $entityName,
                        $relation['relationFields'],
                        $this->_buildRelationOptions(isset($relation['options']) ? $relation["options"] : null)
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
                            $this->messages[] = 'If it is needed, update your validators in accordance with new fields.';
                            break;
                        case 'find':
                            $alreadyFind = true;
                            break;
                        case 'findFirst':
                            $alreadyFindFirst = true;
                            break;
                        case 'columnMap':
                            $alreadyColumnMapped = true;
                            $this->messages[] = 'Do not forget to update columns map.';
                            break;
                        case 'getSource':
                            $alreadyGetSourced = true;
                            $this->messages[] = sprintf('If table name has changed - change method %s:%s.', $method->getDeclaringClass()->getName(), $methodName);
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
                    $validations[] = sprintf(
                        $templateValidateInclusion, $field->getName(), $varItems
                    );
                }
            }
            if ($field->getName() == 'email') {
                $validations[] = sprintf(
                    $templateValidateEmail, $field->getName()
                );
                $uses[] = sprintf(
                    $templateUseAs,
                    'Phalcon\Mvc\Model\Validator\Email',
                    'Email'
                );
            }
        }
        if (count($validations)) {
            $validations[] = $templateValidationFailed;
        }

        /**
         * Check if there has been an extender class
         */
        $extends = $this->options->get('extends', '\Phalcon\Mvc\Model');

        /**
         * Check if there have been any excluded fields
         */
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
            if ($useSettersGetters) {
                if (!array_key_exists(strtolower($field->getName()), $exclude)) {
                    $attributes[] = sprintf(
                        $templateAttributes, $type, 'protected', $field->getName()
                    );
                    $setterName = Utils::camelize($field->getName());
                    $setters[] = sprintf(
                        $templateSetter,
                        $field->getName(),
                        $type,
                        $field->getName(),
                        $setterName,
                        $field->getName(),
                        $field->getName(),
                        $field->getName()
                    );

                    if (isset($this->_typeMap[$type])) {
                        $getters[] = sprintf(
                            $templateGetterMap,
                            $field->getName(),
                            $type,
                            $setterName,
                            $field->getName(),
                            $this->_typeMap[$type],
                            $field->getName()
                        );
                    } else {
                        $getters[] = sprintf(
                            $templateGetter,
                            $field->getName(),
                            $type,
                            $setterName,
                            $field->getName()
                        );
                    }
                }
            } else {
                $attributes[] = sprintf(
                    $templateAttributes, $type, 'public', $field->getName()
                );
            }
        }

        $validationsCode = '';
        if ($alreadyValidations == false && count($validations) > 0) {
            $validationsCode = sprintf($templateValidations, join('', $validations));
        }

        $initCode = '';
        if ($alreadyInitialized == false && count($initialize) > 0) {
            $initCode = sprintf($templateInitialize, rtrim(join('', $initialize)));
        }

        $license = '';
        if (file_exists('license.txt')) {
            $license = trim(file_get_contents('license.txt')) . PHP_EOL . PHP_EOL;
        }

        if (false == $alreadyGetSourced) {
            $methodRawCode[] = sprintf($getSource, $this->options->get('name'));
        }

        if (false == $alreadyFind) {
            $methodRawCode[] = sprintf($templateFind, $className, $className);
        }

        if (false == $alreadyFindFirst) {
            $methodRawCode[] = sprintf($templateFindFirst, $className, $className);
        }

        $content = join('', $attributes);

        if ($useSettersGetters) {
            $content .= join('', $setters) . join('', $getters);
        }

        $content .= $validationsCode . $initCode;
        foreach ($methodRawCode as $methodCode) {
            $content .= $methodCode;
        }

        $auto_generated = '';
        if ($genDocMethods) {
            $auto_generated = '/**' . PHP_EOL . ' * @autogenerated' . PHP_EOL . ' */' . PHP_EOL;
        }

        if ($this->options->contains('mapColumn') && false == $alreadyColumnMapped) {
            $content .= $this->_genColumnMapCode($fields);
        }

        $str_use = '';
        if (!empty($uses)) {
            $str_use = implode(PHP_EOL, $uses) . PHP_EOL . PHP_EOL;
        }

        $abstract = ($this->options->contains('abstract') ? 'abstract ' : '');

        $code = sprintf(
            $templateCode,
            $license,
            $namespace,
            $str_use,
            $auto_generated,
            $abstract,
            $className,
            $extends,
            $content
        );

        if (file_exists($modelPath) && !is_writable($modelPath)) {
            throw new BuilderException(sprintf('Unable to write to %s. Check write-access of a file.', $modelPath));
        }

        if (!file_put_contents($modelPath, $code)) {
            throw new BuilderException(sprintf('Unable to write to %s', $modelPath));
        }

        if ($this->isConsole()) {
            $msgSuccess = ($this->options->contains('abstract') ? 'Abstract ' : '') . 'Model "%s" was successfully created.';

            if (!empty($this->messages)) {
                $msgSuccess .= "\n  * " . join("\n  * ", $this->messages);
            }

            $this->_notifySuccess(sprintf($msgSuccess, Utils::camelize($this->options->get('name'))));
        }
    }

    /**
     * Builds a PHP syntax with all the options in the array
     *
     * @param  array  $options
     * @return string PHP syntax
     */
    private function _buildRelationOptions($options)
    {
        if (empty($options)) {
            return 'NULL';
        }

        $values = array();
        foreach ($options as $name=>$val) {
            if (is_bool($val)) {
                $val = $val ? 'true':'false';
            } elseif (!is_numeric($val)) {
                $val = "'{$val}'";
            }

            $values[] = sprintf('\'%s\' => %s', $name, $val);
        }

        $syntax = 'array('. implode(',', $values). ')';

        return $syntax;
    }

    private function _genColumnMapCode($fields)
    {
        $template = '
    /**
     * Independent Column Mapping.
     * Keys are the real names in the table and the values their names in the application
     *
     * @return array
     */
    public function columnMap()
    {
        return array(
            %s
        );
    }
';

        $contents = array();
        foreach ($fields as $field) {
            $name = $field->getName();
            $contents[] = sprintf('\'%s\' => \'%s\'', $name, $name);
        }

        return sprintf($template, join(",\n            ", $contents));
    }
}
