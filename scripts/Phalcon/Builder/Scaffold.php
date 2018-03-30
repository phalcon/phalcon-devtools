<?php

/*
  +------------------------------------------------------------------------+
  | Phalcon Developer Tools                                                |
  +------------------------------------------------------------------------+
  | Copyright (c) 2011-present Phalcon Team (https://www.phalconphp.com)   |
  +------------------------------------------------------------------------+
  | This source file is subject to the New BSD License that is bundled     |
  | with this package in the file LICENSE.txt.                             |
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
use Phalcon\Utils;
use Phalcon\Db\Column;
use Phalcon\Script\Color;
use Phalcon\Di\FactoryDefault;
use Phalcon\Builder\Model as ModelBuilder;

/**
 * ScaffoldBuilderComponent
 *
 * Build CRUDs using Phalcon
 *
 * @package Phalcon\Builder
 */
class Scaffold extends Component
{
    /**
     * @param string $fieldName
     *
     * @return string
     */
    private function getPossibleLabel($fieldName)
    {
        $fieldName = preg_replace('/_id$/', '', $fieldName);
        $fieldName = preg_replace('/_at$/', '', $fieldName);
        $fieldName = preg_replace('/_in$/', '', $fieldName);
        $fieldName = str_replace('_', ' of ', $fieldName);

        return ucwords($fieldName);
    }

    /**
     * @param string $className
     *
     * @return string
     */
    private function getPossibleSingular($className)
    {
        if (substr($className, strlen($className) - 1, 1) == 's') {
            return substr($className, 0, strlen($className) - 1);
        }

        return $className;
    }

    /**
     * @param string $className
     *
     * @return mixed
     */
    private function getPossiblePlural($className)
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
        $name = $this->options->get('name');
        $config = $this->options->get('config');

        if (empty($config->path('database.adapter'))) {
            throw new BuilderException(
                'Adapter was not found in the config. Please specify a config variable [database][adapter].'
            );
        }

        $adapter = 'Mysql';
        if (!empty($config->path('database.adapter'))) {
            $adapter = ucfirst($config->path('database.adapter'));
            $this->isSupportedAdapter($adapter);
        }

        $di = new FactoryDefault();

        $di->set('db', function () use ($adapter, $config) {
            if (is_object($config->path('database'))) {
                $configArray = $config->path('database')->toArray();
            } else {
                $configArray = $config->path('database');
            }

            $adapterName = 'Phalcon\Db\Adapter\Pdo\\' . $adapter;
            unset($configArray['adapter']);

            return new $adapterName($configArray);
        });

        if (empty($config->path('application.modelsDir'))) {
            throw new BuilderException('The builder is unable to find the models directory.');
        }

        $modelPath = $config->path('application.modelsDir');
        if (false == $this->isAbsolutePath($modelPath)) {
            $modelPath = $this->path->getRootPath($config->path('application.modelsDir'));
        }
        $this->options->offsetSet('modelsDir', rtrim($modelPath, '\\/') . DIRECTORY_SEPARATOR);

        if (empty($config->path('application.controllersDir'))) {
            throw new BuilderException('The builder is unable to find the controllers directory.');
        }

        $controllerPath = $config->path('application.controllersDir');
        if (false == $this->isAbsolutePath($controllerPath)) {
            $controllerPath = $this->path->getRootPath($config->path('application.controllersDir'));
        }
        $this->options->offsetSet('controllersDir', rtrim($controllerPath, '\\/') . DIRECTORY_SEPARATOR);

        if (empty($config->path('application.viewsDir'))) {
            throw new BuilderException('The builder is unable to find the views directory.');
        }
        $viewPath = $config->path('application.viewsDir');
        if (false == $this->isAbsolutePath($viewPath)) {
            $viewPath = $this->path->getRootPath($config->path('application.viewsDir'));
        }
        $this->options->offsetSet('viewsDir', $viewPath);


