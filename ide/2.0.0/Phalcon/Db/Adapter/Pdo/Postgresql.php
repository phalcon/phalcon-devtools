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
	 * $connection = new \Phalcon\Db\Adapter\Pdo\Postgresql($config);
	 *
	 * </code>
	 */
	
	class Postgresql extends \Phalcon\Db\Adapter\Pdo implements \Phalcon\Events\EventsAwareInterface, \Phalcon\Db\AdapterInterface {

		protected $_type;

		protected $_dialectType;

		/**
		 * This method is automatically called in \Phalcon\Db\Adapter\Pdo constructor.
		 * Call it when you need to restore a database connection.
		 *
		 * @param array $descriptor
		 * @return boolean
		 */
		public function connect($descriptor=null){ }


		/**
		 * Returns an array of \Phalcon\Db\Column objects describing a table
		 *
		 * <code>
		 * print_r($connection->describeColumns("posts"));
		 * </code>
		 *
		 * @param string table
		 * @param string schema
		 * @return \Phalcon\Db\Column[]
		 */
		public function describeColumns($table, $schema=null){ }


		/**
		 * Check whether the database system requires an explicit value for identity columns
		 *
		 * @return boolean
		 */
		public function useExplicitIdValue(){ }


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

	}
}
