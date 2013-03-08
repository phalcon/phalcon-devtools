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

use Phalcon\Text;
use Phalcon\Script\Color;
use Phalcon\Builder\Component;

/**
 * ScaffoldBuilderComponent
 *
 * Build CRUDs using Phalcon
 *
 * @category 	Phalcon
 * @package 	Builder
 * @subpackage  Scaffold
 * @copyright   Copyright (c) 2011-2012 Phalcon Team (team@phalconphp.com)
 * @license 	New BSD License
 */
class Scaffold extends Component
{

	private function _findDetailField($entity)
	{
		$posible = array('name');
		$attributes = $entity::getAttributes();
		foreach($attributes as $attribute){
			if(in_array($attribute, $posible)){
				return $attribute;
			}
		}
		return $attributes[0];
	}

	private function _getPossibleLabel($fieldName)
	{
		$fieldName = preg_replace('/_id$/', '', $fieldName);
		$fieldName = preg_replace('/_at$/', '', $fieldName);
		$fieldName = preg_replace('/_in$/', '', $fieldName);
		$fieldName = str_replace('_', ' of ', $fieldName);
		return ucwords($fieldName);
	}

	public function build()
	{

		$options = $this->_options;

		$path = '';
		if(isset($this->_options['directory'])){
			if($this->_options['directory']){
				$path = $this->_options['directory'].'/';
			}
		}

		$name = $options['name'];
		$config = $this->_getConfig($path);

		if (!isset($config->database->adapter)) {
			throw new BuilderException("Adapter was not found in the config. Please specify a config varaible [database][adapter]");
		}

		$adapter = ucfirst($config->database->adapter);

		$this->isSupportedAdapter($adapter);

		$di = new \Phalcon\DI\FactoryDefault();

		$di->set('db', function() use ($adapter, $config) {
			$adapter = '\\Phalcon\\Db\\Adapter\\Pdo\\' . $adapter;
			$connection = new $adapter(array(
				'host'     => $config->database->host,
				'username' => $config->database->username,
				'password' => $config->database->password,
				'dbname'     => $config->database->name,
			));
			return $connection;
		});

		if(isset($config->application->modelsDir)){
			$options['modelsDir'] = $path . $config->application->modelsDir;
		} else {
			throw new BuilderException("The builder is unable to know where is the views directory");
		}

		if(isset($config->application->controllersDir)){
			$options['controllersDir'] = $path . $config->application->controllersDir;
		} else {
			throw new BuilderException("The builder is unable to know where is the controllers directory");
		}

		if(isset($config->application->viewsDir)){
			$options['viewsDir'] = $path . $config->application->viewsDir;
		} else {
			throw new BuilderException("The builder is unable to know where is the views directory");
		}

		$options['manager'] = $di->getShared('modelsManager');

		$options['className'] = Text::camelize($options['name']);
		$options['fileName'] = Text::uncamelize($options['className']);

		$modelClass = Text::camelize($name);
		$modelPath = $config->application->modelsDir.'/'.$modelClass.'.php';
		if (!file_exists($modelPath)) {

			$modelBuilder = new \Phalcon\Builder\Model(array(
				'name' => $name,
				'schema' => $options['schema'],
				'className' => $options['className'],
				'fileName' => $options['fileName'],
				'genSettersGetters' => $options['genSettersGetters'],
				'directory' => $options['directory'],
				'force' => $options['force']
			));

			$modelBuilder->build();
		}

		if(!class_exists($modelClass)){
			require $modelPath;
		}

		$entity = new $modelClass();

		$metaData = $di->getShared('modelsMetadata');

		$attributes = $metaData->getAttributes($entity);
		$dataTypes = $metaData->getDataTypes($entity);
		$identityField = $metaData->getIdentityField($entity);
		$primaryKeys = $metaData->getPrimaryKeyAttributes($entity);

		$setParams = array();
		$selectDefinition = array();

		$relationField = '';

		$single = $name;
		$options['name'] 				 = strtolower(Text::camelize($single));
		$options['plural'] 				 = str_replace('_', ' ', $single);
		$options['single']				 = str_replace('_', ' ', $single);
		$options['entity']				 = $entity;
		$options['theSingle'] 			 = $single;
		$options['singleVar'] 			 = $single;
		$options['setParams'] 			 = $setParams;
		$options['attributes'] 			 = $attributes;
		$options['dataTypes'] 			 = $dataTypes;
		$options['primaryKeys']          = $primaryKeys;
		$options['identityField']		 = $identityField;
		$options['relationField'] 		 = $relationField;
		$options['selectDefinition']	 = $selectDefinition;
		$options['autocompleteFields'] 	 = array();
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

		return true;
	}

