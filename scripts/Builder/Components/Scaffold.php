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

use Phalcon_Builder as Builder;
use Phalcon_BuilderException as BuilderException;
use Phalcon_Utils as Utils;

/**
 * ScaffoldBuilderComponent
 *
 * Builder forms
 *
 * @category 	Phalcon
 * @package 	Scripts
 * @copyright   Copyright (c) 2011-2012 Phalcon Team (team@phalconphp.com)
 * @license 	New BSD License
 * @version 	$Id: Scaffold.php,v 5f278793c1ae 2011/10/27 02:50:13 andres $
 */
class ScaffoldBuilderComponent {

	private $_options;

	public function __construct($options){
		$this->_options = $options;
	}

	private function _findDetailField($entity){
		$posible = array('name');
		$attributes = $entity::getAttributes();
		foreach($attributes as $attribute){
			if(in_array($attribute, $posible)){
				return $attribute;
			}
		}
		return $attributes[0];
	}

	private function _getPosibleLabel($fieldName){
		$fieldName = preg_replace('/_id$/', '', $fieldName);
		$fieldName = preg_replace('/_at$/', '', $fieldName);
		$fieldName = preg_replace('/_in$/', '', $fieldName);
		$fieldName = str_replace('_', ' of ', $fieldName);
		return ucwords($fieldName);
	}

	public function build(){

		$options = $this->_options;

		$name = $options['name'];
		$config = Phalcon_Script::getConfigPaths();

		$options['modelsDir'] = 'public/'.$config->phalcon->modelsDir;
		$options['controllersDir'] = 'public/'.$config->phalcon->controllersDir;
		$options['viewsDir'] = 'public/'.$config->phalcon->viewsDir;

		$options['manager'] = new Phalcon_Model_Manager();
		$options['manager']->setModelsDir($options['modelsDir']);

		Phalcon_Db_Pool::setDefaultDescriptor($config->database);
		$connection = Phalcon_Db_Pool::getConnection();

		if(!$options['manager']->isModel($options['className'])){

			$modelBuilder = Builder::factory('Model', array(
				'name' => $name,
				'schema' => $options['schema'],
				'className' => $options['className'],
				'fileName' => $options['fileName'],
				'force' => $options['force']
			));

			$modelBuilder->build();

			//Phalcon_Builder::createModel($connection, $options['modelsDir'], $options['name'], $options['schema'], true);
		}

		$entity = $options['manager']->getModel($options['className']);
		if($entity==false){
			throw new ScaffoldBuildException('The model '.$options['className'].' does not exist');
		}

		$entity->setConnection($connection);

		$primaryKeys = $options['manager']->getMetaData()->getPrimaryKeyAttributes($entity);
		if(count($primaryKeys)==0){
			throw new ScaffoldException('A primary key for the model '.$options['className'].' is required');
		}

		//$attributes = $options['manager']->getMetaData()->getAttributes($entity);
		$attributes = $options['manager']->getMetaData()->getDataTypes($entity);

		$setParams = $selectDefinition = array();

		$relationField = '';

		$single 						= $name;
		$options['name'] 				= $single;
		$options['plural'] 				= $single;
		$options['single'] 				= $single;
		$options['entity']				= $entity;
		$options['theSingle'] 			= $single;
		$options['singleVar'] 			= $single;
		$options['setParams'] 			= $setParams;
		$options['attributes'] 			= $attributes;
		$options['primaryKeys']         = $primaryKeys;
		$options['relationField'] 		= $relationField;
		$options['selectDefinition']	= $selectDefinition;
		$options['autocompleteFields'] 	= array();
		$options['belongsToDefinitions']= array();

		//Build Controller
		$this->_makeController($options);

		//View layouts
		$this->_makeLayouts($options);

		//View index.phtml
		$this->_makeViewIndex($options);

		//View search.phtml
		$this->_makeViewSearch($options);

		//View new.phtml
		$this->_makeViewNew($options);

		//View edit.phtml
		$this->_makeViewEdit($options);
	}

