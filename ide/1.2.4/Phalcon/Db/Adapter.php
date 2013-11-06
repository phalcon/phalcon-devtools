<?php 

namespace Phalcon\Db {

	/**
	 * Phalcon\Db\Adapter
	 *
	 * Base class for Phalcon\Db adapters
	 */
	
	abstract class Adapter implements \Phalcon\Events\EventsAwareInterface {

		protected $_eventsManager;

		protected $_descriptor;

		protected $_dialectType;

		protected $_type;

		protected $_dialect;

		protected $_connectionId;

		protected $_sqlStatement;

		protected $_sqlVariables;

		protected $_sqlBindTypes;

		protected $_transactionLevel;

		protected $_transactionsWithSavepoints;

		protected static $_connectionConsecutive;

		/**
		 * \Phalcon\Db\Adapter constructor
		 *
		 * @param array $descriptor
		 */
		protected function __construct(){ }


		/**
		 * Sets the event manager
		 *
		 * @param \Phalcon\Events\ManagerInterface $eventsManager
		 */
		public function setEventsManager($eventsManager){ }


		/**
		 * Returns the internal event manager
		 *
		 * @return \Phalcon\Events\ManagerInterface
		 */
		public function getEventsManager(){ }


		/**
		 * Sets the dialect used to produce the SQL
		 *
		 * @param \Phalcon\Db\DialectInterface
		 */
		public function setDialect($dialect){ }


		/**
		 * Returns internal dialect instance
		 *
		 * @return \Phalcon\Db\DialectInterface
		 */
		public function getDialect(){ }


		/**
		 * Returns the first row in a SQL query result
		 *
		 *<code>
		 *	//Getting first robot
		 *	$robot = $connection->fetchOne("SELECT * FROM robots");
		 *	print_r($robot);
		 *
		 *	//Getting first robot with associative indexes only
		 *	$robot = $connection->fetchOne("SELECT * FROM robots", \Phalcon\Db::FETCH_ASSOC);
		 *	print_r($robot);
		 *</code>
		 *
		 * @param string $sqlQuery
		 * @param int $fetchMode
		 * @param array $bindParams
		 * @param array $bindTypes
		 * @return array
		 */
		public function fetchOne($sqlQuery, $fetchMode=null, $bindParams=null, $bindTypes=null){ }


		/**
		 * Dumps the complete result of a query into an array
		 *
		 *<code>
		 *	//Getting all robots with associative indexes only
		 *	$robots = $connection->fetchAll("SELECT * FROM robots", \Phalcon\Db::FETCH_ASSOC);
		 *	foreach ($robots as $robot) {
		 *		print_r($robot);
		 *	}
		 *
		 *  //Getting all robots that contains word "robot" withing the name
		 *  $robots = $connection->fetchAll("SELECT * FROM robots WHERE name LIKE :name",
		 *		Phalcon\Db::FETCH_ASSOC,
		 *		array('name' => '%robot%')
		 *  );
		 *	foreach($robots as $robot){
		 *		print_r($robot);
		 *	}
		 *</code>
		 *
		 * @param string $sqlQuery
		 * @param int $fetchMode
		 * @param array $bindParams
		 * @param array $bindTypes
		 * @return array
		 */
		public function fetchAll($sqlQuery, $fetchMode=null, $bindParams=null, $bindTypes=null){ }


		/**
		 * Inserts data into a table using custom RBDM SQL syntax
		 *
		 * <code>
		 * //Inserting a new robot
		 * $success = $connection->insert(
		 *     "robots",
		 *     array("Astro Boy", 1952),
		 *     array("name", "year")
		 * );
		 *
		 * //Next SQL sentence is sent to the database system
		 * INSERT INTO `robots` (`name`, `year`) VALUES ("Astro boy", 1952);
		 * </code>
		 *
		 * @param 	string $table
		 * @param 	array $values
		 * @param 	array $fields
		 * @param 	array $dataTypes
		 * @return 	boolean
		 */
		public function insert($table, $values, $fields=null, $dataTypes=null){ }


		/**
		 * Updates data on a table using custom RBDM SQL syntax
		 *
		 * <code>
		 * //Updating existing robot
		 * $success = $connection->update(
		 *     "robots",
		 *     array("name"),
		 *     array("New Astro Boy"),
		 *     "id = 101"
		 * );
		 *
		 * //Next SQL sentence is sent to the database system
		 * UPDATE `robots` SET `name` = "Astro boy" WHERE id = 101
		 * </code>
		 *
		 * @param 	string $table
		 * @param 	array $fields
		 * @param 	array $values
		 * @param 	string $whereCondition
		 * @param 	array $dataTypes
		 * @return 	boolean
		 */
		public function update($table, $fields, $values, $whereCondition=null, $dataTypes=null){ }