        $this->options->offsetSet('manager', $di->getShared('modelsManager'));
        $this->options->offsetSet('className', Text::camelize($this->options->get('name')));
        $this->options->offsetSet('fileName', Text::uncamelize($this->options->get('className')));

        $modelsNamespace = '';
        if ($this->options->contains('modelsNamespace') &&
            $this->checkNamespace($this->options->get('modelsNamespace'))) {
            $modelsNamespace = $this->options->get('modelsNamespace');
        }

        $modelName = Text::camelize($name);

        if ($modelsNamespace) {
            $modelClass = '\\' . trim($modelsNamespace, '\\') . '\\' . $modelName;
        } else {
            $modelClass = $modelName;
        }

        $modelPath = $this->options->get('modelsDir') . $modelName.'.php';

        if (!file_exists($modelPath) || $this->options->get('force')) {
            $modelBuilder = new ModelBuilder([
                'name'              => $name,
                'schema'            => $this->options->get('schema'),
                'className'         => $this->options->get('className'),
                'fileName'          => $this->options->get('fileName'),
                'genSettersGetters' => $this->options->get('genSettersGetters'),
                'directory'         => $this->options->get('directory'),
                'force'             => $this->options->get('force'),
                'namespace'         => $this->options->get('modelsNamespace'),
                'config'            => $this->options->get('config'),
            ]);

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

        $setParams = [];
        $selectDefinition = [];

        $relationField = '';

        $single = $name;
        $this->options->offsetSet('name', strtolower(Text::camelize($single)));
        $this->options->offsetSet('plural', $this->getPossiblePlural($name));
        $this->options->offsetSet('singular', $this->getPossibleSingular($name));
        $this->options->offsetSet('modelClass', $modelClass);
        $this->options->offsetSet('entity', $entity);
        $this->options->offsetSet('setParams', $setParams);
        $this->options->offsetSet('attributes', $attributes);
        $this->options->offsetSet('dataTypes', $dataTypes);
        $this->options->offsetSet('primaryKeys', $primaryKeys);
        $this->options->offsetSet('identityField', $identityField);
        $this->options->offsetSet('relationField', $relationField);
        $this->options->offsetSet('selectDefinition', $selectDefinition);
        $this->options->offsetSet('autocompleteFields', []);
        $this->options->offsetSet('belongsToDefinitions', []);

        // Build Controller
        $this->makeController();

        if ($this->options->get('templateEngine') == 'volt') {
            // View layouts
            $this->makeLayoutsVolt();

            // View index.phtml
            $this->makeViewVolt('index');

            // View search.phtml
            $this->makeViewSearchVolt();

            // View new.phtml
            $this->makeViewVolt('new');

            // View edit.phtml
            $this->makeViewVolt('edit');
        } else {
            // View layouts
            $this->makeLayouts();

            // View index.phtml
            $this->makeView('index');

            // View search.phtml
            $this->makeViewSearch();

            // View new.phtml
            $this->makeView('new');

            // View edit.phtml
            $this->makeView('edit');
        }

        print Color::success('Scaffold was successfully created.');

        return true;
    }

    /**
     * @param string $var
     * @param mixed $fields
     * @param bool $useGetSetters
     * @param string $identityField
     *
     * @return string
     */
    private function captureFilterInput($var, $fields, $useGetSetters, $identityField)
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

            $code .= '$' . Utils::lowerCamelizeWithDelimiter($var, '-', true) . '->';
            if ($useGetSetters) {
                $code .= 'set' . Utils::lowerCamelizeWithDelimiter($field, '_', true) . '(' . $fieldCode . ')';
            } else {
                $code .= Utils::lowerCamelizeWithDelimiter($field, '-_', true) . ' = ' . $fieldCode;
            }