	/**
	 * Make controller of model by scaffold
	 *
	 * @param array $options
	 */
	private function _makeController($options){

		$controllerPath = $options['controllersDir'].$options['className'].'Controller.php';

		$code = '<?php'.PHP_EOL.PHP_EOL.
		'class '.$options['className'].'Controller extends Phalcon_Controller {'.PHP_EOL.PHP_EOL.
		//Index
		"\t".'function indexAction(){'.PHP_EOL;
		/*foreach($options['setParams'] as $setParam){
			$code.="\t\t".'$this->view->setParamToView("'.$setParam['varName'].'", '.'$this->'.$setParam['entity'].'->find(array("order" => "'.$setParam['order'].'")));'.PHP_EOL;
		}*/
		$code.="\t".'}'.PHP_EOL.PHP_EOL;

		$primaryKeys = $options['primaryKeys'];
		$paramsPks = $conditionsPks = $orderPks = array();
		foreach($primaryKeys as $primaryKey){
			$orderPks[] = $primaryKey;
			$paramsPks[] = '$'.$primaryKey;
			$conditionsPks[] =	'\''.$primaryKey.'="\'.$'.$primaryKey.'.\'"\'';
		}
		if(count($orderPks)==0){
			$orderPks[] = 1;
		}
		$paramsPksString = implode(', ',$paramsPks);
		$conditionsPksString = implode(' AND ',$conditionsPks);
		$orderPksString	= implode(', ',$orderPks);
		$autocompleteFields = $options['autocompleteFields'];

		//Search
		$code.=
		"\t".'function searchAction(){'.PHP_EOL.PHP_EOL.
		"\t\t".'$request = Phalcon_Request::getInstance();'.PHP_EOL.
		"\t\t".'if($request->isPost()==true){'.PHP_EOL.
		"\t\t\t".'$page = 1;'.PHP_EOL.
		"\t\t\t".'$this->conditions = self::fromModel("'.$options['className'].'", 1);'.PHP_EOL.
		"\t\t".'} else {'.PHP_EOL.
		"\t\t\t".'$page = $this->getQuery(\'page\', \'int\');'.PHP_EOL.
		"\t\t\t".'if($page<=0){'.PHP_EOL.
		"\t\t\t\t".'$page = 1;'.PHP_EOL.
		"\t\t\t".'}'.PHP_EOL.
		"\t\t".'}'.PHP_EOL.PHP_EOL.
		"\t\t".'$'.$options['name'].' = $this->'.$options['className'].'->find(array($this->conditions, "order" => "'.$orderPksString.'"));'.PHP_EOL.
		"\t\t".'if(count($'.$options['name'].')==0){'.PHP_EOL.
		"\t\t\t".'Phalcon_Flash::notice("'.$options['plural'].' not found");'.PHP_EOL.
		"\t\t\t".'Phalcon_Tag::resetInput();'.PHP_EOL.
		"\t\t\t".'return $this->_forward("'.$options['name'].'/index");'.PHP_EOL.
		"\t\t".'}'.PHP_EOL.PHP_EOL.
		"\t\t".'$this->view->setParamToView(\'page\', $page);'.PHP_EOL.
		"\t\t".'$this->view->setParamToView("'.$options['name'].'", $'.$options['name'].');'.PHP_EOL.
		"\t".'}'.PHP_EOL.PHP_EOL;

		//New
		$code.="\t".'function newAction(){'.PHP_EOL;
		/*foreach($options['setParams'] as $setParam){
			$code.="\t\t".'$this->view->setParamToView("'.$setParam['varName'].'", '.'$this->'.$setParam['entity'].'->find(array("order" => "'.$setParam['order'].'")));'.PHP_EOL;
		}*/
		$code.="\t".'}'.PHP_EOL.PHP_EOL;

		//Edit
		$code.="\t".'function editAction('.$paramsPksString.'){'.PHP_EOL.PHP_EOL.
		"\t\t".'$request = Phalcon_Request::getInstance();'.PHP_EOL.
		"\t\t".'if(!$request->isPost()){'.PHP_EOL.PHP_EOL;
		foreach($options['primaryKeys'] as $primaryKey){
			$methodName = Phalcon_Utils::camelize($primaryKey);
			$code.="\t\t\t".'$'.$primaryKey.' = '.$options['className'].'::sanizite'.$methodName.'("'.$primaryKey.'", $'.$primaryKey.');'.PHP_EOL;
		}
		$code.=PHP_EOL;
		$code.="\t\t\t".'$'.$options['singleVar'].' = '.$options['className'].'::findFirst('.$conditionsPksString.');'.PHP_EOL.
		"\t\t\t".'if($'.$options['singleVar'].'==false){'.PHP_EOL.
		"\t\t\t\t".'Phalcon_Flash::error("'.$options['theSingle'].' not found");'.PHP_EOL.
		"\t\t\t\t".'return $this->_forward("'.$options['name'].'/index");'.PHP_EOL.
		"\t\t\t".'}'.PHP_EOL.PHP_EOL;

		foreach($options['attributes'] as $fieldName => $dataType){
			$camelize = Phalcon_Utils::camelize($fieldName);
			$field = Phalcon_Utils::lcfirst($camelize);
			if(isset($autocompleteFields[$fieldName])){
				$fieldConf = $autocompleteFields[$fieldName];
				$detailCamelize = Phalcon_Utils::camelize($fieldConf['detail']);
				$code.="\t\t\t".'Phalcon_Tag::displayTo("'.$field.'", $'.$options['singleVar'].'->get'.$camelize.'());'.PHP_EOL;
				$code.="\t\t\t".'Phalcon_Tag::displayTo("'.$field.'_det", $'.$options['singleVar'].'->get'.$fieldConf['tableName'].'()->get'.$detailCamelize.'());'.PHP_EOL;
			} else {
				if(strpos($dataType, 'date')!==false){
					$code.="\t\t\t".'Phalcon_Tag::displayTo("'.$field.'", (string) $'.$options['singleVar'].'->get'.$camelize.'());'.PHP_EOL;
				} else {
					if(strpos($dataType, 'decimal')!==false){
						$code.="\t\t\t".'Phalcon_Tag::displayTo("'.$field.'", (string) $'.$options['singleVar'].'->get'.$camelize.'());'.PHP_EOL;
					} else {
						$code.="\t\t\t".'Phalcon_Tag::displayTo("'.$field.'", $'.$options['singleVar'].'->get'.$camelize.'());'.PHP_EOL;
					}
				}
			}
		}
		$code.="\t\t".'}'.PHP_EOL;
		$code.=PHP_EOL;
		foreach($options['setParams'] as $setParam){
			$code.="\t\t".'$this->view->setParamToView("'.$setParam['varName'].'", '.'$this->'.$setParam['entity'].'->find(array("order" => "'.$setParam['order'].'")));'.PHP_EOL;
		}
		$code.="\t".'}'.PHP_EOL.PHP_EOL;

		//Form Criteria
		$code.="
	/**
	 * If variable is (int) value
	 *
	 * @param	string \$type
	 * @return	boolean
	 */
	private static function _isIntType(\$type){
		foreach(array('int', 'smallint', 'bigint') as \$intType){
			if(strpos(\$type, \$intType)!==false){
				return true;
			}
		}
		return false;
	}

	/**
	 * Gets a superglobal and convert an entire string with conditions depending on model.
	 *
	 * @param	string \$modelName
	 * @param	int \$superglobal
	 * @return	string
	 */
	public static function fromModel(\$modelName, \$globalType){

		\$superGlobal = array();
		if(\$globalType==1){
			\$superGlobal = \$_POST;
		} else {
			if(\$globalType==2){
				\$superGlobal = \$_GET;
			} else {
				\$superGlobal = \$_REQUEST;
			}
		}

		\$conditions = array();
		\$front = Phalcon_Controller_Front::getInstance();
		\$manager = \$front->getModelComponent();
		\$tempModel = \$manager->getModel(\$modelName);
		\$dataTypes = \$manager->getMetaData()->getDataTypes(\$tempModel);;

		foreach(\$dataTypes as \$fieldName => \$dataType){
			\$indexName = Phalcon_Utils::lcfirst(Phalcon_Utils::camelize(\$fieldName));
			if(isset(\$superGlobal[\$indexName])){
				\$value = null;
				if(self::_isIntType(\$dataType['Type'])){
					\$operator = '=';
					\$filter = new Phalcon_Filter();
					\$value = \$filter->sanitize(\$superGlobal[\$indexName], 'int');
				} else {
					\$operator = 'LIKE';
					\$filter = new Phalcon_Filter();
					\$value = \$filter->sanitize(\$superGlobal[\$indexName], 'striptags', 'extraspaces');
				}
				if(\$value!==null&&\$value!==''&&\$value!='@'){
					if(\$operator=='LIKE'){
						\$conditions[] = \$fieldName.' LIKE \'%'.\$value.'%\'';
					} else {
						\$conditions[] = \$fieldName.' = \''.\$value.'\'';
					}
				}
			}
		}
		if(count(\$conditions)>0){
			return implode(' AND ', \$conditions);
		} else {
			return '1 = 1';
		}
	}";

		$exceptions = array();
		foreach($options['attributes'] as $attribute => $x){
			if(preg_match('/_at$/', $attribute)){
				$exceptions[] = '"'.$attribute.'"';
			} else {
				if(preg_match('/_in$/', $attribute)){
					$exceptions[] = '"'.$attribute.'"';
				}
			}
		}

		//createAction
		$code.= PHP_EOL.PHP_EOL."\t".'function createAction(){'.PHP_EOL.PHP_EOL.
		"\t\t".'$request = Phalcon_Request::getInstance();'.PHP_EOL.
		"\t\t".'if($request->isPost()){'.PHP_EOL.PHP_EOL.
		"\t\t\t".'$'.$options['singleVar'].' = new '.$options['className'].'();';

		$entity = $options['entity'];

		$dataTypes = $options['manager']->getMetaData()->getDataTypes($entity);

		foreach(array_keys($dataTypes) as $field){
			$camelize = Phalcon_Utils::lcfirst(Phalcon_Utils::camelize($field));
			$code .= PHP_EOL."\t\t\t".'$'.$options['singleVar'].'->set'.Phalcon_Utils::camelize($field).'($request->getPost("'.$camelize.'"));';
		}
		
		$code .= PHP_EOL."\t\t\t".'if($'.$options['singleVar'].'->save()==false){'.PHP_EOL.
		"\t\t\t\t".'$messages = array();'.PHP_EOL.
		"\t\t\t\t".'foreach($'.$options['singleVar'].'->getMessages() as $message){'.PHP_EOL.
		"\t\t\t\t\t".'$messages[]= PHP_EOL.$message;'.PHP_EOL.
		"\t\t\t\t".'}'.PHP_EOL.
		"\t\t\t\t".'Phalcon_Flash::error((string) implode(\', \',$messages));'.PHP_EOL.
		"\t\t\t\t".'return $this->_forward("'.$options['name'].'/new");'.PHP_EOL.
		"\t\t\t".'} else {'.PHP_EOL.
		"\t\t\t\t".'Phalcon_Flash::success("The '.$options['theSingle'].' is created successfully");'.PHP_EOL.
		"\t\t\t\t".'return $this->_forward("'.$options['name'].'/index");'.PHP_EOL.
		"\t\t\t".'}'.PHP_EOL.PHP_EOL.
		"\t\t".'} else {'.PHP_EOL.
		"\t\t\t".'return $this->_forward("'.$options['name'].'/index");'.PHP_EOL.
		"\t\t".'}'.PHP_EOL.PHP_EOL.
		"\t".'}'.PHP_EOL.PHP_EOL;

		//saveAction
		$code.= PHP_EOL.PHP_EOL."\t".'function saveAction(){'.PHP_EOL.PHP_EOL.
		"\t\t".'$request = Phalcon_Request::getInstance();'.PHP_EOL.
		"\t\t".'if($request->isPost()){'.PHP_EOL.PHP_EOL.
		"\t\t\t".'$'.$options['singleVar'].' = '.$options['className'].'::factory($request->getPostParams(), array('.join(', ', $exceptions).'));'.PHP_EOL.
		"\t\t\t".'if($'.$options['singleVar'].'->exists()==false){'.PHP_EOL.
		"\t\t\t\t".'Phalcon_Flash::error("'.ucfirst($options['theSingle']).' can\'t be updated, not exists");'.PHP_EOL.
		"\t\t\t\t".'return $this->_forward("'.$options['name'].'/edit");'.PHP_EOL.
		"\t\t\t".'}'.PHP_EOL.PHP_EOL.
		"\t\t\t".'if($'.$options['singleVar'].'->save()==false){'.PHP_EOL.
		"\t\t\t\t".'foreach($'.$options['singleVar'].'->getMessages() as $message){'.PHP_EOL.
		"\t\t\t\t\t".'Phalcon_Flash::error((string) $message);'.PHP_EOL.
		"\t\t\t\t".'}'.PHP_EOL.
		"\t\t\t\t".'return $this->_forward("'.$options['name'].'/edit");'.PHP_EOL.
		"\t\t\t".'} else {'.PHP_EOL.
		"\t\t\t\t".'Phalcon_Flash::success("'.$options['theSingle'].' updated successfully");'.PHP_EOL.
		"\t\t\t\t".'Phalcon_Tag::resetInput();'.PHP_EOL.
		"\t\t\t\t".'return $this->_forward("'.$options['name'].'/index");'.PHP_EOL.
		"\t\t\t".'}'.PHP_EOL.PHP_EOL.
		"\t\t".'} else {'.PHP_EOL.
		"\t\t\t".'return $this->_forward("'.$options['name'].'/index");'.PHP_EOL.
		"\t\t".'}'.PHP_EOL.
		"\t".'}'.PHP_EOL.PHP_EOL;

		//Delete
		$code.= PHP_EOL.PHP_EOL."\t".'function deleteAction('.$paramsPksString.'){'.PHP_EOL.PHP_EOL;
		foreach($options['primaryKeys'] as $primaryKey){
			$methodName = Phalcon_Utils::camelize($primaryKey);
			$code.="\t\t".'$'.$primaryKey.' = '.$options['className'].'::sanizite'.$methodName.'("'.$primaryKey.'", $'.$primaryKey.');'.PHP_EOL;
		}
		$code.=PHP_EOL;
		$code.="\t\t".'$'.$options['singleVar'].' = $this->'.$options['className'].'->findFirst('.$conditionsPksString.');'.PHP_EOL.
		"\t\t".'if($'.$options['singleVar'].'==false){'.PHP_EOL.
		"\t\t\t".'Phalcon_Flash::error("'.$options['theSingle'].' not found");'.PHP_EOL.
		"\t\t\t".'return $this->_forward("'.$options['name'].'/index");'.PHP_EOL.
		"\t\t".'}'.PHP_EOL.PHP_EOL.
		"\t\t".'if($'.$options['singleVar'].'->delete()==false){'.PHP_EOL.
		"\t\t\t".'foreach($'.$options['singleVar'].'->getMessages() as $message){'.PHP_EOL.
		"\t\t\t\t".'Phalcon_Flash::error((string) $message);'.PHP_EOL.
		"\t\t\t".'}'.PHP_EOL.
		"\t\t\t".'return $this->_forward("'.$options['name'].'", "search");'.PHP_EOL.
		"\t\t".'} else {'.PHP_EOL.
		"\t\t\t".'Phalcon_Flash::success("'.$options['theSingle'].' is delete");'.PHP_EOL.
		"\t\t\t".'return $this->_forward("'.$options['name'].'/index");'.PHP_EOL.
		"\t\t".'}'.PHP_EOL.
		"\t".'}'.PHP_EOL.PHP_EOL;

		//Add query of autocomplete fields
		$autocompleteFields = $options['autocompleteFields'];
		foreach($autocompleteFields as $fieldName => $fieldConfig){
			$camelize = Phalcon_Utils::camelize($fieldName);
			$code .= PHP_EOL.PHP_EOL."\t".'function query'.$camelize.'Action(){'.PHP_EOL.
			"\t\t".'//$this->setResponse(\'json\');'.PHP_EOL.
			"\t\t".'$data = array();'.PHP_EOL.
			"\t\t".'$paramValue = $this->getPostparam("data", "striptags");'.PHP_EOL.
			"\t\t".'if($paramValue){'.PHP_EOL.
			"\t\t\t".'$results = $this->'.$fieldConfig['tableName'].'->find(array(\''.$fieldConfig['detail'].' LIKE "\'.$paramValue.\'%"\', "limit" => 10));'.PHP_EOL.
			"\t\t\t".'foreach($results as $row){'.PHP_EOL.
			"\t\t\t\t".'$data[] = array("key" => $row->readAttribute("'.$fieldConfig['primaryKey'].'"), "value" => $row->readAttribute("'.$fieldConfig['detail'].'"));'.PHP_EOL.
			"\t\t\t".'}'.PHP_EOL.
			"\t\t".'}'.PHP_EOL.
			"\t\t".'return $data;'.PHP_EOL.
			"\t".'}'.PHP_EOL.PHP_EOL;
		}
		$code .= "".'}'.PHP_EOL.'?>'.PHP_EOL;

		file_put_contents($controllerPath, $code);
	}

