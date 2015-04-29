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

namespace Phalcon\Mvc\Model;

use Phalcon\Db\Column;
use Phalcon\Mvc\Model\Migration\Profiler;
use Phalcon\Mvc\Model\Exception;
use Phalcon\Events\Manager as EventsManager;
use Phalcon\Version\Item as VersionItem;

/**
 * Phalcon\Mvc\Model\Migration
 *
 * Migrations of DML y DDL over databases
 *
 * @category 	Phalcon
 * @package 	Scripts
 * @copyright   Copyright (c) 2011-2014 Phalcon Team (team@phalconphp.com)
 * @license 	New BSD License
 */
class Migration
{

    /**
     * Migration database connection
     *
     * @var \Phalcon\Db\AdapterInterface
     */
    protected static $_connection;

    /**
     * Database configuration
     *
     * @var \Phalcon\Config
     */
    private static $_databaseConfig;

    /**
     * Path where to save the migration
     *
     * @var string
     */
    private static $_migrationPath = null;


    /**
     * Version of the migration file
     *
     * @var string
     */
    protected $_version = null;

    /**
     * Prepares component
     *
     * @param $database
     *
     * @throws \Phalcon\Exception
     */
    public static function setup($database)
    {
        if ( ! isset($database->adapter))
            throw new \Phalcon\Exception('Unspecified database Adapter in your configuration!');

        $adapter = '\\Phalcon\\Db\\Adapter\\Pdo\\' . $database->adapter;

        if ( ! class_exists($adapter))
            throw new \Phalcon\Exception('Invalid database Adapter!');

        $configArray = $database->toArray();
        unset($configArray['adapter']);
        self::$_connection = new $adapter($configArray);
        self::$_databaseConfig = $database;

        if($database->adapter == 'Mysql') {
            self::$_connection->query('SET FOREIGN_KEY_CHECKS=0');
        }

        if ( \Phalcon\Migrations::isConsole() ) {
            $profiler = new Profiler();

            $eventsManager = new EventsManager();
            $eventsManager->attach('db', function ($event, $connection) use ($profiler) {
                if ($event->getType() == 'beforeQuery') {
                    $profiler->startProfile($connection->getSQLStatement());
                }
                if ($event->getType() == 'afterQuery') {
                    $profiler->stopProfile();
                }
            });

            self::$_connection->setEventsManager($eventsManager);
        }
    }

    /**
     * Set the migration directory path
     *
     * @param string $path
     */
    public static function setMigrationPath($path)
    {
        if (substr($path, -1) != '/') {
            $path .= '/';
        }
        self::$_migrationPath = $path;
    }

    /**
     * Generates all the class migration definitions for certain database setup
     *
     * @param  string $version
     * @param  string $exportData
     * @return array
     */
    public static function generateAll($version, $exportData=null)
    {
        $classDefinition = array();
    	if (self::$_databaseConfig->adapter == 'Postgresql') {
        	foreach (self::$_connection->listTables(isset(self::$_databaseConfig->schema) ? self::$_databaseConfig->schema : 'public') as $table) {
        		$classDefinition[$table] = self::generate($version, $table, $exportData);
        	}
        } else {
        	foreach (self::$_connection->listTables() as $table) {
        		$classDefinition[$table] = self::generate($version, $table, $exportData);
        	}
        }

        return $classDefinition;
    }

    /**
     * Generate specified table migration
     *
     * @param string $version
     * @param string $table
     * @param null $exportData
     * @return string
     *
     * @throws Exception
     */
    public static function generate($version, $table, $exportData=null)
    {
        $oldColumn = null;
        $allFields = array();
        $numericFields = array();
        $tableDefinition = array();

        if (isset(self::$_databaseConfig->schema)) {
            $defaultSchema = self::$_databaseConfig->schema;
        } elseif (isset(self::$_databaseConfig->adapter) && self::$_databaseConfig->adapter == 'Postgresql') {
            $defaultSchema =  'public';
        } elseif (isset(self::$_databaseConfig->dbname)) {
            $defaultSchema = self::$_databaseConfig->dbname;
        } else {
            $defaultSchema = null;
        }

        $description = self::$_connection->describeColumns($table, $defaultSchema);
        foreach ($description as $field) {
            $fieldDefinition = array();
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
                default:
                    throw new Exception('Unrecognized data type ' . $field->getType() . ' at column ' . $field->getName());
            }

            //if ($field->isPrimary()) {
            //	$fieldDefinition[] = "'primary' => true";
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

            if ($field->getSize()) {
                $fieldDefinition[] = "'size' => " . $field->getSize();
            } else {
                $fieldDefinition[] = "'size' => 1";
            }

            if ($field->getScale()) {
                $fieldDefinition[] = "'scale' => " . $field->getScale();
            }

            if ($oldColumn != null) {
                $fieldDefinition[] = "'after' => '" . $oldColumn . "'";
            } else {
                $fieldDefinition[] = "'first' => true";
            }

            $oldColumn = $field->getName();
            $tableDefinition[] = "\t\t\t\tnew Column('" . $field->getName() . "', array(\n\t\t\t\t\t" . join(",\n\t\t\t\t\t", $fieldDefinition) . "\n\t\t\t\t))";
            $allFields[] = "'".$field->getName()."'";
        }

