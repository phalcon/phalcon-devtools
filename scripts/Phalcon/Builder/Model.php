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

use Phalcon\Db\Column;
use Phalcon\Builder\Component;
use Phalcon\Builder\BuilderException;
use Phalcon\Script\Color;
use Phalcon\Text as Utils;

/**
 * ModelBuilderComponent
 *
 * Builder to generate models
 *
 * @category    Phalcon
 * @package    Builder
 * @subpackage  Model
 * @copyright   Copyright (c) 2011-2014 Phalcon Team (team@phalconphp.com)
 * @license    New BSD License
 */
class Model extends Component
{
    /**
     * Mapa de datos escalares a objetos
     *
     * @var array
     */
    private $_typeMap = array(//'Date' => 'Date',
        //'Decimal' => 'Decimal'
    );

    public function __construct($options)
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
        $this->_options = $options;
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
    public function getSource()
    {
        return '%s';
    }
";
        $templateThis = "\t\t\$this->%s(%s);\n";
        $templateRelation = "\t\t\$this->%s(\"%s\", \"%s\", \"%s\", %s);\n";
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
                    \"field\"    => \"%s\",
                    \"domain\"   => array(%s),
                    \"required\" => true,
                )
            )
        );";

        $templateValidateEmail = "
        \$this->validate(
            new Email(
                array(
                    \"field\"    => \"%s\",
                    \"required\" => true,
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
     * @return %s[]
     */
    public static function find(\$parameters = array())
    {
        return parent::find(\$parameters);
    }

    /**
     * @return %s
     */
    public static function findFirst(\$parameters = array())
    {
        return parent::findFirst(\$parameters);
    }
";

        $templateUse = 'use %s;';
        $templateUseAs = 'use %s as %s;';

        $templateCode = "<?php
%s
%s
%s

class %s extends %s
{
%s
}
";

        if (!$this->_options['name']) {
            throw new BuilderException("You must specify the table name");
        }

        $path = '';
        if (isset($this->_options['directory'])) {
            if ($this->_options['directory']) {
                $path = $this->_options['directory'] . '/';
            }
        }

        $config = $this->_getConfig($path);

        if (!isset($this->_options['modelsDir'])) {
            if (!isset($config->application->modelsDir)) {
                throw new BuilderException(
                    "Builder doesn't knows where is the models directory"
                );
            }
            $modelsDir = $config->application->modelsDir;
        } else {
            $modelsDir = $this->_options['modelsDir'];
        }

        if ($this->isAbsolutePath($modelsDir) == false) {
            $modelPath = $path . "public" . DIRECTORY_SEPARATOR . $modelsDir;
        } else {
            $modelPath = $modelsDir;
        }

        $methodRawCode = array();
        $className = $this->_options['className'];
        $modelPath .= $className . '.php';

        if (file_exists($modelPath)) {
            if (!$this->_options['force']) {
                throw new BuilderException(
                    "The model file '" . $className .
                    ".php' already exists in models dir"
                );
            }
        }

        if (!isset($config->database)) {
            throw new BuilderException(
                "Database configuration cannot be loaded from your config file"
            );
        }

        if (!isset($config->database->adapter)) {
            throw new BuilderException(
                "Adapter was not found in the config. " .
                "Please specify a config variable [database][adapter]"
            );
        }

        if (isset($this->_options['namespace'])) {
            $namespace = 'namespace ' . $this->_options['namespace'] . ';'
                . PHP_EOL . PHP_EOL;
            $methodRawCode[] = sprintf($getSource, $this->_options['name']);
        } else {
            $namespace = '';
        }

        $useSettersGetters = $this->_options['genSettersGetters'];
        if (isset($this->_options['genDocMethods'])) {
            $genDocMethods = $this->_options['genDocMethods'];
        } else {
            $genDocMethods = false;
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

        // An array for use statements
        $uses = array();

        $adapterName = 'Phalcon\Db\Adapter\Pdo\\' . $adapter;
        unset($configArray['adapter']);
        $db = new $adapterName($configArray);

        $initialize = array();
        if (isset($this->_options['schema'])) {
            if ($this->_options['schema'] != $config->database->dbname) {
                $initialize[] = sprintf(
                    $templateThis, 'setSchema', '"' . $this->_options['schema'] . '"'
                );
            }
            $schema = $this->_options['schema'];
        } elseif ($adapter == 'Postgresql') {
            $schema = 'public';
            $initialize[] = sprintf(
                $templateThis, 'setSchema', '"' . $this->_options['schema'] . '"'
            );
        } else {
            $schema = $config->database->dbname;
        }

        if ($this->_options['fileName'] != $this->_options['name']) {
            $initialize[] = sprintf(
                $templateThis, 'setSource',
                '\'' . $this->_options['name'] . '\''
            );
        }

        $table = $this->_options['name'];
        if ($db->tableExists($table, $schema)) {
            $fields = $db->describeColumns($table, $schema);
        } else {
            throw new BuilderException('Table "' . $table . '" does not exists');
        }

        if (isset($this->_options['hasMany'])) {
            if (count($this->_options['hasMany'])) {
                foreach ($this->_options['hasMany'] as $relation) {
                    if (is_string($relation['fields'])) {
                        $entityName = $relation['camelizedName'];
                        if (isset($this->_options['namespace'])) {
                            $entityNamespace = "{$this->_options['namespace']}\\";
                            $relation['options']['alias'] = $entityName;
                        } else {
                            $entityNamespace = '';
                        }
                        $initialize[] = sprintf(
                            $templateRelation,
                            'hasMany',
                            $relation['fields'],
                            $entityNamespace . $entityName,
                            $relation['relationFields'],
                            $this->_buildRelationOptions( isset($relation['options']) ? $relation["options"] : NULL)
                        );
                    }
                }
            }
        }

        if (isset($this->_options['belongsTo'])) {
            if (count($this->_options['belongsTo'])) {
                foreach ($this->_options['belongsTo'] as $relation) {
                    if (is_string($relation['fields'])) {
                        $entityName = $relation['referencedModel'];
                        if (isset($this->_options['namespace'])) {
                            $entityNamespace = "{$this->_options['namespace']}\\";
                            $relation['options']['alias'] = $entityName;
                        } else {
                            $entityNamespace = '';
                        }
                        $initialize[] = sprintf(
                            $templateRelation,
                            'belongsTo',
                            $relation['fields'],
                            $entityNamespace . $entityName,
                            $relation['relationFields'],
                            $this->_buildRelationOptions(isset($relation['options']) ? $relation["options"] : NULL)
                        );
                    }
                }
            }
        }

        $alreadyInitialized = false;
        $alreadyValidations = false;
        if (file_exists($modelPath)) {
            try {
                $possibleMethods = array();
                if ($useSettersGetters) {
                    foreach ($fields as $field) {
                        $methodName = Utils::camelize($field->getName());
                        $possibleMethods['set' . $methodName] = true;
                        $possibleMethods['get' . $methodName] = true;
                    }
                }

                require $modelPath;

                $linesCode = file($modelPath);
                $reflection = new \ReflectionClass($this->_options['className']);
                foreach ($reflection->getMethods() as $method) {
                    if ($method->getDeclaringClass()->getName() == $this->_options['className']) {
                        $methodName = $method->getName();
                        if (!isset($possibleMethods[$methodName])) {
                            $methodRawCode[$methodName] = join(
                                '',
                                array_slice(
                                    $linesCode,
                                    $method->getStartLine() - 1,
                                    $method->getEndLine() - $method->getStartLine() + 1
                                )
                            );
                        } else {
                            continue;
                        }
                        if ($methodName == 'initialize') {
                            $alreadyInitialized = true;
                        } else {
                            if ($methodName == 'validation') {
                                $alreadyValidations = true;
                            }
                        }
                    }
                }
            } catch (\ReflectionException $e) {
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
        $extends = '\\Phalcon\\Mvc\\Model';
        if (isset($this->_options['extends'])) {
            if (!empty($this->_options['extends'])) {
                $extends = $this->_options['extends'];
            }
        }

        /**
         * Check if there have been any excluded fields
         */
        $exclude = array();
        if (isset($this->_options['excludeFields'])) {
            if (!empty($this->_options['excludeFields'])) {
                $keys = explode(',', $this->_options['excludeFields']);
                if (count($keys) > 0) {
                    foreach ($keys as $key) {
                        $exclude[trim($key)] = '';
                    }
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

        if ($alreadyValidations == false) {
            if (count($validations) > 0) {
                $validationsCode = sprintf(
                    $templateValidations, join("", $validations)
                );
            } else {
                $validationsCode = "";
            }
        } else {
            $validationsCode = "";
        }

        if ($alreadyInitialized == false) {
            if (count($initialize) > 0) {
                $initCode = sprintf(
                    $templateInitialize,
                    join('', $initialize)
                );
            } else {
                $initCode = "";
            }
        } else {
            $initCode = "";
        }

        $license = '';
        if (file_exists('license.txt')) {
            $license = file_get_contents('license.txt');
        }

        $content = join('', $attributes);

        if ($useSettersGetters) {
            $content .= join('', $setters)
                . join('', $getters);
        }

        $content .= $validationsCode . $initCode;
        foreach ($methodRawCode as $methodCode) {
            $content .= $methodCode;
        }

        if ($genDocMethods) {
            $content .= sprintf($templateFind, $className, $className);
        }

        if (isset($this->_options['mapColumn'])) {
            $content .= $this->_genColumnMapCode($fields);
        }

        $str_use = implode("\n", $uses);

        $code = sprintf(
            $templateCode,
            $license,
            $namespace,
            $str_use,
            $className,
            $extends,
            $content
        );
        file_put_contents($modelPath, $code);

        if ($this->isConsole()) {
            $this->_notifySuccess('Model "' . $this->_options['name'] .'" was successfully created.');
        }
    }

    /**
     * Builds a PHP syntax with all the options in the array
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

            $values[] = sprintf('"%s"=>%s', $name, $val);
        }

        $syntax = 'array('. implode(',', $values). ')';

        return $syntax;
    }

    private function _genColumnMapCode($fields)
    {
        $template = '
    /**
     * Independent Column Mapping.
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

        return sprintf($template, join(", \n            ", $contents));
    }

}