	/**
	 * make layouts of model by scaffold
	 *
	 * @param array $options
	 */
	private function _makeLayouts($options){

		//Make Layouts dir
		$dirPathLayouts	= 'app/views/layouts';
		//If not exists dir; we make it
		if(is_dir($dirPathLayouts)==false){
			mkdir($dirPathLayouts);
		}
		$fileName = Phalcon_Utils::uncamelize($options['name']);
		$viewPath = $dirPathLayouts.'/'.$fileName.'.phtml';

		//View model layout
		$code = '';
		if(isset($options['theme'])){
			$code.='<?php Phalcon_Tag::stylesheetLink("themes/lightness/style") ?>'.PHP_EOL;
			$code.='<?php Phalcon_Tag::stylesheetLink("themes/base") ?>'.PHP_EOL;
		}

		if(isset($options['theme'])){
			$code.='<div class="ui-layout" align="center">'.PHP_EOL;
		} else {
			$code.='<div align="center">'.PHP_EOL;
		}
		$code.="\t".'<?php echo $this->getContent(); ?>'.PHP_EOL.
		'</div>';
		file_put_contents($viewPath, $code);
	}

	/**
	 * Make field to diferent actions
	 *
	 * @param array $options
	 * @param string $action
	 *
	 * @return string $code
	 */
	private function _makeFields(&$options, $action){

		$code = '';
		$entity	= $options['entity'];
		$relationField = $options['relationField'];
		$autocompleteFields	= $options['autocompleteFields'];
		$selectDefinition = $options['selectDefinition'];

		$getDataTypes = $options['manager']->getMetaData()->getDataTypes($entity);

		foreach($getDataTypes as $attribute => $dataType){
			if(!preg_match('/_at$/', $attribute)){

				$camelize = Phalcon_Utils::lcfirst(Phalcon_Utils::camelize($attribute));
				$code.= "\t\t".'<tr>'.PHP_EOL.
				"\t\t\t".'<td align="right">'.PHP_EOL;
				if(($action=='new'||$action=='edit' ) && $attribute=='id'){
				}else{
					$code .= "\t\t\t\t".'<label for="'.$camelize.'">'.$this->_getPosibleLabel($attribute).'</label>'.PHP_EOL;
				}
				$code .= "\t\t\t".'</td>'.PHP_EOL.
				"\t\t\t".'<td align="left">';
				if(isset($relationField[$attribute])){
					//Autocomplete
					if(isset($autocompleteFields[$attribute])){
						$code.=PHP_EOL."\t\t\t\t".'<?php echo Phalcon_Tag::hiddenField(array("'.$camelize.'")), Phalcon_Tag::textFieldWithAutocomplete(array("'.$camelize.'_det", "action" => "'.$options['name'].'/query'.ucfirst($camelize).'")) ?>';
					} else {
						$code.=PHP_EOL."\t\t\t\t".'<?php echo Phalcon_Tag::select(array("'.$camelize.'", $'.$selectDefinition[$attribute]['varName'].
						', "using" => "'.$selectDefinition[$attribute]['primaryKey'].','.$selectDefinition[$attribute]['detail'].'", "useDummy"=>true)) ?>';
					}
				} else {
					//PKs
					if(($action=='new'||$action=='edit' ) && $attribute=='id'){
						$code.=PHP_EOL."\t\t\t\t".'<?php echo Phalcon_Tag::hiddenField(array("'.$camelize.'")) ?>';
					} else {
						//Char Field
						if(strpos($dataType, 'char')!==false){
							if(preg_match('/[a-z]+\(([0-9]+)\)/', $dataType, $matches)){
								if($matches[1]>15){
									$size = floor($matches[1]*0.35);
								} else {
									$size = $matches[1];
								}
								$maxlength = $matches[1];
							}
							$code.=PHP_EOL."\t\t\t\t".'<?php echo Phalcon_Tag::textField(array("'.$camelize.'", "size" => '.$size.', "maxlength" => '.$maxlength.')) ?>';
						} else {
							//Decimal field
							if(strpos($dataType, 'decimal')!==false || strpos($dataType, 'int')!==false){
								if(preg_match('/[a-z]+\(([0-9]+)\)/', $dataType, $matches)){
									if($matches[1]>15){
										$size = floor($matches[1]*0.50);
									} else {
										$size = $matches[1];
									}
									$maxlength = $matches[1];
								}
								$code.=PHP_EOL."\t\t\t".'<?php echo Phalcon_Tag::textField(array("'.$camelize.'", "size" => '.$size.', "maxlength" => '.$maxlength.', "type" => "numeric")) ?>';
							} else {
								//Enum field
								if(strpos($dataType, 'enum')!==false){
									$domain = array();
									if(preg_match('/\((.*)\)/', $dataType, $matches)){
										foreach(explode(',', $matches[1]) as $item){
											$item = strtoupper(str_replace("'", '', $item));
											$domain[$item] = $item;
										}
									}
									$varItems = str_replace(array("\n", " "), '', var_export($domain, true));
									$code.=PHP_EOL."\t\t\t\t".'<?php echo Phalcon_Tag::selectStatic(array("'.$camelize.'", '.$varItems.', "useDummy" => true)) ?>';
								} else {
									//Date field
									if(strpos($dataType, 'date')!==false){
										$code.=PHP_EOL."\t\t\t\t".'<?php echo Phalcon_Tag::textField(array("'.$camelize.'", "useDummy" => true, "type" => "date","calendar" => true)) ?>';
									}
								}
							}
						}
					}
				}
				$code.=PHP_EOL."\t\t\t".'</td>';
			}
			$code.=PHP_EOL."\t\t".'</tr>'.PHP_EOL;
		}
		return $code;
	}

