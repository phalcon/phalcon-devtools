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
 * TwitterBootstrapComponent
 *
 * Build Twitter-Bootstrap CRUDs using Phalcon
 *
 * @category 	Phalcon
 * @package 	Scripts
 * @copyright   Copyright (c) 2011-2012 Phalcon Team (team@phalconphp.com)
 * @license 	New BSD License
 */
class TwitterBootstrapBuilderComponent {

	private $_options;

	public function __construct($options){
		$this->_options = $options;
	}

	private function _getConfig($path){
		return new Phalcon_Config_Adapter_Ini($path."app/config/config.ini");
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

		$path = '';
		if(isset($this->_options['directory'])){
			if($this->_options['directory']){
				$path = $this->_options['directory'].'/';
			}
		}

		if(!file_exists($path.'.phalcon')){
			throw new BuilderException("This command should be invoked inside a phalcon project directory");
		}

		$phalconToolsPath = getenv("PTOOLSPATH");
		if(!$phalconToolsPath){
			throw new BuilderException("Phalcon: PTOOLSPATH environment variable isn't set\n");
		}

		$jsPath = $path.'public/javascript/bootstrap';
		if(!file_exists($jsPath)){
			mkdir($jsPath, 0777, true);
			copy('resources/bootstrap/js/bootstrap.min.js', $jsPath.'/bootstrap.min.js');
		}

		$cssPath = $path.'public/css/bootstrap';
		if(!file_exists($cssPath)){
			mkdir($cssPath, 0777, true);
			copy('resources/bootstrap/css/bootstrap.min.css', $cssPath.'/bootstrap.min.css');
		}

		$imgPath = $path.'public/img/bootstrap';
		if(!file_exists($imgPath)){
			mkdir($imgPath, 0777, true);
			copy('resources/bootstrap/img/glyphicons-halflings.png', $imgPath.'/glyphicons-halflings.png');
		}

		$name = $options['name'];
		$config = $this->_getConfig($path);

		$options['modelsDir'] = $path.'public/'.$config->phalcon->modelsDir;
		$options['controllersDir'] = $path.'public/'.$config->phalcon->controllersDir;
		$options['viewsDir'] = $path.'public/'.$config->phalcon->viewsDir;

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
				'genSettersGetters' => $options['gen-setters-getters'],
				'directory' => $options['directory'],
				'force' => $options['force']
			));

			$modelBuilder->build();

		}

		$entity = $options['manager']->getModel($options['className']);
		if($entity==false){
			throw new BuilderException('The model '.$options['className'].' does not exist');
		}

		$entity->setConnection($connection);

		$metaData = $options['manager']->getMetaData();

		$primaryKeys = $metaData->getPrimaryKeyAttributes($entity);
		if(count($primaryKeys)==0){
			throw new BuilderException('A primary key is required for the model '.$options['className']);
		}

		$attributes = $metaData->getAttributes($entity);
		$dataTypes = $metaData->getDataTypes($entity);

		$setParams = $selectDefinition = array();

		//Try to find relations
		$relationFields = array();
		foreach($attributes as $attribute){
			if(preg_match('/([a-z_0-9]+)_id$/', $attribute, $matches)){
				if($connection->tableExists($matches[1])){
					$pk = array();
					$detailField = null;
					$describe = $connection->describeTable($matches[1]);
					foreach($describe as $field){
						if($field['Field']=='name'||$field['Field']=='description'){
							$detailField = $field['Field'];
						}
						if($field['Key']=='PRI'){
							$pk[] = $field['Field'];
						}
					}
					if($detailField && count($pk) == 1){
						$relationFields[$attribute] = array(
							'table' => $matches[1],
							'detail' => $detailField,
							'primaryKey' => $pk[0],
							'modelName' => Phalcon_Utils::camelize($matches[1]),
							'varName' => Phalcon_Utils::lcfirst(Phalcon_Utils::camelize($matches[1]))
						);
					}
				}
			}
		}

		$single = $name;
		$options['name'] = strtolower(Phalcon_Utils::camelize($single));
		$options['plural'] = str_replace('_', ' ', $single);
		$options['single'] = str_replace('_', ' ', $single);
		$options['entity'] = $single;
		$options['theSingle'] = $single;
		$options['singleVar'] = $single;
		$options['setParams'] = $setParams;
		$options['attributes'] = $attributes;
		$options['dataTypes'] = $dataTypes;
		$options['primaryKeys'] = $primaryKeys;
		$options['relationFields'] = $relationFields;
		$options['selectDefinition'] = $selectDefinition;
		$options['autocompleteFields'] = array();
		$options['belongsToDefinitions'] = array();

		//Build Controller
		$this->_makeController($path, $options);

		//View layouts
		$this->_makeLayouts($path, $options);

		//View index.phtml
		$this->_makeViewIndex($path, $options);

		//View search.phtml
		$this->_makeViewSearch($path, $options);

		//View new.phtml
		$this->_makeViewNew($path, $options);

		//View edit.phtml
		$this->_makeViewEdit($path, $options);

	}

	private function _captureFilterInput(&$code, $options){
		foreach($options['dataTypes'] as $field => $dataType){
			$code .= PHP_EOL."\t\t".'$'.$options['name'].'->'.$field.' = ';
			if(strpos($dataType, 'int')!==false){
				$code .= '$this->request->getPost("'.$field.'", "int");';
			} else {
				if(strpos($dataType, 'float')!==false){
					$code .= '$this->request->getPost("'.$field.'", "float");';
				} else {
					if($field=='email'){
						$code .= '$this->request->getPost("'.$field.'", "email");';
					} else {
						$code .= '$this->request->getPost("'.$field.'");';
					}
				}
			}
		}
		$first = true;
		foreach($options['dataTypes'] as $field => $dataType){
			if(strpos($dataType, 'char')!==false || strpos($dataType, 'text')!==false){
				if($field!='email'){
					if($first){
						$code .= PHP_EOL;
						$first = false;
					}
					$code .= PHP_EOL."\t\t".'$'.$options['name'].'->'.$field.' = strip_tags($'.$options['name'].'->'.$field.');';
				}
			}
		}
		if(!$first){
			$code .= PHP_EOL;
		}
	}

	/**
	 * Make controller of model by scaffold
	 *
	 * @param array $options
	 */
	private function _makeController($path, $options){

		$controllerPath = $options['controllersDir'].ucfirst(strtolower($options['className'])).'Controller.php';

		if(!file_exists($controllerPath)){

			$code = '<?php'.PHP_EOL.PHP_EOL.
			'use Phalcon_Tag as Tag;'.PHP_EOL.
			'use Phalcon_Flash as Flash;'.PHP_EOL.PHP_EOL.
			'class '.$options['className'].'Controller extends ControllerBase {'.PHP_EOL.PHP_EOL.
			//Index
			"\t".'function indexAction(){
		$this->session->conditions = null;'.PHP_EOL;

			if(count($options['relationFields'])){
				$code.=PHP_EOL;
				foreach($options['relationFields'] as $relationField){
					$code.="\t\t".'$this->view->setVar("'.$relationField['varName'].'", '.$relationField['modelName'].'::find());'.PHP_EOL;
				}
			}

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
			"\t".'function searchAction(){

		$numberPage = 1;
		if($this->request->isPost()){
			$query = Phalcon_Model_Query::fromInput("'.$options['className'].'", $_POST);
			$this->session->conditions = $query->getConditions();
		} else {
			$numberPage = $this->request->getQuery("page", "int");
			if($numberPage<=0){
				$numberPage = 1;
			}
		}

		$parameters = array();
		if($this->session->conditions){
			$parameters["conditions"] = $this->session->conditions;
		}
		$parameters["order"] = "'.$orderPksString.'";

		$'.$options['name'].' = '.$options['className'].'::find($parameters);
		if(count($'.$options['name'].')==0){
			Flash::notice("The search did not find any '.$options['plural'].'", "alert alert-info");
			return $this->_forward("'.$options['name'].'/index");
		}

		$paginator = Phalcon_Paginator::factory("Model", array(
			"data" => $'.$options['name'].',
			"limit"=> 10,
			"page" => $numberPage
		));
		$page = $paginator->getPaginate();

		$this->view->setVar("page", $page);
		$this->view->setVar("'.$options['name'].'", $'.$options['name'].');
	}'.PHP_EOL.PHP_EOL;

			//New
			$code.="\t".'function newAction(){'.PHP_EOL.PHP_EOL;

			if(count($options['relationFields'])){
				foreach($options['relationFields'] as $relationField){
					$code.="\t\t".'$this->view->setVar("'.$relationField['varName'].'", '.$relationField['modelName'].'::find());'.PHP_EOL;
				}
			}

			$code.="\t".'}'.PHP_EOL.PHP_EOL;

			//Edit
			$code.="\t".'function editAction($'.$orderPksString.'){

		$request = Phalcon_Request::getInstance();
		if(!$request->isPost()){

			$'.$orderPksString.' = $this->filter->sanitize($'.$orderPksString.', array("int"));

			$'.$options['name'].' = '.$options['className'].'::findFirst(\''.$orderPksString.'="\'.$'.$orderPksString.'.\'"\');
			if(!$'.$options['name'].'){
				Flash::error("'.$options['single'].' was not found", "alert alert-error");
				return $this->_forward("'.$options['name'].'/index");
			}
			$this->view->setVar("'.$orderPksString.'", $'.$options['name'].'->'.$orderPksString.');
		'.PHP_EOL;

			//genSettersGetters

			foreach($options['attributes'] as $field){
				$code.="\t\t\t".'Tag::displayTo("'.$field.'", $'.$options['name'].'->'.$field.');'.PHP_EOL;
			}

			if(count($options['relationFields'])){
				$code.=PHP_EOL;
				foreach($options['relationFields'] as $relationField){
					$code.="\t\t".'$this->view->setVar("'.$relationField['varName'].'", '.$relationField['modelName'].'::find());'.PHP_EOL;
				}
			}

			$code.="\t\t".'}
	}'.PHP_EOL;

			$exceptions = array();
			foreach($options['attributes'] as $attribute){
				if(preg_match('/_at$/', $attribute)){
					$exceptions[] = '"'.$attribute.'"';
				} else {
					if(preg_match('/_in$/', $attribute)){
						$exceptions[] = '"'.$attribute.'"';
					}
				}
			}

			//createAction
			$code.= PHP_EOL."\t".'function createAction(){

		if(!$this->request->isPost()){
			return $this->_forward("'.$options['name'].'/index");
		}

		$'.$options['name'].' = new '.$options['className'].'();';

			$entity = $options['entity'];

			self::_captureFilterInput($code, $options);

			$code .= PHP_EOL."\t\t".'if(!$'.$options['name'].'->save()){
			foreach($'.$options['name'].'->getMessages() as $message){
				Flash::error((string) $message, "alert alert-error");
			}
			return $this->_forward("'.$options['name'].'/new");
		} else {
			Flash::success("'.$options['single'].' was created successfully", "alert alert-success");
			return $this->_forward("'.$options['name'].'/index");
		}

	}'.PHP_EOL;

			//saveAction
			$code.= PHP_EOL."\t".'function saveAction(){

		if(!$this->request->isPost()){
			return $this->_forward("'.$options['name'].'/index");
		}

		$'.$orderPksString.' = $this->request->getPost("'.$orderPksString.'", "int");
		$'.$options['name'].' = '.$options['className'].'::findFirst("'.$orderPksString.'=\'$'.$orderPksString.'\'");
		if($'.$options['name'].'==false){
			Flash::error("'.$options['single'].' does not exist ".$'.$orderPksString.', "alert alert-error");
			return $this->_forward("'.$options['name'].'/index");
		}';

			self::_captureFilterInput($code, $options);

			$code .= PHP_EOL."\t\t".'if(!$'.$options['name'].'->save()){
			foreach($'.$options['name'].'->getMessages() as $message){
				Flash::error((string) $message, "alert alert-error");
			}
			return $this->_forward("'.$options['name'].'/edit/".$'.$options['name'].'->'.$orderPksString.');
		} else {
			Flash::success("'.$options['single'].' was updated successfully", "alert alert-success");
			return $this->_forward("'.$options['name'].'/index");
		}

	}'.PHP_EOL;

			//Delete
			$code.= PHP_EOL."\t".'function deleteAction($'.$orderPksString.'){

		$'.$orderPksString.' = $this->filter->sanitize($'.$orderPksString.', array("int"));

		$'.$options['name'].' = '.$options['className'].'::findFirst(\''.$orderPksString.'="\'.$'.$orderPksString.'.\'"\');
		if(!$'.$options['name'].'){
			Flash::error("'.$options['single'].' was not found", "alert alert-error");
			return $this->_forward("'.$options['name'].'/index");
		}

		if(!$'.$options['name'].'->delete()){
			foreach($'.$options['name'].'->getMessages() as $message){
				Flash::error((string) $message, "alert alert-error");
			}
			return $this->_forward("'.$options['name'].'/search");
		} else {
			Flash::success("'.$options['single'].' was deleted", "alert alert-success");
			return $this->_forward("'.$options['name'].'/index");
		}
	}'.PHP_EOL.PHP_EOL;

			$code .= "".'}'.PHP_EOL;

			file_put_contents($controllerPath, $code);
		}

	}

	/**
	 * make layouts of model by scaffold
	 *
	 * @param array $options
	 */
	private function _makeLayouts($path, $options){

		//Make Layouts dir
		$dirPathLayouts	= $path.'app/views/layouts';
		//If not exists dir; we make it
		if(is_dir($dirPathLayouts)==false){
			mkdir($dirPathLayouts);
		}

		$fileName = Phalcon_Utils::uncamelize($options['name']);
		$viewPath = $dirPathLayouts.'/'.$fileName.'.phtml';
		if(!file_exists($viewPath)){

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
	}

	/**
	 * Build fields for different actions
	 *
	 * @param array $options
	 * @param string $action
	 *
	 * @return string $code
	 */
	private function _makeFields($path, $options, $action){

		$code = '';
		$entity	= $options['entity'];
		$relationFields = $options['relationFields'];
		$autocompleteFields	= $options['autocompleteFields'];

		foreach($options['dataTypes'] as $attribute => $dataType){

			if(($action=='new'||$action=='edit' ) && $attribute=='id'){
			} else {
				$code .= "\t".'<div class="clearfix">'.PHP_EOL;
				$code .= "\t\t".'<label for="'.$attribute.'">'.$this->_getPosibleLabel($attribute).'</label>'.PHP_EOL;
			}

			if(isset($relationFields[$attribute])){
				$code.= "\t\t".'<?php echo Phalcon_Tag::select(array("'.$attribute.'", $'.$relationFields[$attribute]['varName'].
					', "using" => array("'.$relationFields[$attribute]['primaryKey'].'", "'.$relationFields[$attribute]['detail'].'"), "useDummy" => true)) ?>';
			} else {
				//PKs
				if(($action=='new'||$action=='edit' ) && $attribute=='id'){
					$code.=PHP_EOL."\t".'<input type="hidden" name="'.$attribute.'" id="'.$attribute.'" value="<?php echo $'.$attribute.' ?>" />';
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
						$code.="\t\t".'<?php echo Phalcon_Tag::textField(array("'.$attribute.'", "size" => '.$size.', "maxlength" => '.$maxlength.')) ?>';
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
							$code.="\t\t".'<?php echo Phalcon_Tag::textField(array("'.$attribute.'", "size" => '.$size.', "maxlength" => '.$maxlength.', "type" => "number")) ?>';
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
								$code.="\t\t".'<?php echo Phalcon_Tag::selectStatic(array("'.$attribute.'", '.$varItems.', "useDummy" => true)) ?>';
							} else {
								//Date field
								if(strpos($dataType, 'date')!==false){
									$code.="\t\t".'<?php echo Phalcon_Tag::textField(array("'.$attribute.'", "type" => "date")) ?>';
								}
							}
						}
					}
				}
			}
			if(($action=='new'||$action=='edit' ) && $attribute=='id'){
				$code .= PHP_EOL.PHP_EOL;
			} else {
				$code .= PHP_EOL."\t".'</div>'.PHP_EOL.PHP_EOL;
			}
		}
		return $code;
	}

	/**
	 * Creates main view
	 *
	 * @param array $options
	 */
	private function _makeViewIndex($path, $options){

		$dirPath = $path.'app/views/'.$options['name'];
		if(is_dir($dirPath)==false){
			mkdir($dirPath);
		}

		$relationFields = $options['relationFields'];
		$belongsToDefinitions = $options['belongsToDefinitions'];
		$selectDefinition = $options['selectDefinition'];
		$autocompleteFields	= $options['autocompleteFields'];

		$entity = $options['entity'];
		$plural = $options['plural'];
		$name = $options['name'];

		$viewPath = $dirPath.'/index.phtml';

		$code = '<?php echo $this->getContent(); ?>'.PHP_EOL.PHP_EOL.
		'<div align="right">'.PHP_EOL.
		"\t".'<?php echo Phalcon_Tag::linkTo(array("'.$options['name'].'/new", "Create '.ucfirst($options['single']).'", "class" => "btn btn-primary")) ?>'.PHP_EOL.
		'</div>'.PHP_EOL.PHP_EOL.
		'<?php echo Phalcon_Tag::form(array("'.$options['name'].'/search")) ?>'.PHP_EOL.PHP_EOL.
		'<div class="center scaffold">'.PHP_EOL.PHP_EOL.
		"\t".'<h2>Search '.$plural.'</h2>'.PHP_EOL.PHP_EOL;

		//make fields by action
		$code.= self::_makeFields($path, $options, 'index');

		$code.= "\t".'<div class="clearfix">'.PHP_EOL.
		"\t\t".'<?php echo Phalcon_Tag::submitButton(array("Search", "class" => "btn btn-primary")) ?></td>'.PHP_EOL.
		"\t".'</div>'.PHP_EOL.PHP_EOL;

		$code.= '</div>'.PHP_EOL.PHP_EOL.
		'</form>'.PHP_EOL;

		//index.phtml
		file_put_contents($viewPath, $code);
	}

	/**
	 * make views index.phtml of model by scaffold
	 *
	 * @param array $options
	 */
	private function _makeViewNew($path, $options){

		$dirPath = $path.'app/views/'.$options['name'];
		if(is_dir($dirPath)==false){
			mkdir($dirPath);
		}

		$viewPath = $dirPath.'/new.phtml';
		if(!file_exists($viewPath)){

			$relationFields = $options['relationFields'];
			$belongsToDefinitions = $options['belongsToDefinitions'];
			$selectDefinition = $options['selectDefinition'];
			$autocompleteFields	= $options['autocompleteFields'];

			$entity = $options['entity'];

			$plural = $options['plural'];
			$name = $options['name'];

			$code = '<?php echo Phalcon_Tag::form("'.$options['name'].'/create") ?>'.PHP_EOL.PHP_EOL.
			'<ul class="pager">'.PHP_EOL.
			"\t".'<li class="previous pull-left">'.PHP_EOL.
			"\t\t".'<?php echo Phalcon_Tag::linkTo(array("'.$options['name'].'", "&larr; Go Back")) ?>'.PHP_EOL.
			"\t".'</li>'.PHP_EOL.
			"\t".'<li class="pull-right">'.PHP_EOL.
			"\t\t".'<?php echo Phalcon_Tag::submitButton(array("Save", "class" => "btn btn-success")) ?>'.PHP_EOL.
			"\t".'</li>'.PHP_EOL.
			'</ul>'.PHP_EOL.PHP_EOL.
			'<?php echo $this->getContent(); ?>'.PHP_EOL.PHP_EOL.
			'<div class="center scaffold">'.PHP_EOL.
			"\t".'<h2>Create '.$options['single'].'</h2>'.PHP_EOL.PHP_EOL;

			//make fields by action
			$code.= self::_makeFields($path, $options, 'new');

			$code.= '</div>'.PHP_EOL.
			'</form>'.PHP_EOL;

			//index.phtml
			file_put_contents($viewPath, $code);
		}
	}

	/**
	 * make views index.phtml of model by scaffold
	 *
	 * @param array $options
	 */
	private function _makeViewEdit($path, $options){

		$dirPath = $path.'app/views/'.$options['name'];
		if(is_dir($dirPath)==false){
			mkdir($dirPath);
		}

		$viewPath = $dirPath.'/edit.phtml';
		if($viewPath){

			$relationFields = $options['relationFields'];
			$belongsToDefinitions = $options['belongsToDefinitions'];
			$selectDefinition = $options['selectDefinition'];
			$autocompleteFields	= $options['autocompleteFields'];

			$entity = $options['entity'];

			$plural = $options['plural'];
			$name = $options['name'];

			$code = '<?php echo Phalcon_Tag::form("'.$options['name'].'/save") ?>'.PHP_EOL.PHP_EOL.
			'<ul class="pager">'.PHP_EOL.
			"\t".'<li class="previous pull-left">'.PHP_EOL.
			"\t\t".'<?php echo Phalcon_Tag::linkTo(array("'.$options['name'].'", "&larr; Go Back")) ?>'.PHP_EOL.
			"\t".'</li>'.PHP_EOL.
			"\t".'<li class="pull-right">'.PHP_EOL.
			"\t\t".'<?php echo Phalcon_Tag::submitButton(array("Save", "class" => "btn btn-success")) ?>'.PHP_EOL.
			"\t".'</li>'.PHP_EOL.
			'</ul>'.PHP_EOL.PHP_EOL.
			'<?php echo $this->getContent(); ?>'.PHP_EOL.PHP_EOL.
			'<div class="center scaffold">'.PHP_EOL.
			"\t".'<h2>Edit '.$options['single'].'</h2>'.PHP_EOL.PHP_EOL;

			//make fields by action
			$code.= self::_makeFields($path, $options, 'new');

			$code.= "\t".'</form>'.PHP_EOL.
			'</div>'.PHP_EOL;

			//index.phtml
			file_put_contents($viewPath, $code);

		}
	}

	/**
	 * make view search.phtml of model by scaffold
	 *
	 * @param array $options
	 */
	private function _makeViewSearch($path, $options){

		//View model layout
		$dirPath = $path.'app/views/'.$options['name'];
		$viewPath = $dirPath.'/search.phtml';

		if(!file_exists($viewPath)){

			$code = '<?php echo $this->getContent(); ?>

<ul class="pager">
	<li class="previous pull-left">
		<?php echo Phalcon_Tag::linkTo("'.$options['name'].'/index", "&larr; Go Back"); ?>
	</li>
	<li class="pull-right">
		<?php echo Phalcon_Tag::linkTo(array("'.$options['name'].'/new", "Create '.$options['single'].'", "class" => "btn btn-primary")); ?>
	</li>
</ul>

<table class="table table-bordered table-striped" align="center">'.PHP_EOL.
			"\t".'<thead>'.PHP_EOL.
			"\t\t".'<tr>'.PHP_EOL;
			foreach($options['attributes'] as $attribute){
				$code.="\t\t\t".'<th>'.$this->_getPosibleLabel($attribute).'</th>'.PHP_EOL;
			}
			$code.="\t\t".'</tr>'.PHP_EOL.
			"\t".'</thead>'.PHP_EOL.
			"\t".'<tbody>'.PHP_EOL.
			"\t".'<?php
		if(isset($page->items)){
			foreach($page->items as $'.$options['name'].'){ ?>'.PHP_EOL.
				"\t\t".'<tr>'.PHP_EOL;
				$options['allReferences'] = array_merge($options['autocompleteFields'], $options['relationFields']);
				foreach($options['dataTypes'] as $fieldName => $dataType){
					$code.="\t\t\t".'<td><?php echo ';
					if(!isset($options['allReferences'][$fieldName])){
						if(strpos($dataType, 'date')!==false){
							$code.='(string) $'.$options['name'].'->'.$fieldName;
						} else {
							if(strpos($dataType, 'decimal')!==false){
								$code.='(string) $'.$options['name'].'->'.$fieldName;
							} else {
								$code.='$'.$options['name'].'->'.$fieldName;
							}
						}
					} else {
						$code.='$'.$options['name'].'->get'.$options['allReferences'][$fieldName]['modelName'].'()->'.$options['allReferences'][$fieldName]['detail'];
					}
					$code.=' ?></td>'.PHP_EOL;
				}

				$primaryKeyCode = array();
				foreach($options['primaryKeys'] as $primaryKey){
					$primaryKeyCode[] = '$'.$options['name'].'->'.$primaryKey;
				}
				$code.="\t\t\t".'<td width="12%"><?php echo Phalcon_Tag::linkTo(array("'.$options['name'].'/edit/".'.join('/', $primaryKeyCode).', \'<i class="icon-pencil"></i> Edit\', "class" => "btn")); ?></td>'.PHP_EOL;
				$code.="\t\t\t".'<td width="12%"><?php echo Phalcon_Tag::linkTo(array("'.$options['name'].'/delete/".'.join('/', $primaryKeyCode).', \'<i class="icon-remove"></i> Delete\', "class" => "btn")); ?></td>'.PHP_EOL;

				$code.="\t\t".'</tr>'.PHP_EOL.
				"\t".'<?php }
		} ?>'.PHP_EOL.
			"\t".'</tbody>'.PHP_EOL.
			"\t".'<tbody>'.PHP_EOL.
			"\t\t".'<tr>'.PHP_EOL.
			"\t\t\t".'<td colspan="'.(count($options['attributes'])+2).'" align="right">'.PHP_EOL.
			"\t\t\t\t".'<div class="btn-group">'.PHP_EOL.
			"\t\t\t\t\t".'<?php echo Phalcon_Tag::linkTo(array("'.$options['name'].'/search", \'<i class="icon-fast-backward"></i> First\', "class" => "btn")) ?>'.PHP_EOL.
			"\t\t\t\t\t".'<?php echo Phalcon_Tag::linkTo(array("'.$options['name'].'/search?page=".$page->before, \'<i class="icon-step-backward"></i> Previous\', "class" => "btn ")) ?>'.PHP_EOL.
			"\t\t\t\t\t".'<?php echo Phalcon_Tag::linkTo(array("'.$options['name'].'/search?page=".$page->next, \'<i class="icon-step-forward"></i> Next\', "class" => "btn")) ?>'.PHP_EOL.
			"\t\t\t\t\t".'<?php echo Phalcon_Tag::linkTo(array("'.$options['name'].'/search?page=".$page->last, \'<i class="icon-fast-forward"></i> Last\', "class" => "btn")) ?>'.PHP_EOL.
			"\t\t\t\t\t".'<span class="help-inline"><?php echo $page->current, "/", $page->total_pages ?></span>'.PHP_EOL.
			"\t\t\t\t".'</div>'.PHP_EOL.
			"\t\t\t".'</td>'.PHP_EOL.
			"\t\t".'</tr>'.PHP_EOL.
			"\t".'<tbody>'.PHP_EOL.
			'</table>';
			file_put_contents($viewPath, $code);
		}
	}

}