            $code .= ';' . PHP_EOL . "\t\t";
        }

        return $code;
    }

    /**
     * @param string $var
     * @param mixed $fields
     * @param bool $useGetSetters
     *
     * @return string
     */
    private function assignTagDefaults($var, $fields, $useGetSetters)
    {
        $code = '';
        foreach ($fields as $field => $dataType) {
            if ($useGetSetters) {
                $accessor = 'get' . Text::camelize($field) . '()';
            } else {
                $accessor = $field;
            }

            $code .= '$this->tag->setDefault("' . $field . '", $' .
                Utils::lowerCamelizeWithDelimiter($var, '-', true) . '->' . $accessor . ');' . PHP_EOL . "\t\t\t";
        }

        return $code;
    }

    /**
     * @param string $attribute
     * @param int $dataType
     * @param mixed $relationField
     * @param array $selectDefinition
     *
     * @return string
     */
    private function makeField($attribute, $dataType, $relationField, $selectDefinition)
    {
        $id = 'field' . Text::camelize($attribute);
        $code = '<div class="form-group">' . PHP_EOL . "\t" . '<label for="' . $id .
            '" class="col-sm-2 control-label">' . $this->getPossibleLabel($attribute) . '</label>' . PHP_EOL .
            "\t" . '<div class="col-sm-10">' . PHP_EOL;

        if (isset($relationField[$attribute])) {
            $code .= "\t\t" . '<?php echo $this->tag->select(["' . $attribute . '", $' .
                $selectDefinition[$attribute]['varName'] . ', "using" => "' .
                $selectDefinition[$attribute]['primaryKey'] . ',' . $selectDefinition[$attribute]['detail'] .
                '", "useDummy" => true), "class" => "form-control", "id" => "' . $id . '"] ?>';
        } else {
            switch ($dataType) {
                case 5: // enum
                    $code .= "\t\t" . '<?php echo $this->tag->selectStatic(["' . $attribute .
                        '", [], "class" => "form-control", "id" => "' . $id . '"]) ?>';
                    break;
                case Column::TYPE_CHAR:
                    $code .=  "\t\t" . '<?php echo $this->tag->textField(["' . $attribute .
                        '", "class" => "form-control", "id" => "' . $id . '"]) ?>';
                    break;
                case Column::TYPE_DECIMAL:
                case Column::TYPE_INTEGER:
                    $code .= "\t\t" . '<?php echo $this->tag->textField(["' . $attribute .
                        '", "type" => "number", "class" => "form-control", "id" => "' . $id . '"]) ?>';
                    break;
                case Column::TYPE_DATE:
                    $code .= "\t\t" . '<?php echo $this->tag->textField(["' . $attribute .
                        '", "type" => "date", "class" => "form-control", "id" => "' . $id . '"]) ?>';
                    break;
                case Column::TYPE_TEXT:
                    $code .= "\t\t" . '<?php echo $this->tag->textArea(["' . $attribute .
                        '", "cols" => 30, "rows" => 4, "class" => "form-control", "id" => "' . $id . '"]) ?>';
                    break;
                default:
                    $code .= "\t\t" . '<?php echo $this->tag->textField(["' . $attribute .
                        '", "size" => 30, "class" => "form-control", "id" => "' . $id . '"]) ?>';
                    break;
            }
        }

        $code .= PHP_EOL . "\t" . '</div>' . PHP_EOL;
        $code .= '</div>' . PHP_EOL . PHP_EOL;

        return str_replace("\t", '    ', $code);
    }

    /**
     * @param string $attribute
     * @param int $dataType
     * @param mixed $relationField
     * @param array $selectDefinition
     *
     * @return string
     */
    private function makeFieldVolt($attribute, $dataType, $relationField, $selectDefinition)
    {
        $id = 'field' . Text::camelize($attribute);
        $code = '<div class="form-group">' . PHP_EOL . "\t" . '<label for="' . $id .
            '" class="col-sm-2 control-label">' . $this->getPossibleLabel($attribute) . '</label>' . PHP_EOL . "\t" .
            '<div class="col-sm-10">' . PHP_EOL;

        if (isset($relationField[$attribute])) {
            $code .= "\t\t" . '{{ select("' . $attribute . '", ' . $selectDefinition[$attribute]['varName'] .
                ', "using" :[ "' . $selectDefinition[$attribute]['primaryKey'] . ',' .
                $selectDefinition[$attribute]['detail'] .
                '", "useDummy" => true], "class" : "form-control", "id" : "' . $id . '") }}';
        } else {
            switch ($dataType) {
                case 5: // enum
                    $code .= "\t\t" . '{{ select_static("' . $attribute .
                        '", "using": [], "class" : "form-control", "id" : "' . $id . '") }}';
                    break;
                case Column::TYPE_CHAR:
                    $code .= "\t\t" . '{{ text_field("' . $attribute .
                        '", "class" : "form-control", "id" : "' . $id . '") }}';
                    break;
                case Column::TYPE_DECIMAL:
                case Column::TYPE_INTEGER:
                    $code .= "\t\t" . '{{ text_field("' . $attribute .
                        '", "type" : "numeric", "class" : "form-control", "id" : "' . $id . '") }}';
                    break;
                case Column::TYPE_DATE:
                    $code .= "\t\t" . '{{ text_field("' . $attribute .
                        '", "type" : "date", "class" : "form-control", "id" : "' . $id . '") }}';
                    break;
                case Column::TYPE_TEXT:
                    $code .= "\t\t" . '{{ text_area("' . $attribute .
                        '", "cols": "30", "rows": "4", "class" : "form-control", "id" : "' . $id . '") }}';
                    break;
                default:
                    $code .= "\t\t" . '{{ text_field("' . $attribute .
                        '", "size" : 30, "class" : "form-control", "id" : "' . $id . '") }}';
                    break;
            }
        }

        $code .= PHP_EOL . "\t" . '</div>' . PHP_EOL;
        $code .= '</div>' . PHP_EOL . PHP_EOL;

        return str_replace("\t", '    ', $code);
    }

    /**
     * Build fields for different actions
     *
     * @param  string $action
     * @return string
     */
    private function makeFields($action)
    {
        $entity             = $this->options->get('entity');
        $relationField      = $this->options->get('relationField');
        $autocompleteFields = $this->options->get('autocompleteFields');
        $selectDefinition   = $this->options->get('selectDefinition')->toArray();
        $identityField      = $this->options->get('identityField');

        $code = '';
        foreach ($this->options->get('dataTypes') as $attribute => $dataType) {
            if (($action == 'new' || $action == 'edit') && $attribute == $identityField) {
                continue;
            }

            $code .= $this->makeField($attribute, $dataType, $relationField, $selectDefinition);
        }

        return $code;
    }

    /**
     * @param string $action
     *
     * @return string
     */
    private function makeFieldsVolt($action)
    {
        $entity             = $this->options->get('entity');
        $relationField      = $this->options->get('relationField');
        $autocompleteFields = $this->options->get('autocompleteFields');
        $selectDefinition   = $this->options->get('selectDefinition')->toArray();
        $identityField      = $this->options->get('identityField');

        $code = '';
        foreach ($this->options->get('dataTypes') as $attribute => $dataType) {
            if (($action == 'new' || $action == 'edit') && $attribute == $identityField) {
                continue;
            }

            $code .= $this->makeFieldVolt($attribute, $dataType, $relationField, $selectDefinition);
        }

        return $code;
    }

    /**
     * Generate controller using scaffold
     */
    private function makeController()
    {
        $controllerPath = $this->options->get('controllersDir') . $this->options->get('className') . 'Controller.php';

        if (file_exists($controllerPath)) {
            if (!$this->options->contains('force')) {
                return;
            }
        }

        $code = file_get_contents($this->options->get('templatePath') . '/scaffold/no-forms/Controller.php');
        $usesNamespaces = false;

        if ($this->options->contains('controllersNamespace') &&
            $this->checkNamespace($this->options->get('controllersNamespace'))) {
            $code = str_replace(
                '$namespace$',
                'namespace ' . $this->options->get('controllersNamespace').';' . PHP_EOL,
                $code
            );
            $usesNamespaces = true;
        } else {
            $code = str_replace('$namespace$', ' ', $code);
        }

        if (($this->options->contains('modelsNamespace') &&
                $this->checkNamespace($this->options->get('modelsNamespace'))) || $usesNamespaces) {
            $code = str_replace(
                '$useFullyQualifiedModelName$',
                "use " . ltrim($this->options->get('modelClass'), '\\') . ';',
                $code
            );
        } else {
            $code = str_replace('$useFullyQualifiedModelName$', '', $code);
        }

        $code = str_replace('$fullyQualifiedModelName$', $this->options->get('modelClass'), $code);

        $code = str_replace(
            '$singularVar$',
            '$' . Utils::lowerCamelizeWithDelimiter($this->options->get('singular'), '-', true),
            $code
        );
        $code = str_replace('$singular$', $this->options->get('singular'), $code);

        $code = str_replace(
            '$pluralVar$',
            '$' . Utils::lowerCamelizeWithDelimiter($this->options->get('plural'), '-', true),
            $code
        );
        $code = str_replace('$plural$', $this->options->get('plural'), $code);

        $code = str_replace('$className$', $this->options->get('className'), $code);

        $code = str_replace('$assignInputFromRequestCreate$', $this->captureFilterInput(
            $this->options->get('singular'),
            $this->options->get('dataTypes'),
            $this->options->get('genSettersGetters'),
            $this->options->get('identityField')
        ), $code);

        $code = str_replace('$assignInputFromRequestUpdate$', $this->captureFilterInput(
            $this->options->get('singular'),
            $this->options->get('dataTypes'),
            $this->options->get('genSettersGetters'),
            $this->options->get('identityField')
        ), $code);

        $code = str_replace('$assignTagDefaults$', $this->assignTagDefaults(
            $this->options->get('singular'),
            $this->options->get('dataTypes'),
            $this->options->get('genSettersGetters')
        ), $code);

        $attributes = $this->options->get('attributes');

        $code = str_replace('$pkVar$', '$' . $attributes[0], $code);

        if ($this->options->get('genSettersGetters')) {
            $code = str_replace('$pkGet$', 'get' . Text::camelize($attributes[0]) . '()', $code);
        } else {
            $code = str_replace('$pkGet$', $attributes[0], $code);
        }
        $code = str_replace('$pk$', $attributes[0], $code);

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
    private function makeLayouts()
    {
        // Make Layouts dir
        $dirPathLayouts = $this->options->get('viewsDir') . 'layouts';

        //If dir doesn't exist we make it
        if (is_dir($dirPathLayouts) == false) {
            mkdir($dirPathLayouts, 0777, true);
        }

        $fileName = $this->options->get('fileName');
        $viewPath = $dirPathLayouts . DIRECTORY_SEPARATOR . $fileName . '.phtml';
        if (!file_exists($viewPath) || $this->options->contains('force')) {
            // View model layout
            $code = '';
            if ($this->options->contains('theme')) {
                $code .= '<?php $this->tag->stylesheetLink("themes/lightness/style") ?>'.PHP_EOL;
                $code .= '<?php $this->tag->stylesheetLink("themes/base") ?>'.PHP_EOL;
                $code .= '<div class="ui-layout" align="center">' . PHP_EOL;
            } else {
                $code .= '<div class="row center-block">' . PHP_EOL;
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
    private function makeLayoutsVolt()
    {
        // Make Layouts dir
        $dirPathLayouts = $this->options->get('viewsDir') . 'layouts';

        // If not exists dir; we make it
        if (is_dir($dirPathLayouts) == false) {
            mkdir($dirPathLayouts, 0777, true);
        }

        $fileName = Text::uncamelize($this->options->get('fileName'));
        $viewPath = $dirPathLayouts . DIRECTORY_SEPARATOR . $fileName . '.volt';
        if (!file_exists($viewPath) || $this->options->contains('force')) {
            // View model layout
            $code = '';
            if ($this->options->contains('theme')) {
                $code .= '{{ stylesheet_link("themes/lightness/style") }}'.PHP_EOL;
                $code .= '{{ stylesheet_link("themes/base") }}'.PHP_EOL;
                $code .= '<div class="ui-layout" align="center">' . PHP_EOL;
            } else {
                $code .= '<div class="row center-block">' . PHP_EOL;
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
     * @param string $type
     *
     * @throws BuilderException
     */
    private function makeView($type)
    {
        $dirPath = $this->options->get('viewsDir') . $this->options->get('fileName');
        if (is_dir($dirPath) == false) {
            mkdir($dirPath);
        }

        $viewPath = $dirPath . DIRECTORY_SEPARATOR .$type. '.phtml';
        if (file_exists($viewPath)) {
            if (!$this->options->contains('force')) {
                return;
            }
        }

        $templatePath = $this->options->get('templatePath') . '/scaffold/no-forms/views/' .$type. '.phtml';
        if (!file_exists($templatePath)) {
            throw new BuilderException(sprintf('Template "%s" does not exist', $templatePath));
        }

        $code = file_get_contents($templatePath);

        $code = str_replace('$plural$', $this->options->get('plural'), $code);
        $code = str_replace('$captureFields$', self::makeFields($type), $code);

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
        $dirPath = $this->options->get('viewsDir') . $this->options->get('fileName');
        if (is_dir($dirPath) == false) {
            mkdir($dirPath, 0777, true);
        }

        $viewPath = $dirPath . DIRECTORY_SEPARATOR . $type . '.volt';
        if (file_exists($viewPath)) {
            if (!$this->options->contains('force')) {
                return;
            }
        }

        $templatePath = $this->options->get('templatePath') . '/scaffold/no-forms/views/' . $type . '.volt';
        if (!file_exists($templatePath)) {
            throw new BuilderException(sprintf('Template "%s" does not exist.', $templatePath));
        }

        $code = file_get_contents($templatePath);

        $code = str_replace('$plural$', $this->options->get('plural'), $code);
        $code = str_replace('$captureFields$', self::makeFieldsVolt($type), $code);

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
    private function makeViewSearch()
    {
        $dirPath = $this->options->get('viewsDir') . $this->options->get('fileName');
        if (is_dir($dirPath) == false) {
            mkdir($dirPath);
        }

        $viewPath = $dirPath . DIRECTORY_SEPARATOR . 'search.phtml';
        if (file_exists($viewPath) && !$this->options->contains('force')) {
            return;
        }

        $templatePath = $this->options->get('templatePath') . '/scaffold/no-forms/views/search.phtml';
        if (!file_exists($templatePath)) {
            throw new BuilderException(sprintf('Template "%s" does not exist', $templatePath));
        }

        $headerCode = '';
        foreach ($this->options->get('attributes') as $attribute) {
            $headerCode .= "\t\t\t" . '<th>' . $this->getPossibleLabel($attribute) . '</th>' . PHP_EOL;
        }

        $rowCode = '';
        $this->options->offsetSet('allReferences', array_merge(
            $this->options->get('autocompleteFields')->toArray(),
            $this->options->get('selectDefinition')->toArray()
        ));
        foreach ($this->options->get('dataTypes') as $fieldName => $dataType) {
            $rowCode .= "\t\t\t" . '<td><?php echo ';
            if (!isset($this->options->get('allReferences')[$fieldName])) {
                if ($this->options->get('genSettersGetters')) {
                    $rowCode .= '$' . Utils::lowerCamelizeWithDelimiter($this->options->get('singular'), '-', true) .
                        '->get' . Text::camelize($fieldName) . '()';
                } else {
                    $rowCode .= '$' . $this->options->get('singular') . '->' . $fieldName;
                }
            } else {
                $detailField = ucfirst($this->options->get('allReferences')[$fieldName]['detail']);
                $rowCode .= '$' . $this->options->get('singular') . '->get' .
                    $this->options->get('allReferences')[$fieldName]['tableName'] . '()->get' . $detailField . '()';
            }
            $rowCode .= ' ?></td>' . PHP_EOL;
        }

        $idField =  $this->options->get('attributes')[0];
        if ($this->options->contains('genSettersGetters')) {
            $idField = 'get' . Text::camelize($this->options->get('attributes')[0]) . '()';
        }

        $code = file_get_contents($templatePath);

        $code = str_replace('$plural$', $this->options->get('plural'), $code);
        $code = str_replace('$headerColumns$', $headerCode, $code);
        $code = str_replace('$rowColumns$', $rowCode, $code);
        $code = str_replace(
            '$singularVar$',
            '$' . Utils::lowerCamelizeWithDelimiter($this->options->get('singular'), '-', true),
            $code
        );
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
    private function makeViewSearchVolt()
    {
        $dirPath = $this->options->get('viewsDir') . $this->options->get('fileName');
        if (is_dir($dirPath) == false) {
            mkdir($dirPath);
        }

        $viewPath = $dirPath . DIRECTORY_SEPARATOR . 'search.volt';
        if (file_exists($viewPath)) {
            if (!$this->options->contains('force')) {
                return;
            }
        }

        $templatePath = $this->options->get('templatePath') . '/scaffold/no-forms/views/search.volt';
        if (!file_exists($templatePath)) {
            throw new BuilderException("Template '" . $templatePath . "' does not exist");
        }

        $headerCode = '';
        foreach ($this->options->get('attributes') as $attribute) {
            $headerCode .= "\t\t\t" . '<th>' . $this->getPossibleLabel($attribute) . '</th>' . PHP_EOL;
        }

        $rowCode = '';
        $this->options->offsetSet('allReferences', array_merge(
            $this->options->get('autocompleteFields')->toArray(),
            $this->options->get('selectDefinition')->toArray()
        ));
        foreach ($this->options->get('dataTypes') as $fieldName => $dataType) {
            $rowCode .= "\t\t\t" . '<td>{{ ';
            if (!isset($this->options->get('allReferences')[$fieldName])) {
                if ($this->options->contains('genSettersGetters')) {
                    $rowCode .= Utils::lowerCamelizeWithDelimiter($this->options->get('singular'), '-', true) .
                        '.get' . Text::camelize($fieldName) . '()';
                } else {
                    $rowCode .= $this->options->get('singular') . '.' . $fieldName;
                }
            } else {
                $detailField = ucfirst($this->options->get('allReferences')[$fieldName]['detail']);
                $rowCode .= $this->options->get('singular') . '.get' .
                    $this->options->get('allReferences')[$fieldName]['tableName'] . '().get' . $detailField . '()';
            }
            $rowCode .= ' }}</td>' . PHP_EOL;
        }

        $idField = $this->options->get('attributes')[0];
        if ($this->options->contains('genSettersGetters')) {
            $idField = 'get' . Text::camelize($this->options->get('attributes')[0]) . '()';
        }

        $code = file_get_contents($templatePath);

        $code = str_replace('$plural$', $this->options->get('plural'), $code);
        $code = str_replace('$headerColumns$', $headerCode, $code);
        $code = str_replace('$rowColumns$', $rowCode, $code);
        $code = str_replace(
            '$singularVar$',
            Utils::lowerCamelizeWithDelimiter($this->options->get('singular'), '-', true),
            $code
        );
        $code = str_replace('$pk$', $idField, $code);

        if ($this->isConsole()) {
            echo $viewPath, PHP_EOL;
        }

        $code = str_replace("\t", "    ", $code);
        file_put_contents($viewPath, $code);
    }
}
