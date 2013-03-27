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

use Phalcon\Db\Column,
	Phalcon\Builder\Component,
	Phalcon\Builder\BuilderException,
	Phalcon\Script\Color,
	Phalcon\Text as Utils;

/**
 * ModelBuilderComponent
 *
 * Builder to generate models
 *
 * @category 	Phalcon
 * @package 	Builder
 * @subpackage  Model
 * @copyright   Copyright (c) 2011-2012 Phalcon Team (team@phalconphp.com)
 * @license 	New BSD License
 */
class Model extends Component
{

	/**
	 * Mapa de datos escalares a objetos
	 *
	 * @var array
	 */
	private $_typeMap = array(
		//'Date' => 'Date',
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
	 * @param string $type
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

		if (!$this->_options['name']) {
			throw new BuilderException("You must specify the table name");
		}

		$path = '';
		if (isset($this->_options['directory'])) {
			if ($this->_options['directory']) {
				$path = $this->_options['directory'].'/';
			}
		}

		$config = $this->_getConfig($path);

		if (!isset($this->_options['modelsDir'])) {
			if(!isset($config->application->modelsDir)){
				throw new BuilderException("Builder doesn't knows where is the models directory");
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
		$modelPath .= $className.'.php';

		if (file_exists($modelPath)) {
			if (!$this->_options['force']) {
				throw new BuilderException("The model file '".$className.".php' already exists in models dir");
			}
		}

		if (!isset($config->database)) {
			throw new BuilderException("Database configuration cannot be loaded from your config file");
		}

		if (!isset($config->database->adapter)) {
			throw new BuilderException("Adapter was not found in the config. Please specify a config variable [database][adapter]");
		}

		if (isset($this->_options['namespace'])) {
			$namespace = 'namespace '.$this->_options['namespace'].';'.PHP_EOL.PHP_EOL;
			$methodRawCode[] = "\t".'public function getSource()'."\n\t".'{'."\n\t\t".'return "'.$this->_options['name'].'";'."\n\t".'}';
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

		$adapterName = 'Phalcon\Db\Adapter\Pdo\\' . $adapter;
		$db = new $adapterName($configArray);		

		$initialize = array();
		if (isset($this->_options['schema'])) {
			if ($this->_options['schema'] != $config->database->name) {
				$initialize[] = "\t\t\$this->setSchema(\"{$this->_options['schema']}\");";
			}
			$schema = $this->_options['schema'];
		} else {
			$schema = $config->database->dbname;
		}

		if ($this->_options['fileName'] != $this->_options['name']) {
			$initialize[] = "\t\t\$this->setSource(\"{$this->_options['name']}\");";
		}

		$table = $this->_options['name'];
		if ($db->tableExists($table, $schema)) {
			$fields = $db->describeColumns($table, $schema);
		} else {
			throw new BuilderException('Table "'.$table.'" does not exists');
		}

		if (isset($this->_options['hasMany'])) {
			if (count($this->_options['hasMany'])) {
				foreach ($this->_options['hasMany'] as $relation) {
					if (is_string($relation['fields'])) {
						$entityName = $relation['camelizedName'];
						if (preg_match('/_id$/', $relation['relationFields']) && $relation['fields']=='id') {
							$initialize[] = "\t\t\$this->hasMany(\"{$relation['fields']}\", \"$entityName\", \"{$relation['relationFields']}\")";
						} else {
							$initialize[] = "\t\t\$this->hasMany(\"{$relation['fields']}\", \"$entityName\", \"{$relation['relationFields']}\")";
						}
					}
				}
			}
		}

		if (isset($this->_options['belongsTo'])) {
			if (count($this->_options['belongsTo'])) {
				foreach ($this->_options['belongsTo'] as $relation) {
					if (is_string($relation['fields'])) {
						$entityName = $relation['referencedModel'];
						if (preg_match('/_id$/', $relation['fields'])&&$relation['relationFields']=='id') {
							$initialize[] = "\t\t\$this->belongsTo(\"{$relation['fields']}\", \"$entityName\", \"{$relation['relationFields']}\")";
						} else {
							$initialize[] = "\t\t\$this->belongsTo(\"{$relation['fields']}\", \"$entityName\", \"{$relation['relationFields']}\")";
						}
					}
				}
			}
		}

		if (isset($this->_options['foreignKeys'])) {
			if (count($this->_options['foreignKeys']) && is_array($this->_options['foreignKeys'])) {
				foreach ($this->_options['foreignKeys'] as $foreignKey) {
					$initialize[] = "\t\t\$this->addForeignKey(\"{$foreignKey['fields']}\", \"{$foreignKey['entity']}\", \"{$foreignKey['referencedFields']}\")";
				}
			}
		}

		$alreadyInitialized = false;
		$alreadyValidations = false;
		if (file_exists($modelPath)) {
			try {
				$posibleMethods = array();
				if ($useSettersGetters) {
					foreach ($fields as $field) {
						$methodName = Utils::camelize($field->getName());
						$posibleMethods['set'.$methodName] = true;
						$posibleMethods['get'.$methodName] = true;
					}
				}

				require $modelPath;

				$linesCode = file($modelPath);
				$reflection = new \ReflectionClass($this->_options['className']);
				foreach ($reflection->getMethods() as $method) {
					if ($method->getDeclaringClass()->getName() == $this->_options['className']) {
						$methodName = $method->getName();
						if (!isset($posibleMethods[$methodName])) {
							$methodRawCode[$methodName] = join('', array_slice($linesCode, $method->getStartLine()-1, $method->getEndLine()-$method->getStartLine()+1));
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
				if (count($domain)){
					$varItems = join(', ', $domain);
					$validations[] = "\t\t\$this->validate(new InclusionIn(array(\n\t\t\t\"field\" => \"{$field->getName()}\",\n\t\t\t\"domain\" => array($varItems),\n\t\t\t\"required\" => true\n\t\t)))";
				}
			}
			if ($field->getName() == 'email') {
				$validations[] = "\t\t\$this->validate(new Email(array(\n\t\t\t\"field\" => \"{$field->getName()}\",\n\t\t\t\"required\" => true\n\t\t)))";
			}
		}
		if (count($validations)) {
			$validations[] = "\t\tif (\$this->validationHasFailed() == true) {\n\t\t\treturn false;\n\t\t}";
		}

		$attributes = array();
		$setters = array();
		$getters = array();
		foreach ($fields as $field) {
			$type = $this->getPHPType($field->getType());
			if ($useSettersGetters) {
				$attributes[] = "\t/**\n\t * @var $type\n\t *\n\t */\n\tprotected \${$field->getName()};\n";
				$setterName = Utils::camelize($field->getName());
				$setters[] = "\t/**\n\t * Method to set the value of field {$field->getName()}\n\t *\n\t * @param $type \${$field->getName()}\n\t */\n\tpublic function set$setterName(\${$field->getName()})\n\t{\n\t\t\$this->{$field->getName()} = \${$field->getName()};\n\t}\n";
				if (isset($this->_typeMap[$type])) {
					$getters[] = "\t/**\n\t * Returns the value of field {$field->getName()}\n\t *\n\t * @return $type\n\t */\n\tpublic function get$setterName()\n\t{\n\t\tif (\$this->{$field->getName()}) {\n\t\t\treturn new {$this->_typeMap[$type]}(\$this->{$field->getName()});\n\t\t} else {\n\t\t\treturn null;\n\t\t}\n\t}\n";
				} else {
					$getters[] = "\t/**\n\t * Returns the value of field {$field->getName()}\n\t *\n\t * @return $type\n\t */\n\tpublic function get$setterName()\n\t{\n\t\treturn \$this->{$field->getName()};\n\t}\n";
				}
			} else {
				$attributes[] = "\t/**\n\t * @var $type\n\t *\n\t */\n\tpublic \${$field->getName()};\n";
			}
		}

		if ($alreadyValidations == false) {
			if (count($validations) > 0) {
				$validationsCode = "\n\t/**\n\t * Validations and business logic \n\t */\n\tpublic function validation()\n\t{\t\t\n".join(";\n", $validations)."\n\t}\n";
			} else {
				$validationsCode = "";
			}
		} else {
			$validationsCode = "";
		}

		if ($alreadyInitialized == false) {
			if (count($initialize) > 0) {
				$initCode = "\n\t/**\n\t * Initializer method for model.\n\t */\n\tpublic function initialize()\n\t{\t\t\n".join(";\n", $initialize).";\n\t}\n";
			} else {
				$initCode = "";
			}
		} else {
			$initCode = "";
		}

		$code = "<?php\n\n";
		if (file_exists('license.txt')) {
			$code.=PHP_EOL.file_get_contents('license.txt');
		}

		$code.=$namespace."\nclass ".$className." extends \\Phalcon\\Mvc\\Model \n{\n\n".join("\n", $attributes)."\n";
		if ($useSettersGetters) {
			$code.="\n".join("\n", $setters)."\n\n".join("\n", $getters);
		}

		$code.=$validationsCode.$initCode."\n";
		foreach ($methodRawCode as $methodCode) {
			$code .= $methodCode . PHP_EOL;
		}

		if ($genDocMethods) {
			$code.="\n\t/**\n\t * @return ".$className."[]\n\t */\n";
			$code.="\tpublic static function find(\$parameters=array())\n\t{\n";
			$code.="\t\treturn parent::find(\$parameters);\n";
			$code.="\t}\n\n";
			$code.="\n\t/**\n\t * @return ".$className."\n\t */\n";
			$code.="\tpublic static function findFirst(\$parameters=array())\n\t{\n";
			$code.="\t\treturn parent::findFirst(\$parameters);\n";
			$code.="\t}\n\n";
		}

		$code.="}\n";
		$code = str_replace("\t", "    ", $code);
		file_put_contents($modelPath, $code);

		print Color::success('Model "' . $this->_options['name'] . '" was successfully created.') . PHP_EOL;
	}

}