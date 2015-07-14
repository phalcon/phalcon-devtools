<?php

namespace Phalcon\Db\Result;

use Phalcon\Db;
use Phalcon\Db\ResultInterface;


class Pdo implements ResultInterface
{

	protected $_connection;

	protected $_result;

	/**
	 * Active fetch mode
	 */
	protected $_fetchMode = Db::FETCH_OBJ;

	/**
	 * Internal resultset
	 *
	 * @var \PDOStatement
	 */
	protected $_pdoStatement;

	protected $_sqlStatement;

	protected $_bindParams;

	protected $_bindTypes;

	protected $_rowCount = false;



	/**
	 * Phalcon\Db\Result\Pdo constructor
	 * 
	 * @param Db\AdapterInterface $connection
	 * @param \PDOStatement $result
	 * @param string $sqlStatement
	 * @param array $bindParams
	 * @param array $bindTypes
	 *
	 */
	public function __construct(Db\AdapterInterface $connection, \PDOStatement $result, $sqlStatement=null, $bindParams=null, $bindTypes=null) {}

	/**
	 * Allows to execute the statement again. Some database systems don't support scrollable cursors,
	 * So, as cursors are forward only, we need to execute the cursor again to fetch rows from the begining
	 *
	 * @return boolean
	 */
	public function execute() {}

	/**
	 * Fetches an array/object of strings that corresponds to the fetched row, or FALSE if there are no more rows.
	 * This method is affected by the active fetch flag set using Phalcon\Db\Result\Pdo::setFetchMode
	 *
	 *<code>
	 *	$result = $connection->query("SELECT * FROM robots ORDER BY name");
	 *	$result->setFetchMode(Phalcon\Db::FETCH_OBJ);
	 *	while ($robot = $result->fetch()) {
	 *		echo $robot->name;
	 *	}
	 *</code>
	 * 
	 * @param mixed $fetchStyle
	 * @param mixed $cursorOrientation
	 * @param mixed $cursorOffset
	 *
	 * @return mixed
	 */
	public function fetch($fetchStyle=null, $cursorOrientation=null, $cursorOffset=null) {}

	/**
	 * Returns an array of strings that corresponds to the fetched row, or FALSE if there are no more rows.
	 * This method is affected by the active fetch flag set using Phalcon\Db\Result\Pdo::setFetchMode
	 *
	 *<code>
	 *	$result = $connection->query("SELECT * FROM robots ORDER BY name");
	 *	$result->setFetchMode(Phalcon\Db::FETCH_NUM);
	 *	while ($robot = result->fetchArray()) {
	 *		print_r($robot);
	 *	}
	 *</code>
	 *
	 * @return mixed
	 */
	public function fetchArray() {}

	/**
	 * Returns an array of arrays containing all the records in the result
	 * This method is affected by the active fetch flag set using Phalcon\Db\Result\Pdo::setFetchMode
	 *
	 *<code>
	 *	$result = $connection->query("SELECT * FROM robots ORDER BY name");
	 *	$robots = $result->fetchAll();
	 *</code>
	 * 
	 * @param mixed $fetchStyle
	 * @param mixed $fetchArgument
	 * @param mixed $ctorArgs
	 *
	 * @return array
	 */
	public function fetchAll($fetchStyle=null, $fetchArgument=null, $ctorArgs=null) {}

	/**
	 * Gets number of rows returned by a resultset
	 *
	 *<code>
	 *	$result = $connection->query("SELECT * FROM robots ORDER BY name");
	 *	echo 'There are ', $result->numRows(), ' rows in the resultset';
	 *</code>
	 *
	 * @return int
	 */
	public function numRows() {}

	/**
			 * MySQL library properly returns the number of records PostgreSQL too
	 * 
	 * @param int $number
			 *
	 * @return void
	 */
	public function dataSeek($number) {}

	/**
		 * PDO doesn't support scrollable cursors, so we need to re-execute the statement
	 * 
	 * @param int $fetchMode
	 * @param mixed $colNoOrClassNameOrObject
	 * @param mixed $ctorargs
		 *
	 * @return boolean
	 */
	public function setFetchMode($fetchMode, $colNoOrClassNameOrObject=null, $ctorargs=null) {}

	/**
	 * Gets the internal PDO result object
	 *
	 * @return \PDOStatement
	 */
	public function getInternalResult() {}

}
