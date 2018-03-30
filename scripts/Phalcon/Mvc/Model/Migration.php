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

namespace Phalcon\Mvc\Model;

use Phalcon\Db;
use Phalcon\Text;
use Phalcon\Utils;
use DirectoryIterator;
use Phalcon\Db\Column;
use Phalcon\Migrations;
use Phalcon\Utils\Nullify;
use Phalcon\Generator\Snippet;
use Phalcon\Version\ItemInterface;
use Phalcon\Db\Dialect\DialectMysql;
use Phalcon\Db\Exception as DbException;
use Phalcon\Mvc\Model\Migration\Profiler;
use Phalcon\Listeners\DbProfilerListener;
use Phalcon\Db\Dialect\DialectPostgresql;
use Phalcon\Events\Manager as EventsManager;
use Phalcon\Exception\Db\UnknownColumnTypeException;
use Phalcon\Version\ItemCollection as VersionCollection;
use Phalcon\Db\Adapter\Pdo\PdoMysql;
use Phalcon\Db\Adapter\Pdo\PdoPostgresql;

/**
 * Phalcon\Mvc\Model\Migration
 *
 * Migrations of DML y DDL over databases
 * @method afterCreateTable()
 * @method morph()
 * @method up()
 * @method afterUp()
 * @method down()
 * @method afterDown()
 *
 * @package Phalcon\Mvc\Model
 */
class Migration
{
    const DIRECTION_FORWARD = 1;
    const DIRECTION_BACK = -1;

    /**
     * Migration database connection
     * @var \Phalcon\Db\AdapterInterface
     */
    protected static $connection;

    /**
     * Database configuration
     * @var \Phalcon\Config
     */
    private static $databaseConfig;

    /**
     * Path where to save the migration
     * @var string
     */
    private static $migrationPath = null;

    /**
     * Skip auto increment
     * @var bool
     */
    private static $skipAI = false;

    /**
     * Version of the migration file
     *
     * @var string
     */
    protected $version = null;

    /**
     * Prepares component
     *
     * @param \Phalcon\Config $database Database config
     * @param bool $verbose array with settings
     * @since 3.2.1 Using Postgresql::describeReferences and DialectPostgresql dialect class
     *
     * @throws \Phalcon\Db\Exception
     */
    public static function setup($database, $verbose = false)
    {
        if (!isset($database->adapter)) {
            throw new DbException('Unspecified database Adapter in your configuration!');
        }

        /**
         * The original Phalcon\Db\Adapter\Pdo\Mysql::addForeignKey is broken until the v3.2.0
         *
         * @see: Phalcon\Db\Dialect\PdoMysql The extended and fixed dialect class for MySQL
         */
        if ($database->adapter == 'Mysql') {
            $adapter = PdoMysql::class;
        } elseif ($database->adapter == 'Postgresql') {
            $adapter = PdoPostgresql::class;
        } else {
            $adapter = '\\Phalcon\\Db\\Adapter\\Pdo\\'.$database->adapter;
        }

        if (!class_exists($adapter)) {
            throw new DbException("Invalid database adapter: '{$adapter}'");
        }

        $configArray = $database->toArray();
        unset($configArray['adapter']);
        self::$connection = new $adapter($configArray);
        self::$databaseConfig = $database;

        //Connection custom dialect Dialect/DialectMysql
        if ($database->adapter == 'Mysql') {
            self::$connection->setDialect(new DialectMysql);
        }

        //Connection custom dialect Dialect/DialectPostgresql
        if ($database->adapter == 'Postgresql') {
            self::$connection->setDialect(new DialectPostgresql);
        }

        if (!Migrations::isConsole() || !$verbose) {
            return;
        }

        $eventsManager = new EventsManager();

        $eventsManager->attach(
            'db',
            new DbProfilerListener()
        );

        self::$connection->setEventsManager($eventsManager);
    }

    /**
     * Set the skip auto increment value
     *
     * @param bool $skip
     */
    public static function setSkipAutoIncrement($skip)
    {
        self::$skipAI = $skip;
    }