	/**
	 * make views index.phtml of model by scaffold
	 *
	 * @param array $options
	 */
	private function _makeViewIndex($options){

		$dirPath = 'app/views/'.$options['name'];
		if(is_dir($dirPath)==false){
			mkdir($dirPath);
		}

		$relationField = $options['relationField'];
		$belongsToDefinitions = $options['belongsToDefinitions'];
		$selectDefinition = $options['selectDefinition'];
		$autocompleteFields	= $options['autocompleteFields'];

		$entity = $options['entity'];
		$plural = $options['plural'];
		$name = $options['name'];

		$viewPath = $dirPath.'/index.phtml';

		$code = '<?php echo $this->getContent(); ?>'.PHP_EOL.
		'<div align="center">'.PHP_EOL.
		"\t".'<h1>Buscar '.$plural.'</h1>'.PHP_EOL.
		"\t".'<?php echo Phalcon_Tag::form(array("'.$options['name'].'/search")) ?>'.PHP_EOL.
		'<div align="right" style="position: fixed; top:0px;">'.PHP_EOL.
		"\t".'<?php echo Phalcon_Tag::linkTo(array("'.$options['name'].'/new", "Crear '.ucfirst($options['single']).'")) ?>'.PHP_EOL.
		'</div>'.PHP_EOL.PHP_EOL.
		"\t".'<table align="center">'.PHP_EOL;

		//make fields by action
		$code.= self::_makeFields($options, 'index');

		$code.= PHP_EOL.
		"\t\t".'<tr>'.PHP_EOL.
		"\t\t\t".'<td></td><td><?php echo Phalcon_Tag::submitButton(array("Buscar")) ?></td>'.PHP_EOL.
		"\t\t".'</tr>'.PHP_EOL;

		$code.= "\t".'</table>'.PHP_EOL.
		'<?php echo Phalcon_Tag::endForm() ?>'.PHP_EOL.
		'</div>';

		//index.phtml
		file_put_contents($viewPath, $code);
	}

