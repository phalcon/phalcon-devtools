<?php

declare(strict_types=1);

/**
 * This file is part of the Phalcon Developer Tools.
 *
 * (c) Phalcon Team <team@phalcon.io>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace Phalcon\DevTools\Builder\Component;

use Nette\PhpGenerator\PsrPrinter;
use Phalcon\Db\Adapter\Pdo\AbstractPdo;
use Phalcon\Db\Column;
use Phalcon\DevTools\Builder\Exception\BuilderException;
use Phalcon\DevTools\Exception\InvalidArgumentException;
use Phalcon\DevTools\Exception\InvalidParameterException;
use Phalcon\DevTools\Exception\RuntimeException;
use Phalcon\DevTools\Exception\WriteFileException;
use Phalcon\DevTools\Generator\Entity\ModelEntityGenerator;
use Phalcon\DevTools\Generator\Helper\MethodArgumentDto;
use Phalcon\DevTools\Generator\Helper\ModelMethodsHelper;
use Phalcon\DevTools\Options\OptionsAware as ModelOption;
use Phalcon\DevTools\Snippet\ModelSnippet;
use Phalcon\DevTools\Utils;
use Phalcon\Mvc\Model\ResultInterface;
use Phalcon\Mvc\Model\ResultsetInterface;
use Phalcon\Mvc\ModelInterface;
use Phalcon\Text;
use Phalcon\Validation;
use Phalcon\Validation\Validator\Email as EmailValidator;
use ReflectionClassConstant;
use ReflectionProperty;
use Roave\BetterReflection\Reflection\ReflectionClass;

/**
 * Builder to generate models
 */
class Model extends AbstractComponent
{
    /**
     * Map of scalar data objects
     *
     * @var array
     */
    private $typeMap = [
        //'Date' => 'Date',
        //'Decimal' => 'Decimal'
    ];
    /**
     * Options container
     *
     * @var ModelOption
     */
    protected $modelOptions;

    /**
     * Create Builder object
     *
     * @param array $options
     *
     * @throws InvalidArgumentException
     */
    public function __construct(array $options)
    {
        $this->modelOptions = new ModelOption($options);

        if (!$this->modelOptions->hasOption('name')) {
            throw new InvalidArgumentException('Please, specify the table name');
        }

        $this->modelOptions->setNotDefinedOption('camelize', false);
        $this->modelOptions->setNotDefinedOption('force', false);
        $this->modelOptions->setNotDefinedOption(
            'className',
            Utils::lowerCamelizeWithDelimiter($options['name'], '_-')
        );
        $this->modelOptions->setNotDefinedOption('fileName', Utils::lowerCamelizeWithDelimiter($options['name'], '_-'));
        $this->modelOptions->setNotDefinedOption('abstract', false);
        $this->modelOptions->setNotDefinedOption('annotate', false);

        if ($this->modelOptions->getOption('abstract')) {
            $this->modelOptions->setOption('className', 'Abstract' . $this->modelOptions->getOption('className'));
        }

        parent::__construct($options);

        $this->modelOptions->setOption('config', $this->modelOptions->getOption('config'));
        $this->modelOptions->setOption('snippet', new ModelSnippet());
    }