		/**
		 * Deletes data from a table using custom RBDM SQL syntax
		 *
		 * <code>
		 * //Deleting existing robot
		 * $success = $connection->delete(
		 *     "robots",
		 *     "id = 101"
		 * );
		 *
		 * //Next SQL sentence is generated
		 * DELETE FROM `robots` WHERE `id` = 101
		 * </code>
		 *
		 * @param  string $table
		 * @param  string $whereCondition
		 * @param  array $placeholders
		 * @param  array $dataTypes
		 * @return boolean
		 */
		public function delete($table, $whereCondition=null, $placeholders=null, $dataTypes=null){ }


		/**
		 * Gets a list of columns
		 *
		 * @param array $columnList
		 * @return string
		 */
		public function getColumnList($columnList){ }


		/**
		 * Appends a LIMIT clause to $sqlQuery argument
		 *
		 * <code>
		 * 	echo $connection->limit("SELECT * FROM robots", 5);
		 * </code>
		 *
		 * @param  	string $sqlQuery
		 * @param 	int $number
		 * @return 	string
		 */
		public function limit($sqlQuery, $number){ }


		/**
		 * Generates SQL checking for the existence of a schema.table
		 *
		 * <code>
		 * 	var_dump($connection->tableExists("blog", "posts"));
		 * </code>
		 *
		 * @param string $tableName
		 * @param string $schemaName
		 * @return string
		 */
		public function tableExists($tableName, $schemaName=null){ }


		/**
		 * Generates SQL checking for the existence of a schema.view
		 *
		 *<code>
		 * var_dump($connection->viewExists("active_users", "posts"));
		 *</code>
		 *
		 * @param string $viewName
		 * @param string $schemaName
		 * @return string
		 */
		public function viewExists($viewName, $schemaName=null){ }


		/**
		 * Returns a SQL modified with a FOR UPDATE clause
		 *
		 * @param string $sqlQuery
		 * @return string
		 */
		public function forUpdate($sqlQuery){ }


		/**
		 * Returns a SQL modified with a LOCK IN SHARE MODE clause
		 *
		 * @param string $sqlQuery
		 * @return string
		 */
		public function sharedLock($sqlQuery){ }


		/**
		 * Creates a table
		 *
		 * @param string $tableName
		 * @param string $schemaName
		 * @param array $definition
		 * @return boolean
		 */
		public function createTable($tableName, $schemaName, $definition){ }


		/**
		 * Drops a table from a schema/database
		 *
		 * @param string $tableName
		 * @param   string $schemaName
		 * @param boolean $ifExists
		 * @return boolean
		 */
		public function dropTable($tableName, $schemaName=null, $ifExists=null){ }


		/**
		 * Creates a view
		 *
		 * @param string $tableName
		 * @param array $definition
		 * @param string $schemaName
		 * @return boolean
		 */
		public function createView($viewName, $definition, $schemaName=null){ }


		/**
		 * Drops a view
		 *
		 * @param string $viewName
		 * @param   string $schemaName
		 * @param boolean $ifExists
		 * @return boolean
		 */
		public function dropView($viewName, $schemaName=null, $ifExists=null){ }


		/**
		 * Adds a column to a table
		 *
		 * @param string $tableName
		 * @param 	string $schemaName
		 * @param \Phalcon\Db\ColumnInterface $column
		 * @return boolean
		 */
		public function addColumn($tableName, $schemaName, $column){ }


		/**
		 * Modifies a table column based on a definition
		 *
		 * @param string $tableName
		 * @param string $schemaName
		 * @param \Phalcon\Db\ColumnInterface $column
		 * @return 	boolean
		 */
		public function modifyColumn($tableName, $schemaName, $column){ }


		/**
		 * Drops a column from a table
		 *
		 * @param string $tableName
		 * @param string $schemaName
		 * @param string $columnName
		 * @return 	boolean
		 */
		public function dropColumn($tableName, $schemaName, $columnName){ }


		/**
		 * Adds an index to a table
		 *
		 * @param string $tableName
		 * @param string $schemaName
		 * @param \Phalcon\Db\IndexInterface $index
		 * @return 	boolean
		 */
		public function addIndex($tableName, $schemaName, $index){ }


		/**
		 * Drop an index from a table
		 *
		 * @param string $tableName
		 * @param string $schemaName
		 * @param string $indexName
		 * @return 	boolean
		 */
		public function dropIndex($tableName, $schemaName, $indexName){ }


		/**
		 * Adds a primary key to a table
		 *
		 * @param string $tableName
		 * @param string $schemaName
		 * @param \Phalcon\Db\IndexInterface $index
		 * @return 	boolean
		 */
		public function addPrimaryKey($tableName, $schemaName, $index){ }


		/**
		 * Drops a table's primary key
		 *
		 * @param string $tableName
		 * @param string $schemaName
		 * @return 	boolean
		 */
		public function dropPrimaryKey($tableName, $schemaName){ }


