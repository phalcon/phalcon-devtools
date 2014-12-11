<?php 

namespace Phalcon\Db {

	/**
	 * Phalcon\Db\ReferenceInterface initializer
	 */
	
	interface ReferenceInterface {

		/**
		 * Gets the index name
		 *
		 * @return string
		 */
		public function getName();


		/**
		 * Gets the schema where referenced table is
		 *
		 * @return string
		 */
		public function getSchemaName();


		/**
		 * Gets the schema where referenced table is
		 *
		 * @return string
		 */
		public function getReferencedSchema();


		/**
		 * Gets local columns which reference is based
		 *
		 * @return array
		 */
		public function getColumns();


		/**
		 * Gets the referenced table
		 *
		 * @return string
		 */
		public function getReferencedTable();


		/**
		 * Gets referenced columns
		 *
		 * @return array
		 */
		public function getReferencedColumns();

	}
}
