<?php 

namespace Phalcon\Db {

	/**
	 * Phalcon\Db\Index
	 *
	 * Allows to define indexes to be used on tables. Indexes are a common way
	 * to enhance database performance. An index allows the database server to find
	 * and retrieve specific rows much faster than it could do without an index
	 */
	
	class Index implements \Phalcon\Db\IndexInterface {

		protected $_name;

		protected $_columns;

		protected $_type;

		/**
		 * Index name
		 *
		 * @var string
		 */
		public function getName(){ }


		/**
		 * Index columns
		 *
		 * @var array
		 */
		public function getColumns(){ }


		/**
		 * Index type
		 *
		 * @var string
		 */
		public function getType(){ }


		/**
		 * \Phalcon\Db\Index constructor
		 */
		public function __construct($name, $columns, $type=null){ }


		/**
		 * Restore a \Phalcon\Db\Index object from export
		 */
		public static function __set_state($data){ }

	}
}
