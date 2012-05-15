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

use Phalcon_BuilderException as BuilderException;
use Phalcon_Utils as Utils;

/**
 * ModelBuilderComponent
 *
 * Builder to generate models
 *
 * @category 	Phalcon
 * @package 	Scripts
 * @copyright   Copyright (c) 2011-2012 Phalcon Team (team@phalconphp.com)
 * @license 	New BSD License
 * @version 	$Id: Model.php,v a434b34d7989 2011/10/26 22:23:04 andres $
 */
class ModelBuilderComponent {

	/**
	 * Opciones del ModelBuilder
	 *
	 * @var array
	 */
	private $_options = array();

	/**
	 * Mapa de datos escalares a objetos
	 *
	 * @var array
	 */
	private $_typeMap = array(
		'Date' => 'Date',
		'Decimal' => 'Decimal'
	);

	/**
	 * Devuelve el tipo PHP asociado
	 *
	 * @param string $type
	 * @return string
	 */
	public function getPHPType($type){
		if(stripos($type, 'int')!==false){
			return 'integer';
		}
		if(stripos($type, 'float')!==false){
			return 'float';
		}
		/*if(strtolower($type)=='date'){
			return 'Date';
		}
		if(stripos($type, 'decimal')!==false){
			return 'Decimal';
		}*/
		return 'string';
	}

	private function _getConfig($path){
		return new Phalcon_Config_Adapter_Ini($path."app/config/config.ini");
	}

	public function __construct($options){
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

	public function build(){

		if(!$this->_options['name']){
			throw new BuilderException("You must specify the table name");
		}

		$path = '';
		if(isset($this->_options['PROJECTPATH'])){
			if($this->_options['PROJECTPATH']){
				$path = $this->_options['PROJECTPATH'].'/../';
			}
		}

		if(!file_exists($path.'.phalcon')){
			throw new BuilderException("This command should be invoked inside a phalcon project");
		}

		$useSettersGetters = $this->_options['genSettersGetters'];

		$config = $this->_getConfig($path);
		$modelsDir = 'public/'.$config->phalcon->modelsDir;

		$modelPath = $path.$modelsDir.'/'.$this->_options['className'].'.php';

		if(file_exists($modelPath)){
			if(!$this->_options['force']){
				throw new BuilderException("The model file '".$this->_options['className'].".php' already exist in models dir");
			}
		}

		$initialize = array();

		try {
			Phalcon_Db_Pool::setDefaultDescriptor($config->database);
			$db = Phalcon_Db_Pool::getConnection();
		}
		catch(Phalcon_Db_Exception $e){
			throw new ScriptException('Phalcon_Db_Exception: '.$e->getMessage());
		}

		if(isset($this->_options['schema'])){
			if($this->_options['schema']!=$db->getDatabaseName()){
				$initialize[] = "\t\t\$this->setSchema(\"{$this->_options['schema']}\");";
			}
			$schema = $this->_options['schema'];
		} else {
			$schema = null;
		}

		if($this->_options['fileName']!=$this->_options['name']){
			$initialize[] = "\t\t\$this->setSource(\"{$this->_options['name']}\");";
		}

		$table = $this->_options['name'];
		if($db->tableExists($table, $schema)){
			$fields = $db->describeTable($table, $schema);
		} else {
			throw new BuilderException("Table $table not exists");
		}

		if(isset($this->_options['hasMany'])){
			if(count($this->_options['hasMany'])){
				foreach($this->_options['hasMany'] as $entityName => $relation){
					if(is_string($relation['fields'])){
						if(preg_match('/_id$/', $relation['relationFields'])&&$relation['fields']=='id'){
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
			if(count($this->_options['foreignKeys'])){
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
						$methodName = Utils::camelize($field['Field']);
						$posibleMethods['set'.$methodName] = true;
						$posibleMethods['get'.$methodName] = true;
					}
				}
				require $modelPath;
				$linesCode = file($modelPath);
				$reflection = new ReflectionClass($this->_options['className']);
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
			catch(ReflectionException $e){
			}
		}

		$validations = array();
		/*foreach($fields as $field){
			if(strpos($field['Type'], 'enum')!==false){
				$domain = array();
				if(preg_match('/\((.*)\)/', $field['Type'], $matches)){
					foreach(explode(',', $matches[1]) as $item){
						$domain[] = $item;
					}
				}
				$varItems = join(', ', $domain);
				$validations[] = "\t\t\$this->validate(\"InclusionIn\", array(\n\t\t\t\"field\" => \"{$field['Field']}\",\n\t\t\t\"domain\" => array($varItems),\n\t\t\t\"required\" => true\n\t\t))";
			}
			if($field['Field']=='email'){
				$validations[] = "\t\t\$this->validate(\"Email\", array(\n\t\t\t\"field\" => \"{$field['Field']}\",\n\t\t\t\"required\" => true\n\t\t))";
			}
		}
		if(count($validations)){
			$validations[] = "\t\tif(\$this->validationHasFailed()==true){\n\t\t\treturn false;\n\t\t}";
		}*/

		$attributes = array();
		$setters = array();
		$getters = array();
		foreach($fields as $field){
			$type = $this->getPHPType($field['Type']);
			if($useSettersGetters){
				$attributes[] = "\t/**\n\t * @var $type\n\t */\n\tprotected \${$field['Field']};\n";
				$setterName = Utils::camelize($field['Field']);
				$setters[] = "\t/**\n\t * Method to set the value of field {$field['Field']}\n\t * @param $type \${$field['Field']}\n\t */\n\tpublic function set$setterName(\${$field['Field']}){\n\t\t\$this->{$field['Field']} = \${$field['Field']};\n\t}\n";
				if(isset($this->_typeMap[$type])){
					$getters[] = "\t/**\n\t * Returns the value of field {$field['Field']}\n\t * @return $type\n\t */\n\tpublic function get$setterName(){\n\t\tif(\$this->{$field['Field']}){\n\t\t\treturn new {$this->_typeMap[$type]}(\$this->{$field['Field']});\n\t\t} else {\n\t\t\treturn null;\n\t\t}\n\t}\n";
				} else {
					$getters[] = "\t/**\n\t * Returns the value of field {$field['Field']}\n\t * @return $type\n\t */\n\tpublic function get$setterName(){\n\t\treturn \$this->{$field['Field']};\n\t}\n";
				}
			} else {
				$attributes[] = "\t/**\n\t * @var $type\n\t */\n\tpublic \${$field['Field']};\n";
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
		$code.="\nclass ".$this->_options['className']." extends Phalcon_Model_Base {\n\n".join("\n", $attributes)."\n";
		if($useSettersGetters){
			$code.="\n".join("\n", $setters)."\n\n".join("\n", $getters);
		}
		$code.=$validationsCode.$initCode."\n";
		foreach($methodRawCode as $methodCode){
			$code.=$methodCode.PHP_EOL;
		}
		$code.="}\n\n";
		file_put_contents($path.$modelsDir."/".$this->_options['className'].".php", $code);

	}

}