    /**
     * Module build
     *
     * @throws BuilderException
     */
    public function build(): void
    {
        /** @var ModelSnippet $snippet */
        $snippet = $this->modelOptions->getOption('snippet');
        $config = $this->modelOptions->getOption('config');

        if ($this->modelOptions->hasOption('directory')) {
            $this->path->setRootPath($this->modelOptions->getOption('directory'));
        }

        $methodRawCode = [];
        $this->setModelsDir();
        $modelPath = $this->setModelPath();
        if (file_exists($modelPath) && !is_writable($modelPath)) {
            throw new WriteFileException(sprintf('Unable to write to %s. Check write-access of a file.', $modelPath));
        }

        $db = $this->getDb($config);

        $namespace = $this->modelOptions->getValidOptionOrDefault('namespace', '');
        if (!$this->checkNamespace($namespace) || empty(trim($namespace))) {
            $namespace = null;
        }
        $baseClass = $this->modelOptions->getValidOptionOrDefault('extends', \Phalcon\Mvc\Model::class);
        $className = $this->modelOptions->getOption('className');
        $fullClassName = $this->getFullClassName($this->modelOptions->getOption('className'));
        $modelGenerator = new ModelEntityGenerator($className, $baseClass, $namespace);
        $modelMethodsHelper = new ModelMethodsHelper();
        $modelGenerator->setMethodsHelper($modelMethodsHelper);

        $genDocMethods = $this->modelOptions->getValidOptionOrDefault('genDocMethods', false);
        $useSettersGetters = $this->modelOptions->getValidOptionOrDefault('genSettersGetters', false);
        $schema = $this->modelOptions->getValidOptionOrDefault('schema', Utils::resolveDbSchema($config->database));

        $table = $this->modelOptions->getOption('name');
        if (!$db->tableExists($table, $schema)) {
            throw new InvalidArgumentException(sprintf('Table "%s" does not exist.', $table));
        }
        $fields = $db->describeColumns($table, $schema);

        if (file_exists($modelPath)) {
            try {
                /** @noinspection PhpIncludeInspection */
                require_once $modelPath;

                $linesCode = file($modelPath);
                $imports = preg_grep('/^use\s(.*);$/', $linesCode);
                foreach ($imports as $import) {
                    $importClass = trim(str_replace(['use', ';'], '', $import));
                    $modelGenerator->addImport($importClass);
                }

                $reflection = ReflectionClass::createFromName($fullClassName);

                $possibleMethods = [];
                if ($useSettersGetters) {
                    foreach ($fields as $field) {
                        /** @var Column $field */
                        $methodName = Text::camelize($field->getName(), '_-');

                        $possibleMethods['set' . $methodName] = true;
                        $possibleMethods['get' . $methodName] = true;
                    }
                }
                $modelGenerator->createMethodsFromReflection(
                    $fullClassName,
                    $reflection,
                    $possibleMethods
                );

                $possibleFieldsTransformed = [];
                foreach ($fields as $field) {
                    $fieldName = $this->getFieldName($field->getName());
                    $possibleFieldsTransformed[$fieldName] = true;
                }
                $modelGenerator->createPropertiesFromReflection(
                    $fullClassName,
                    $reflection,
                    $possibleFieldsTransformed
                );

                $modelGenerator->createConstantsFromReflection($fullClassName, $reflection);
            } catch (\Throwable $throwable) {
                throw new RuntimeException(
                    sprintf('Failed to create the model "%s". Error: %s', $className, $throwable->getMessage())
                );
            }
        }

        // Check if there have been any excluded fields
        $exclude = [];
        if ($this->modelOptions->hasOption('excludeFields')) {
            $keys = explode(',', $this->modelOptions->getOption('excludeFields'));
            if (count($keys) > 0) {
                foreach ($keys as $key) {
                    $exclude[trim($key)] = true;
                }
            }
        }

        foreach ($fields as $field) {
            if (isset($exclude[strtolower($field->getName())])) {
                continue;
            }

            $type = $this->getPHPType($field->getType());
            $fieldName = $this->getFieldName($field->getName());
            $modelGenerator->addPropertyFromColumn(
                $field,
                $fieldName,
                $type,
                $useSettersGetters ? 'protected' : 'public',
                $this->modelOptions->getValidOptionOrDefault('annotate', false)
            );

            if ($useSettersGetters) {
                $methodName = Utils::camelize($field->getName(), '_-');
                $modelGenerator->addSetter($field, $methodName, $type, $fieldName);
                $modelGenerator->addGetter($field, $methodName, $type, $fieldName, $this->typeMap);
            }
        }

        if (!$modelMethodsHelper->alreadyValidations()) {
            $validations = [];
            foreach ($fields as $field) {
                $fieldName = $this->getFieldName($field->getName());

                if ($field->getType() === Column::TYPE_CHAR) {
                    $domain = [];
                    if (preg_match('/\((.*)\)/', (string)$field->getType(), $matches)) {
                        foreach (explode(',', $matches[1]) as $item) {
                            $domain[] = $item;
                        }
                    }
                    if (count($domain)) {
                        $varItems = join(', ', $domain);
                        $validations[] = $snippet->getValidateInclusion($fieldName, $varItems);
                    }
                }

                if ($field->getName() === 'email') {
                    $validations[] = $snippet->getValidateEmail($fieldName);
                    $modelGenerator->addImport(EmailValidator::class, 'EmailValidator');
                }
            }

            if (count($validations)) {
                array_unshift($validations, '$validator = new Validation();');
                $validations[] = 'return $this->validate($validator);';

                $modelGenerator->addMethod('validation')
                    ->setBody(implode('', $validations))
                    ->addComments([
                        "Validations and business logic\n",
                        '@return bool',
                    ]);
                $modelGenerator->addImport(Validation::class);
            }
        }

        if (!$modelMethodsHelper->alreadyInitialized()) {
            $initialize = [];
            if ($schema) {
                $initialize['schema'] = "\$this->setSchema('{$schema}');" . PHP_EOL;
            }
            $initialize['source'] = "\$this->setSource('{$table}');" . PHP_EOL;

            $referenceList = $this->getReferenceList($schema, $db);
            foreach ($referenceList as $tableName => $references) {
                foreach ($references as $reference) {
                    if ($reference->getReferencedTable() !== $table) {
                        continue;
                    }

                    $refColumns = $reference->getReferencedColumns();
                    $columns = $reference->getColumns();
                    $initialize[] = $snippet->getRelation(
                        'hasMany',
                        $this->getFieldName($refColumns[0]),
                        $this->getEntityClassName($tableName),
                        $this->getFieldName($columns[0]),
                        $this->getEntityAlias($tableName)
                    );
                }
            }

            foreach ($db->describeReferences($table, $schema) as $reference) {
                $refColumns = $reference->getReferencedColumns();
                $columns = $reference->getColumns();
                $initialize[] = $snippet->getRelation(
                    'belongsTo',
                    $this->getFieldName($columns[0]),
                    $this->getEntityClassName($reference->getReferencedTable()),
                    $this->getFieldName($refColumns[0]),
                    $this->getEntityAlias($reference->getReferencedTable())
                );
            }

            $modelGenerator->addMethod('initialize')
                ->setBody(implode('', $initialize))
                ->addComments(['Initialize method for model.']);
        }

        if (!$modelMethodsHelper->alreadyFind()) {
            $modelGenerator->addMethod('find')
                ->setStatic()
                ->setBody('return parent::find($parameters);')
                ->setReturnType(ResultsetInterface::class)
                ->addArguments([
                    new MethodArgumentDto('parameters', null, false, null),
                ])
                ->addComments([
                    "Allows to query a set of records that match the specified conditions\n",
                    '@param mixed $parameters',
                    "@return {$className}[]|{$className}|ResultSetInterface",
                ]);
            $modelGenerator->addImport(ResultsetInterface::class);
        }

        if (!$modelMethodsHelper->alreadyFindFirst()) {
            $modelGenerator->addMethod('findFirst')
                ->setStatic()
                ->setBody('return parent::findFirst($parameters);')
                ->setReturnType(ModelInterface::class, true)
                ->addArguments([
                    new MethodArgumentDto('parameters', null, false, null),
                ])
                ->addComments([
                    "Allows to query the first record that match the specified conditions\n",
                    '@param mixed $parameters',
                    "@return {$className}|ResultInterface|ModelInterface|null",
                ]);
            $modelGenerator->addImport(ResultInterface::class);
            $modelGenerator->addImport(ModelInterface::class);
        }

        if ($genDocMethods) {
            $modelGenerator->addClassComments([
                $className,
                !empty($namespace) ? '@package ' . str_replace(['namespace ', ';', "\r", "\n"], '', $namespace) : '',
                '@autogenerated by Phalcon Developer Tools',
                '@date ' . date('Y-m-d, H:i:s'),
            ]);
        }

        if ($this->modelOptions->hasOption('mapColumn') &&
            $this->modelOptions->getOption('mapColumn') &&
            !$modelMethodsHelper->alreadyColumnMapped()
        ) {
            $modelGenerator->addMethod('columnMap')
                ->setBody(
                    $snippet->getColumnMap(
                        $fields,
                        $this->modelOptions->getValidOptionOrDefault('camelize', false)
                    )
                )
                ->addComments([
                    'Independent Column Mapping.',
                    "Keys are the real names in the table and the values their names in the application\n",
                    '@return array',
                ]);
        }

        $abstract = $this->modelOptions->getValidOptionOrDefault('abstract', false);
        if ($abstract) {
            $modelGenerator->setClassAbstract();
        }

        $code = $this->setLicense($modelGenerator);
        if (!file_put_contents($modelPath, $code)) {
            throw new WriteFileException(sprintf('Unable to write to %s', $modelPath));
        }

        if ($this->isConsole()) {
            $msgSuccess = $abstract ? 'Abstract ' : '';
            $msgSuccess .= 'Model "%s" was successfully created.';
            $this->notifySuccess(sprintf($msgSuccess, Text::camelize($table, '_-')));
        }
    }

