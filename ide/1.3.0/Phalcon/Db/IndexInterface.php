<?php 

namespace Phalcon\Db {

	/**
	 * Phalcon\Db\IndexInterface initializer
	 */
	
	interface IndexInterface {

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