    /**
     * Set the migration directory path
     *
     * @param string $path
     */
    public static function setMigrationPath($path)
    {
        self::$migrationPath = rtrim($path, '\\/').DIRECTORY_SEPARATOR;
    }

    /**
     * Generates all the class migration definitions for certain database setup
     *
     * @param  ItemInterface $version
     * @param  string        $exportData
     *
     * @return array
     */
    public static function generateAll(ItemInterface $version, $exportData = null)
    {
        $classDefinition = [];
        $schema = Utils::resolveDbSchema(self::$databaseConfig);

        foreach (self::$connection->listTables($schema) as $table) {
            $classDefinition[$table] = self::generate($version, $table, $exportData);
        }

        return $classDefinition;
    }

    /**
     * Returns database name
     *
     * @return mixed
     */
    public static function getDbName()
    {
        return self::$databaseConfig->get('dbname');
    }

    /**
     * Generate specified table migration
     *
     * @param ItemInterface $version
     * @param string        $table
     * @param mixed         $exportData
     *
     * @return string
     * @throws \Phalcon\Db\Exception
     */
    public static function generate(ItemInterface $version, $table, $exportData = null)
    {
        $oldColumn = null;
        $allFields = [];
        $numericFields = [];
        $tableDefinition = [];
        $snippet = new Snippet();

        $defaultSchema = Utils::resolveDbSchema(self::$databaseConfig);
        $description = self::$connection->describeColumns($table, $defaultSchema);

        foreach ($description as $field) {
            /** @var \Phalcon\Db\ColumnInterface $field */
            $fieldDefinition = [];
            switch ($field->getType()) {
                case Column::TYPE_INTEGER:
                    $fieldDefinition[] = "'type' => Column::TYPE_INTEGER";
                    $numericFields[$field->getName()] = true;
                    break;
                case Column::TYPE_VARCHAR:
                    $fieldDefinition[] = "'type' => Column::TYPE_VARCHAR";
                    break;
                case Column::TYPE_CHAR:
                    $fieldDefinition[] = "'type' => Column::TYPE_CHAR";
                    break;
                case Column::TYPE_DATE:
                    $fieldDefinition[] = "'type' => Column::TYPE_DATE";
                    break;
                case Column::TYPE_DATETIME:
                    $fieldDefinition[] = "'type' => Column::TYPE_DATETIME";
                    break;
                case Column::TYPE_TIMESTAMP:
                    $fieldDefinition[] = "'type' => Column::TYPE_TIMESTAMP";
                    break;
                case Column::TYPE_DECIMAL:
                    $fieldDefinition[] = "'type' => Column::TYPE_DECIMAL";
                    $numericFields[$field->getName()] = true;
                    break;
                case Column::TYPE_TEXT:
                    $fieldDefinition[] = "'type' => Column::TYPE_TEXT";
                    break;
                case Column::TYPE_BOOLEAN:
                    $fieldDefinition[] = "'type' => Column::TYPE_BOOLEAN";
                    break;
                case Column::TYPE_FLOAT:
                    $fieldDefinition[] = "'type' => Column::TYPE_FLOAT";
                    break;
                case Column::TYPE_DOUBLE:
                    $fieldDefinition[] = "'type' => Column::TYPE_DOUBLE";
                    break;
                case Column::TYPE_TINYBLOB:
                    $fieldDefinition[] = "'type' => Column::TYPE_TINYBLOB";
                    break;
                case Column::TYPE_BLOB:
                    $fieldDefinition[] = "'type' => Column::TYPE_BLOB";
                    break;
                case Column::TYPE_MEDIUMBLOB:
                    $fieldDefinition[] = "'type' => Column::TYPE_MEDIUMBLOB";
                    break;
                case Column::TYPE_LONGBLOB:
                    $fieldDefinition[] = "'type' => Column::TYPE_LONGBLOB";
                    break;
                case Column::TYPE_JSON:
                    $fieldDefinition[] = "'type' => Column::TYPE_JSON";
                    break;
                case Column::TYPE_JSONB:
                    $fieldDefinition[] = "'type' => Column::TYPE_JSONB";
                    break;
                case Column::TYPE_BIGINTEGER:
                    $fieldDefinition[] = "'type' => Column::TYPE_BIGINTEGER";
                    break;
                default:
                    throw new UnknownColumnTypeException($field);
            }

            if ($field->hasDefault() && !$field->isAutoIncrement()) {
                $default = $field->getDefault();
                $fieldDefinition[] = "'default' => \"$default\"";
            }
            //if ($field->isPrimary()) {
                //$fieldDefinition[] = "'primary' => true";
            //}

            if ($field->isUnsigned()) {
                $fieldDefinition[] = "'unsigned' => true";
            }

            if ($field->isNotNull()) {
                $fieldDefinition[] = "'notNull' => true";
            }

            if ($field->isAutoIncrement()) {
                $fieldDefinition[] = "'autoIncrement' => true";
            }

            if (self::$databaseConfig->path('adapter') == 'Postgresql' &&
                in_array($field->getType(), [Column::TYPE_BOOLEAN, Column::TYPE_INTEGER, Column::TYPE_BIGINTEGER])
            ) {
                // nothing
            } else {
                if ($field->getSize()) {
                    $fieldDefinition[] = "'size' => ".$field->getSize();
                } else {
                    $fieldDefinition[] = "'size' => 1";
                }
            }

            if ($field->getScale()) {
                $fieldDefinition[] = "'scale' => ".$field->getScale();
            }

            if ($oldColumn != null) {
                $fieldDefinition[] = "'after' => '".$oldColumn."'";
            } else {
                $fieldDefinition[] = "'first' => true";
            }

            $oldColumn = $field->getName();
            $tableDefinition[] = $snippet->getColumnDefinition($field->getName(), $fieldDefinition);
            $allFields[] = "'".$field->getName()."'";
        }

        $indexesDefinition = [];
        $indexes = self::$connection->describeIndexes($table, $defaultSchema);
        foreach ($indexes as $indexName => $dbIndex) {
            /** @var \Phalcon\Db\Index $dbIndex */
            $indexDefinition = [];
            foreach ($dbIndex->getColumns() as $indexColumn) {
                $indexDefinition[] = "'".$indexColumn."'";
            }
            $indexesDefinition[] = $snippet->getIndexDefinition($indexName, $indexDefinition, $dbIndex->getType());
        }

        $referencesDefinition = [];
        $references = self::$connection->describeReferences($table, $defaultSchema);
        foreach ($references as $constraintName => $dbReference) {
            $columns = [];
            foreach ($dbReference->getColumns() as $column) {
                $columns[] = "'".$column."'";
            }

            $referencedColumns = [];
            foreach ($dbReference->getReferencedColumns() as $referencedColumn) {
                $referencedColumns[] = "'".$referencedColumn."'";
            }

            $referenceDefinition = [];
            $referenceDefinition[] = "'referencedTable' => '".$dbReference->getReferencedTable()."'";
            $referenceDefinition[] = "'referencedSchema' => '".$dbReference->getReferencedSchema()."'";
            $referenceDefinition[] = "'columns' => [".join(",", array_unique($columns))."]";
            $referenceDefinition[] = "'referencedColumns' => [".join(",", array_unique($referencedColumns))."]";
            $referenceDefinition[] = "'onUpdate' => '".$dbReference->getOnUpdate()."'";
            $referenceDefinition[] = "'onDelete' => '".$dbReference->getOnDelete()."'";

            $referencesDefinition[] = $snippet->getReferenceDefinition($constraintName, $referenceDefinition);
        }

        $optionsDefinition = [];
        $tableOptions = self::$connection->tableOptions($table, $defaultSchema);
        foreach ($tableOptions as $optionName => $optionValue) {
            if (self::$skipAI && strtoupper($optionName) == "AUTO_INCREMENT") {
                $optionValue = '';
            }
            $optionsDefinition[] = "'".strtoupper($optionName)."' => '".$optionValue."'";
        }

        $classVersion = preg_replace('/[^0-9A-Za-z]/', '', $version->getStamp());
        $className = Text::camelize($table).'Migration_'.$classVersion;

        // morph()
        $classData = $snippet->getMigrationMorph($className, $table, $tableDefinition);

        if (count($indexesDefinition)) {
            $classData .= $snippet->getMigrationDefinition('indexes', $indexesDefinition);
        }

        if (count($referencesDefinition)) {
            $classData .= $snippet->getMigrationDefinition('references', $referencesDefinition);
        }

        if (count($optionsDefinition)) {
            $classData .= $snippet->getMigrationDefinition('options', $optionsDefinition);
        }

        $classData .= "            ]\n        );\n    }\n";

        // up()
        $classData .= $snippet->getMigrationUp();

        if ($exportData == 'always') {
            $classData .= $snippet->getMigrationBatchInsert($table, $allFields);
        }

        $classData .= "\n    }\n";

        // down()
        $classData .= $snippet->getMigrationDown();

        if ($exportData == 'always') {
            $classData .= $snippet->getMigrationBatchDelete($table);
        }

        $classData .= "\n    }\n";

        // afterCreateTable()
        if ($exportData == 'oncreate') {
            $classData .= $snippet->getMigrationAfterCreateTable($table, $allFields);
        }

        // end of class
        $classData .= "\n}\n";

        // dump data
        if ($exportData == 'always' || $exportData == 'oncreate') {
            $fileHandler = fopen(self::$migrationPath . $version->getVersion() . '/' . $table . '.dat', 'w');
            $cursor = self::$connection->query('SELECT * FROM '. self::$connection->escapeIdentifier($table));
            $cursor->setFetchMode(Db::FETCH_ASSOC);
            while ($row = $cursor->fetchArray()) {
                $data = [];
                foreach ($row as $key => $value) {
                    if (isset($numericFields[$key])) {
                        if ($value === '' || is_null($value)) {
                            $data[] = 'NULL';
                        } else {
                            $data[] = addslashes($value);
                        }
                    } else {
                        $data[] = is_null($value) ? "NULL" : addslashes($value);
                    }

                    unset($value);
                }

                fputcsv($fileHandler, $data);
                unset($row);
                unset($data);
            }

            fclose($fileHandler);
        }

        return $classData;
    }