    protected function setLicense(ModelEntityGenerator $modelGenerator): string
    {
        if (file_exists('license.txt')) {
            $license = trim(file_get_contents('license.txt')) . PHP_EOL . PHP_EOL;
            if (false !== strpos($license, '*')) {
                return str_replace(
                    '<?php' . PHP_EOL . PHP_EOL,
                    '<?php' . PHP_EOL . PHP_EOL . $license,
                    $modelGenerator->printCode(new PsrPrinter())
                );
            }

            $licenseLines = explode("\n", $license);
            $modelGenerator->addComments($licenseLines);
        }

        return $modelGenerator->printCode(new PsrPrinter());
    }

    /**
     * Set path to folder where models are
     *
     * @throw InvalidParameterException
     */
    protected function setModelsDir(): void
    {
        if ($this->modelOptions->hasOption('modelsDir')) {
            $this->modelOptions->setOption(
                'modelsDir',
                rtrim($this->modelOptions->getOption('modelsDir'), '/\\') . DIRECTORY_SEPARATOR
            );

            return;
        }

        if ($modelsDir = $this->modelOptions->getOption('config')->path('application.modelsDir')) {
            $this->modelOptions->setOption('modelsDir', rtrim($modelsDir, '/\\') . DIRECTORY_SEPARATOR);

            return;
        }

        throw new InvalidParameterException("Builder doesn't know where is the models directory.");
    }

