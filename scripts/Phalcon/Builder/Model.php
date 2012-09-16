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

use Phalcon\Builder;
use Phalcon\Builder\Component;
use Phalcon\Builder\Exception as BuilderException;
use Phalcon\Script\Color;
use Phalcon\Text as Utils;

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
class Model extends Component {

	/**
	 * Mapa de datos escalares a objetos
	 *
	 * @var array
	 */
	private $_typeMap = array(
		//'Date' => 'Date',
		//'Decimal' => 'Decimal'
	);

	public function __construct($options) {
		if(!isset($options['name'])){
			throw new BuilderException("Please, specify the model name");
		}
		if(!isset($options['force'])){
			$options['force'] = false;
		}
		if(!isset($options['className'])){
			$options['className'] = Utils::camelize($options['name']);
		}
		if(!isset($options['fileName'])){
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
	public function getPHPType($type){
		switch ($type) {
			case \Phalcon\Db\Column::TYPE_INTEGER:
			case \Phalcon\Db\Column::TYPE_DECIMAL:
			case \Phalcon\Db\Column::TYPE_FLOAT:
				return 'integer';
				break;
			case \Phalcon\Db\Column::TYPE_DATE:
			case \Phalcon\Db\Column::TYPE_VARCHAR:
			case \Phalcon\Db\Column::TYPE_DATETIME:
			case \Phalcon\Db\Column::TYPE_CHAR:
			case \Phalcon\Db\Column::TYPE_TEXT:
			return 'string';
				break;
			default:
				return 'string';
				break;
		}
	}

	public function build(){

		if(!$this->_options['name']){
			throw new BuilderException("You must specify the table name");
		}

		$path = '';
		if(isset($this->_options['directory'])){
			if($this->_options['directory']){
				$path = $this->_options['directory'].'/';
			}
		}

		if(!file_exists($path.'.phalcon')){
			throw new BuilderException("This command should be invoked inside a phalcon project directory");
		}

		$useSettersGetters = $this->_options['genSettersGetters'];
		if(isset($this->_options['genDocMethods'])){
			$genDocMethods = $this->_options['genDocMethods'];	
		} else {
			$genDocMethods = false;
		}
		

		$config = $this->_getConfig($path);
		$modelsDir = $config->phalcon->modelsDir;

		$modelPath = $modelsDir . '/' . $this->_options['className'].'.php';

		if(file_exists($modelPath)){
			if(!$this->_options['force']){
				throw new BuilderException("The model file '".$this->_options['className'].".php' already exist in models dir");
			}
		}

		if (!isset($config->database->adapter)) {
			throw new BuilderException("Adapter was not found in the config. Please specify a config varaible [database][adapter]");
		}

		$initialize = array();
		$adapter = ucfirst($config->database->adapter);

		if (!in_array($adapter, array('Mysql', 'Postgresql'))) {
			throw new BuilderException("Adapter $adapter is not supported");
		}

		$adapter = '\\Phalcon\\Db\\Adapter\\Pdo\\' . $adapter;
		$db = new $adapter(array(
			'host'     => $config->database->host,
			'username' => $config->database->username,
			'password' => $config->database->password,
			'name'     => $config->database->name,
		));

		if(isset($this->_options['schema'])){
			if($this->_options['schema']!=$db->getDatabaseName()){
				$initialize[] = "\t\t\$this->setSchema(\"{$this->_options['schema']}\");";
			}
			$schema = $this->_options['schema'];
		} else {
			$schema = $config->database->name;
		}

		if($this->_options['fileName']!=$this->_options['name']){
			$initialize[] = "\t\t\$this->setSource(\"{$this->_options['name']}\");";
		}

		$table = $this->_options['name'];
		if($db->tableExists($table, $schema)){
			$fields = $db->describeColumns($table, $schema);
		} else {
			throw new BuilderException("Table $table not exists");
		}

		if(isset($this->_options['hasMany'])){
			if(count($this->_options['hasMany'])){
				foreach($this->_options['hasMany'] as $entityName => $relation){
					if(is_string($relation['fields'])){
						if(preg_match('/_id$/', $relation['relationFields']) && $relation['fields']=='id'){
							$initialize[] = "\t\t\$this->hasMany(\"{$relation['fields']}\", \"$entityName\", \"{$relation['relationFields']}\")";
						} else {
							$initialize[] = "\t\t\$this->hasMany(\"{$relation['fields']}\", \"$entityName\", \"{$relation['relationFields']}\")";
						}
					}
				}
			}
		}

		if(isset($this->_options['belongsTo'])){
			if(count($this->_options['belongsTo'])){
				foreach($this->_options['belongsTo'] as $entityName => $relation){
					if(is_string($relation['fields'])){
						if(preg_match('/_id$/', $relation['fields'])&&$relation['relationFields']=='id'){
							$initialize[] = "\t\t\$this->belongsTo(\"{$relation['fields']}\", \"$entityName\", \"{$relation['relationFields']}\")";
						} else {
							$initialize[] = "\t\t\$this->belongsTo(\"{$relation['fields']}\", \"$entityName\", \"{$relation['relationFields']}\")";
						}
					}
				}
			}
		}

		if(isset($this->_options['foreignKeys'])){
			if(count($this->_options['foreignKeys']) && is_array($this->_options['foreignKeys'])){
				foreach($this->_options['foreignKeys'] as $foreignKey){
					$initialize[] = "\t\t\$this->addForeignKey(\"{$foreignKey['fields']}\", \"{$foreignKey['entity']}\", \"{$foreignKey['referencedFields']}\")";
				}
			}
		}

		$methodRawCode = array();
		$alreadyInitialized = false;
		$alreadyValidations = false;
		if(file_exists($modelPath)){
			try {
				$posibleMethods = array();
				if($useSettersGetters){
					foreach($fields as $field){
						$methodName = Utils::camelize($field->getName());
						$posibleMethods['set'.$methodName] = true;
						$posibleMethods['get'.$methodName] = true;
					}
				}
				require $modelPath;
				$linesCode = file($modelPath);
				$reflection = new \ReflectionClass($this->_options['className']);
				foreach($reflection->getMethods() as $method){
					if($method->getDeclaringClass()->getName()==$this->_options['className']){
						$methodName = $method->getName();
						if(!isset($posibleMethods[$methodName])){
							$methodRawCode[$methodName] = join('', array_slice($linesCode, $method->getStartLine()-1, $method->getEndLine()-$method->getStartLine()+1));
						} else {
							continue;
						}
						if($methodName=='initialize'){
							$alreadyInitialized = true;
						} else {
							if($methodName=='validation'){
								$alreadyValidations = true;
							}
						}
					}
				}
			}
			catch(\ReflectionException $e){
			}
		}

		$validations = array();
		foreach($fields as $field){
			if($field->getType() === \Phalcon\Db\Column::TYPE_CHAR){
				$domain = array();
				if(preg_match('/\((.*)\)/', $field->getType(), $matches)){
					foreach(explode(',', $matches[1]) as $item){
						$domain[] = $item;
					}
				}
				$varItems = join(', ', $domain);
				$validations[] = "\t\t\$this->validate(\"InclusionIn\", array(\n\t\t\t\"field\" => \"{$field->getName()}\",\n\t\t\t\"domain\" => array($varItems),\n\t\t\t\"required\" => true\n\t\t))";
			}
			if($field->getName()=='email'){
				$validations[] = "\t\t\$this->validate(\"Email\", array(\n\t\t\t\"field\" => \"{$field->getName()}\",\n\t\t\t\"required\" => true\n\t\t))";
			}
		}
		if(count($validations)){
			$validations[] = "\t\tif(\$this->validationHasFailed()==true){\n\t\t\treturn false;\n\t\t}";
		}

		$attributes = array();
		$setters = array();
		$getters = array();
		foreach($fields as $field){
			$type = $this->getPHPType($field->getType());
			if($useSettersGetters){
				$attributes[] = "\t/**\n\t * @var $type\n\t */\n\tprotected \${$field->getName()};\n";
				$setterName = Utils::camelize($field->getName());
				$setters[] = "\t/**\n\t * Method to set the value of field {$field->getName()}\n\n\t * @param $type \${$field->getName()}\n\t */\n\tpublic function set$setterName(\${$field->getName()}){\n\t\t\$this->{$field->getName()} = \${$field->getName()};\n\t}\n";
				if(isset($this->_typeMap[$type])){
					$getters[] = "\t/**\n\t * Returns the value of field {$field->getName()}\n\n\t * @return $type\n\t */\n\tpublic function get$setterName(){\n\t\tif(\$this->{$field->getName()}){\n\t\t\treturn new {$this->_typeMap[$type]}(\$this->{$field->getName()});\n\t\t} else {\n\t\t\treturn null;\n\t\t}\n\t}\n";
				} else {
					$getters[] = "\t/**\n\t * Returns the value of field {$field->getName()}\n\n\t * @return $type\n\t */\n\tpublic function get$setterName(){\n\t\treturn \$this->{$field->getName()};\n\t}\n";
				}
			} else {
				$attributes[] = "\t/**\n\n\t * @var $type\n\t */\n\tpublic \${$field->getName()};\n";
			}
		}

		if($alreadyValidations==false){
			if(count($validations)>0){
				$validationsCode = "\n\t/**\n\t * Validations and business logic \n\t */\n\tpublic function validation(){\t\t\n".join(";\n", $validations)."\n\t}\n";
			} else {
				$validationsCode = "";
			}
		} else {
			$validationsCode = "";
		}
		if($alreadyInitialized==false){
			if(count($initialize)>0){
				$initCode = "\n\t/**\n\t * Initializer method for model.\n\t */\n\tpublic function initialize(){\t\t\n".join(";\n", $initialize).";\n\t}\n";
			} else {
				$initCode = "";
			}
		} else {
			$initCode = "";
		}

		$code = "<?php\n";
		if(file_exists('license.txt')){
			$code.=PHP_EOL.file_get_contents('license.txt');
		}
		$code.="\nclass ".$this->_options['className']." extends \\Phalcon\\Mvc\\Model {\n\n".join("\n", $attributes)."\n";
		if($useSettersGetters){
			$code.="\n".join("\n", $setters)."\n\n".join("\n", $getters);
		}
		$code.=$validationsCode.$initCode."\n";
		foreach($methodRawCode as $methodCode){
			$code.=$methodCode.PHP_EOL;
		}

		if($genDocMethods){
			$code.="\n\t/**\n\t * @return ".$this->_options['className']."[]\n\t */\n";
			$code.="\tpublic static function find(\$parameters=array()){\n";
			$code.="\t\treturn parent::find(\$parameters);\n";
			$code.="\t}\n\n";
			$code.="\n\t/**\n\t * @return ".$this->_options['className']."\n\t */\n";
			$code.="\tpublic static function findFirst(\$parameters=array()){\n";
			$code.="\t\treturn parent::findFirst(\$parameters);\n";
			$code.="\t}\n\n";
		}

		$code.="}\n";
		$code = str_replace("\t", "    ", $code);
		file_put_contents($path.$modelsDir."/".$this->_options['className'].".php", $code);

		print Color::success('Model "' . $this->_options['name'] . '" was successfully created.') . PHP_EOL;
	}

}