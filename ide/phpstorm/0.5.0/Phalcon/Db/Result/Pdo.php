<?php 

namespace Phalcon\Db\Result {

	/**
	 * Phalcon\Db\Result\Pdo
	 *
	 * Encapsulates the resultset internals
	 *
	 * <code>
	 *	$result = $connection->query("SELECT * FROM robots ORDER BY name");
	 *	$result->setFetchMode(Phalcon\Db::FETCH_NUM);
	 *	while($robot = $result->fetchArray()){
	 *		print_r($robot);
	 *	}
	 * </code>
	 */
	
	class Pdo {

		protected $_result;

		protected $_fetchMode;

		protected $_pdoStatement;

		/**
		 * Phalcon\Db\Result\Pdo constructor
		 *
		 * @param PDOStatement $result
		 */
		public function __construct($result){ }


		/**
		 * Returns an array of strings that corresponds to the fetched row, or FALSE if there are no more rows.
		 * This method is affected by the active fetch flag set using Phalcon\Db\Result\Pdo::setFetchMode
		 *
		 *<code>
		 *	$result = $connection->query("SELECT * FROM robots ORDER BY name");
		 *	$result->setFetchMode(Phalcon\Db::FETCH_NUM);
		 *	while($robot = $result->fetchArray()){
		 *		print_r($robot);
		 *	}
		 *</code>
		 *
		 * @return boolean
		 */
		public function fetchArray(){ }


		/**
		 * Gets number of rows returned by a resulset
		 *
		 *<code>
		 *	$result = $connection->query("SELECT * FROM robots ORDER BY name");
		 *	echo 'There are ', $result->numRows(), ' rows in the resulset';
		 *</code>
		 *
		 * @return int
		 */
		public function numRows(){ }


		/**
		 * Moves internal resulset cursor to another position letting us to fetch a certain row
		 *
		 *<code>
		 *	$result = $connection->query("SELECT * FROM robots ORDER BY name");
		 *	$result->dataSeek(2); // Move to third row on result
		 *	$row = $result->fetchArray(); // Fetch third row
		 *</code>
		 *
		 * @param int $number
		 */
		public function dataSeek($number){ }


		/**
		 * Changes the fetching mode affecting Phalcon\Db\Result\Pdo::fetchArray
		 *
		 *<code>
		 *	//Return array with integer indexes
		 *	$result->setFetchMode(Phalcon\Db::FETCH_NUM);
		 *
		 *	//Return associative array without integer indexes
		 *	$result->setFetchMode(Phalcon\Db::FETCH_ASSOC);
		 *
		 *	//Return associative array together with integer indexes
		 *	$result->setFetchMode(Phalcon\Db::FETCH_BOTH);
		 *</code>
		 *
		 * @param int $fetchMode
		 */
		public function setFetchMode($fetchMode){ }


		/**
		 * Gets the internal PDO result object
		 *
		 * @return PDOStatement
		 */
		public function getInternalResult(){ }

	}
}
