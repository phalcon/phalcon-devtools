<?php

namespace Phalcon\Db;

interface DialectInterface
{

    /**
     * Generates the SQL for LIMIT clause
     *
     * @param string $sqlQuery 
     * @param int $number 
     * @return string 
     */
	public function limit($sqlQuery, $number);

    /**
     * Returns a SQL modified with a FOR UPDATE clause
     *
     * @param	string sqlQuery
     * @return	string
     * @param mixed $sqlQuery 
     */
	public function forUpdate($sqlQuery);

    /**
     * Returns a SQL modified with a LOCK IN SHARE MODE clause
     *
     * @param	string sqlQuery
     * @return	string
     * @param mixed $sqlQuery 
     */
	public function sharedLock($sqlQuery);

    /**
     * Builds a SELECT statement
     *
     * @param array $definition 
     * @return string 
     */
	public function select(array $definition);

    /**
     * Gets a list of columns
     *
     * @param	array columnList
     * @return	string
     * @param array $columnList 
     */
	public function getColumnList($columnList);

    /**
     * Gets the column name in MySQL
     *
     * @param mixed $column 
     */
	public function getColumnDefinition(\Phalcon\Db\ColumnInterface $column);

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
	public function addColumn($tableName, $schemaName, \Phalcon\Db\ColumnInterface $column);

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
	public function modifyColumn($tableName, $schemaName, \Phalcon\Db\ColumnInterface $column);

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
	public function dropColumn($tableName, $schemaName, $columnName);

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
	public function addIndex($tableName, $schemaName, \Phalcon\Db\IndexInterface $index);

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
	public function dropIndex($tableName, $schemaName, $indexName);

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
	public function addPrimaryKey($tableName, $schemaName, \Phalcon\Db\IndexInterface $index);

    /**
     * Generates SQL to delete primary key from a table
     *
     * @param	string tableName
     * @param	string schemaName
     * @return	string
     * @param mixed $tableName 
     * @param mixed $schemaName 
     */
	public function dropPrimaryKey($tableName, $schemaName);

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
	public function addForeignKey($tableName, $schemaName, \Phalcon\Db\ReferenceInterface $reference);

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
	public function dropForeignKey($tableName, $schemaName, $referenceName);

    /**
     * Generates SQL to create a table
     *
     * @param	string schemaName
     * @param	array definition
     * @param mixed $tableName 
     * @param mixed $schemaName 
     * @param array $definition 
     * @param  $string tableName
     * @return  
     */
	public function createTable($tableName, $schemaName, array $definition);

    /**
     * Generates SQL to drop a table
     *
     * @param string $tableName 
     * @param string $schemaName 
     * @return string 
     */
	public function dropTable($tableName, $schemaName);

    /**
     * Generates SQL checking for the existence of a schema.table
     *
     * @param string $tableName 
     * @param string $schemaName 
     * @return string 
     */
	public function tableExists($tableName, $schemaName = null);

    /**
     * Generates SQL to describe a table
     *
     * @param string $table 
     * @param string $schema 
     * @return string 
     */
	public function describeColumns($table, $schema = null);

    /**
     * List all tables in database
     *
     * @param string $schemaName 
     * @return array 
     */
	public function listTables($schemaName = null);

    /**
     * Generates SQL to query indexes on a table
     *
     * @param	string table
     * @param	string schema
     * @return	string
     * @param mixed $table 
     * @param mixed $schema 
     */
	public function describeIndexes($table, $schema = null);

    /**
     * Generates SQL to query foreign keys on a table
     *
     * @param	string table
     * @param	string schema
     * @return	string
     * @param mixed $table 
     * @param mixed $schema 
     */
	public function describeReferences($table, $schema = null);

    /**
     * Generates the SQL to describe the table creation options
     *
     * @param	string table
     * @param	string schema
     * @return	string
     * @param mixed $table 
     * @param mixed $schema 
     */
	public function tableOptions($table, $schema = null);

    /**
     * Checks whether the platform supports savepoints
     *
     * @return boolean 
     */
	public function supportsSavepoints();

    /**
     * Checks whether the platform supports releasing savepoints.
     *
     * @return boolean 
     */
	public function supportsReleaseSavepoints();

    /**
     * Generate SQL to create a new savepoint
     *
     * @param string $name 
     * @return string 
     */
	public function createSavepoint($name);

    /**
     * Generate SQL to release a savepoint
     *
     * @param string $name 
     * @return string 
     */
	public function releaseSavepoint($name);

    /**
     * Generate SQL to rollback a savepoint
     *
     * @param string $name 
     * @return string 
     */
	public function rollbackSavepoint($name);

}