        $indexesDefinition = array();
        $indexes = self::$_connection->describeIndexes($table, $defaultSchema);
        foreach ($indexes as $indexName => $dbIndex) {
            $indexDefinition = array();
            foreach ($dbIndex->getColumns() as $indexColumn) {
                $indexDefinition[] = "'" . $indexColumn . "'";
            }
            $indexesDefinition[] = "\t\t\t\tnew Index('".$indexName."', array(" . join(", ", $indexDefinition) . "))";
        }

        $referencesDefinition = array();
        $references = self::$_connection->describeReferences($table, $defaultSchema);
        foreach ($references as $constraintName => $dbReference) {

            $columns = array();
            foreach ($dbReference->getColumns() as $column) {
                $columns[] = "'" . $column . "'";
            }

            $referencedColumns = array();
            foreach ($dbReference->getReferencedColumns() as $referencedColumn) {
                $referencedColumns[] = "'" . $referencedColumn . "'";
            }

            $referenceDefinition = array();
            $referenceDefinition[] = "'referencedSchema' => '" . $dbReference->getReferencedSchema() . "'";
            $referenceDefinition[] = "'referencedTable' => '" . $dbReference->getReferencedTable() . "'";
            $referenceDefinition[] = "'columns' => array(" . join(",", $columns) . ")";
            $referenceDefinition[] = "'referencedColumns' => array(".join(",", $referencedColumns) . ")";

            $referencesDefinition[] = "\t\t\t\tnew Reference('" . $constraintName."', array(\n\t\t\t\t\t" . join(",\n\t\t\t\t\t", $referenceDefinition) . "\n\t\t\t\t))";
        }

        $optionsDefinition = array();
        $tableOptions = self::$_connection->tableOptions($table, $defaultSchema);
        foreach ($tableOptions as $optionName => $optionValue) {
            $optionsDefinition[] = "\t\t\t\t'" . strtoupper($optionName) . "' => '" . $optionValue . "'";
        }

        $classVersion = preg_replace('/[^0-9A-Za-z]/', '', $version);
        $className = \Phalcon\Text::camelize($table) . 'Migration_'.$classVersion;

        // begin of class

        $classData =
            "use Phalcon\\Db\\Column;\n" .
            "use Phalcon\\Db\\Index;\n" .
            "use Phalcon\\Db\\Reference;\n" .
            "use Phalcon\\Mvc\\Model\\Migration;\n" .
            "\n" .
            "class ".$className." extends Migration\n" .
            "{\n";

        // morph()

        $classData .=
            "\n" .
            "\t/**\n" .
            "\t * Define the table structure\n" .
            "\t *\n" .
            "\t * @return void\n" .
            "\t */\n" .
            "\tpublic function morph()\n" .
            "\t{\n" .
            "\t\t\$this->morphTable('" . $table . "', array(\n" .
            "\t\t\t'columns' => array(\n" . join(",\n", $tableDefinition) . "\n" .
            "\t\t\t),";

        if (count($indexesDefinition)) {
            $classData .= "\n\t\t\t'indexes' => array(\n" . join(",\n", $indexesDefinition) . "\n\t\t\t),";
        }

        if (count($referencesDefinition)) {
            $classData .= "\n\t\t\t'references' => array(\n".join(",\n", $referencesDefinition) . "\n\t\t\t),";
        }

