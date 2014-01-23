<?php 

namespace Phalcon\Db {

	/**
	 * Phalcon\Db\IndexInterface initializer
	 */
	
	interface IndexInterface {

		/**
		 * \Phalcon\Db\Index constructor
		 *
		 * @param string $indexName
		 * @param array $columns
		 */
		public function __construct($indexName, $columns);


		/**
		 * Gets the index name
		 *
		 * @return string
		 */
		public function getName();


		/**
		 * Gets the columns that comprends the index
		 *
		 * @return array
		 */
		public function getColumns();

	}
}