	/**
	 * make views index.phtml of model by scaffold
	 *
	 * @param array $options
	 */
	private function _makeViewNew($options){

		$dirPath = 'app/views/'.$options['name'];
		if(is_dir($dirPath)==false){
			mkdir($dirPath);
		}

		$relationField = $options['relationField'];
		$belongsToDefinitions = $options['belongsToDefinitions'];
		$selectDefinition = $options['selectDefinition'];
		$autocompleteFields	= $options['autocompleteFields'];

		$entity = $options['entity'];

		$plural = $options['plural'];
		$name = $options['name'];

		$viewPath = $dirPath.'/new.phtml';

		$code = '<?php echo $this->getContent(); ?>'.PHP_EOL.PHP_EOL;
		$code.= '<?php echo Phalcon_Tag::form("'.$options['name'].'/create") ?>'.PHP_EOL.PHP_EOL.
		'<table width="100%">'.PHP_EOL.
		"\t".'<tr>'.PHP_EOL.
		"\t\t".'<td align="left"><?php echo Phalcon_Tag::linkTo(array("'.$options['name'].'", "Volver")) ?></td>'.PHP_EOL.
		"\t\t".'<td align="right"><?php echo Phalcon_Tag::submitButton(array("Grabar")) ?></td>'.PHP_EOL.
		"\t".'<tr>'.PHP_EOL.
		'</table>'.PHP_EOL.PHP_EOL.
		'<div align="center">'.PHP_EOL.
		"\t".'<h1>Creando '.$options['single'].'</h1>'.PHP_EOL.
		'</div>'.PHP_EOL.PHP_EOL.
		"\t".'<table align="center">'.PHP_EOL;

		//make fields by action
		$code.= self::_makeFields($options, 'new');

		$code.= "\t".'</table>'.PHP_EOL.
		"\t".'<?php echo Phalcon_Tag::endForm() ?>'.PHP_EOL;

		//index.phtml
		file_put_contents($viewPath, $code);
	}