		/**
		 * Adds a foreign key to a table
		 *
		 * @param string $tableName
		 * @param string $schemaName
		 * @param \Phalcon\Db\ReferenceInterface $reference
		 * @return boolean true
		 */
		public function addForeignKey($tableName, $schemaName, $reference){ }


		/**
		 * Drops a foreign key from a table
		 *
		 * @param string $tableName
		 * @param string $schemaName
		 * @param string $referenceName
		 * @return boolean true
		 */
		public function dropForeignKey($tableName, $schemaName, $referenceName){ }


		/**
		 * Returns the SQL column definition from a column
		 *
		 * @param \Phalcon\Db\ColumnInterface $column
		 * @return string
		 */
		public function getColumnDefinition($column){ }


		/**
		 * List all tables on a database
		 *
		 *<code>
		 * 	print_r($connection->listTables("blog"));
		 *</code>
		 *
		 * @param string $schemaName
		 * @return array
		 */
		public function listTables($schemaName=null){ }


		/**
		 * List all views on a database
		 *
		 *<code>
		 *	print_r($connection->listViews("blog")); ?>
		 *</code>
		 *
		 * @param string $schemaName
		 * @return array
		 */
		public function listViews($schemaName=null){ }


		/**
		 * Lists table indexes
		 *
		 *<code>
		 *	print_r($connection->describeIndexes('robots_parts'));
		 *</code>
		 *
		 * @param string $table
		 * @param string $schema
		 * @return \Phalcon\Db\Index[]
		 */
		public function describeIndexes($table, $schema=null){ }


		/**
		 * Lists table references
		 *
		 *<code>
		 * print_r($connection->describeReferences('robots_parts'));
		 *</code>
		 *
		 * @param string $table
		 * @param string $schema
		 * @return \Phalcon\Db\Reference[]
		 */
		public function describeReferences($table, $schema=null){ }


		/**
		 * Gets creation options from a table
		 *
		 *<code>
		 * print_r($connection->tableOptions('robots'));
		 *</code>
		 *
		 * @param string $tableName
		 * @param string $schemaName
		 * @return array
		 */
		public function tableOptions($tableName, $schemaName=null){ }


		/**
		 * Creates a new savepoint
		 *
		 * @param string $name
		 * @return boolean
		 */
		public function createSavepoint($name){ }


		/**
		 * Releases given savepoint
		 *
		 * @param string $name
		 * @return boolean
		 */
		public function releaseSavepoint($name){ }


		/**
		 * Rollbacks given savepoint
		 *
		 * @param string $name
		 * @return boolean
		 */
		public function rollbackSavepoint($name){ }


		/**
		 * Set if nested transactions should use savepoints
		 *
		 * @param boolean $nestedTransactionsWithSavepoints
		 * @return \Phalcon\Db\AdapterInterface
		 */
		public function setNestedTransactionsWithSavepoints($nestedTransactionsWithSavepoints){ }


		/**
		 * Returns if nested transactions should use savepoints
		 *
		 * @return boolean
		 */
		public function isNestedTransactionsWithSavepoints(){ }


		/**
		 * Returns the savepoint name to use for nested transactions
		 *
		 * @return string
		 */
		public function getNestedTransactionSavepointName(){ }


		/**
		 * Returns the default identity value to be inserted in an identity column
		 *
		 *<code>
		 * //Inserting a new robot with a valid default value for the column 'id'
		 * $success = $connection->insert(
		 *     "robots",
		 *     array($connection->getDefaultIdValue(), "Astro Boy", 1952),
		 *     array("id", "name", "year")
		 * );
		 *</code>
		 *
		 * @return \Phalcon\Db\RawValue
		 */
		public function getDefaultIdValue(){ }


		/**
		 * Check whether the database system requires a sequence to produce auto-numeric values
		 *
		 * @return boolean
		 */
		public function supportSequences(){ }


		/**
		 * Check whether the database system requires an explicit value for identity columns
		 *
		 * @return boolean
		 */
		public function useExplicitIdValue(){ }


		/**
		 * Return descriptor used to connect to the active database
		 *
		 * @return array
		 */
		public function getDescriptor(){ }


		/**
		 * Gets the active connection unique identifier
		 *
		 * @return string
		 */
		public function getConnectionId(){ }


		/**
		 * Active SQL statement in the object
		 *
		 * @return string
		 */
		public function getSQLStatement(){ }


		/**
		 * Active SQL statement in the object without replace bound paramters
		 *
		 * @return string
		 */
		public function getRealSQLStatement(){ }


		/**
		 * Active SQL statement in the object
		 *
		 * @return array
		 */
		public function getSQLVariables(){ }


		/**
		 * Active SQL statement in the object
		 *
		 * @return array
		 */
		public function getSQLBindTypes(){ }


		/**
		 * Returns type of database system the adapter is used for
		 *
		 * @return string
		 */
		public function getType(){ }


		/**
		 * Returns the name of the dialect used
		 *
		 * @return string
		 */
		public function getDialectType(){ }

	}
}
