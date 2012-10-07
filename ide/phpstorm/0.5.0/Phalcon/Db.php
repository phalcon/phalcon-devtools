<?php 

namespace Phalcon {

	/**
	 * Phalcon\Db
	 *
	 * Phalcon\Db and its related classes provide a simple SQL database interface for Phalcon Framework.
	 * The Phalcon\Db is the basic class you use to connect your PHP application to an RDBMS.
	 * There is a different adapter class for each brand of RDBMS.
	 *
	 * This component is intended to lower level database operations. If you want to interact with databases using
	 * higher level of abstraction use Phalcon\Mvc\Model.
	 *
	 * Phalcon\Db is an abstract class. You only can use it with a database adapter like Phalcon\Db\Adapter\Pdo
	 *
	 * <code>
	 *
	 *try {
	 *
	 *  $connection = new Phalcon\Db\Adapter\Pdo\Mysql(array(
	 *     'host' => '192.168.0.11',
	 *     'username' => 'sigma',
	 *     'password' => 'secret',
	 *     'dbname' => 'blog',
	 *     'port' => '3306',
	 *  ));
	 *
	 *  $result = $connection->query("SELECT * FROM robots LIMIT 5");
	 *  $result->setFetchMode(Phalcon\Db::FETCH_NUM);
	 *  while($robot = $result->fetchArray()){
	 *    print_r($robot);
	 *  }
	 *
	 *} catch(Phalcon\Db\Exception $e){
	 *	echo $e->getMessage(), PHP_EOL;
	 *}
	 *
	 * </code>
	 */
	
	abstract class Db {

		const FETCH_ASSOC = 1;

		const FETCH_BOTH = 2;

		const FETCH_NUM = 3;

		protected $_eventsManager;

		protected $_descriptor;

		protected $_dialectType;

		protected $_type;

		protected $_dialect;

		protected $_connectionId;

		protected $_sqlStatement;

		protected static $_connectionConsecutive;

		/**
		 * \Phalcon\Db constructor
		 *
		 * @param array $descriptor
		 */
		protected function __construct(){ }


		/**
		 * Sets the event manager
		 *
		 * @param \Phalcon\Events\Manager $eventsManager
		 */
		public function setEventsManager($eventsManager){ }


		/**
		 * Returns the internal event manager
		 *
		 * @return \Phalcon\Events\Manager
		 */
		public function getEventsManager(){ }


		/**
		 * Returns the first row in a SQL query result
		 *
		 *<code>
		 *	//Getting first robot
		 *	$robot = $connection->fecthOne("SELECT * FROM robots");
		 *	print_r($robot);
		 *
		 *	//Getting first robot with associative indexes only
		 *	$robot = $connection->fecthOne("SELECT * FROM robots", \Phalcon\Db::FETCH_ASSOC);
		 *	print_r($robot);
		 *</code>
		 *
		 * @param string $sqlQuery
		 * @param int $fetchMode
		 * @return array
		 */
		public function fetchOne($sqlQuery, $fetchMode){ }


		/**
		 * Dumps the complete result of a query into an array
		 *
		 *<code>
		 *	//Getting all robots
		 *	$robots = $connection->fetchAll("SELECT * FROM robots");
		 *	foreach($robots as $robot){
		 *		print_r($robot);
		 *	}
		 *
		 *	//Getting all robots with associative indexes only
		 *	$robots = $connection->fetchAll("SELECT * FROM robots", \Phalcon\Db::FETCH_ASSOC);
		 *	foreach($robots as $robot){
		 *		print_r($robot);
		 *	}
		 *</code>
		 *
		 * @param string $sqlQuery
		 * @param int $fetchMode
		 * @return array
		 */
		public function fetchAll($sqlQuery, $fetchMode){ }


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
		 * @return 	boolean
		 */
		public function insert($table, $values, $fields){ }


		/**
		 * Updates data on a table using custom RBDM SQL syntax
		 *
		 * <code>
		 * //Updating existing robot
		 * $success = $connection->update(
		 *     "robots",
		 *     array("name")
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
		 * @return 	boolean
		 */
		public function update($table, $fields, $values, $whereCondition){ }


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
		 * @return boolean
		 */
		public function delete($table, $whereCondition, $placeholders){ }


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
		 * <code>$connection->limit("SELECT * FROM robots", 5);</code>
		 *
		 * @param  	string $sqlQuery
		 * @param 	int $number
		 * @return 	string
		 */
		public function limit($sqlQuery, $number){ }


		/**
		 * Generates SQL checking for the existence of a schema.table
		 *
		 * <code>$connection->tableExists("blog", "posts")</code>
		 *
		 * @param string $tableName
		 * @param string $schemaName
		 * @return string
		 */
		public function tableExists($tableName, $schemaName){ }


		/**
		 * Generates SQL checking for the existence of a schema.view
		 *
		 * <code>$connection->viewExists("active_users", "posts")</code>
		 *
		 * @param string $viewName
		 * @param string $schemaName
		 * @return string
		 */
		public function viewExists($viewName, $schemaName){ }


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
		 * Creates a table using MySQL SQL
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
		public function dropTable($tableName, $schemaName, $ifExists){ }


		/**
		 * Adds a column to a table
		 *
		 * @param string $tableName
		 * @param 	string $schemaName
		 * @param \Phalcon\Db\Column $column
		 * @return boolean
		 */
		public function addColumn($tableName, $schemaName, $column){ }


		/**
		 * Modifies a table column based on a definition
		 *
		 * @param string $tableName
		 * @param string $schemaName
		 * @param \Phalcon\Db\Column $column
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
		 * @param DbIndex $index
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
		 * @param \Phalcon\Db\Index $index
		 * @return 	boolean
		 */
		public function addPrimaryKey($tableName, $schemaName, $index){ }


		/**
		 * Drops primary key from a table
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
		 * @param \Phalcon\Db\Reference $reference
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
		 * @param \Phalcon\Db\Column $column
		 * @return string
		 */
		public function getColumnDefinition($column){ }


		/**
		 * List all tables on a database
		 *
		 * <code> print_r($connection->listTables("blog") ?></code>
		 *
		 * @param string $schemaName
		 * @return array
		 */
		public function listTables($schemaName){ }


		/**
		 * Return descriptor used to connect to the active database
		 *
		 * @return string
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
		 */
		public function getSQLStatement(){ }


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


		/**
		 * Returns internal dialect instance
		 *
		 * @return \Phalcon\Db\Dialect
		 */
		public function getDialect(){ }

	}
}