	/**
	 * make views index.phtml of model by scaffold
	 *
	 * @param array $options
	 */
	private function _makeViewEdit($options){

		$dirPath = 'app/views/'.$options['name'];
		if(is_dir($dirPath)==false){
			mkdir($dirPath);
		}

		$relationField = $options['relationField'];
		$belongsToDefinitions = $options['belongsToDefinitions'];
		$selectDefinition = $options['selectDefinition'];
		$autocompleteFields	= $options['autocompleteFields'];

		$entity = $options['entity'];

		$plural = $options['plural'];
		$name = $options['name'];

		$viewPath = $dirPath.'/edit.phtml';

		$code = '<?php echo $this->getContent(); ?>'.PHP_EOL.PHP_EOL;
		$code.= '<?php echo Phalcon_Tag::form("'.$options['name'].'/save") ?>'.PHP_EOL.PHP_EOL.
		'<table width="100%">'.PHP_EOL.
		"\t".'<tr>'.PHP_EOL.
		"\t\t".'<td align="left"><?php echo Phalcon_Tag::submitButton(array("Volver", "'.$options['name'].'")) ?></td>'.PHP_EOL.
		"\t\t".'<td align="right"><?php echo Phalcon_Tag::submitButton(array("Actualizar")) ?></td>'.PHP_EOL.
		"\t".'<tr>'.PHP_EOL.
		'</table>'.PHP_EOL.PHP_EOL.
		'<div align="center">'.PHP_EOL.
		"\t".'<h1>Editando '.$options['single'].'</h1>'.PHP_EOL.
		'</div>'.PHP_EOL.PHP_EOL.
		"\t".'<table align="center">'.PHP_EOL;

		//make fields by action
		$code.= self::_makeFields($options, 'new');

		$code.= "\t".'</table>'.PHP_EOL.
		"\t".'<?php echo Phalcon_Tag::endForm() ?>'.PHP_EOL;

		//index.phtml
		file_put_contents($viewPath, $code);
	}

