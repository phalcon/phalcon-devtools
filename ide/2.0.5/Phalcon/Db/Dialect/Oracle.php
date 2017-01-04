<?php

namespace Phalcon\Db\Dialect;

use Phalcon\Text;
use Phalcon\Db\Dialect;
use Phalcon\Db\Column;
use Phalcon\Db\Exception;
use Phalcon\Db\IndexInterface;
use Phalcon\Db\ColumnInterface;
use Phalcon\Db\ReferenceInterface;


class Oracle extends Dialect
{

	protected $_escapeChar = '';



	/**
	 * Generates the SQL for LIMIT clause
	 * 
	 * @param string $sqlQuery
	 * @param mixed $number
	 *
	 * @return string
	 */
	public function limit($sqlQuery, $number) {}

	/**
	 * Gets the column name in Oracle
	 * 
	 * @param ColumnInterface $column
	 *
	 * @return string
	 */
	public function getColumnDefinition(ColumnInterface $column) {}

	/**
	 * Generates SQL to add a column to a table
	 * 
	 * @param string $tableName
	 * @param string $schemaName
	 * @param ColumnInterface $column
	 *
	 * @return string
	 */
	public function addColumn($tableName, $schemaName, ColumnInterface $column) {}

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
	public function modifyColumn($tableName, $schemaName, ColumnInterface $column, ColumnInterface $currentColumn=null) {}

	/**
	 * Generates SQL to delete a column from a table
	 * 
	 * @param string $tableName
	 * @param string $schemaName
	 * @param string $columnName
	 *
	 * @return string
	 */
	public function dropColumn($tableName, $schemaName, $columnName) {}

	/**
	 * Generates SQL to add an index to a table
	 * 
	 * @param string $tableName
	 * @param string $schemaName
	 * @param IndexInterface $index
	 *
	 * @return string
	 */
	public function addIndex($tableName, $schemaName, IndexInterface $index) {}

	/**
	/**
	 * Generates SQL to delete an index from a table
	 * 
	 * @param string $tableName
	 * @param string $schemaName
	 * @param string $indexName
	 *
	 * @return string
	 */
	public function dropIndex($tableName, $schemaName, $indexName) {}

	/**
	 * Generates SQL to add the primary key to a table
	 * 
	 * @param string $tableName
	 * @param string $schemaName
	 * @param IndexInterface $index
	 *
	 * @return string
	 */
	public function addPrimaryKey($tableName, $schemaName, IndexInterface $index) {}

	/**
	 * Generates SQL to delete primary key from a table
	 * 
	 * @param string $tableName
	 * @param string $schemaName
	 *
	 * @return string
	 */
	public function dropPrimaryKey($tableName, $schemaName) {}

	/**
	 * Generates SQL to add an index to a table
	 * 
	 * @param string $tableName
	 * @param string $schemaName
	 * @param ReferenceInterface $reference
	 *
	 * @return string
	 */
	public function addForeignKey($tableName, $schemaName, ReferenceInterface $reference) {}

	/**
	 * Generates SQL to delete a foreign key from a table
	 * 
	 * @param string $tableName
	 * @param string $schemaName
	 * @param string $referenceName
	 *
	 * @return string
	 */
	public function dropForeignKey($tableName, $schemaName, $referenceName) {}

	/**
	 * Generates SQL to create a table in Oracle
	 * 
	 * @param string $tableName
	 * @param string $schemaName
	 * @param array $definition
	 *
	 * @return string
	 */
	public function createTable($tableName, $schemaName, array $definition) {}

	/**
	 * Generates SQL to drop a table
	 * 
	 * @param string $tableName
	 * @param string $schemaName
	 * @param boolean $ifExists
	 *
	 * @return string
	 */
	public function dropTable($tableName, $schemaName, $ifExists=true) {}

	/**
	 * Generates SQL to create a view
	 * 
	 * @param string $viewName
	 * @param array $definition
	 * @param string $schemaName
	 *
	 * @return string
	 */
	public function createView($viewName, array $definition, $schemaName=null) {}

	/**
	 * Generates SQL to drop a view
	 * 
	 * @param string $viewName
	 * @param string $schemaName
	 * @param boolean $ifExists
	 *
	 * @return string
	 */
	public function dropView($viewName, $schemaName=null, $ifExists=true) {}

	/**
	 * Generates SQL checking for the existence of a schema.view
	 * 
	 * @param string $viewName
	 * @param string $schemaName
	 *
	 * @return string
	 */
	public function viewExists($viewName, $schemaName=null) {}

	/**
	 * Generates the SQL to list all views of a schema or user
	 * 
	 * @param string $schemaName
	 *
	 * @return string
	 */
	public function listViews($schemaName=null) {}

	/**
	 * Generates SQL checking for the existence of a schema.table
	 *
	 * <code>
	 *    echo $dialect->tableExists("posts", "blog");
	 *    echo $dialect->tableExists("posts");
	 * </code>
	 * 
	 * @param string $tableName
	 * @param string $schemaName
	 *
	 * @return string
	 */
	public function tableExists($tableName, $schemaName=null) {}

	/**
	 * Generates SQL describing a table
	 *
	 * <code>
	 *    print_r($dialect->describeColumns("posts"));
	 * </code>
	 * 
	 * @param string $table
	 * @param string $schema
	 *
	 * @return string
	 */
	public function describeColumns($table, $schema=null) {}

	/**
	 * List all tables in database
	 *
	 * <code>
	 *    print_r($dialect->listTables("blog"))
	 * </code>
	 * 
	 * @param string $schemaName
	 *
	 * @return string
	 */
	public function listTables($schemaName=null) {}

	/**
	 * Generates SQL to query indexes on a table
	 * 
	 * @param string $table
	 * @param string $schema
	 *
	 * @return string
	 */
	public function describeIndexes($table, $schema=null) {}

	/**
	 * Generates SQL to query foreign keys on a table
	 * 
	 * @param string $table
	 * @param string $schema
	 *
	 * @return string
	 */
	public function describeReferences($table, $schema=null) {}

	/**
	 * Generates the SQL to describe the table creation options
	 * 
	 * @param string $table
	 * @param string $schema
	 *
	 * @return string
	 */
	public function tableOptions($table, $schema=null) {}

	/**
	 * Checks whether the platform supports savepoints
	 *
	 * @return boolean
	 */
	public function supportsSavepoints() {}

	/**
	 * Checks whether the platform supports releasing savepoints.
	 *
	 * @return boolean
	 */
	public function supportsReleaseSavepoints() {}

}