    /**
     * Set path to model
     *
     * @throw WriteFileException
     */
    protected function setModelPath(): string
    {
        $modelPath = $this->modelOptions->getOption('modelsDir');

        if (!$this->isAbsolutePath($modelPath)) {
            $modelPath = $this->path->getRootPath($modelPath);
        }

        $modelPath .= $this->modelOptions->getOption('className') . '.php';

        if (file_exists($modelPath) && !$this->modelOptions->getOption('force')) {
            throw new WriteFileException(
                sprintf(
                    'The model file "%s.php" already exists in models dir',
                    $this->modelOptions->getOption('className')
                )
            );
        }

        $this->modelOptions->setOption('modelPath', $modelPath);

        return $modelPath;
    }

    /**
     * @throw InvalidParameterException
     */
    protected function checkDatabaseParam(): void
    {
        if (!isset($this->modelOptions->getOption('config')->database)) {
            throw new InvalidParameterException('Database configuration cannot be loaded from your config file.');
        }

        if (!isset($this->modelOptions->getOption('config')->database->adapter)) {
            throw new InvalidParameterException(
                "Adapter was not found in the config. " . "Please specify a config variable [database][adapter]"
            );
        }
    }

    /**
     * @throws BuilderException
     */
    protected function getDb($config): AbstractPdo
    {
        $this->checkDatabaseParam();
        if (isset($config->devtools->loader)) {
            /** @noinspection PhpIncludeInspection */
            require_once $config->devtools->loader;
        }

        $adapter = $config->database->adapter ?? 'Mysql';
        $this->isSupportedAdapter($adapter);
        $configArray = is_object($config->database) ? $config->database->toArray() : $config->database;

        $adapterName = "\Phalcon\Db\Adapter\Pdo\\{$adapter}";
        unset($configArray['adapter']);

        return new $adapterName($configArray);
    }

