<?php

namespace Phalcon\Db\Dialect;

/**
 * Phalcon\Db\Dialect\Sqlite
 *
 * Generates database specific SQL for the Sqlite RDBMS
 */
class Sqlite extends \Phalcon\Db\Dialect
{

    protected $_escapeChar = "\\\"";


    /**
     * Gets the column name in SQLite
     *
     * @param \Phalcon\Db\ColumnInterface $column
     * @return string
     */
    public function getColumnDefinition(\Phalcon\Db\ColumnInterface $column) {}

    /**
     * Generates SQL to add a column to a table
     *
     * @param string $tableName
     * @param string $schemaName
     * @param \Phalcon\Db\ColumnInterface $column
     * @return string
     */
    public function addColumn($tableName, $schemaName, \Phalcon\Db\ColumnInterface $column) {}

    /**
     * Generates SQL to modify a column in a table
     *
     * @param string $tableName
     * @param string $schemaName
     * @param \Phalcon\Db\ColumnInterface $column
     * @param \Phalcon\Db\ColumnInterface $currentColumn
     * @return string
     */
    public function modifyColumn($tableName, $schemaName, \Phalcon\Db\ColumnInterface $column, \Phalcon\Db\ColumnInterface $currentColumn = null) {}

    /**
     * Generates SQL to delete a column from a table
     *
     * @param string $tableName
     * @param string $schemaName
     * @param string $columnName
     * @return string
     */
    public function dropColumn($tableName, $schemaName, $columnName) {}

    /**
     * Generates SQL to add an index to a table
     *
     * @param string $tableName
     * @param string $schemaName
     * @param \Phalcon\Db\IndexInterface $index
     * @return string
     */
    public function addIndex($tableName, $schemaName, \Phalcon\Db\IndexInterface $index) {}

    /**
     * Generates SQL to delete an index from a table
     *
     * @param string $tableName
     * @param string $schemaName
     * @param string $indexName
     * @return string
     */
    public function dropIndex($tableName, $schemaName, $indexName) {}

    /**
     * Generates SQL to add the primary key to a table
     *
     * @param string $tableName
     * @param string $schemaName
     * @param \Phalcon\Db\IndexInterface $index
     * @return string
     */
    public function addPrimaryKey($tableName, $schemaName, \Phalcon\Db\IndexInterface $index) {}

    /**
     * Generates SQL to delete primary key from a table
     *
     * @param string $tableName
     * @param string $schemaName
     * @return string
     */
    public function dropPrimaryKey($tableName, $schemaName) {}

    /**
     * Generates SQL to add an index to a table
     *
     * @param string $tableName
     * @param string $schemaName
     * @param \Phalcon\Db\ReferenceInterface $reference
     * @return string
     */
    public function addForeignKey($tableName, $schemaName, \Phalcon\Db\ReferenceInterface $reference) {}

    /**
     * Generates SQL to delete a foreign key from a table
     *
     * @param string $tableName
     * @param string $schemaName
     * @param string $referenceName
     * @return string
     */
    public function dropForeignKey($tableName, $schemaName, $referenceName) {}

    /**
     * Generates SQL to create a table
     *
     * @param string $tableName
     * @param string $schemaName
     * @param array $definition
     * @return string
     */
    public function createTable($tableName, $schemaName, array $definition) {}

    /**
     * Generates SQL to truncate a table
     *
     * @param string $tableName
     * @param string $schemaName
     * @return string
     */
    public function truncateTable($tableName, $schemaName) {}

    /**
     * Generates SQL to drop a table
     *
     * @param string $tableName
     * @param string $schemaName
     * @param bool $ifExists
     * @return string
     */
    public function dropTable($tableName, $schemaName = null, $ifExists = true) {}

    /**
     * Generates SQL to create a view
     *
     * @param string $viewName
     * @param array $definition
     * @param string $schemaName
     * @return string
     */
    public function createView($viewName, array $definition, $schemaName = null) {}

    /**
     * Generates SQL to drop a view
     *
     * @param string $viewName
     * @param string $schemaName
     * @param bool $ifExists
     * @return string
     */
    public function dropView($viewName, $schemaName = null, $ifExists = true) {}

    /**
     * Generates SQL checking for the existence of a schema.table
     *
     * <code>
     * echo $dialect->tableExists("posts", "blog");
     *
     * echo $dialect->tableExists("posts");
     * </code>
     *
     * @param string $tableName
     * @param string $schemaName
     * @return string
     */
    public function tableExists($tableName, $schemaName = null) {}

    /**
     * Generates SQL checking for the existence of a schema.view
     *
     * @param string $viewName
     * @param string $schemaName
     * @return string
     */
    public function viewExists($viewName, $schemaName = null) {}

    /**
     * Generates SQL describing a table
     *
     * <code>
     * print_r(
     *     $dialect->describeColumns("posts")
     * );
     * </code>
     *
     * @param string $table
     * @param string $schema
     * @return string
     */
    public function describeColumns($table, $schema = null) {}

    /**
     * List all tables in database
     *
     * <code>
     * print_r(
     *     $dialect->listTables("blog")
     * );
     * </code>
     *
     * @param string $schemaName
     * @return string
     */
    public function listTables($schemaName = null) {}

    /**
     * Generates the SQL to list all views of a schema or user
     *
     * @param string $schemaName
     * @return string
     */
    public function listViews($schemaName = null) {}

    /**
     * Generates the SQL to get query list of indexes
     *
     * <code>
     * print_r(
     *     $dialect->listIndexesSql("blog")
     * );
     * </code>
     *
     * @param string $table
     * @param string $schema
     * @param string $keyName
     * @return string
     */
    public function listIndexesSql($table, $schema = null, $keyName = null) {}

    /**
     * Generates SQL to query indexes on a table
     *
     * @param string $table
     * @param string $schema
     * @return string
     */
    public function describeIndexes($table, $schema = null) {}

    /**
     * Generates SQL to query indexes detail on a table
     *
     * @param string $index
     * @return string
     */
    public function describeIndex($index) {}

    /**
     * Generates SQL to query foreign keys on a table
     *
     * @param string $table
     * @param string $schema
     * @return string
     */
    public function describeReferences($table, $schema = null) {}

    /**
     * Generates the SQL to describe the table creation options
     *
     * @param string $table
     * @param string $schema
     * @return string
     */
    public function tableOptions($table, $schema = null) {}

}