    /**
     * Migrate
     * @param \Phalcon\Version\IncrementalItem|\Phalcon\Version\TimestampedItem $fromVersion
     * @param \Phalcon\Version\IncrementalItem|\Phalcon\Version\TimestampedItem $toVersion
     * @param string  $tableName
     */
    public static function migrate($fromVersion, $toVersion, $tableName)
    {
        if (!is_object($fromVersion)) {
            $fromVersion = VersionCollection::createItem($fromVersion);
        }

        if (!is_object($toVersion)) {
            $toVersion = VersionCollection::createItem($toVersion);
        }

        if ($fromVersion->getStamp() == $toVersion->getStamp()) {
            return; // nothing to do
        }

        if ($fromVersion->getStamp() < $toVersion->getStamp()) {
            $toMigration = self::createClass($toVersion, $tableName);

            if (is_object($toMigration)) {
                // morph the table structure
                if (method_exists($toMigration, 'morph')) {
                    $toMigration->morph();
                }

                // modify the datasets
                if (method_exists($toMigration, 'up')) {
                    $toMigration->up();
                    if (method_exists($toMigration, 'afterUp')) {
                        $toMigration->afterUp();
                    }
                }
            }
        } else {
            // rollback!

            // reset the data modifications
            $fromMigration = self::createClass($fromVersion, $tableName);
            if (is_object($fromMigration) && method_exists($fromMigration, 'down')) {
                $fromMigration->down();

                if (method_exists($fromMigration, 'afterDown')) {
                    $fromMigration->afterDown();
                }
            }

            // call the last morph function in the previous migration files
            $toMigration = self::createPrevClassWithMorphMethod($toVersion, $tableName);

            if (is_object($toMigration)) {
                if (method_exists($toMigration, 'morph')) {
                    $toMigration->morph();
                }
            }
        }
    }

