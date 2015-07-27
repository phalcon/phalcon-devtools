<?php 

namespace Phalcon\Db\Adapter\Pdo {

	/**
	 * Phalcon\Db\Adapter\Pdo\Oracle
	 *
	 * Specific functions for the Oracle database system
	 * <code>
	 *
	 * $config = array(
	 *  "dbname" => "//localhost/dbname",
	 *  "username" => "oracle",
	 *  "password" => "oracle"
	 * );
	 *
	 * $connection = new \Phalcon\Db\Adapter\Pdo\Oracle($config);
	 *
	 * </code>
	 */
	
	class Oracle extends \Phalcon\Db\Adapter\Pdo implements \Phalcon\Events\EventsAwareInterface, \Phalcon\Db\AdapterInterface {

		protected $_type;

		protected $_dialectType;

		/**
		 * This method is automatically called in \Phalcon\Db\Adapter\Pdo constructor.
		 * Call it when you need to restore a database connection.
		 *
		 * @param array descriptor
		 * @return boolean
		 */
		public function connect($descriptor=null){ }


		/**
		 * Returns an array of \Phalcon\Db\Column objects describing a table
		 *
		 * <code>print_r($connection->describeColumns("posts")); ?></code>
		 */
		public function describeColumns($table, $schema=null){ }


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
		 */
		public function lastInsertId($sequenceName=null){ }


		/**
		 * Check whether the database system requires an explicit value for identity columns
		 */
		public function useExplicitIdValue(){ }


		/**
		 * Return the default identity value to insert in an identity column
		 */
		public function getDefaultIdValue(){ }


		/**
		 * Check whether the database system requires a sequence to produce auto-numeric values
		 */
		public function supportSequences(){ }

	}
}