	private function _captureFilterInput(&$code, $options)
	{
		foreach ($options['dataTypes'] as $field => $dataType) {
			$code .= PHP_EOL."\t\t".'$'.$options['name'].'->'.$field.' = ';
			if (strpos($dataType, 'int') !== false) {
				$code .= '$this->request->getPost("'.$field.'", "int");';
			} else {
				if ($field == 'email') {
					$code .= '$this->request->getPost("'.$field.'", "email");';
				} else {
					$code .= '$this->request->getPost("'.$field.'");';
				}
			}
		}
	}

	/**
	 * Generate controller using scaffold
	 *
	 * @param array $options
	 */
	private function _makeController($path, $options)
	{

		$controllerPath = $options['controllersDir'].ucfirst(strtolower($options['className'])).'Controller.php';

		if (!file_exists($controllerPath)) {

			$code = '<?php'.PHP_EOL.PHP_EOL.
			'use \Phalcon\Tag as Tag;'.PHP_EOL.PHP_EOL.
			'class '.$options['className'].'Controller extends ControllerBase'.PHP_EOL."\t".'{'.PHP_EOL.PHP_EOL.
			//Index
			"\t".'function indexAction()'.PHP_EOL."\t".'{
		$this->session->conditions = null;'.PHP_EOL;

			if (isset($options['relationFields'])) {
				if (count($options['relationFields'])) {
					$code.=PHP_EOL;
					foreach ($options['relationFields'] as $relationField) {
						$code.="\t\t".'$this->view->setVar("'.$relationField['varName'].'", '.$relationField['modelName'].'::find());'.PHP_EOL;
					}
				}
			}

			$code.="\t".'}'.PHP_EOL.PHP_EOL;

			$primaryKeys = $options['primaryKeys'];
			$paramsPks = $conditionsPks = $orderPks = array();
			foreach ($primaryKeys as $primaryKey) {
				$orderPks[] = $primaryKey;
				$paramsPks[] = '$'.$primaryKey;
				$conditionsPks[] =	'\''.$primaryKey.'="\'.$'.$primaryKey.'.\'"\'';
			}
			if (count($orderPks)==0) {
				$orderPks[] = 1;
			}
			$paramsPksString = implode(', ',$paramsPks);
			$conditionsPksString = implode(' AND ',$conditionsPks);
			$orderPksString	= implode(', ',$orderPks);
			$autocompleteFields = $options['autocompleteFields'];

			//Search
			$code.=
			"\t".'public function searchAction()'.PHP_EOL.'{

		$numberPage = 1;
		if ($this->request->isPost()) {
			$query = \Phalcon\Mvc\Model\Criteria::fromInput($this->di, "'.$options['className'].'", $_POST);
			$this->session->conditions = $query->getConditions();
                        $this->session->bind = $query->getParams()["bind"];
		} else {
			$numberPage = $this->request->getQuery("page", "int");
			if ($numberPage <= 0) {
				$numberPage = 1;
			}
		}

		$parameters = array();
		if ($this->session->conditions) {
			$parameters["conditions"] = $this->session->conditions;
                        $parameters["bind"] = $this->session->bind;
		}
		$parameters["order"] = "'.$orderPksString.'";

		$'.$options['name'].' = '.$options['className'].'::find($parameters);
		if (count($'.$options['name'].') == 0) {
			$this->flash->notice("The search did not find any '.$options['plural'].'");
			return $this->dispatcher->forward(array("controller" => "'.$options['name'].'", "action" => "index"));
		}

		$paginator = new \Phalcon\Paginator\Adapter\Model(array(
			"data" => $'.$options['name'].',
			"limit"=> 10,
			"page" => $numberPage
		));
		$page = $paginator->getPaginate();

		$this->view->setVar("page", $page);
	}'.PHP_EOL.PHP_EOL;

			//New
			$code.="\t".'public function newAction()
	{'.PHP_EOL.PHP_EOL;

			if (isset($options['relationFields'])) {
				if (count($options['relationFields'])) {
					foreach ($options['relationFields'] as $relationField) {
						$code.="\t\t".'$this->view->setVar("'.$relationField['varName'].'", '.$relationField['modelName'].'::find());'.PHP_EOL;
					}
				}
			}

			$code.="\t".'}'.PHP_EOL.PHP_EOL;

			//Edit
			$code.="\t".'public function editAction($'.$orderPksString.')
	{

		$request = $this->request;
		if (!$request->isPost()) {

			$'.$orderPksString.' = $this->filter->sanitize($'.$orderPksString.', array("int"));

			$'.$options['name'].' = '.$options['className'].'::findFirst(\''.$orderPksString.'="\'.$'.$orderPksString.'.\'"\');
			if (!$'.$options['name'].') {
				$this->flash->error("'.$options['single'].' was not found");
				return $this->dispatcher->forward(array("controller" => "'.$options['name'].'", "action" => "index"));
			}
			$this->view->setVar("'.$orderPksString.'", $'.$options['name'].'->'.$orderPksString.');
		'.PHP_EOL;

			//genSettersGetters

			foreach ($options['attributes'] as $field) {
				$code.="\t\t\t".'Tag::displayTo("'.$field.'", $'.$options['name'].'->'.$field.');'.PHP_EOL;
			}

			if (isset($options['relationFields'])) {
				if (count($options['relationFields'])) {
					$code.=PHP_EOL;
					foreach ($options['relationFields'] as $relationField) {
						$code.="\t\t".'$this->view->setVar("'.$relationField['varName'].'", '.$relationField['modelName'].'::find());'.PHP_EOL;
					}
				}
			}

			$code.="\t\t".'}
	}'.PHP_EOL;

			$exceptions = array();
			foreach ($options['attributes'] as $attribute) {
				if (preg_match('/_at$/', $attribute)) {
					$exceptions[] = '"'.$attribute.'"';
				} else {
					if (preg_match('/_in$/', $attribute)) {
						$exceptions[] = '"'.$attribute.'"';
					}
				}
			}

			//createAction
			$code.= PHP_EOL."\t".'public function createAction()
	{

		if (!$this->request->isPost()) {
			return $this->dispatcher->forward(array("controller" => "'.$options['name'].'", "action" => "index"));
		}

		$'.$options['name'].' = new '.$options['className'].'();';

			$entity = $options['entity'];

			self::_captureFilterInput($code, $options);

			$code .= PHP_EOL."\t\t".'if (!$'.$options['name'].'->save()) {
			foreach ($'.$options['name'].'->getMessages() as $message) {
				$this->flash->error((string) $message);
			}
			return $this->dispatcher->forward(array("controller" => "'.$options['name'].'", "action" => "new"));
		} else {
			$this->flash->success("'.$options['single'].' was created successfully");
			return $this->dispatcher->forward(array("controller" => "'.$options['name'].'", "action" => "index"));
		}

	}'.PHP_EOL;

			//saveAction
			$code.= PHP_EOL."\t".'public function saveAction()
	{

		if (!$this->request->isPost()) {
			return $this->dispatcher->forward(array("controller" => "'.$options['name'].'", "action" => "index"));
		}

		$'.$orderPksString.' = $this->request->getPost("'.$orderPksString.'", "int");
		$'.$options['name'].' = '.$options['className'].'::findFirst("'.$orderPksString.'=\'$'.$orderPksString.'\'");
		if (!$'.$options['name'].') {
			$this->flash->error("'.$options['single'].' does not exist ".$'.$orderPksString.');
			return $this->dispatcher->forward(array("controller" => "'.$options['name'].'", "action" => "index"));
		}';

			self::_captureFilterInput($code, $options);

			$code .= PHP_EOL."\t\t".'if (!$'.$options['name'].'->save()) {
			foreach ($'.$options['name'].'->getMessages() as $message) {
				$this->flash->error((string) $message);
			}
			return $this->dispatcher->forward(array("controller" => "'.$options['name'].'", "action" => "edit", "params" => array($'.$options['name'].'->'.$orderPksString.')));
		} else {
			$this->flash->success("'.$options['single'].' was updated successfully");
			return $this->dispatcher->forward(array("controller" => "'.$options['name'].'", "action" => "index"));
		}

	}'.PHP_EOL;

			//Delete
			$code.= PHP_EOL."\t".'public function deleteAction($'.$orderPksString.'){

		$'.$orderPksString.' = $this->filter->sanitize($'.$orderPksString.', array("int"));

		$'.$options['name'].' = '.$options['className'].'::findFirst(\''.$orderPksString.'="\'.$'.$orderPksString.'.\'"\');
		if (!$'.$options['name'].') {
			$this->flash->error("'.$options['single'].' was not found");
			return $this->dispatcher->forward(array("controller" => "'.$options['name'].'", "action" => "index"));
		}

		if (!$'.$options['name'].'->delete()) {
			foreach ($'.$options['name'].'->getMessages() as $message){
				$this->flash->error((string) $message);
			}
			return $this->dispatcher->forward(array("controller" => "'.$options['name'].'", "action" => "search"));
		} else {
			$this->flash->success("'.$options['single'].' was deleted");
			return $this->dispatcher->forward(array("controller" => "'.$options['name'].'", "action" => "index"));
		}
	}'.PHP_EOL.PHP_EOL;

			$code .= "".'}'.PHP_EOL;
			$code = str_replace("\t", "    ", $code);
			file_put_contents($controllerPath, $code);
		}

	}

