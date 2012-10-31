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

		protected $_connection;

		protected $_result;

		protected $_fetchMode;

		protected $_pdoStatement;

		protected $_sqlStatement;

		protected $_bindParams;

		protected $_bindTypes;

		protected $_rowCount;

		/**
		 * \Phalcon\Db\Result\Pdo constructor
		 *
		 * @param \Phalcon\Db\Adapter\Pdo $connection
		 * @param string $sqlStatement
		 * @param array $bindParams
		 * @param array $bindTypes
		 * @param PDOStatement $result
		 */
		public function __construct($connection, $result, $sqlStatement=null, $bindParams=null, $bindTypes=null){ }


		/**
		 * Allows to executes the statement again. Some database systems don't support scrollable cursors,
		 * So, as cursors are forward only, we need to execute the cursor again to fetch rows from the begining
		 *
		 * @return boolean
		 */
		public function execute(){ }


		/**
		 * Returns an array of strings that corresponds to the fetched row, or FALSE if there are no more rows.
		 * This method is affected by the active fetch flag set using \Phalcon\Db\Result\Pdo::setFetchMode
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
		 * Returns an array of arrays containing all the records in the result
		 * This method is affected by the active fetch flag set using \Phalcon\Db\Result\Pdo::setFetchMode
		 *
		 *<code>
		 *	$result = $connection->query("SELECT * FROM robots ORDER BY name");
		 *	$robots = $result->fetchAll();
		 *</code>
		 *
		 * @return array
		 */
		public function fetchAll(){ }


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
		 * Changes the fetching mode affecting \Phalcon\Db\Result\Pdo::fetchArray
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
