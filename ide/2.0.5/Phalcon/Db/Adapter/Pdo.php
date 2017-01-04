<?php

namespace Phalcon\Db\Adapter;

use Phalcon\Db\Adapter;
use Phalcon\Db\Exception;
use Phalcon\Db\Column;
use Phalcon\Db\ResultInterface;
use Phalcon\Events\ManagerInterface;
use Phalcon\Db\Result\Pdo as ResultPdo;


abstract class Pdo extends Adapter
{

	/**
	 * PDO Handler
	 */
	protected $_pdo;

	/**
	 * Last affected rows
	 */
	protected $_affectedRows;



	/**
	 * Constructor for Phalcon\Db\Adapter\Pdo
	 * 
	 * @param array $descriptor
	 */
	public function __construct(array $descriptor) {}

	/**
	 * This method is automatically called in Phalcon\Db\Adapter\Pdo constructor.
	 * Call it when you need to restore a database connection
	 *
	 *<code>
	 * //Make a connection
	 * $connection = new \Phalcon\Db\Adapter\Pdo\Mysql(array(
	 *  'host' => '192.168.0.11',
	 *  'username' => 'sigma',
	 *  'password' => 'secret',
	 *  'dbname' => 'blog',
	 * ));
	 *
	 * //Reconnect
	 * $connection->connect();
	 * </code>
	 *
	 * @param array $descriptor
	 * 
	 * @return void
	 */
	public function connect($descriptor=null) {}

	/**
		 * Check for a username or use null as default
	 * 
	 * @param string $sqlStatement
		 *
	 * @return \PDOStatement
	 */
	public function prepare($sqlStatement) {}

	/**
	 * Executes a prepared statement binding. This function uses integer indexes starting from zero
	 *
	 *<code>
	 * $statement = $db->prepare('SELECT * FROM robots WHERE name = :name');
	 * $result = $connection->executePrepared($statement, array('name' => 'Voltron'));
	 *</code>
	 *
	 * @param \PDOStatement $statement
	 * @param array $placeholders
	 * @param array $dataTypes
	 * 
	 * @return \PDOStatement
	 */
	public function executePrepared(\PDOStatement $statement, array $placeholders, $dataTypes) {}

	/**
				 * The bind type is double so we try to get the double value
	 * 
	 * @param string $sqlStatement
	 * @param mixed $bindParams
	 * @param mixed $bindTypes
				 *
	 * @return ResultInterface|boolean
	 */
	public function query($sqlStatement, $bindParams=null, $bindTypes=null) {}

	/**
		 * Execute the beforeQuery event if a EventsManager is available
	 * 
	 * @param string $sqlStatement
	 * @param mixed $bindParams
	 * @param mixed $bindTypes
		 *
	 * @return boolean
	 */
	public function execute($sqlStatement, $bindParams=null, $bindTypes=null) {}

	/**
		 * Execute the beforeQuery event if a EventsManager is available
		 *
	 * @return int
	 */
	public function affectedRows() {}

	/**
	 * Closes the active connection returning success. Phalcon automatically closes and destroys
	 * active connections when the request ends
	 *
	 * @return boolean
	 */
	public function close() {}

	/**
	 * Escapes a column/table/schema name
	 *
	 *<code>
	 *	$escapedTable = $connection->escapeIdentifier('robots');
	 *	$escapedTable = $connection->escapeIdentifier(array('store', 'robots'));
	 *</code>
	 *
	 * @param mixed $identifier
	 * 
	 * @return string
	 */
	public function escapeIdentifier($identifier) {}

	/**
	 * Escapes a value to avoid SQL injections according to the active charset in the connection
	 *
	 *<code>
	 *	$escapedStr = $connection->escapeString('some dangerous value');
	 *</code>
	 * 
	 * @param string $str
	 *
	 * @return string
	 */
	public function escapeString($str) {}

	/**
	 * Converts bound parameters such as :name: or ?1 into PDO bind params ?
	 *
	 *<code>
	 * print_r($connection->convertBoundParams('SELECT * FROM robots WHERE name = :name:', array('Bender')));
	 *</code>
	 * 
	 * @param string $sql
	 * @param array $params
	 *
	 * @return array
	 */
	public function convertBoundParams($sql, array $params=[]) {}

	/**
	 * Returns the insert id for the auto_increment/serial column inserted in the lastest executed SQL statement
	 *
	 *<code>
	 * //Inserting a new robot
	 * $success = $connection->insert(
	 *     "robots",
	 *     array("Astro Boy", 1952),
	 *     array("name", "year")
	 * );
	 *
	 * //Getting the generated id
	 * $id = $connection->lastInsertId();
	 *</code>
	 *
	 * @param string $sequenceName
	 * 
	 * @return int|boolean
	 */
	public function lastInsertId($sequenceName=null) {}

	/**
	 * Starts a transaction in the connection
	 * 
	 * @param boolean $nesting
	 *
	 * @return boolean
	 */
	public function begin($nesting=true) {}

	/**
		 * Increase the transaction nesting level
	 * 
	 * @param boolean $nesting
		 *
	 * @return boolean
	 */
	public function rollback($nesting=true) {}

	/**
		 * Check the transaction nesting level
	 * 
	 * @param boolean $nesting
		 *
	 * @return boolean
	 */
	public function commit($nesting=true) {}

	/**
		 * Check the transaction nesting level
		 *
	 * @return int
	 */
	public function getTransactionLevel() {}

	/**
	 * Checks whether the connection is under a transaction
	 *
	 *<code>
	 *	$connection->begin();
	 *	var_dump($connection->isUnderTransaction()); //true
	 *</code>
	 *
	 * @return boolean
	 */
	public function isUnderTransaction() {}

	/**
	 * Return internal PDO handler
	 *
	 * @return \Pdo
	 */
	public function getInternalHandler() {}

	/**
	 * Return the error info, if any
	 *
	 * @return mixed
	 */
	public function getErrorInfo() {}

}