    /**
     * Scan for all versions
     *
     * @param string $dir Directory to scan
     *
     * @return ItemInterface[]
     */
    public static function scanForVersions($dir)
    {
        $versions = [];
        $iterator = new DirectoryIterator($dir);

        foreach ($iterator as $fileinfo) {
            $filename = $fileinfo->getFilename();
            if (!$fileinfo->isDir()
                || $fileinfo->isDot()
                || !VersionCollection::isCorrectVersion($filename)
            ) {
                continue;
            }

            $versions[] = VersionCollection::createItem($filename);
        }

        return $versions;
    }

    /**
     * Find the last morph function in the previous migration files
     *
     * @param ItemInterface $toVersion
     * @param string        $tableName
     *
     * @return null|Migration
     * @throws Exception
     * @internal param ItemInterface $version
     */
    private static function createPrevClassWithMorphMethod(ItemInterface $toVersion, $tableName)
    {
        $prevVersions = [];
        $versions = self::scanForVersions(self::$migrationPath);
        foreach ($versions as $prevVersion) {
            if ($prevVersion->getStamp() <= $toVersion->getStamp()) {
                $prevVersions[] = $prevVersion;
            }
        }

        $prevVersions = VersionCollection::sortDesc($prevVersions);
        foreach ($prevVersions as $prevVersion) {
            $migration = self::createClass($prevVersion, $tableName);
            if (is_object($migration) && method_exists($migration, 'morph')) {
                return $migration;
            }
        }

        return null;
    }

