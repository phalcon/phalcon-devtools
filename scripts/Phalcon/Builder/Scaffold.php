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

use Phalcon\Text;
use Phalcon\Script\Color;
use Phalcon\Builder\Component;
use Phalcon\Builder\Model as ModelBuilder;
use Phalcon\DI\FactoryDefault;
use Phalcon\Db\Column;

/**
 * ScaffoldBuilderComponent
 *
 * Build CRUDs using Phalcon
 *
 * @category 	Phalcon
 * @package 	Builder
 * @subpackage  Scaffold
 * @copyright   Copyright (c) 2011-2014 Phalcon Team (team@phalconphp.com)
 * @license 	New BSD License
 */
class Scaffold extends Component
{

    private function _findDetailField($entity)
    {
        $posible = array('name');
        $attributes = $entity::getAttributes();
        foreach ($attributes as $attribute) {
            if (in_array($attribute, $posible)) {
                return $attribute;
            }
        }

        return $attributes[0];
    }

    /**
     * @param $fieldName
     *
     * @return string
     */
    private function _getPossibleLabel($fieldName)
    {
        $fieldName = preg_replace('/_id$/', '', $fieldName);
        $fieldName = preg_replace('/_at$/', '', $fieldName);
        $fieldName = preg_replace('/_in$/', '', $fieldName);
        $fieldName = str_replace('_', ' of ', $fieldName);

        return ucwords($fieldName);
    }

    /**
     * @param $className
     *
     * @return string
     */
    private function _getPossibleSingular($className)
    {
        if (substr($className, strlen($className) - 1, 1) == 's') {
            return substr($className, 0, strlen($className) - 1);
        } else {
            return $className;
        }
    }

    /**
     * @param $className
     *
     * @return mixed
     */
    private function _getPossiblePlural($className)
    {
        if (substr($className, strlen($className) - 1, 1) == 's') {
            return $className;
        }

        return $className;
    }

