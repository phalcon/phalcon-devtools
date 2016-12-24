<?php

namespace Phalcon\Db;

/**
 * Phalcon\Db\AdapterInterface
 *
 * Interface for Phalcon\Db adapters
 */
interface AdapterInterface
{

    /**
     * Returns the first row in a SQL query result
     *
     * @param string $sqlQuery
     * @param int $fetchMode
     * @param int $placeholders
     * @return array
     */
    public function fetchOne($sqlQuery, $fetchMode = 2, $placeholders = null);

    /**
     * Dumps the complete result of a query into an array
     *
     * @param string $sqlQuery
     * @param int $fetchMode
     * @param int $placeholders
     * @return array
     */
    public function fetchAll($sqlQuery, $fetchMode = 2, $placeholders = null);

    /**
     * Inserts data into a table using custom RDBMS SQL syntax
     *
     * @param mixed $table
     * @param array $values
     * @param mixed $fields
     * @param mixed $dataTypes
     * @param $string table
     * @param $array dataTypes
     * @return 
     */
    public function insert($table, array $values, $fields = null, $dataTypes = null);

    /**
     * Updates data on a table using custom RDBMS SQL syntax
     *
     * @param mixed $table
     * @param mixed $fields
     * @param mixed $values
     * @param mixed $whereCondition
     * @param mixed $dataTypes
     * @param $string whereCondition
     * @param $array dataTypes
     * @return 
     */
    public function update($table, $fields, $values, $whereCondition = null, $dataTypes = null);

    /**
     * Deletes data from a table using custom RDBMS SQL syntax
     *
     * @param string $table
     * @param string $whereCondition
     * @param array $placeholders
     * @param array $dataTypes
     * @return boolean
     */
    public function delete($table, $whereCondition = null, $placeholders = null, $dataTypes = null);

    /**
     * Gets a list of columns
     *
     * @param	array columnList
     * @return	string
     * @param mixed $columnList
     */
    public function getColumnList($columnList);

    /**
     * Appends a LIMIT clause to sqlQuery argument
     *
     * @param mixed $sqlQuery
     * @param mixed $number
     * @param $string sqlQuery
     * @param $int number
     * @return 
     */
    public function limit($sqlQuery, $number);

    /**
     * Generates SQL checking for the existence of a schema.table
     *
     * @param string $tableName
     * @param string $schemaName
     * @return bool
     */
    public function tableExists($tableName, $schemaName = null);

    /**
     * Generates SQL checking for the existence of a schema.view
     *
     * @param string $viewName
     * @param string $schemaName
     * @return bool
     */
    public function viewExists($viewName, $schemaName = null);

    /**
     * Returns a SQL modified with a FOR UPDATE clause
     *
     * @param string $sqlQuery
     * @return string
     */
    public function forUpdate($sqlQuery);

    /**
     * Returns a SQL modified with a LOCK IN SHARE MODE clause
     *
     * @param string $sqlQuery
     * @return string
     */
    public function sharedLock($sqlQuery);

    /**
     * Creates a table
     *
     * @param string $tableName
     * @param string $schemaName
     * @param array $definition
     * @return bool
     */
    public function createTable($tableName, $schemaName, array $definition);

    /**
     * Drops a table from a schema/database
     *
     * @param string $tableName
     * @param string $schemaName
     * @param bool $ifExists
     * @return bool
     */
    public function dropTable($tableName, $schemaName = null, $ifExists = true);

    /**
     * Creates a view
     *
     * @param string $viewName
     * @param array $definition
     * @param string $schemaName
     * @return bool
     */
    public function createView($viewName, array $definition, $schemaName = null);

    /**
     * Drops a view
     *
     * @param string $viewName
     * @param string $schemaName
     * @param bool $ifExists
     * @return bool
     */
    public function dropView($viewName, $schemaName = null, $ifExists = true);