    /**
     * Create migration object for specified version
     *
     * @param ItemInterface $version
     * @param string        $tableName
     *
     * @return null|\Phalcon\Mvc\Model\Migration
     *
     * @throws Exception
     */
    private static function createClass(ItemInterface $version, $tableName)
    {
        $fileName = self::$migrationPath.$version->getVersion().DIRECTORY_SEPARATOR.$tableName.'.php';
        if (!file_exists($fileName)) {
            return null;
        }

        $classVersion = preg_replace('/[^0-9A-Za-z]/', '', $version);
        $className = Text::camelize($tableName).'Migration_'.$version->getStamp();

        include_once $fileName;
        if (!class_exists($className)) {
            throw new Exception('Migration class cannot be found '.$className.' at '.$fileName);
        }

        $migration = new $className($version);
        $migration->version = $version;

        return $migration;
    }

    /**
     * Look for table definition modifications and apply to real table
     *
     * @param string $tableName
     * @param array $definition
     *
     * @throws \Phalcon\Db\Exception
     */
    public function morphTable($tableName, $definition)
    {
        $defaultSchema = Utils::resolveDbSchema(self::$databaseConfig);
        $tableExists = self::$connection->tableExists($tableName, $defaultSchema);
        $tableSchema = null;

        if (isset($definition['columns'])) {
            if (count($definition['columns']) == 0) {
                throw new DbException('Table must have at least one column');
            }

            $fields = [];
            /** @var \Phalcon\Db\ColumnInterface $tableColumn */
            foreach ($definition['columns'] as $tableColumn) {
                if (!is_object($tableColumn)) {
                    throw new DbException('Table must have at least one column');
                }
                /** @var \Phalcon\Db\ColumnInterface[] $fields */
                $fields[$tableColumn->getName()] = $tableColumn;
                if (empty($tableSchema)) {
                    $tableSchema = $tableColumn->getSchemaName();
                }
            }

            if ($tableExists == true) {
                $localFields = [];
                /**
                 * @var \Phalcon\Db\ColumnInterface[] $description
                 * @var \Phalcon\Db\ColumnInterface[] $localFields
                 */
                $description = self::$connection->describeColumns($tableName, $defaultSchema);
                foreach ($description as $field) {
                    $localFields[$field->getName()] = $field;
                }

                foreach ($fields as $fieldName => $tableColumn) {
                    /**
                     * @var \Phalcon\Db\ColumnInterface   $tableColumn
                     * @var \Phalcon\Db\ColumnInterface[] $localFields
                     */
                    if (!isset($localFields[$fieldName])) {
                        self::$connection->addColumn($tableName, $tableColumn->getSchemaName(), $tableColumn);
                    } else {
                        $changed = false;

                        if ($localFields[$fieldName]->getType() != $tableColumn->getType()) {
                            $changed = true;
                        }

                        if ($localFields[$fieldName]->getSize() != $tableColumn->getSize()) {
                            $changed = true;
                        }

                        if ($tableColumn->isNotNull() != $localFields[$fieldName]->isNotNull()) {
                            $changed = true;
                        }

                        if ($tableColumn->getDefault() != $localFields[$fieldName]->getDefault()) {
                            $changed = true;
                        }

                        if ($changed == true) {
                            self::$connection->modifyColumn(
                                $tableName,
                                $tableColumn->getSchemaName(),
                                $tableColumn,
                                $tableColumn
                            );
                        }
                    }
                }

                foreach ($localFields as $fieldName => $localField) {
                    if (!isset($fields[$fieldName])) {
                        self::$connection->dropColumn($tableName, null, $fieldName);
                    }
                }
            } else {
                self::$connection->createTable($tableName, $defaultSchema, $definition);
                if (method_exists($this, 'afterCreateTable')) {
                    $this->afterCreateTable();
                }
            }
        }

        if (isset($definition['references'])) {
            if ($tableExists == true) {
                $references = [];
                foreach ($definition['references'] as $tableReference) {
                    $references[$tableReference->getName()] = $tableReference;
                }

                $localReferences = [];
                $activeReferences = self::$connection->describeReferences($tableName, $defaultSchema);
                foreach ($activeReferences as $activeReference) {
                    $localReferences[$activeReference->getName()] = [
                        'referencedTable'   => $activeReference->getReferencedTable(),
                        "referencedSchema"  => $activeReference->getReferencedSchema(),
                        'columns'           => $activeReference->getColumns(),
                        'referencedColumns' => $activeReference->getReferencedColumns(),
                    ];
                }

                foreach ($definition['references'] as $tableReference) {
                    if (!isset($localReferences[$tableReference->getName()])) {
                        self::$connection->addForeignKey(
                            $tableName,
                            $tableReference->getSchemaName(),
                            $tableReference
                        );
                    } else {
                        $changed = false;
                        if ($tableReference->getReferencedTable() !=
                            $localReferences[$tableReference->getName()]['referencedTable']
                        ) {
                            $changed = true;
                        }

                        if ($changed == false) {
                            if (count($tableReference->getColumns()) !=
                                count($localReferences[$tableReference->getName()]['columns'])
                            ) {
                                $changed = true;
                            }
                        }

                        if ($changed == false) {
                            if (count($tableReference->getReferencedColumns()) !=
                                count($localReferences[$tableReference->getName()]['referencedColumns'])
                            ) {
                                $changed = true;
                            }
                        }
                        if ($changed == false) {
                            foreach ($tableReference->getColumns() as $columnName) {
                                if (!in_array($columnName, $localReferences[$tableReference->getName()]['columns'])) {
                                    $changed = true;
                                    break;
                                }
                            }
                        }
                        if ($changed == false) {
                            foreach ($tableReference->getReferencedColumns() as $columnName) {
                                if (!in_array(
                                    $columnName,
                                    $localReferences[$tableReference->getName()]['referencedColumns']
                                )
                                ) {
                                    $changed = true;
                                    break;
                                }
                            }
                        }

                        if ($changed == true) {
                            self::$connection->dropForeignKey(
                                $tableName,
                                $tableReference->getSchemaName(),
                                $tableReference->getName()
                            );
                            self::$connection->addForeignKey(
                                $tableName,
                                $tableReference->getSchemaName(),
                                $tableReference
                            );
                        }
                    }
                }

                foreach ($localReferences as $referenceName => $reference) {
                    if (!isset($references[$referenceName])) {
                        self::$connection->dropForeignKey($tableName, null, $referenceName);
                    }
                }
            }
        }

        if (isset($definition['indexes'])) {
            if ($tableExists == true) {
                $indexes = [];
                foreach ($definition['indexes'] as $tableIndex) {
                    $indexes[$tableIndex->getName()] = $tableIndex;
                }

                $localIndexes = [];
                $actualIndexes = self::$connection->describeIndexes($tableName, $defaultSchema);
                foreach ($actualIndexes as $actualIndex) {
                    $localIndexes[$actualIndex->getName()] = $actualIndex->getColumns();
                }

                foreach ($definition['indexes'] as $tableIndex) {
                    if (!isset($localIndexes[$tableIndex->getName()])) {
                        if ($tableIndex->getName() == 'PRIMARY') {
                            self::$connection->addPrimaryKey($tableName, $tableSchema, $tableIndex);
                        } else {
                            self::$connection->addIndex($tableName, $tableSchema, $tableIndex);
                        }
                    } else {
                        $changed = false;
                        if (count($tableIndex->getColumns()) != count($localIndexes[$tableIndex->getName()])) {
                            $changed = true;
                        } else {
                            foreach ($tableIndex->getColumns() as $columnName) {
                                if (!in_array($columnName, $localIndexes[$tableIndex->getName()])) {
                                    $changed = true;
                                    break;
                                }
                            }
                        }
                        if ($changed == true) {
                            if ($tableIndex->getName() == 'PRIMARY') {
                                self::$connection->dropPrimaryKey($tableName, $tableSchema);
                                self::$connection->addPrimaryKey(
                                    $tableName,
                                    $tableSchema,
                                    $tableIndex
                                );
                            } else {
                                self::$connection->dropIndex(
                                    $tableName,
                                    $tableSchema,
                                    $tableIndex->getName()
                                );
                                self::$connection->addIndex($tableName, $tableSchema, $tableIndex);
                            }
                        }
                    }
                }
                foreach ($localIndexes as $indexName => $indexColumns) {
                    if (!isset($indexes[$indexName])) {
                        self::$connection->dropIndex($tableName, null, $indexName);
                    }
                }
            }
        }
    }