    /**
     * @return bool
     * @throws \Phalcon\Builder\BuilderException
     */
    public function build()
    {

        $options = $this->_options;

        $path = '';
        if (isset($this->_options['directory'])) {
            if ($this->_options['directory']) {
                $path = $this->_options['directory'] . '/';
            }
        }

        $name = $options['name'];
        $config = $this->_getConfig($path);

        if (!isset($config->database->adapter)) {
            throw new BuilderException("Adapter was not found in the config. Please specify a config variable [database][adapter]");
        }

        $adapter = ucfirst($config->database->adapter);

        $this->isSupportedAdapter($adapter);

        $di = new FactoryDefault();

        $di->set('db', function () use ($adapter, $config) {

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
            unset($configArray['adapter']);

            return new $adapterName($configArray);
        });

        if (isset($config->application->modelsDir)) {
            $options['modelsDir'] = $path . $config->application->modelsDir;
        } else {
            throw new BuilderException("The builder is unable to find the views directory");
        }

        if (isset($config->application->controllersDir)) {
            $options['controllersDir'] = $path . $config->application->controllersDir;
        } else {
            throw new BuilderException("The builder is unable to find the controllers directory");
        }

        if (isset($config->application->viewsDir)) {
            $options['viewsDir'] = $path . $config->application->viewsDir;
        } else {
            throw new BuilderException("The builder is unable to find the views directory");
        }

        $options['manager'] = $di->getShared('modelsManager');

        $options['className'] = Text::camelize($options['name']);
        $options['fileName'] = Text::uncamelize($options['className']);

        $modelClass = Text::camelize($name);
        $modelPath = $config->application->modelsDir.'/'.$modelClass.'.php';
        if (!file_exists($modelPath)) {

            $modelBuilder = new ModelBuilder(array(
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

        if (!class_exists($modelClass)) {
            require $modelPath;
        }

        $entity = new $modelClass();

        $metaData = $di['modelsMetadata'];

        $attributes = $metaData->getAttributes($entity);
        $dataTypes = $metaData->getDataTypes($entity);
        $identityField = $metaData->getIdentityField($entity);
        $primaryKeys = $metaData->getPrimaryKeyAttributes($entity);

        $setParams = array();
        $selectDefinition = array();

        $relationField = '';

        $single = $name;
        $options['name'] 				 = strtolower(Text::camelize($single));
        $options['plural'] 				 = $this->_getPossiblePlural($name);
        $options['singular']			 = $this->_getPossibleSingular($name);
        $options['entity']				 = $entity;
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

        if (isset($options['templateEngine']) && $options['templateEngine'] == 'volt') {
            //View layouts
            $this->_makeLayoutsVolt($path, $options);

            //View index.phtml
            $this->_makeViewIndexVolt($path, $options);

            //View search.phtml
            $this->_makeViewSearchVolt($path, $options);

            //View new.phtml
            $this->_makeViewNewVolt($path, $options);

            //View edit.phtml
            $this->_makeViewEditVolt($path, $options);
        } else {
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

        return true;
    }

    /**
     * @param $type
     *
     * @return string
     * @throws \Phalcon\Builder\BuilderException
     */
    private function _resolveType($type)
    {
        switch ($type) {
            case Column::TYPE_INTEGER:
                return 'integer';
                break;
            case Column::TYPE_DECIMAL:
                return 'decimal';
                break;
            case Column::TYPE_FLOAT:
                return 'float';
                break;
            case Column::TYPE_DATE:
                return 'date';
                break;
            case Column::TYPE_VARCHAR:
                return 'varchar';
                break;
            case Column::TYPE_DATETIME:
                return 'datetime';
                break;
            case Column::TYPE_CHAR:
                return 'char';
                break;
            case Column::TYPE_TEXT:
                return 'text';
                break;
            default:
                throw new BuilderException('Data type could not be resolved');
        }
    }

    /**
     * @param $var
     * @param $fields
     * @param $useGetSetters
     * @param $identityField
     *
     * @return string
     */
    private function _captureFilterInput($var, $fields, $useGetSetters, $identityField)
    {
        $code = '';
        foreach ($fields as $field => $dataType) {

            if ($field == $identityField) {
                continue;
            }

            if (strpos($dataType, 'int') !== false) {
                $fieldCode = '$this->request->getPost("'.$field.'", "int")';
            } else {
                if ($field == 'email') {
                    $fieldCode = '$this->request->getPost("'.$field.'", "email")';
                } else {
                    $fieldCode = '$this->request->getPost("'.$field.'")';
                }
            }

            $code .= '$'.$var.'->';
            if ($useGetSetters) {
                $code .= 'set' . Text::camelize($field) . '(' . $fieldCode . ')';
            } else {
                $code .= $field . ' = ' . $fieldCode;
            }

            $code .= ';' . PHP_EOL . "\t\t";
        }

        return $code;
    }

    /**
     * @param $var
     * @param $fields
     * @param $useGetSetters
     *
     * @return string
     */
    private function _assignTagDefaults($var, $fields, $useGetSetters)
    {
        $code = '';
        foreach ($fields as $field => $dataType) {

            if ($useGetSetters) {
                $accessor = 'get' . Text::camelize($field) . '()';
            } else {
                $accessor = $field;
            }

            $code .= '$this->tag->setDefault("' . $field . '", $' . $var . '->' . $accessor . ');' . PHP_EOL . "\t\t\t";
        }

        return $code;
    }

    /**
     * @param $attribute
     * @param $dataType
     * @param $relationField
     * @param $selectDefinition
     *
     * @return string
     */
    private function _makeField($attribute, $dataType, $relationField, $selectDefinition)
    {
        $code = "\t" . '<tr>' . PHP_EOL .
                "\t\t" . '<td align="right">' . PHP_EOL .
                "\t\t\t" . '<label for="' . $attribute . '">' . $this->_getPossibleLabel($attribute) . '</label>' . PHP_EOL .
                "\t\t" . '</td>' . PHP_EOL .
                "\t\t" . '<td align="left">';

        if (isset($relationField[$attribute])) {
            $code .= PHP_EOL . "\t\t\t\t" . '<?php echo $this->tag->select(array("' . $attribute . '", $' . $selectDefinition[$attribute]['varName'] .
                ', "using" => "' . $selectDefinition[$attribute]['primaryKey'] . ',' . $selectDefinition[$attribute]['detail'] . '", "useDummy" => true)) ?>';
        } else {

            switch ($dataType) {
                case Column::TYPE_CHAR:
                    $code .= PHP_EOL . "\t\t\t\t" . '<?php echo $this->tag->textField(array("' . $attribute . '")) ?>';
                    break;
                case Column::TYPE_DECIMAL:
                case Column::TYPE_INTEGER:
                    $code .= PHP_EOL . "\t\t\t" . '<?php echo $this->tag->textField(array("' . $attribute . '", "type" => "number")) ?>';
                    break;
                case Column::TYPE_DATE:
                    $code .= PHP_EOL . "\t\t\t\t" . '<?php echo $this->tag->textField(array("' . $attribute . '", "type" => "date")) ?>';
                    break;
                case Column::TYPE_TEXT:
                    $code .= PHP_EOL . "\t\t\t\t" . '<?php echo $this->tag->textField(array("' . $attribute . '", "type" => "date")) ?>';
                    break;
                default:
                    $code .= PHP_EOL . "\t\t\t" . '<?php echo $this->tag->textField(array("' . $attribute . '", "size" => 30)) ?>';
                    break;
            }
        }

        $code .= PHP_EOL . "\t\t" . '</td>';
        $code .= PHP_EOL . "\t" . '</tr>' . PHP_EOL;

        return $code;
    }

    /**
     * @param $attribute
     * @param $dataType
     * @param $relationField
     * @param $selectDefinition
     *
     * @return string
     */
    private function _makeFieldVolt($attribute, $dataType, $relationField, $selectDefinition)
    {
        $code = "\t" . '<tr>' . PHP_EOL .
                "\t\t" . '<td align="right">' . PHP_EOL .
                "\t\t\t" . '<label for="' . $attribute . '">' . $this->_getPossibleLabel($attribute) . '</label>' . PHP_EOL .
                "\t\t" . '</td>' . PHP_EOL .
                "\t\t" . '<td align="left">';

        if (isset($relationField[$attribute])) {
            $code .= PHP_EOL . "\t\t\t\t" . '{{ select("' . $attribute . '", ' . $selectDefinition[$attribute]['varName'] .
                ', "using" :[ "' . $selectDefinition[$attribute]['primaryKey'] . ',' . $selectDefinition[$attribute]['detail'] . '", "useDummy" => true]) }}';
        } else {

            switch ($dataType) {
                case Column::TYPE_CHAR:
                    $code .= PHP_EOL . "\t\t\t\t" . '{{ text_field("' . $attribute . '") }}';
                    break;
                case Column::TYPE_DECIMAL:
                case Column::TYPE_INTEGER:
                    $code .= PHP_EOL . "\t\t\t" . '{{ text_field("' . $attribute . '", "type" : "numeric") }}';
                    break;
                case Column::TYPE_DATE:
                    $code .= PHP_EOL . "\t\t\t\t" . '{{ text_field("' . $attribute . '", "type" : "date") }}';
                    break;
                case Column::TYPE_TEXT:
                    $code .= PHP_EOL . "\t\t\t\t" . '{{ text_field("' . $attribute . '", "type" : "date") }}';
                    break;
                default:
                    $code .= PHP_EOL . "\t\t\t" . '{{ text_field("' . $attribute . '", "size" : 30) }}';
                    break;
            }
        }

        $code .= PHP_EOL . "\t\t" . '</td>';
        $code .= PHP_EOL . "\t" . '</tr>' . PHP_EOL;

        return $code;
    }

    /**
     * Build fields for different actions
     *
     * @param  string $path
     * @param  array  $options
     * @param  string $action
     * @return string $code
     */
    private function _makeFields($path, $options, $action)
    {

        $entity	= $options['entity'];
        $relationField = $options['relationField'];
        $autocompleteFields	= $options['autocompleteFields'];
        $selectDefinition = $options['selectDefinition'];
        $identityField = $options['identityField'];

        $code = '';
        foreach ($options['dataTypes'] as $attribute => $dataType) {

            if (($action == 'new' || $action == 'edit' ) && $attribute == $identityField) {
                continue;
            }

            $code .= $this->_makeField($attribute, $dataType, $relationField, $selectDefinition);
        }

        return $code;
    }

    /**
     * @param $path
     * @param $options
     * @param $action
     *
     * @return string
     */
    private function _makeFieldsVolt($path, $options, $action)
    {

        $entity	= $options['entity'];
        $relationField = $options['relationField'];
        $autocompleteFields	= $options['autocompleteFields'];
        $selectDefinition = $options['selectDefinition'];
        $identityField = $options['identityField'];

        $code = '';
        foreach ($options['dataTypes'] as $attribute => $dataType) {

            if (($action == 'new' || $action == 'edit' ) && $attribute == $identityField) {
                continue;
            }

            $code .= $this->_makeFieldVolt($attribute, $dataType, $relationField, $selectDefinition);
        }

        return $code;
    }

    /**
     * Generate controller using scaffold
     *
     * @param string $path
     * @param array  $options
     */
    private function _makeController($path, $options)
    {

        $controllerPath = $options['controllersDir'] . $options['className'] . 'Controller.php';

        if (file_exists($controllerPath)) {
            if (!$options['force']) {
                return;
            }
        }

        $path = $options['templatePath'] . '/scaffold/no-forms/Controller.php';

        $code = file_get_contents($path);

        $code = str_replace('$singularVar$', '$' . $options['singular'], $code);
        $code = str_replace('$singular$', $options['singular'], $code);

        $code = str_replace('$pluralVar$', '$' . $options['plural'], $code);
        $code = str_replace('$plural$', $options['plural'], $code);

        $code = str_replace('$className$', $options['className'], $code);

        $code = str_replace('$assignInputFromRequestCreate$', $this->_captureFilterInput($options['singular'], $options['dataTypes'], $options['genSettersGetters'], $options['identityField']), $code);
        $code = str_replace('$assignInputFromRequestUpdate$', $this->_captureFilterInput($options['singular'], $options['dataTypes'], $options['genSettersGetters'], $options['identityField']), $code);

        $code = str_replace('$assignTagDefaults$', $this->_assignTagDefaults($options['singular'], $options['dataTypes'], $options['genSettersGetters']), $code);

        $code = str_replace('$pkVar$', '$' . $options['attributes'][0], $code);
        $code = str_replace('$pk$', $options['attributes'][0], $code);

        if ($this->isConsole()) {
            echo $controllerPath, PHP_EOL;
        }

        $code = str_replace("\t", "    ", $code);
        file_put_contents($controllerPath, $code);
    }

    /**
     * Make layouts of model using scaffold
     *
     * @param string $path
     * @param array  $options
     */
    private function _makeLayouts($path, $options)
    {

        //Make Layouts dir
        $dirPathLayouts	= $options['viewsDir'] . '/layouts';

        //If dir doesn't exist we make it
        if (is_dir($dirPathLayouts) == false) {
            mkdir($dirPathLayouts);
        }

        $fileName = $options['fileName'];
        $viewPath = $dirPathLayouts . '/' . $fileName . '.phtml';
        if (!file_exists($viewPath) || $options['force']) {

            //View model layout
            $code = '';
            if (isset($options['theme'])) {
                $code.='<?php $this->tag->stylesheetLink("themes/lightness/style") ?>'.PHP_EOL;
                $code.='<?php $this->tag->stylesheetLink("themes/base") ?>'.PHP_EOL;
            }

            if (isset($options['theme'])) {
                $code .= '<div class="ui-layout" align="center">' . PHP_EOL;
            } else {
                $code .= '<div align="center">' . PHP_EOL;
            }
            $code .= "\t" . '<?php echo $this->getContent(); ?>' . PHP_EOL . '</div>';

            if ($this->isConsole()) {
                echo $viewPath, PHP_EOL;
            }

            $code = str_replace("\t", "    ", $code);
            file_put_contents($viewPath, $code);

        }
    }

    /**
     * @param $path
     * @param $options
     */
    private function _makeLayoutsVolt($path, $options)
    {

        //Make Layouts dir
        $dirPathLayouts	= $options['viewsDir'] . '/layouts';

        //If not exists dir; we make it
        if (is_dir($dirPathLayouts) == false) {
            mkdir($dirPathLayouts);
        }

        $fileName = Text::uncamelize($options['fileName']);
        $viewPath = $dirPathLayouts . '/' . $fileName . '.volt';
        if (!file_exists($viewPath || $options['force'])) {

            //View model layout
            $code = '';
            if (isset($options['theme'])) {
                $code.='{{ stylesheet_link("themes/lightness/style") }}'.PHP_EOL;
                $code.='{{ stylesheet_link("themes/base") }}'.PHP_EOL;
            }

            if (isset($options['theme'])) {
                $code .= '<div class="ui-layout" align="center">' . PHP_EOL;
            } else {
                $code .= '<div align="center">' . PHP_EOL;
            }
            $code .= "\t" . '{{ content() }}' . PHP_EOL . '</div>';

            if ($this->isConsole()) {
                echo $viewPath, PHP_EOL;
            }

            $code = str_replace("\t", "    ", $code);
            file_put_contents($viewPath, $code);

        }
    }

    /**
     * @param $path
     * @param $options
     * @param $type
     *
     * @throws \Phalcon\Builder\BuilderException
     */
    private function makeView($path, $options, $type)
    {

        $dirPath = $options['viewsDir'] . $options['fileName'];
        if (is_dir($dirPath) == false) {
            mkdir($dirPath);
        }

        $viewPath = $dirPath . '/' .$type. '.phtml';
        if (file_exists($viewPath)) {
            if (!$options['force']) {
                return;
            }
        }

        $templatePath = $options['templatePath'] . '/scaffold/no-forms/views/' .$type. '.phtml';
        if (!file_exists($templatePath)) {
            throw new BuilderException("Template '" . $templatePath . "' does not exist");
        }

        $code = file_get_contents($templatePath);

        $code = str_replace('$plural$', $options['plural'], $code);
        $code = str_replace('$captureFields$', self::_makeFields($path, $options, $type), $code);

        if ($this->isConsole()) {
            echo $viewPath, PHP_EOL;
        }

        $code = str_replace("\t", "    ", $code);
        file_put_contents($viewPath, $code);
    }

    /**
     * @param $path
     * @param $options
     * @param $type
     *
     * @throws \Phalcon\Builder\BuilderException
     */
    private function makeViewVolt($path, $options, $type)
    {

        $dirPath = $options['viewsDir'] . $options['fileName'];
        if (is_dir($dirPath) == false) {
            mkdir($dirPath);
        }

        $viewPath = $dirPath . '/' .$type. '.volt';
        if (file_exists($viewPath)) {
            if (!$options['force']) {
                return;
            }
        }

        $templatePath = $options['templatePath'] . '/scaffold/no-forms/views/' .$type. '.volt';
        if (!file_exists($templatePath)) {
            throw new BuilderException("Template '" . $templatePath . "' does not exist");
        }

        $code = file_get_contents($templatePath);

        $code = str_replace('$plural$', $options['plural'], $code);
        $code = str_replace('$captureFields$', self::_makeFieldsVolt($path, $options, $type), $code);

        if ($this->isConsole()) {
            echo $viewPath, PHP_EOL;
        }

        $code = str_replace("\t", "    ", $code);
        file_put_contents($viewPath, $code);
    }

    /**
     * Creates main view
     *
     * @param string $path
     * @param array  $options
     */
    private function _makeViewIndex($path, $options)
    {
        $this->makeView($path, $options, 'index');
    }

    /**
     * @param $path
     * @param $options
     */
    private function _makeViewIndexVolt($path, $options)
    {
        $this->makeViewVolt($path, $options, 'index');
    }

    /**
     * Creates the view to create a new item
     *
     * @param string $path
     * @param array  $options
     */
    private function _makeViewNew($path, $options)
    {
        $this->makeView($path, $options, 'new');
    }

    /**
     * @param $path
     * @param $options
     */
    private function _makeViewNewVolt($path, $options)
    {
        $this->makeViewVolt($path, $options, 'new');
    }

    /**
     * Creates the view to edit an item
     *
     * @param string $path
     * @param array  $options
     */
    private function _makeViewEdit($path, $options)
    {
        $this->makeView($path, $options, 'edit');
    }

    private function _makeViewEditVolt($path, $options)
    {
        $this->makeViewVolt($path, $options, 'edit');
    }

    /**
     * Creates the view to display search results
     *
     * @param $path
     * @param $options
     *
     * @throws \Phalcon\Builder\BuilderException
     */
    private function _makeViewSearch($path, $options)
    {

        $dirPath = $options['viewsDir'] . $options['fileName'];
        if (is_dir($dirPath) == false) {
            mkdir($dirPath);
        }

        $viewPath = $dirPath . '/search.phtml';
        if (file_exists($viewPath)) {
            if (!$options['force']) {
                return;
            }
        }

        $templatePath = $options['templatePath'] . '/scaffold/no-forms/views/search.phtml';
        if (!file_exists($templatePath)) {
            throw new BuilderException("Template '" . $templatePath . "' does not exist");
        }

        $headerCode = '';
        foreach ($options['attributes'] as $attribute) {
            $headerCode .= "\t\t\t" . '<th>' . $this->_getPossibleLabel($attribute) . '</th>' . PHP_EOL;
        }

        $rowCode = '';
        $options['allReferences'] = array_merge($options['autocompleteFields'], $options['selectDefinition']);
        foreach ($options['dataTypes'] as $fieldName => $dataType) {
            $rowCode .= "\t\t\t" . '<td><?php echo ';
            if (!isset($options['allReferences'][$fieldName])) {
                if ($options['genSettersGetters']) {
                    $rowCode .= '$' . $options['singular'] . '->get' . Text::camelize($fieldName) . '()';
                } else {
                    $rowCode .= '$' . $options['singular'] . '->' . $fieldName;
                }
            } else {
                $detailField = ucfirst($options['allReferences'][$fieldName]['detail']);
                $rowCode .= '$' . $options['singular'] . '->get' . $options['allReferences'][$fieldName]['tableName'] . '()->get' . $detailField . '()';
            }
            $rowCode .= ' ?></td>' . PHP_EOL;
        }

        if ($options['genSettersGetters']) {
            $idField = 'get' . Text::camelize($options['attributes'][0]) . '()';
        } else {
            $idField =  $options['attributes'][0];
        }

        $code = file_get_contents($templatePath);

        $code = str_replace('$plural$', $options['plural'], $code);
        $code = str_replace('$headerColumns$', $headerCode, $code);
        $code = str_replace('$rowColumns$', $rowCode, $code);
        $code = str_replace('$singularVar$', '$' . $options['singular'], $code);
        $code = str_replace('$pk$', $idField, $code);

        if ($this->isConsole()) {
            echo $viewPath, PHP_EOL;
        }

        $code = str_replace("\t", "    ", $code);
        file_put_contents($viewPath, $code);
    }

    /**
     * @param $path
     * @param $options
     *
     * @throws \Phalcon\Builder\BuilderException
     */
    private function _makeViewSearchVolt($path, $options)
    {

        $dirPath = $options['viewsDir'] . $options['fileName'];
        if (is_dir($dirPath) == false) {
            mkdir($dirPath);
        }

        $viewPath = $dirPath . '/search.volt';
        if (file_exists($viewPath)) {
            if (!$options['force']) {
                return;
            }
        }

        $templatePath = $options['templatePath'] . '/scaffold/no-forms/views/search.volt';
        if (!file_exists($templatePath)) {
            throw new BuilderException("Template '" . $templatePath . "' does not exist");
        }

        $headerCode = '';
        foreach ($options['attributes'] as $attribute) {
            $headerCode .= "\t\t\t" . '<th>' . $this->_getPossibleLabel($attribute) . '</th>' . PHP_EOL;
        }

        $rowCode = '';
        $options['allReferences'] = array_merge($options['autocompleteFields'], $options['selectDefinition']);
        foreach ($options['dataTypes'] as $fieldName => $dataType) {
            $rowCode .= "\t\t\t" . '<td>{{ ';
            if (!isset($options['allReferences'][$fieldName])) {
                if ($options['genSettersGetters']) {
                    $rowCode .= $options['singular'] . '.get' . Text::camelize($fieldName) . '()';
                } else {
                    $rowCode .= $options['singular'] . '.' . $fieldName;
                }
            } else {
                $detailField = ucfirst($options['allReferences'][$fieldName]['detail']);
                $rowCode .= $options['singular'] . '.get' . $options['allReferences'][$fieldName]['tableName'] . '().get' . $detailField . '()';
            }
            $rowCode .= ' }}</td>' . PHP_EOL;
        }

        if ($options['genSettersGetters']) {
            $idField = 'get' . Text::camelize($options['attributes'][0]) . '()';
        } else {
            $idField =  $options['attributes'][0];
        }

        $code = file_get_contents($templatePath);

        $code = str_replace('$plural$', $options['plural'], $code);
        $code = str_replace('$headerColumns$', $headerCode, $code);
        $code = str_replace('$rowColumns$', $rowCode, $code);
        $code = str_replace('$singularVar$', $options['singular'], $code);
        $code = str_replace('$pk$', $idField, $code);

        if ($this->isConsole()) {
            echo $viewPath, PHP_EOL;
        }

        $code = str_replace("\t", "    ", $code);
        file_put_contents($viewPath, $code);
    }
}
