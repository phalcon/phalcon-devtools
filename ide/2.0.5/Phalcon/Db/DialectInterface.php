<?php

namespace Phalcon\Db;

use Phalcon\Db\ColumnInterface;
use Phalcon\Db\ReferenceInterface;
use Phalcon\Db\IndexInterface;


interface DialectInterface
{

	/**
	 * Generates the SQL for LIMIT clause
	 * 
	 * @param string $sqlQuery
	 * @param mixed $number
	 *
	 * @return string
	 */
	public function limit($sqlQuery, $number);

	/**
	 * Returns a SQL modified with a FOR UPDATE clause
	 * 
	 * @param string $sqlQuery
	 *
	 * @return string
	 */
	public function forUpdate($sqlQuery);

	/**
	 * Returns a SQL modified with a LOCK IN SHARE MODE clause
	 * 
	 * @param string $sqlQuery
	 *
	 * @return string
	 */
	public function sharedLock($sqlQuery);

	/**
	 * Builds a SELECT statement
	 * 
	 * @param array $definition
	 *
	 * @return string
	 */
	public function select(array $definition);

	/**
	 * Gets a list of columns
	 * 
	 * @param array $columnList
	 *
	 * @return string
	 */
	public function getColumnList(array $columnList);

	/**
	 * Gets the column name in RDBMS
	 * 
	 * @param ColumnInterface $column
	 *
	 * @return string
	 */
	public function getColumnDefinition(ColumnInterface $column);

	/**
	 * Generates SQL to add a column to a table
	 * 
	 * @param string $tableName
	 * @param string $schemaName
	 * @param ColumnInterface $column
	 *
	 * @return string
	 */
	public function addColumn($tableName, $schemaName, ColumnInterface $column);

	/**
	 * Generates SQL to modify a column in a table
	 * 
	 * @param string $tableName
	 * @param string $schemaName
	 * @param ColumnInterface $column
	 * @param ColumnInterface $currentColumn
	 *
	 * @return string
	 */
	public function modifyColumn($tableName, $schemaName, ColumnInterface $column, ColumnInterface $currentColumn=null);

	/**
	 * Generates SQL to delete a column from a table
	 * 
	 * @param string $tableName
	 * @param string $schemaName
	 * @param string $columnName
	 *
	 * @return string
	 */
	public function dropColumn($tableName, $schemaName, $columnName);

	/**
	 * Generates SQL to add an index to a table
	 * 
	 * @param string $tableName
	 * @param string $schemaName
	 * @param IndexInterface $index
	 *
	 * @return string
	 */
	public function addIndex($tableName, $schemaName, IndexInterface $index);

	/**
 	 * Generates SQL to delete an index from a table
	 * 
	 * @param string $tableName
	 * @param string $schemaName
	 * @param string $indexName
	 *
	 * @return string
	 */
	public function dropIndex($tableName, $schemaName, $indexName);

	/**
	 * Generates SQL to add the primary key to a table
	 * 
	 * @param string $tableName
	 * @param string $schemaName
	 * @param IndexInterface $index
	 *
	 * @return string
	 */
	public function addPrimaryKey($tableName, $schemaName, IndexInterface $index);

	/**
	 * Generates SQL to delete primary key from a table
	 * 
	 * @param string $tableName
	 * @param string $schemaName
	 *
	 * @return string
	 */
	public function dropPrimaryKey($tableName, $schemaName);

	/**
	 * Generates SQL to add an index to a table
	 * 
	 * @param string $tableName
	 * @param string $schemaName
	 * @param ReferenceInterface $reference
	 *
	 * @return string
	 */
	public function addForeignKey($tableName, $schemaName, ReferenceInterface $reference);

	/**
	 * Generates SQL to delete a foreign key from a table
	 * 
	 * @param string $tableName
	 * @param string $schemaName
	 * @param string $referenceName
	 *
	 * @return string
	 */
	public function dropForeignKey($tableName, $schemaName, $referenceName);

	/**
	 * Generates SQL to create a table
	 * 
	 * @param string $tableName
	 * @param string $schemaName
	 * @param array $definition
	 *
	 * @return string
	 */
	public function createTable($tableName, $schemaName, array $definition);

	/**
	 * Generates SQL to create a view
	 * 
	 * @param string $viewName
	 * @param array $definition
	 * @param string $schemaName
	 *
	 * @return string
	 */
	public function createView($viewName, array $definition, $schemaName=null);

	/**
	 * Generates SQL to drop a table
	 * 
	 * @param string $tableName
	 * @param string $schemaName
	 *
	 * @return string
	 */
	public function dropTable($tableName, $schemaName);

	/**
	 * Generates SQL to drop a view
	 * 
	 * @param string $viewName
	 * @param string $schemaName
	 * @param boolean $ifExists
	 *
	 * @return string
	 */
	public function dropView($viewName, $schemaName=null, $ifExists=true);

	/**
	 * Generates SQL checking for the existence of a schema.table
	 * 
	 * @param string $tableName
	 * @param string $schemaName
	 *
	 * @return string
	 */
	public function tableExists($tableName, $schemaName=null);

	/**
	 * Generates SQL checking for the existence of a schema.view
	 * 
	 * @param string $viewName
	 * @param string $schemaName
	 *
	 * @return string
	 */
	public function viewExists($viewName, $schemaName=null);

	/**
	 * Generates SQL to describe a table
	 * 
	 * @param string $table
	 * @param string $schema
	 *
	 * @return string
	 */
	public function describeColumns($table, $schema=null);

	/**
	 * List all tables in database
	 * 
	 * @param string $schemaName
	 *
	 * @return string
	 */
	public function listTables($schemaName=null);

	/**
	 * Generates SQL to query indexes on a table
	 * 
	 * @param string $table
	 * @param string $schema
	 *
	 * @return string
	 */
	public function describeIndexes($table, $schema=null);

	/**
	 * Generates SQL to query foreign keys on a table
	 * 
	 * @param string $table
	 * @param string $schema
	 *
	 * @return string
	 */
	public function describeReferences($table, $schema=null);

	/**
	 * Generates the SQL to describe the table creation options
	 * 
	 * @param string $table
	 * @param string $schema
	 *
	 * @return string
	 */
	public function tableOptions($table, $schema=null);

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
	 *
	 * @return string
	 */
	public function createSavepoint($name);

	/**
	 * Generate SQL to release a savepoint
	 * 
	 * @param string $name
	 *
	 * @return string
	 */
	public function releaseSavepoint($name);

	/**
	 * Generate SQL to rollback a savepoint
	 * 
	 * @param string $name
	 *
	 * @return string
	 */
	public function rollbackSavepoint($name);

}