    /**
     * Adds a column to a table
     *
     * @param string $tableName
     * @param string $schemaName
     * @param ColumnInterface $column
     * @return bool
     */
    public function addColumn($tableName, $schemaName, ColumnInterface $column);

    /**
     * Modifies a table column based on a definition
     *
     * @param string $tableName
     * @param string $schemaName
     * @param ColumnInterface $column
     * @param ColumnInterface $currentColumn
     * @return bool
     */
    public function modifyColumn($tableName, $schemaName, ColumnInterface $column, ColumnInterface $currentColumn = null);

    /**
     * Drops a column from a table
     *
     * @param string $tableName
     * @param string $schemaName
     * @param string $columnName
     * @return bool
     */
    public function dropColumn($tableName, $schemaName, $columnName);

    /**
     * Adds an index to a table
     *
     * @param string $tableName
     * @param string $schemaName
     * @param IndexInterface $index
     * @return bool
     */
    public function addIndex($tableName, $schemaName, IndexInterface $index);

    /**
     * Drop an index from a table
     *
     * @param string $tableName
     * @param string $schemaName
     * @param string $indexName
     * @return bool
     */
    public function dropIndex($tableName, $schemaName, $indexName);

    /**
     * Adds a primary key to a table
     *
     * @param string $tableName
     * @param string $schemaName
     * @param IndexInterface $index
     * @return bool
     */
    public function addPrimaryKey($tableName, $schemaName, IndexInterface $index);

    /**
     * Drops primary key from a table
     *
     * @param string $tableName
     * @param string $schemaName
     * @return bool
     */
    public function dropPrimaryKey($tableName, $schemaName);

    /**
     * Adds a foreign key to a table
     *
     * @param string $tableName
     * @param string $schemaName
     * @param ReferenceInterface $reference
     * @return bool
     */
    public function addForeignKey($tableName, $schemaName, ReferenceInterface $reference);

    /**
     * Drops a foreign key from a table
     *
     * @param string $tableName
     * @param string $schemaName
     * @param string $referenceName
     * @return bool
     */
    public function dropForeignKey($tableName, $schemaName, $referenceName);

    /**
     * Returns the SQL column definition from a column
     *
     * @param ColumnInterface $column
     * @return string
     */
    public function getColumnDefinition(ColumnInterface $column);

    /**
     * List all tables on a database
     *
     * @param string $schemaName
     * @return array
     */
    public function listTables($schemaName = null);

    /**
     * List all views on a database
     *
     * @param string $schemaName
     * @return array
     */
    public function listViews($schemaName = null);

    /**
     * Return descriptor used to connect to the active database
     *
     * @return array
     */
    public function getDescriptor();

    /**
     * Gets the active connection unique identifier
     *
     * @return string
     */
    public function getConnectionId();

    /**
     * Active SQL statement in the object
     *
     * @return string
     */
    public function getSQLStatement();

    /**
     * Active SQL statement in the object without replace bound parameters
     *
     * @return string
     */
    public function getRealSQLStatement();

    /**
     * Active SQL statement in the object
     *
     * @return array
     */
    public function getSQLVariables();

    /**
     * Active SQL statement in the object
     *
     * @return array
     */
    public function getSQLBindTypes();

    /**
     * Returns type of database system the adapter is used for
     *
     * @return string
     */
    public function getType();

    /**
     * Returns the name of the dialect used
     *
     * @return string
     */
    public function getDialectType();

    /**
     * Returns internal dialect instance
     *
     * @return DialectInterface
     */
    public function getDialect();

    /**
     * This method is automatically called in \Phalcon\Db\Adapter\Pdo constructor.
     * Call it when you need to restore a database connection
     *
     * @param array $descriptor
     * @return bool
     */
    public function connect(array $descriptor = null);

    /**
     * Sends SQL statements to the database server returning the success state.
     * Use this method only when the SQL statement sent to the server return rows
     *
     * @param string $sqlStatement
     * @param mixed $placeholders
     * @param mixed $dataTypes
     * @return bool|ResultInterface
     */
    public function query($sqlStatement, $placeholders = null, $dataTypes = null);

