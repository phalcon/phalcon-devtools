<?php 

namespace Phalcon\Db\Adapter\Pdo {

	/**
	 * Phalcon\Db\Adapter\Pdo\Mysql
	 *
	 * Specific functions for the Mysql database system
	 * <code>
	 *
	 *	$config = array(
	 *		"host" => "192.168.0.11",
	 *		"dbname" => "blog",
	 *		"port" => 3306,
	 *		"username" => "sigma",
	 *		"password" => "secret"
	 *	);
	 *
	 *	$connection = new Phalcon\Db\Adapter\Pdo\Mysql($config);
	 *
	 * </code>
	 */
	
	class Mysql extends \Phalcon\Db\Adapter\Pdo {

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

		protected $_pdo;

		protected $_affectedRows;

		/**
		 * Returns an array of \Phalcon\Db\Column objects describing a table
		 *
		 * <code>print_r($connection->describeColumns("posts") ?></code>
		 *
		 * @param string $table
		 * @param string $schema
		 * @return \Phalcon\Db\Column[]
		 */
		public function describeColumns($table, $schema){ }


		/**
		 * Lists table indexes
		 *
		 * @param string $table
		 * @param string $schema
		 * @return \Phalcon\Db\Index[]
		 */
		public function describeIndexes($table, $schema){ }


		/**
		 * Lists table references
		 *
		 * @param string $table
		 * @param string $schema
		 * @return \Phalcon\Db\Reference[]
		 */
		public function describeReferences($table, $schema){ }


		/**
		 * Gets creation options from a table
		 *
		 * @param string $tableName
		 * @param string $schemaName
		 * @return array
		 */
		public function tableOptions($tableName, $schemaName){ }

	}
}
