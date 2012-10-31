<?php 

namespace Phalcon\Db\Adapter {

	/**
	 * Phalcon\Db\Adapter\Pdo
	 *
	 * Phalcon\Db\Adapter\Pdo is the Phalcon\Db that internally uses PDO to connect to a database
	 *
	 * <code>
	 * $connection = new Phalcon\Db\Adapter\Pdo\Mysql(array(
	 *  'host' => '192.168.0.11',
	 *  'username' => 'sigma',
	 *  'password' => 'secret',
	 *  'dbname' => 'blog',
	 *  'port' => '3306',
	 * ));
	 * </code>
	 */
	
	abstract class Pdo extends \Phalcon\Db {

		const FETCH_ASSOC = 1;

		const FETCH_BOTH = 2;

		const FETCH_NUM = 3;

		protected $_pdo;

		protected $_affectedRows;

		/**
		 * Constructor for \Phalcon\Db\Adapter\Pdo
		 *
		 * @param array $descriptor
		 */
		public function __construct($descriptor){ }


		/**
		 * This method is automatically called in \Phalcon\Db\Adapter\Pdo constructor.
		 * Call it when you need to restore a database connection
		 *
		 * @param 	array $descriptor
		 * @return 	boolean
		 */
		public function connect($descriptor=null){ }


		/**
		 * Executes a prepared statement binding
		 *
		 * @param PDOStatement $statement
		 * @param array $placeholders
		 * @param array $dataTypes
		 * @return PDOStatement
		 */
		protected function _executePrepared(){ }


		/**
		 * Sends SQL statements to the database server returning the success state.
		 * Use this method only when the SQL statement sent to the server return rows
		 *
		 *<code>
		 *	//Querying data
		 *	$resultset = $connection->query("SELECT * FROM robots WHERE type='mechanical'");</code>
		 *	$resultset = $connection->query("SELECT * FROM robots WHERE type=?", array("mechanical"));
		 *</code>
		 *
		 * @param  string $sqlStatement
		 * @param  array $placeholders
		 * @param  array $dataTypes
		 * @return \Phalcon\Db\Result\Pdo
		 */
		public function query($sqlStatement, $placeholders=null, $dataTypes=null){ }


		/**
		 * Sends SQL statements to the database server returning the success state.
		 * Use this method only when the SQL statement sent to the server don't return any row
		 *
		 *<code>
		 *	//Inserting data
		 *	$success = $connection->execute("INSERT INTO robots VALUES (1, 'Astro Boy')");
		 *	$success = $connection->execute("INSERT INTO robots VALUES (?, ?)", array(1, 'Astro Boy'));
		 *</code>
		 *
		 * @param  string $sqlStatement
		 * @param  array $placeholders
		 * @param  array $dataTypes
		 * @return boolean
		 */
		public function execute($sqlStatement, $placeholders=null, $dataTypes=null){ }


		/**
		 * Returns the number of affected rows by the last INSERT/UPDATE/DELETE repoted by the database system
		 *
		 *<code>
		 *	$connection->query("DELETE FROM robots");
		 *	echo $connection->affectedRows(), ' were deleted';
		 *</code>
		 *
		 * @return int
		 */
		public function affectedRows(){ }


		/**
		 * Closes active connection returning success. \Phalcon automatically closes and destroys active connections within \Phalcon\Db\Pool
		 *
		 * @return boolean
		 */
		public function close(){ }


		/**
		 * Escapes a value to avoid SQL injections
		 *
		 * @param string $str
		 * @return string
		 */
		public function escapeString($str){ }


		/**
		 * Bind params to a SQL statement
		 *
		 * @param string $sql
		 * @param array $params
		 */
		public function bindParams($sqlStatement, $params){ }


		/**
		 * Converts bound params like :name: or ?1 into ? bind params
		 *
		 * @param string $sql
		 * @param array $params
		 * @return array
		 */
		public function convertBoundParams($sql, $params){ }


		/**
		 * Returns insert id for the auto_increment column inserted in the last SQL statement
		 *
		 * @param string $sequenceName
		 * @return int
		 */
		public function lastInsertId($sequenceName=null){ }


		/**
		 * Starts a transaction in the connection
		 *
		 * @return boolean
		 */
		public function begin(){ }


		/**
		 * Rollbacks the active transaction in the connection
		 *
		 * @return boolean
		 */
		public function rollback(){ }


		/**
		 * Commits the active transaction in the connection
		 *
		 * @return boolean
		 */
		public function commit(){ }


		/**
		 * Checks whether connection is under database transaction
		 *
		 * @return boolean
		 */
		public function isUnderTransaction(){ }


		/**
		 * Return internal PDO handler
		 *
		 * @return PDO
		 */
		public function getInternalHandler(){ }


		/**
		 * Lists table indexes
		 *
		 * @param string $table
		 * @param string $schema
		 * @return \Phalcon\Db\Index[]
		 */
		public function describeIndexes($table, $schema=null){ }


		/**
		 * Lists table references
		 *
		 * @param string $table
		 * @param string $schema
		 * @return \Phalcon\Db\Reference[]
		 */
		public function describeReferences($table, $schema=null){ }


		/**
		 * Gets creation options from a table
		 *
		 * @param string $tableName
		 * @param string $schemaName
		 * @return array
		 */
		public function tableOptions($tableName, $schemaName=null){ }


		/**
		 * Return the default identity value to insert in an identity column
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

	}
}