    /**
     * Sends SQL statements to the database server returning the success state.
     * Use this method only when the SQL statement sent to the server doesn't return any rows
     *
     * @param string $sqlStatement
     * @param mixed $placeholders
     * @param mixed $dataTypes
     * @return bool
     */
    public function execute($sqlStatement, $placeholders = null, $dataTypes = null);

    /**
     * Returns the number of affected rows by the last INSERT/UPDATE/DELETE reported by the database system
     *
     * @return int
     */
    public function affectedRows();

    /**
     * Closes active connection returning success. Phalcon automatically closes
     * and destroys active connections within Phalcon\Db\Pool
     *
     * @return bool
     */
    public function close();

    /**
     * Escapes a column/table/schema name
     *
     * @param string $identifier
     * @return string
     */
    public function escapeIdentifier($identifier);

    /**
     * Escapes a value to avoid SQL injections
     *
     * @param string $str
     * @return string
     */
    public function escapeString($str);

    /**
     * Returns insert id for the auto_increment column inserted in the last SQL statement
     *
     * @param string $sequenceName
     * @return int
     */
    public function lastInsertId($sequenceName = null);

    /**
     * Starts a transaction in the connection
     *
     * @param bool $nesting
     * @return bool
     */
    public function begin($nesting = true);

    /**
     * Rollbacks the active transaction in the connection
     *
     * @param bool $nesting
     * @return bool
     */
    public function rollback($nesting = true);

    /**
     * Commits the active transaction in the connection
     *
     * @param bool $nesting
     * @return bool
     */
    public function commit($nesting = true);

    /**
     * Checks whether connection is under database transaction
     *
     * @return bool
     */
    public function isUnderTransaction();

    /**
     * Return internal PDO handler
     *
     * @return \Pdo
     */
    public function getInternalHandler();

    /**
     * Lists table indexes
     *
     * @param string $table
     * @param string $schema
     * @return IndexInterface[]
     */
    public function describeIndexes($table, $schema = null);

    /**
     * Lists table references
     *
     * @param string $table
     * @param string $schema
     * @return ReferenceInterface[]
     */
    public function describeReferences($table, $schema = null);

    /**
     * Gets creation options from a table
     *
     * @param string $tableName
     * @param string $schemaName
     * @return array
     */
    public function tableOptions($tableName, $schemaName = null);

    /**
     * Check whether the database system requires an explicit value for identity columns
     *
     * @return bool
     */
    public function useExplicitIdValue();

    /**
     * Return the default identity value to insert in an identity column
     *
     * @return RawValue
     */
    public function getDefaultIdValue();

    /**
     * Check whether the database system requires a sequence to produce auto-numeric values
     *
     * @return bool
     */
    public function supportSequences();

    /**
     * Creates a new savepoint
     *
     * @param string $name
     * @return bool
     */
    public function createSavepoint($name);

    /**
     * Releases given savepoint
     *
     * @param string $name
     * @return bool
     */
    public function releaseSavepoint($name);

    /**
     * Rollbacks given savepoint
     *
     * @param string $name
     * @return bool
     */
    public function rollbackSavepoint($name);

    /**
     * Set if nested transactions should use savepoints
     *
     * @param bool $nestedTransactionsWithSavepoints
     * @return AdapterInterface
     */
    public function setNestedTransactionsWithSavepoints($nestedTransactionsWithSavepoints);

    /**
     * Returns if nested transactions should use savepoints
     *
     * @return bool
     */
    public function isNestedTransactionsWithSavepoints();

    /**
     * Returns the savepoint name to use for nested transactions
     *
     * @return string
     */
    public function getNestedTransactionSavepointName();

    /**
     * Returns an array of Phalcon\Db\Column objects describing a table
     *
     * @param string $table
     * @param string $schema
     * @return ColumnInterface[]
     */
    public function describeColumns($table, $schema = null);

}