    /**
     * Inserts data from a data migration file in a table
     *
     * @param string $tableName
     * @param string $fields
     */
    public function batchInsert($tableName, $fields)
    {
        $migrationData = self::$migrationPath . $this->version . '/' . $tableName . '.dat';
        if (!file_exists($migrationData)) {
            return; // nothing to do
        }

        self::$connection->begin();
        self::$connection->delete($tableName);
        $batchHandler = fopen($migrationData, 'r');
        while (($line = fgetcsv($batchHandler)) !== false) {
            $values = array_map(
                function ($value) {
                    return null === $value ? null : stripslashes($value);
                },
                $line
            );

            $nullify = new Nullify();
            self::$connection->insert($tableName, $nullify($values), $fields);
            unset($line);
        }
        fclose($batchHandler);
        self::$connection->commit();
    }

    /**
     * Delete the migration datasets from the table
     *
     * @param string $tableName
     */
    public function batchDelete($tableName)
    {
        $migrationData = self::$migrationPath.$this->version.'/'.$tableName.'.dat';
        if (!file_exists($migrationData)) {
            return; // nothing to do
        }

        self::$connection->begin();
        self::$connection->delete($tableName);
        $batchHandler = fopen($migrationData, 'r');
        while (($line = fgetcsv($batchHandler)) !== false) {
            $values = array_map(
                function ($value) {
                    return null === $value ? null : stripslashes($value);
                },
                $line
            );

            self::$connection->delete($tableName, 'id=?', [$values[0]]);
            unset($line);
        }
        fclose($batchHandler);
        self::$connection->commit();
    }

    /**
     * Get db connection
     *
     * @return \Phalcon\Db\AdapterInterface
     */
    public function getConnection()
    {
        return self::$connection;
    }
}
