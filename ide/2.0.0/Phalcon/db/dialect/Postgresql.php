<?php

namespace Phalcon\Db\Dialect;

class Postgresql extends \Phalcon\Db\Dialect implements \Phalcon\Db\DialectInterface
{

    protected $_escapeChar = "\\\"";


    /**
     * Gets the column name in PostgreSQL
     *
     * @param mixed $column 
     * @return string 
     */
	public function getColumnDefinition(\Phalcon\Db\ColumnInterface $column) {}

    /**
     * Generates SQL to add a column to a table
     *
     * @param	string tableName
     * @param	string schemaName
     * @param	Phalcon\Db\ColumnInterface column
     * @return	string
     * @param mixed $tableName 
     * @param mixed $schemaName 
     * @param mixed $column 
     */
	public function addColumn($tableName, $schemaName, \Phalcon\Db\ColumnInterface $column) {}

    /**
     * Generates SQL to modify a column in a table
     *
     * @param	string tableName
     * @param	string schemaName
     * @param	Phalcon\Db\ColumnInterface column
     * @return	string
     * @param mixed $tableName 
     * @param mixed $schemaName 
     * @param mixed $column 
     */
	public function modifyColumn($tableName, $schemaName, \Phalcon\Db\ColumnInterface $column) {}

    /**
     * Generates SQL to delete a column from a table
     *
     * @param	string tableName
     * @param	string schemaName
     * @param	string columnName
     * @param mixed $tableName 
     * @param mixed $schemaName 
     * @param mixed $columnName 
     * @return  
     */
	public function dropColumn($tableName, $schemaName, $columnName) {}

    /**
     * Generates SQL to add an index to a table
     *
     * @param	string tableName
     * @param	string schemaName
     * @param	Phalcon\Db\IndexInterface index
     * @return	string
     * @param mixed $tableName 
     * @param mixed $schemaName 
     * @param mixed $index 
     */
	public function addIndex($tableName, $schemaName, \Phalcon\Db\IndexInterface $index) {}

    /**
     * Generates SQL to delete an index from a table
     *
     * @param	string tableName
     * @param	string schemaName
     * @param	string indexName
     * @return	string
     * @param mixed $tableName 
     * @param mixed $schemaName 
     * @param mixed $indexName 
     */
	public function dropIndex($tableName, $schemaName, $indexName) {}

    /**
     * Generates SQL to add the primary key to a table
     *
     * @param	string tableName
     * @param	string schemaName
     * @param	Phalcon\Db\IndexInterface index
     * @return	string
     * @param mixed $tableName 
     * @param mixed $schemaName 
     * @param mixed $index 
     */
	public function addPrimaryKey($tableName, $schemaName, \Phalcon\Db\IndexInterface $index) {}

    /**
     * Generates SQL to delete primary key from a table
     *
     * @param	string tableName
     * @param	string schemaName
     * @return	string
     * @param mixed $tableName 
     * @param mixed $schemaName 
     */
	public function dropPrimaryKey($tableName, $schemaName) {}

    /**
     * Generates SQL to add an index to a table
     *
     * @param	string tableName
     * @param	string schemaName
     * @param	Phalcon\Db\ReferenceInterface reference
     * @return	string
     * @param mixed $tableName 
     * @param mixed $schemaName 
     * @param mixed $reference 
     */
	public function addForeignKey($tableName, $schemaName, \Phalcon\Db\ReferenceInterface $reference) {}

    /**
     * Generates SQL to delete a foreign key from a table
     *
     * @param	string tableName
     * @param	string schemaName
     * @param	string referenceName
     * @return	string
     * @param mixed $tableName 
     * @param mixed $schemaName 
     * @param mixed $referenceName 
     */
	public function dropForeignKey($tableName, $schemaName, $referenceName) {}

    /**
     * Generates SQL to add the table creation options
     *
     * @param	array definition
     * @return	array
     * @param mixed $definition 
     */
	protected function _getTableOptions($definition) {}

    /**
     * Generates SQL to create a table in PostgreSQL
     *
     * @param	string schemaName
     * @param	array definition
     * @param mixed $tableName 
     * @param mixed $schemaName 
     * @param array $definition 
     * @param  $string tableName
     * @return  
     */
	public function createTable($tableName, $schemaName, $definition) {}

    /**
     * Generates SQL to drop a table
     *
     * @param string $tableName 
     * @param string $schemaName 
     * @param boolean $ifExists 
     * @return boolean 
     */
	public function dropTable($tableName, $schemaName, $ifExists = true) {}

    /**
     * Generates SQL to create a view
     *
     * @param string $viewName 
     * @param array $definition 
     * @param string $schemaName 
     * @return string 
     */
	public function createView($viewName, $definition, $schemaName) {}

    /**
     * Generates SQL to drop a view
     *
     * @param string $viewName 
     * @param string $schemaName 
     * @param boolean $ifExists 
     * @return string 
     */
	public function dropView($viewName, $schemaName, $ifExists = true) {}

    /**
     * Generates SQL checking for the existence of a schema.table
     * <code>echo dialect->tableExists("posts", "blog")</code>
     * <code>echo dialect->tableExists("posts")</code>
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
     * Generates a SQL describing a table
     * <code>print_r(dialect->describeColumns("posts") ?></code>
     *
     * @param string $table 
     * @param string $schema 
     * @return string 
     */
	public function describeColumns($table, $schema = null) {}

    /**
     * List all tables in database
     * <code>
     * print_r(dialect->listTables("blog")) ?>
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
     * Generates SQL to query indexes on a table
     *
     * @param	string table
     * @param	string schema
     * @return	string
     * @param mixed $table 
     * @param mixed $schema 
     * @return string 
     */
	public function describeIndexes($table, $schema = null) {}

    /**
     * Generates SQL to query foreign keys on a table
     *
     * @param	string table
     * @param	string schema
     * @return	string
     * @param mixed $table 
     * @param mixed $schema 
     * @return string 
     */
	public function describeReferences($table, $schema = null) {}

    /**
     * Generates the SQL to describe the table creation options
     *
     * @param	string table
     * @param	string schema
     * @return	string
     * @param mixed $table 
     * @param mixed $schema 
     * @return string 
     */
	public function tableOptions($table, $schema = null) {}

}
