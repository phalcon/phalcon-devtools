<?php 

namespace Phalcon\Db\Adapter\Pdo {

	/**
	 * Phalcon\Db\Adapter\Pdo\Postgresql
	 *
	 * Specific functions for the Postgresql database system
	 * <code>
	 *
	 * $config = array(
	 *  "host" => "192.168.0.11",
	 *  "dbname" => "blog",
	 *  "username" => "postgres",
	 *  "password" => ""
	 * );
	 *
	 * $connection = new Phalcon\Db\Adapter\Pdo\Postgresql($config);
	 *
	 * </code>
	 */
	
	class Postgresql extends \Phalcon\Db\Adapter\Pdo {

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
		 * This method is automatically called in \Phalcon\Db\Adapter\Pdo constructor.
		 * Call it when you need to restore a database connection.
		 *
		 * Support set search_path after connectted if schema is specified in config.
		 *
		 * @param array $descriptor
		 * @return boolean
		 */
		public function connect($descriptor){ }


		/**
		 * Returns an array of \Phalcon\Db\Column objects describing a table
		 *
		 * <code>print_r($connection->describeColumns("posts")); ?></code>
		 *
		 * @param string $table
		 * @param string $schema
		 * @return \Phalcon\Db\Column[]
		 */
		public function describeColumns($table, $schema){ }

	}
}