	/**
	 * make view search.phtml of model by scaffold
	 *
	 * @param array $options
	 */
	private function _makeViewSearch($options){

		//View model layout
		$dirPath = 'app/views/'.$options['name'];
		$viewPath = $dirPath.'/search.phtml';

		$code = '<table width="100%">'.PHP_EOL.
		"\t".'<tr>'.PHP_EOL.
		"\t\t".'<td align="left"><?php echo Phalcon_Tag::linkTo(array("'.$options['name'].'", "Volver")) ?></td>'.PHP_EOL.
		'<?php echo Phalcon_Tag::linkTo(array("'.$options['name'].'/new", "Crear '.ucfirst($options['single']).'")) ?></td>'.PHP_EOL.
		"\t".'<tr>'.PHP_EOL.
		'</table>'.PHP_EOL.PHP_EOL.
		'<?php $pages = Phalcon_Tag::paginate($'.$options['name'].', $page, 10); ?>'.PHP_EOL.PHP_EOL.
		'<table class="browse" align="center">'.PHP_EOL.
		"\t".'<thead>'.PHP_EOL.
		"\t\t".'<tr>'.PHP_EOL;
		foreach($options['attributes'] as $attribute => $dataType){
			$code.="\t\t\t".'<th>'.$this->_getPosibleLabel($attribute).'</th>'.PHP_EOL;
		}
		$code.="\t\t".'</tr>'.PHP_EOL.
		"\t".'</thead>'.PHP_EOL.
		"\t".'<tbody>'.PHP_EOL.
		"\t".'<?php foreach($pages->items as $'.$options['singleVar'].'){ ?>'.PHP_EOL.
		"\t\t".'<tr>'.PHP_EOL;
		$options['allReferences'] = array_merge($options['autocompleteFields'], $options['selectDefinition']);
		foreach($options['attributes'] as $fieldName => $dataType){
			$code.="\t\t\t".'<td><?php echo ';
			if(!isset($options['allReferences'][$fieldName])){
				$camelize = Phalcon_Utils::camelize($fieldName);
				if(strpos($dataType, 'date')!==false){
					$code.='(string) $'.$options['singleVar'].'->get'.$camelize.'()';
				} else {
					if(strpos($dataType, 'decimal')!==false){
						$code.='(string) $'.$options['singleVar'].'->get'.$camelize.'()';
					} else {
						$code.='$'.$options['singleVar'].'->get'.$camelize.'()';
					}
				}
			} else {
				$detailField = ucfirst($options['allReferences'][$fieldName]['detail']);
				$code.='$'.$options['singleVar'].'->get'.$options['allReferences'][$fieldName]['tableName'].'()->get'.$detailField.'()';
			}
			$code.=' ?></td>'.PHP_EOL;
		}
		$primaryKeyCode = array();
		foreach($options['primaryKeys'] as $primaryKey){
			$camelize = Phalcon_Utils::camelize($primaryKey);
			$primaryKeyCode[] = '$'.$options['singleVar'].'->get'.$camelize.'()';
		}
		$code.="\t\t\t".'<td><?php echo Phalcon_Tag::linkTo("'.$options['name'].'/edit/".'.join('/', $primaryKeyCode).', "Editar"); ?></td>'.PHP_EOL;
		$code.="\t\t\t".'<td><?php echo Phalcon_Tag::linkTo("'.$options['name'].'/delete/".'.join('/', $primaryKeyCode).', "Borrar"); ?></td>'.PHP_EOL;

		$code.="\t\t".'</tr>'.PHP_EOL.
		"\t".'<?php } ?>'.PHP_EOL.
		"\t".'</tbody>'.PHP_EOL.
		"\t".'<tbody>'.PHP_EOL.
		"\t\t".'<tr>'.PHP_EOL.
		"\t\t\t".'<td colspan="'.count($options['attributes']).'" align="right">'.PHP_EOL.
		"\t\t\t\t".'<table align="center">'.PHP_EOL.
		"\t\t\t\t\t".'<tr>'.PHP_EOL.
		"\t\t\t\t\t\t".'<td><?php echo Phalcon_Tag::linkToAction("Primera", "'.$options['name'].'/search") ?></td>'.PHP_EOL.
		"\t\t\t\t\t\t".'<td><?php echo Phalcon_Tag::linkToAction("Anterior", "'.$options['name'].'/search?page=".$pages->before) ?></td>'.PHP_EOL.
		"\t\t\t\t\t\t".'<td><?php echo Phalcon_Tag::linkToAction("Siguiente", "'.$options['name'].'/search?page=".$pages->next) ?></td>'.PHP_EOL.
		"\t\t\t\t\t\t".'<td><?php echo Phalcon_Tag::linkToAction("Última", "'.$options['name'].'/search?page=".$pages->last) ?></td>'.PHP_EOL.
		"\t\t\t\t\t\t".'<td><?php echo $pages->current, "/", $pages->total_pages ?></td>'.PHP_EOL.
		"\t\t\t\t\t".'</tr>'.PHP_EOL.
		"\t\t\t\t".'</table>'.PHP_EOL.
		"\t\t\t".'</td>'.PHP_EOL.
		"\t\t".'</tr>'.PHP_EOL.
		"\t".'<tbody>'.PHP_EOL.
		'</table>';
		file_put_contents($viewPath, $code);
	}
}

