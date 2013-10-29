<?php 

namespace Phalcon\Db\Adapter\Pdo {

	/**
	 * Phalcon\Db\Adapter\Pdo\Sqlite
	 *
	 * Specific functions for the Sqlite database system
	 * <code>
	 *
	 * $config = array(
	 *  "dbname" => "/tmp/test.sqlite"
	 * );
	 *
	 * $connection = new Phalcon\Db\Adapter\Pdo\Sqlite($config);
	 *
	 * </code>
	 */
	
	class Sqlite extends \Phalcon\Db\Adapter\Pdo implements \Phalcon\Events\EventsAwareInterface, \Phalcon\Db\AdapterInterface {

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
		 * print_r($connection->describeColumns("posts")); ?>
		 * </code>
		 *
		 * @param string $table
		 * @param string $schema
		 * @return \Phalcon\Db\Column[]
		 */
		public function describeColumns($table, $schema=null){ }


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
		 * Check whether the database system requires an explicit value for identity columns
		 *
		 * @return boolean
		 */
		public function useExplicitIdValue(){ }

	}
}