	/**
	 * make layouts of model by scaffold
	 *
	 * @param array $options
	 */
	private function _makeLayouts($path, $options)
	{

		//Make Layouts dir
		$dirPathLayouts	= $options['viewsDir'].'/layouts';
		//If not exists dir; we make it
		if (is_dir($dirPathLayouts) == false) {
			mkdir($dirPathLayouts);
		}

		$fileName = Text::uncamelize($options['name']);
		$viewPath = $dirPathLayouts.'/'.$fileName.'.phtml';
		if (!file_exists($viewPath)) {

			//View model layout
			$code = '';
			if(isset($options['theme'])){
				$code.='<?php \Phalcon\Tag::stylesheetLink("themes/lightness/style") ?>'.PHP_EOL;
				$code.='<?php \Phalcon\Tag::stylesheetLink("themes/base") ?>'.PHP_EOL;
			}

			if(isset($options['theme'])){
				$code.='<div class="ui-layout" align="center">'.PHP_EOL;
			} else {
				$code.='<div align="center">'.PHP_EOL;
			}
			$code.="\t".'<?php echo $this->getContent(); ?>'.PHP_EOL.
			'</div>';
			$code = str_replace("\t", "    ", $code);
			file_put_contents($viewPath, $code);

		}
	}

	private function _resolveType($type)
	{
		switch ($type) {
			case \Phalcon\Db\Column::TYPE_INTEGER:
				return 'integer';
				break;
			case \Phalcon\Db\Column::TYPE_DECIMAL:
				return 'decimal';
				break;
			case \Phalcon\Db\Column::TYPE_FLOAT:
				return 'float';
				break;
			case \Phalcon\Db\Column::TYPE_DATE:
				return 'date';
				break;
			case \Phalcon\Db\Column::TYPE_VARCHAR:
				return 'varchar';
				break;
			case \Phalcon\Db\Column::TYPE_DATETIME:
				return 'datetime';
				break;
			case \Phalcon\Db\Column::TYPE_CHAR:
				return 'char';
				break;
			case \Phalcon\Db\Column::TYPE_TEXT:
				return 'text';
				break;
			default:
				throw new BuilderException('Data type could have not been resolved');
				break;
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
	private function _makeFields($path, $options, $action)
	{

		$code = '';
		$entity	= $options['entity'];
		$relationField = $options['relationField'];
		$autocompleteFields	= $options['autocompleteFields'];
		$selectDefinition = $options['selectDefinition'];
		$identityField = $options['identityField'];

		foreach ($options['dataTypes'] as $attribute => $dataType) {

			$code.= "\t\t".'<tr>'.PHP_EOL.
			"\t\t\t".'<td align="right">'.PHP_EOL;
			if (($action == 'new' || $action == 'edit' ) && $attribute == $identityField){
			} else {
				$code .= "\t\t\t\t".'<label for="'.$attribute.'">'.$this->_getPossibleLabel($attribute).'</label>'.PHP_EOL;
			}
			$code .= "\t\t\t".'</td>'.PHP_EOL.
			"\t\t\t".'<td align="left">';

			if(isset($relationField[$attribute])){
				$code.=PHP_EOL."\t\t\t\t".'<?php echo \Phalcon\Tag::select(array("'.$attribute.'", $'.$selectDefinition[$attribute]['varName'].
					', "using" => "'.$selectDefinition[$attribute]['primaryKey'].','.$selectDefinition[$attribute]['detail'].'", "useDummy" => true)) ?>';
			} else {
				//PKs
				if (($action=='new' || $action=='edit' ) && $attribute == $identityField) {
					if ($action=='edit'){
						$code.=PHP_EOL."\t\t\t\t".'<input type="hidden" name="'.$attribute.'" id="'.$attribute.'" value="<?php echo $'.$attribute.' ?>" />';
					}
				} else {
					//Char Field
					if ($dataType==\Phalcon\Db\Column::TYPE_CHAR) {
						$code.=PHP_EOL."\t\t\t\t".'<?php echo \Phalcon\Tag::textField(array("'.$attribute.'")) ?>';
					} else {
						//Decimal field
						if ($dataType==\Phalcon\Db\Column::TYPE_DECIMAL || $dataType==\Phalcon\Db\Column::TYPE_INTEGER) {
							$code.=PHP_EOL."\t\t\t".'<?php echo \Phalcon\Tag::textField(array("'.$attribute.'", "type" => "numeric")) ?>';
						} else {
							//Date field
							if ($dataType==\Phalcon\Db\Column::TYPE_DATE) {
								$code.=PHP_EOL."\t\t\t\t".'<?php echo \Phalcon\Tag::textField(array("'.$attribute.'", "type" => "date")) ?>';
							} else {
								if ($dataType==\Phalcon\Db\Column::TYPE_TEXT) {
									$code.=PHP_EOL."\t\t\t\t".'<?php echo \Phalcon\Tag::textArea(array("'.$attribute.'", "cols" => "40", "rows" => "5")) ?>';
								} else {
									$code.=PHP_EOL."\t\t\t".'<?php echo \Phalcon\Tag::textField(array("'.$attribute.'", "size" => 30)) ?>';
								}
							}
						}
					}
				}
			}
			$code.=PHP_EOL."\t\t\t".'</td>';
			$code.=PHP_EOL."\t\t".'</tr>'.PHP_EOL;
		}

		$code = str_replace("\t", "    ", $code);
		return $code;
	}

	/**
	 * Creates main view
	 *
	 * @param array $options
	 */
	private function _makeViewIndex($path, $options)
	{

		$dirPath = $options['viewsDir'].$options['name'];
		if (is_dir($dirPath)==false) {
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
		'<div align="right">'.PHP_EOL.
		"\t".'<?php echo \Phalcon\Tag::linkTo(array("'.$options['name'].'/new", "Create '.ucfirst($options['single']).'")) ?>'.PHP_EOL.
		'</div>'.PHP_EOL.PHP_EOL.
		'<div align="center">'.PHP_EOL.
		"\t".'<h1>Search '.$plural.'</h1>'.PHP_EOL.
		"\t".'<?php echo \Phalcon\Tag::form(array("'.$options['name'].'/search")) ?>'.PHP_EOL.
		"\t".'<table align="center">'.PHP_EOL;

		//make fields by action
		$code.= self::_makeFields($path, $options, 'index');

		$code.= PHP_EOL.
		"\t\t".'<tr>'.PHP_EOL.
		"\t\t\t".'<td></td><td><?php echo \Phalcon\Tag::submitButton(array("Search")) ?></td>'.PHP_EOL.
		"\t\t".'</tr>'.PHP_EOL;

		$code.= "\t".'</table>'.PHP_EOL.
		'</form>'.PHP_EOL.
		'</div>';

		//index.phtml
		$code = str_replace("\t", "    ", $code);
		file_put_contents($viewPath, $code);
	}

	/**
	 * make views index.phtml of model by scaffold
	 *
	 * @param array $options
	 */
	private function _makeViewNew($path, $options)
	{

		$dirPath = $options['viewsDir'].$options['name'];
		if (is_dir($dirPath)==false) {
			mkdir($dirPath);
		}

		$viewPath = $dirPath.'/new.phtml';
		if (!file_exists($viewPath)) {

			$relationField = $options['relationField'];
			$belongsToDefinitions = $options['belongsToDefinitions'];
			$selectDefinition = $options['selectDefinition'];
			$autocompleteFields	= $options['autocompleteFields'];

			$entity = $options['entity'];

			$plural = $options['plural'];
			$name = $options['name'];

			$code = '<?php echo \Phalcon\Tag::form("'.$options['name'].'/create") ?>'.PHP_EOL.PHP_EOL.
			'<table width="100%">'.PHP_EOL.
			"\t".'<tr>'.PHP_EOL.
			"\t\t".'<td align="left"><?php echo \Phalcon\Tag::linkTo(array("'.$options['name'].'", "Go Back")) ?></td>'.PHP_EOL.
			"\t\t".'<td align="right"><?php echo \Phalcon\Tag::submitButton("Save") ?></td>'.PHP_EOL.
			"\t".'<tr>'.PHP_EOL.
			'</table>'.PHP_EOL.PHP_EOL.
			'<?php echo $this->getContent(); ?>'.PHP_EOL.PHP_EOL.
			'<div align="center">'.PHP_EOL.
			"\t".'<h1>Create '.$options['single'].'</h1>'.PHP_EOL.
			'</div>'.PHP_EOL.PHP_EOL.
			"\t".'<table align="center">'.PHP_EOL;

			//make fields by action
			$code.= self::_makeFields($path, $options, 'new');

			$code.= "\t".'</table>' . PHP_EOL . '<?php echo \Phalcon\Tag::endForm() ?>' . PHP_EOL;

			//index.phtml
			$code = str_replace("\t", "    ", $code);
			file_put_contents($viewPath, $code);
		}
	}

	/**
	 * make views index.phtml of model by scaffold
	 *
	 * @param array $options
	 */
	private function _makeViewEdit($path, $options)
	{

		$dirPath = $options['viewsDir'].$options['name'];
		if(is_dir($dirPath)==false){
			mkdir($dirPath);
		}

		$viewPath = $dirPath.'/edit.phtml';
		if($viewPath){

			$relationField = $options['relationField'];
			$belongsToDefinitions = $options['belongsToDefinitions'];
			$selectDefinition = $options['selectDefinition'];
			$autocompleteFields	= $options['autocompleteFields'];

			$entity = $options['entity'];

			$plural = $options['plural'];
			$name = $options['name'];

			$code = '<?php echo $this->getContent(); ?>'.PHP_EOL.PHP_EOL;
			$code.= '<?php echo \Phalcon\Tag::form("'.$options['name'].'/save") ?>'.PHP_EOL.PHP_EOL.
			'<table width="100%">'.PHP_EOL.
			"\t".'<tr>'.PHP_EOL.
			"\t\t".'<td align="left"><?php echo \Phalcon\Tag::linkTo(array("'.$options['name'].'", "Back")) ?></td>'.PHP_EOL.
			"\t\t".'<td align="right"><?php echo \Phalcon\Tag::submitButton(array("Save")) ?></td>'.PHP_EOL.
			"\t".'<tr>'.PHP_EOL.
			'</table>'.PHP_EOL.PHP_EOL.
			'<div align="center">'.PHP_EOL.
			"\t".'<h1>Edit '.$options['name'].'</h1>'.PHP_EOL.
			'</div>'.PHP_EOL.PHP_EOL.
			"\t".'<table align="center">'.PHP_EOL;

			//make fields by action
			$code.= self::_makeFields($path, $options, 'new');

			$code.= "\t".'</table>'.PHP_EOL.
			"\t".'<?php echo \Phalcon\Tag::endForm() ?>'.PHP_EOL;

			//index.phtml
			$code = str_replace("\t", "    ", $code);
			file_put_contents($viewPath, $code);

		}
	}

	/**
	 * make view search.phtml of model by scaffold
	 *
	 * @param array $options
	 */
	private function _makeViewSearch($path, $options)
	{

		//View model layout
		$dirPath = $options['viewsDir'].$options['name'];
		$viewPath = $dirPath.'/search.phtml';

		if (!file_exists($viewPath)) {

			$code = '<?php $this->getContent(); ?>

<table width="100%">
	<tr>
		<td align="left">
			<?php echo \Phalcon\Tag::linkTo(array("'.$options['name'].'/index", "Go Back")); ?>
		</td>
		<td align="right">
			<?php echo \Phalcon\Tag::linkTo(array("'.$options['name'].'/new", "Create '.$options['single'].'")); ?>
		</td>
	<tr>
</table>

<table class="browse" align="center">'.PHP_EOL.
			"\t".'<thead>'.PHP_EOL.
			"\t\t".'<tr>'.PHP_EOL;
			foreach($options['attributes'] as $attribute){
				$code.="\t\t\t".'<th>'.$this->_getPossibleLabel($attribute).'</th>'.PHP_EOL;
			}
			$code.="\t\t".'</tr>'.PHP_EOL.
			"\t".'</thead>'.PHP_EOL.
			"\t".'<tbody>'.PHP_EOL.
			"\t".'<?php
		if(isset($page->items)){
			foreach($page->items as $'.$options['name'].'){ ?>'.PHP_EOL.
				"\t\t".'<tr>'.PHP_EOL;
				$options['allReferences'] = array_merge($options['autocompleteFields'], $options['selectDefinition']);
				foreach($options['dataTypes'] as $fieldName => $dataType){
					$code.="\t\t\t".'<td><?php echo ';
					if (!isset($options['allReferences'][$fieldName])) {
						if (strpos($dataType, 'date')!==false) {
							$code.='(string) $'.$options['name'].'->'.$fieldName;
						} else {
							if (strpos($dataType, 'decimal')!==false) {
								$code.='(string) $'.$options['name'].'->'.$fieldName;
							} else {
								$code.='$'.$options['name'].'->'.$fieldName;
							}
						}
					} else {
						$detailField = ucfirst($options['allReferences'][$fieldName]['detail']);
						$code.='$'.$options['name'].'->get'.$options['allReferences'][$fieldName]['tableName'].'()->get'.$detailField.'()';
					}
					$code.=' ?></td>'.PHP_EOL;
				}

				$primaryKeyCode = array();
				foreach($options['primaryKeys'] as $primaryKey){
					$primaryKeyCode[] = '$'.$options['name'].'->'.$primaryKey;
				}
				$code.="\t\t\t".'<td><?php echo \Phalcon\Tag::linkTo(array("'.$options['name'].'/edit/".'.join('/', $primaryKeyCode).', "Edit")); ?></td>'.PHP_EOL;
				$code.="\t\t\t".'<td><?php echo \Phalcon\Tag::linkTo(array("'.$options['name'].'/delete/".'.join('/', $primaryKeyCode).', "Delete")); ?></td>'.PHP_EOL;

				$code.="\t\t".'</tr>'.PHP_EOL.
				"\t".'<?php }
		} ?>'.PHP_EOL.
			"\t".'</tbody>'.PHP_EOL.
			"\t".'<tbody>'.PHP_EOL.
			"\t\t".'<tr>'.PHP_EOL.
			"\t\t\t".'<td colspan="'.count($options['attributes']).'" align="right">'.PHP_EOL.
			"\t\t\t\t".'<table align="center">'.PHP_EOL.
			"\t\t\t\t\t".'<tr>'.PHP_EOL.
			"\t\t\t\t\t\t".'<td><?php echo \Phalcon\Tag::linkTo("'.$options['name'].'/search", "First") ?></td>'.PHP_EOL.
			"\t\t\t\t\t\t".'<td><?php echo \Phalcon\Tag::linkTo("'.$options['name'].'/search?page=".$page->before, "Previous") ?></td>'.PHP_EOL.
			"\t\t\t\t\t\t".'<td><?php echo \Phalcon\Tag::linkTo("'.$options['name'].'/search?page=".$page->next, "Next") ?></td>'.PHP_EOL.
			"\t\t\t\t\t\t".'<td><?php echo \Phalcon\Tag::linkTo("'.$options['name'].'/search?page=".$page->last, "Last") ?></td>'.PHP_EOL.
			"\t\t\t\t\t\t".'<td><?php echo $page->current, "/", $page->total_pages ?></td>'.PHP_EOL.
			"\t\t\t\t\t".'</tr>'.PHP_EOL.
			"\t\t\t\t".'</table>'.PHP_EOL.
			"\t\t\t".'</td>'.PHP_EOL.
			"\t\t".'</tr>'.PHP_EOL.
			"\t".'<tbody>'.PHP_EOL.
			'</table>';
			$code = str_replace("\t", "    ", $code);
			file_put_contents($viewPath, $code);
		}
	}
}