        if (count($optionsDefinition)) {
            $classData .= "\n\t\t\t'options' => array(\n".join(",\n", $optionsDefinition) . "\n\t\t\t)\n";
        }

        $classData .=
            "\t\t));\n" .
            "\t}\n";

        // up()

        $classData .=
            "\n" .
            "\t/**\n" .
            "\t * Run the migrations\n" .
            "\t *\n" .
            "\t * @return void\n" .
            "\t */\n" .
            "\tpublic function up()\n" .
            "\t{\n";

        if ($exportData == 'always') {
            $classData .= "\t\t\$this->batchInsert('" . $table . "', array(\n\t\t\t" . join(",\n\t\t\t", $allFields) . "\n\t\t));\n";
        }

        $classData .=
            "\t}\n";

        // down()

        $classData .=
            "\n" .
            "\t/**\n" .
            "\t * Reverse the migrations\n" .
            "\t *\n" .
            "\t * @return void\n" .
            "\t */\n" .
            "\tpublic function down()\n" .
            "\t{\n";

        if ($exportData == 'always') {
            $classData .= "\t\t\$this->batchDelete('" . $table . "');\n";
        }

        $classData .=
            "\t}\n";

        // afterCreateTable()

        if ($exportData == 'oncreate') {
            $classData .=
                "\n" .
                "\t/**\n" .
                "\t * This function is called after the table was created\n" .
                "\t *\n" .
                "\t * @return void\n" .
                "\t */\n" .
                "\tpublic function afterCreateTable()\n" .
                "\t{\n" .
                "\t\t\$this->batchInsert('" . $table . "', array(\n\t\t\t" . join(",\n\t\t\t", $allFields) . "\n\t\t));\n";
                "\t}\n";
        }

        // end of class

        $classData .=
            "\n" .
            "}\n";

        $classData = str_replace("\t", "    ", $classData);

        // dump data

        if ($exportData == 'always' || $exportData == 'oncreate') {
            $fileHandler = fopen(self::$_migrationPath . $version . '/' . $table . '.dat', 'w');
            $cursor = self::$_connection->query('SELECT * FROM ' . $table);
            $cursor->setFetchMode(\Phalcon\Db::FETCH_ASSOC);
            while ($row = $cursor->fetchArray()) {
                $data = array();
                foreach ($row as $key => $value) {
                    if (isset($numericFields[$key])) {
                        if ($value==='' || is_null($value)) {
                            $data[] = 'NULL';
                        } else {
                            $data[] = addslashes($value);
                        }
                    } else {
                        $data[] = "'".addslashes($value)."'";
                    }
                    unset($value);
                }
                fputs($fileHandler, join('|', $data).PHP_EOL);
                unset($row);
                unset($data);
            }
            fclose($fileHandler);
        }