    /**
     * @param array $linesCode
     * @param string $pattern
     * @param ReflectionProperty|ReflectionClassConstant $attribute
     *
     * @return null|string
     */
    protected function getAttribute(array $linesCode, string $pattern, $attribute): ?string
    {
        $endLine = $startLine = 0;
        foreach ($linesCode as $line => $code) {
            if (preg_match($pattern, $code)) {
                $startLine = $line;
                break;
            }
        }
        if (!empty($startLine)) {
            $countLines = count($linesCode);
            for ($i = $startLine; $i < $countLines; $i++) {
                if (preg_match('/;(\s*)$/', $linesCode[$i])) {
                    $endLine = $i;
                    break;
                }
            }
        }

        if (!empty($startLine) && !empty($endLine)) {
            $attributeDeclaration = join(
                '',
                array_slice(
                    $linesCode,
                    $startLine,
                    $endLine - $startLine + 1
                )
            );
            $attributeFormatted = $attributeDeclaration;
            if (!empty($attribute->getDocComment())) {
                $attributeFormatted = "    " . $attribute->getDocComment() . PHP_EOL . $attribute;
            }

            return $attributeFormatted;
        }

        return null;
    }

    /**
     * @param string $fieldName
     *
     * @return string
     */
    protected function getFieldName(string $fieldName): string
    {
        if ($this->modelOptions->getOption('camelize')) {
            return Utils::lowerCamelize(Utils::camelize($fieldName, '_-'));
        }

        return Utils::lowerCamelizeWithDelimiter($fieldName, '-', true);
    }

    /**
     * @param string $tableName
     *
     * @return string
     */
    protected function getEntityAlias(string $tableName): string
    {
        return "['alias' => '" . Text::camelize($tableName, '_-') . "']";
    }

    /**
     * @param string $classname
     *
     * @return string
     */
    protected function getFullClassName(string $classname): string
    {
        $namespace = $this->modelOptions->getValidOptionOrDefault('namespace', '');
        if (!empty($namespace)) {
            $namespace .= "\\";
        }

        return $namespace . $classname;
    }

    /**
     * Get reference full class name
     *
     * @param string $reference
     *
     * @return string
     */
    protected function getEntityClassName(string $reference): string
    {
        $classname = Utils::camelize($reference);

        return $this->getFullClassName($classname);
    }

    /**
     * Get reference list from option
     *
     * @param string|null $schema
     * @param AbstractPdo $db
     *
     * @return array
     */
    protected function getReferenceList(?string $schema, AbstractPdo $db): array
    {
        if ($this->modelOptions->hasOption('referenceList')) {
            return $this->modelOptions->getOption('referenceList');
        }

        $referenceList = [];
        foreach ($db->listTables($schema) as $name) {
            $referenceList[$name] = $db->describeReferences($name, $schema);
        }

        return $referenceList;
    }

    /**
     * Returns the associated PHP type
     *
     * @param int $type
     *
     * @return string
     */
    protected function getPHPType(int $type): string
    {
        switch ($type) {
            case Column::TYPE_INTEGER:
            case Column::TYPE_TINYINTEGER:
            case Column::TYPE_SMALLINTEGER:
            case Column::TYPE_MEDIUMINTEGER:
            case Column::TYPE_BIGINTEGER:
            case Column::TYPE_BIT:
                return 'integer';
            case Column::TYPE_DECIMAL:
            case Column::TYPE_FLOAT:
            case Column::TYPE_DOUBLE:
                return 'double';
            case Column::TYPE_BOOLEAN:
                return 'boolean';
            case Column::TYPE_DATE:
            case Column::TYPE_DATETIME:
            case Column::TYPE_TIME:
            case Column::TYPE_CHAR:
            case Column::TYPE_VARCHAR:
            case Column::TYPE_TEXT:
            case Column::TYPE_TINYTEXT:
            case Column::TYPE_MEDIUMTEXT:
            case Column::TYPE_LONGTEXT:
            case Column::TYPE_JSON:
            case Column::TYPE_JSONB:
            default:
                return 'string';
        }
    }
}
