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

use Phalcon\Text;
use Phalcon\Builder\Model as ModelBuilder;
use Phalcon\DI\FactoryDefault;
use Phalcon\Db\Column;

/**
 * ScaffoldBuilderComponent
 *
 * Build CRUDs using Phalcon
 *
 * @package     Phalcon\Builder
 * @copyright   Copyright (c) 2011-2015 Phalcon Team (team@phalconphp.com)
 * @license     New BSD License
 */
class Scaffold extends Component
{
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
        }

        return $className;
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
     * @throws BuilderException
     */
    public function build()
    {
        if ($this->options->contains('directory')) {
            $this->currentPath = rtrim($this->options->get('directory'), '\\/') . DIRECTORY_SEPARATOR;
        }

        $name = $this->options->get('name');
        $config = $this->getConfig();

        if (!isset($config->database->adapter)) {
            throw new BuilderException('Adapter was not found in the config. Please specify a config variable [database][adapter].');
        }

        $adapter = 'Mysql';
        if (isset($config->database->adapter)) {
            $adapter = ucfirst($config->database->adapter);
            $this->isSupportedAdapter($adapter);
        }

        $di = new FactoryDefault();

        $di->set('db', function () use ($adapter, $config) {
            if (is_object($config->database)) {
                $configArray = $config->database->toArray();
            } else {
                $configArray = $config->database;
            }

            $adapterName = 'Phalcon\Db\Adapter\Pdo\\' . $adapter;
            unset($configArray['adapter']);

            return new $adapterName($configArray);
        });

        if (!isset($config->application->modelsDir)) {
            throw new BuilderException('The builder is unable to find the models directory.');
        }

        $modelPath = $config->application->modelsDir;
        if (false == $this->isAbsolutePath($modelPath)) {
            $modelPath = $this->currentPath . $config->application->modelsDir;
        }
        $this->options->offsetSet('modelsDir', rtrim($modelPath, '\\/') . DIRECTORY_SEPARATOR);

        if (!isset($config->application->controllersDir)) {
            throw new BuilderException('The builder is unable to find the controllers directory.');
        }

        $controllerPath = $config->application->controllersDir;
        if (false == $this->isAbsolutePath($controllerPath)) {
            $controllerPath = $this->currentPath . $config->application->controllersDir;
        }
        $this->options->offsetSet('controllersDir', rtrim($controllerPath, '\\/') . DIRECTORY_SEPARATOR);

        if (!isset($config->application->viewsDir)) {
            throw new BuilderException('The builder is unable to find the views directory.');
        }
        $viewPath = $config->application->viewsDir;
        if (false == $this->isAbsolutePath($viewPath)) {
            $viewPath = $this->currentPath . $config->application->viewsDir;
        }
        $this->options->offsetSet('viewsDir', rtrim($viewPath, '\\/') . DIRECTORY_SEPARATOR);


        $this->options->offsetSet('manager', $di->getShared('modelsManager'));
        $this->options->offsetSet('className', Text::camelize($this->options->get('name')));
        $this->options->offsetSet('fileName', Text::uncamelize($this->options->get('className')));

        $modelsNamespace = '';
        if ($this->options->contains('modelsNamespace') && $this->checkNamespace($this->options->get('modelsNamespace'))) {
            $modelsNamespace = $this->options->get('modelsNamespace');
        }

        if ($modelsNamespace && substr($modelsNamespace, -1) !== '\\') {
            $modelsNamespace .= "\\";
        }

        $modelName = Text::camelize($name);
        $modelClass = $modelsNamespace . $modelName;
        $modelPath = $this->options->get('modelsDir') . $modelName.'.php';
        if (!file_exists($modelPath)) {
            $modelBuilder = new ModelBuilder(array(
                'name'              => $name,
                'schema'            => $this->options->get('schema'),
                'className'         => $this->options->get('className'),
                'fileName'          => $this->options->get('fileName'),
                'genSettersGetters' => $this->options->get('genSettersGetters'),
                'directory'         => $this->options->get('directory'),
                'force'             => $this->options->get('force')
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
        $this->options->offsetSet('name', strtolower(Text::camelize($single)));
        $this->options->offsetSet('plural', $this->_getPossiblePlural($name));
        $this->options->offsetSet('singular', $this->_getPossibleSingular($name));
        $this->options->offsetSet('entity', $entity);
        $this->options->offsetSet('setParams', $setParams);
        $this->options->offsetSet('attributes', $attributes);
        $this->options->offsetSet('dataTypes', $dataTypes);
        $this->options->offsetSet('primaryKeys', $primaryKeys);
        $this->options->offsetSet('identityField', $identityField);
        $this->options->offsetSet('relationField', $relationField);
        $this->options->offsetSet('selectDefinition', $selectDefinition);
        $this->options->offsetSet('autocompleteFields', array());
        $this->options->offsetSet('belongsToDefinitions', array());

        // Build Controller
        $this->_makeController();

        if ($this->options->get('templateEngine') == 'volt') {
            // View layouts
            $this->_makeLayoutsVolt();

            // View index.phtml
            $this->makeViewVolt('index');

            // View search.phtml
            $this->_makeViewSearchVolt();

            // View new.phtml
            $this->makeViewVolt('new');

            // View edit.phtml
            $this->makeViewVolt('edit');
        } else {
            // View layouts
            $this->_makeLayouts();

            // View index.phtml
            $this->makeView('index');

            // View search.phtml
            $this->_makeViewSearch();

            // View new.phtml
            $this->makeView('new');

            // View edit.phtml
            $this->makeView('edit');
        }

        return true;
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
                case 5: // enum
                    $code .= PHP_EOL . "\t\t\t\t" . '<?php echo $this->tag->selectStatic(array("' . $attribute . '", array())) ?>';
                    break;
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
                    $code .= PHP_EOL . "\t\t\t\t" . '<?php echo $this->tag->textArea(array("' . $attribute . '", "cols" => 30, "rows" => 4)) ?>';
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
                case 5: // enum
                    $code .= PHP_EOL . "\t\t\t\t" . '{{ select_static("' . $attribute . '", "using": []) }}';
                    break;
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
                    $code .= PHP_EOL . "\t\t\t\t" . '{{ text_area("' . $attribute . '", "cols": "30", "rows": "4") }}';
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
     * @param  string $action
     * @return string
     */
    private function _makeFields($action)
    {
        $entity             = $this->options->entity;
        $relationField      = $this->options->relationField;
        $autocompleteFields = $this->options->autocompleteFields;
        $selectDefinition   = $this->options->selectDefinition->toArray();
        $identityField      = $this->options->identityField;

        $code = '';
        foreach ($this->options->dataTypes as $attribute => $dataType) {
            if (($action == 'new' || $action == 'edit') && $attribute == $identityField) {
                continue;
            }

            $code .= $this->_makeField($attribute, $dataType, $relationField, $selectDefinition);
        }

        return $code;
    }

    /**
     * @param $action
     *
     * @return string
     */
    private function _makeFieldsVolt($action)
    {
        $entity             = $this->options->entity;
        $relationField      = $this->options->relationField;
        $autocompleteFields = $this->options->autocompleteFields;
        $selectDefinition   = $this->options->selectDefinition->toArray();
        $identityField      = $this->options->identityField;

        $code = '';
        foreach ($this->options->dataTypes as $attribute => $dataType) {
            if (($action == 'new' || $action == 'edit') && $attribute == $identityField) {
                continue;
            }

            $code .= $this->_makeFieldVolt($attribute, $dataType, $relationField, $selectDefinition);
        }

        return $code;
    }

    /**
     * Generate controller using scaffold
     */
    private function _makeController()
    {
        $controllerPath = $this->options->controllersDir . $this->options->className . 'Controller.php';

        if (file_exists($controllerPath)) {
            if (!$this->options->contains('force')) {
                return;
            }
        }

        $code = file_get_contents($this->options->templatePath . '/scaffold/no-forms/Controller.php');

        if ($this->options->contains('controllersNamespace') && $this->checkNamespace($this->options->controllersNamespace)) {
            $code = str_replace('$namespace$', 'namespace '.$this->options->controllersNamespace.';'.PHP_EOL, $code);
        } else {
            $code = str_replace('$namespace$', ' ', $code);
        }

        $code = str_replace('$singularVar$', '$' . $this->options->singular, $code);
        $code = str_replace('$singular$', $this->options->singular, $code);

        $code = str_replace('$pluralVar$', '$' . $this->options->plural, $code);
        $code = str_replace('$plural$', $this->options->plural, $code);

        $code = str_replace('$className$', $this->options->className, $code);

        $code = str_replace('$assignInputFromRequestCreate$', $this->_captureFilterInput($this->options->singular, $this->options->dataTypes, $this->options->genSettersGetters, $this->options->identityField), $code);
        $code = str_replace('$assignInputFromRequestUpdate$', $this->_captureFilterInput($this->options->singular, $this->options->dataTypes, $this->options->genSettersGetters, $this->options->identityField), $code);

        $code = str_replace('$assignTagDefaults$', $this->_assignTagDefaults($this->options->singular, $this->options->dataTypes, $this->options->genSettersGetters), $code);

        $code = str_replace('$pkVar$', '$' . $this->options->attributes[0], $code);
        $code = str_replace('$pk$', $this->options->attributes[0], $code);

        if ($this->isConsole()) {
            echo $controllerPath, PHP_EOL;
        }

        $code = str_replace("\t", "    ", $code);
        file_put_contents($controllerPath, $code);
    }

    /**
     * Make layouts of model using scaffold
     *
     * @return $this
     */
    private function _makeLayouts()
    {
        // Make Layouts dir
        $dirPathLayouts = $this->options->viewsDir . 'layouts';

        //If dir doesn't exist we make it
        if (is_dir($dirPathLayouts) == false) {
            mkdir($dirPathLayouts, 0777, true);
        }

        $fileName = $this->options->fileName;
        $viewPath = $dirPathLayouts . DIRECTORY_SEPARATOR . $fileName . '.phtml';
        if (!file_exists($viewPath) || $this->options->contains('force')) {

            // View model layout
            $code = '';
            if ($this->options->contains('theme')) {
                $code .= '<?php $this->tag->stylesheetLink("themes/lightness/style") ?>'.PHP_EOL;
                $code .= '<?php $this->tag->stylesheetLink("themes/base") ?>'.PHP_EOL;
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

        return $this;
    }

    /**
     * Make View layouts
     *
     * @return $this
     */
    private function _makeLayoutsVolt()
    {
        // Make Layouts dir
        $dirPathLayouts = $this->options->viewsDir . 'layouts';

        // If not exists dir; we make it
        if (is_dir($dirPathLayouts) == false) {
            mkdir($dirPathLayouts, 0777, true);
        }

        $fileName = Text::uncamelize($this->options->fileName);
        $viewPath = $dirPathLayouts . DIRECTORY_SEPARATOR . $fileName . '.volt';
        if (!file_exists($viewPath || $this->options->contains('force'))) {

            // View model layout
            $code = '';
            if ($this->options->contains('theme')) {
                $code .= '{{ stylesheet_link("themes/lightness/style") }}'.PHP_EOL;
                $code .= '{{ stylesheet_link("themes/base") }}'.PHP_EOL;
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

        return $this;
    }

    /**
     * @param $type
     *
     * @throws BuilderException
     */
    private function makeView($type)
    {
        $dirPath = $this->options->viewsDir . $this->options->fileName;
        if (is_dir($dirPath) == false) {
            mkdir($dirPath);
        }

        $viewPath = $dirPath . DIRECTORY_SEPARATOR .$type. '.phtml';
        if (file_exists($viewPath)) {
            if (!$this->options->contains('force')) {
                return;
            }
        }

        $templatePath = $this->options->templatePath . '/scaffold/no-forms/views/' .$type. '.phtml';
        if (!file_exists($templatePath)) {
            throw new BuilderException(sprintf('Template "%s" does not exist', $templatePath));
        }

        $code = file_get_contents($templatePath);

        $code = str_replace('$plural$', $this->options->plural, $code);
        $code = str_replace('$captureFields$', self::_makeFields($type), $code);

        if ($this->isConsole()) {
            echo $viewPath, PHP_EOL;
        }

        $code = str_replace("\t", "    ", $code);
        file_put_contents($viewPath, $code);
    }

    /**
     * @param string $type
     *
     * @throws \Phalcon\Builder\BuilderException
     */
    private function makeViewVolt($type)
    {
        $dirPath = $this->options->viewsDir . $this->options->fileName;
        if (is_dir($dirPath) == false) {
            mkdir($dirPath, 0777, true);
        }

        $viewPath = $dirPath . DIRECTORY_SEPARATOR .$type. '.volt';
        if (file_exists($viewPath)) {
            if (!$this->options->contains('force')) {
                return;
            }
        }

        $templatePath = $this->options->templatePath . '/scaffold/no-forms/views/' .$type. '.volt';
        if (!file_exists($templatePath)) {
            throw new BuilderException(sprintf('Template "%s" does not exist.', $templatePath));
        }

        $code = file_get_contents($templatePath);

        $code = str_replace('$plural$', $this->options->plural, $code);
        $code = str_replace('$captureFields$', self::_makeFieldsVolt($type), $code);

        if ($this->isConsole()) {
            echo $viewPath, PHP_EOL;
        }

        $code = str_replace("\t", "    ", $code);
        file_put_contents($viewPath, $code);
    }

    /**
     * Creates the view to display search results
     *
     * @throws \Phalcon\Builder\BuilderException
     */
    private function _makeViewSearch()
    {
        $dirPath = $this->options->viewsDir . $this->options->fileName;
        if (is_dir($dirPath) == false) {
            mkdir($dirPath);
        }

        $viewPath = $dirPath . DIRECTORY_SEPARATOR . 'search.phtml';
        if (file_exists($viewPath) && !$this->options->contains('force')) {
            return;
        }

        $templatePath = $this->options->templatePath . '/scaffold/no-forms/views/search.phtml';
        if (!file_exists($templatePath)) {
            throw new BuilderException(sprintf('Template "%s" does not exist', $templatePath));
        }

        $headerCode = '';
        foreach ($this->options->attributes as $attribute) {
            $headerCode .= "\t\t\t" . '<th>' . $this->_getPossibleLabel($attribute) . '</th>' . PHP_EOL;
        }

        $rowCode = '';
        $this->options->offsetSet('allReferences', array_merge($this->options->autocompleteFields->toArray(), $this->options->selectDefinition->toArray()));
        foreach ($this->options->dataTypes as $fieldName => $dataType) {
            $rowCode .= "\t\t\t" . '<td><?php echo ';
            if (!isset($this->options->allReferences[$fieldName])) {
                if ($this->options->genSettersGetters) {
                    $rowCode .= '$' . $this->options->singular . '->get' . Text::camelize($fieldName) . '()';
                } else {
                    $rowCode .= '$' . $this->options->singular . '->' . $fieldName;
                }
            } else {
                $detailField = ucfirst($this->options->allReferences[$fieldName]['detail']);
                $rowCode .= '$' . $this->options->singular . '->get' . $this->options->allReferences[$fieldName]['tableName'] . '()->get' . $detailField . '()';
            }
            $rowCode .= ' ?></td>' . PHP_EOL;
        }

        $idField =  $this->options->attributes[0];
        if ($this->options->contains('genSettersGetters')) {
            $idField = 'get' . Text::camelize($this->options->attributes[0]) . '()';
        }

        $code = file_get_contents($templatePath);

        $code = str_replace('$plural$', $this->options->plural, $code);
        $code = str_replace('$headerColumns$', $headerCode, $code);
        $code = str_replace('$rowColumns$', $rowCode, $code);
        $code = str_replace('$singularVar$', '$' . $this->options->singular, $code);
        $code = str_replace('$pk$', $idField, $code);

        if ($this->isConsole()) {
            echo $viewPath, PHP_EOL;
        }

        $code = str_replace("\t", "    ", $code);
        file_put_contents($viewPath, $code);
    }

    /**
     * @throws \Phalcon\Builder\BuilderException
     */
    private function _makeViewSearchVolt()
    {
        $dirPath = $this->options->viewsDir . $this->options->fileName;
        if (is_dir($dirPath) == false) {
            mkdir($dirPath);
        }

        $viewPath = $dirPath . DIRECTORY_SEPARATOR . 'search.volt';
        if (file_exists($viewPath)) {
            if (!$this->options->contains('force')) {
                return;
            }
        }

        $templatePath = $this->options->templatePath . '/scaffold/no-forms/views/search.volt';
        if (!file_exists($templatePath)) {
            throw new BuilderException("Template '" . $templatePath . "' does not exist");
        }

        $headerCode = '';
        foreach ($this->options->attributes as $attribute) {
            $headerCode .= "\t\t\t" . '<th>' . $this->_getPossibleLabel($attribute) . '</th>' . PHP_EOL;
        }

        $rowCode = '';
        $this->options->offsetSet('allReferences', array_merge($this->options->autocompleteFields->toArray(), $this->options->selectDefinition->toArray()));
        foreach ($this->options->dataTypes as $fieldName => $dataType) {
            $rowCode .= "\t\t\t" . '<td>{{ ';
            if (!isset($this->options->allReferences[$fieldName])) {
                if ($this->options->contains('genSettersGetters')) {
                    $rowCode .= $this->options->singular . '.get' . Text::camelize($fieldName) . '()';
                } else {
                    $rowCode .= $this->options->singular . '.' . $fieldName;
                }
            } else {
                $detailField = ucfirst($this->options->allReferences[$fieldName]['detail']);
                $rowCode .= $this->options->singular . '.get' . $this->options->allReferences[$fieldName]['tableName'] . '().get' . $detailField . '()';
            }
            $rowCode .= ' }}</td>' . PHP_EOL;
        }

        $idField = $this->options->attributes[0];
        if ($this->options->contains('genSettersGetters')) {
            $idField = 'get' . Text::camelize($this->options->attributes[0]) . '()';
        }

        $code = file_get_contents($templatePath);

        $code = str_replace('$plural$', $this->options->plural, $code);
        $code = str_replace('$headerColumns$', $headerCode, $code);
        $code = str_replace('$rowColumns$', $rowCode, $code);
        $code = str_replace('$singularVar$', $this->options->singular, $code);
        $code = str_replace('$pk$', $idField, $code);

        if ($this->isConsole()) {
            echo $viewPath, PHP_EOL;
        }

        $code = str_replace("\t", "    ", $code);
        file_put_contents($viewPath, $code);
    }
}