        return $classData;
    }

    /**
     * Migrate single table
     *
     * @param Phalcon\Version\Item $version
     * @param string $filePath
     * @param string $action null|'up'|'down'
     * @return string
     *
     * @throws Exception
     */
    public static function migrate($fromVersion, $toVersion, $tableName)
    {
        if (!is_object($fromVersion)) {
            $fromVersion = new VersionItem($fromVersion);
        }

        if (!is_object($toVersion)) {
            $toVersion = new VersionItem($toVersion);
        }

        if ($fromVersion->getStamp() == $toVersion->getStamp()) {
            return; // nothing to do
        }

        if ($fromVersion->getStamp() < $toVersion->getStamp()) {

            $toMigration = self::createClass($toVersion, $tableName);
            if (!is_null($toMigration)) {

                // morph the table structure
                if (method_exists($toMigration, 'morph')) {
                    $toMigration->morph();
                }

                // modifiy the datasets
                if (method_exists($toMigration, 'up')) {
                    $toMigration->up();
                    // we don't need the afterUp function anymore!
                    //if (method_exists($toMigration, 'afterUp')) {
                    //    $toMigration->afterUp();
                    //}
                }
            }

        } else {

            // rollback!

            // reset the data modifications
            $fromMigration = self::createClass($fromVersion, $tableName);
            if (!is_null($fromMigration) && method_exists($fromMigration, 'down')) {
                $fromMigration->down();
            }

            // call the last morph function in the previous migration files
            $toMigration = self::createPrevClassWithMorphMethode($toVersion, $tableName);
            if (!is_null($toMigration)) {
                $toMigration->morph();
            } else {
                // for safety's sake commented out!
                //self::$_connection->dropTable($tableName);
            }

        }
    }

    /**
     * Look for table definition modifications and apply to real table
     *
     * @param $tableName
     * @param $definition
     *
     * @throws Exception
     */
    public function morphTable($tableName, $definition)
    {

        if (isset(self::$_databaseConfig->dbname)) {
            $defaultSchema = self::$_databaseConfig->dbname;
        } else {
            $defaultSchema = null;
        }

        $tableExists = self::$_connection->tableExists($tableName, $defaultSchema);
        if (isset($definition['columns'])) {

            if (count($definition['columns']) == 0) {
                throw new Exception('Table must have at least one column');
            }

            $fields = array();
            foreach ($definition['columns'] as $tableColumn) {
                if (!is_object($tableColumn)) {
                    throw new Exception('Table must have at least one column');
                }
                $fields[$tableColumn->getName()] = $tableColumn;
            }

            if ($tableExists == true) {

                $localFields = array();
                $description = self::$_connection->describeColumns($tableName, $defaultSchema);
                foreach ($description as $field) {
                    $localFields[$field->getName()] = $field;
                }

                foreach ($fields as $fieldName => $tableColumn) {
                    if (!isset($localFields[$fieldName])) {
                        self::$_connection->addColumn($tableName, $tableColumn->getSchemaName(), $tableColumn);
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

                        if ($changed == true) {
                            self::$_connection->modifyColumn($tableName, $tableColumn->getSchemaName(), $tableColumn);
                        }
                    }
                }

                foreach ($localFields as $fieldName => $localField) {
                    if (!isset($fields[$fieldName])) {
                        self::$_connection->dropColumn($tableName, null, $fieldName);
                    }
                }
            } else {
                self::$_connection->createTable($tableName, $defaultSchema, $definition);
                if (method_exists($this, 'afterCreateTable')) {
                    $this->afterCreateTable();
                }
            }
        }

        if (isset($definition['references'])) {
            if ($tableExists == true) {

                $references = array();
                foreach ($definition['references'] as $tableReference) {
                    $references[$tableReference->getName()] = $tableReference;
                }

                $localReferences = array();
                $activeReferences = self::$_connection->describeReferences($tableName, $defaultSchema);
                foreach ($activeReferences as $activeReference) {
                    $localReferences[$activeReference->getName()] = array(
                        'referencedTable' => $activeReference->getReferencedTable(),
                        'columns' => $activeReference->getColumns(),
                        'referencedColumns' => $activeReference->getReferencedColumns(),
                    );
                }

                foreach ($definition['references'] as $tableReference) {
                    if (!isset($localReferences[$tableReference->getName()])) {
                        self::$_connection->addForeignKey($tableName, $tableReference->getSchemaName(), $tableReference);
                    } else {

                        $changed = false;
                        if ($tableReference->getReferencedTable()!=$localReferences[$tableReference->getName()]['referencedTable']) {
                            $changed = true;
                        }

                        if ($changed == false) {
                            if (count($tableReference->getColumns()) != count($localReferences[$tableReference->getName()]['columns'])) {
                                $changed = true;
                            }
                        }

                        if ($changed==false) {
                            if (count($tableReference->getReferencedColumns()) != count($localReferences[$tableReference->getName()]['referencedColumns'])) {
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
                                if (!in_array($columnName, $localReferences[$tableReference->getName()]['referencedColumns'])) {
                                    $changed = true;
                                    break;
                                }
                            }
                        }

                        if ($changed == true) {
                            self::$_connection->dropForeignKey($tableName, $tableReference->getSchemaName(), $tableReference->getName());
                            self::$_connection->addForeignKey($tableName, $tableReference->getSchemaName(), $tableReference);
                        }
                    }
                }

                foreach ($localReferences as $referenceName => $reference) {
                    if (!isset($references[$referenceName])) {
                        self::$_connection->dropForeignKey($tableName, null, $referenceName);
                    }
                }

            }
        }

        if (isset($definition['indexes'])) {
            if ($tableExists == true) {

                $indexes = array();
                foreach ($definition['indexes'] as $tableIndex) {
                    $indexes[$tableIndex->getName()] = $tableIndex;
                }

                $localIndexes = array();
                $actualIndexes = self::$_connection->describeIndexes($tableName, $defaultSchema);
                foreach ($actualIndexes as $actualIndex) {
                    $localIndexes[$actualIndex->getName()] = $actualIndex->getColumns();
                }

                foreach ($definition['indexes'] as $tableIndex) {
                    if (!isset($localIndexes[$tableIndex->getName()])) {
                        if ($tableIndex->getName() == 'PRIMARY') {
                            self::$_connection->addPrimaryKey($tableName, $tableColumn->getSchemaName(), $tableIndex);
                        } else {
                            self::$_connection->addIndex($tableName, $tableColumn->getSchemaName(), $tableIndex);
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
                                self::$_connection->dropPrimaryKey($tableName, $tableColumn->getSchemaName());
                                self::$_connection->addPrimaryKey($tableName, $tableColumn->getSchemaName(), $tableIndex);
                            } else {
                                self::$_connection->dropIndex($tableName, $tableColumn->getSchemaName(), $tableIndex->getName());
                                self::$_connection->addIndex($tableName, $tableColumn->getSchemaName(), $tableIndex);
                            }
                        }
                    }
                }
                foreach ($localIndexes as $indexName => $indexColumns) {
                    if (!isset($indexes[$indexName])) {
                        self::$_connection->dropIndex($tableName, null, $indexName);
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
        $migrationData = self::$_migrationPath . $this->_version . '/' . $tableName . '.dat';
        if (!file_exists($migrationData)) {
            return;
        }

        self::$_connection->begin();
        self::$_connection->delete($tableName);
        $batchHandler = fopen($migrationData, 'r');
        while (($line = fgets($batchHandler)) !== false) {
            self::$_connection->insert($tableName, explode('|', rtrim($line)), $fields);
            unset($line);
        }
        fclose($batchHandler);
        self::$_connection->commit();
    }

    /**
     * Delete the migration datasets from the table
     *
     * @param string $tableName
     */
    public function batchDelete($tableName)
    {
        $migrationData = self::$_migrationPath . $this->_version . '/' . $tableName . '.dat';
        if (!file_exists($migrationData)) {
            return;
        }

        self::$_connection->begin();
        self::$_connection->delete($tableName);
        $batchHandler = fopen($migrationData, 'r');
        while (($line = fgets($batchHandler)) !== false) {
            $data = explode('|', rtrim($line), 2);
            self::$_connection->delete($tableName, 'id=?', [$data[0]]);
            unset($line);
        }
        fclose($batchHandler);
        self::$_connection->commit();
    }

    /**
     * Create migration object for specified version
     *
     * @param Phalcon\Version\Item|string $version
     * @param string $tableName
     * @return null|Phalcon\Mvc\Model\Migration
     *
     * @throws Exception
     */
    private static function createClass($version, $tableName)
    {
        if (is_object($version)) {
            $version = (string)$version;
        }

        $fileName = self::$_migrationPath . $version . '/' . $tableName . '.php';
        if (!file_exists($fileName)) {
            return null;
        }

        $classVersion = preg_replace('/[^0-9A-Za-z]/', '', $version);
        $className = \Phalcon\Text::camelize($tableName).'Migration_'.$classVersion;
        @include_once $fileName;
        if (!class_exists($className)) {
            throw new Exception('Migration class cannot be found ' . $className . ' at ' . $fileName);
        }

        $migration = new $className($version);
        $migration->_version = $version;
        return $migration;
    }

    /**
     * Find the last morph function in the previous migration files
     *
     * @return null|Phalcon\Mvc\Model\Migration
     */
    private static function createPrevClassWithMorphMethode($version, $tableName)
    {
        $prevVersions = array();
        $iterator = new \DirectoryIterator(self::$_migrationPath);
        foreach ($iterator as $fileinfo) {
            if ($fileinfo->isDir() && preg_match('/[a-z0-9](\.[a-z0-9]+)+/', $fileinfo->getFilename(), $matches)) {
                $prevVersion = new VersionItem($matches[0], 3);
                if (($prevVersion->getStamp() <= $version->getStamp())) {
                    $prevVersions[] = $prevVersion;
                }
            }
        }

        $prevVersions = VersionItem::sortDesc($prevVersions);
        foreach ($prevVersions as $prevVersion) {
            $migration = self::createClass($prevVersion, $tableName);
            if (!is_null($migration) && method_exists($migration, 'morph')) {
                return $migration;
            }
        }

        return null;
    }
}
