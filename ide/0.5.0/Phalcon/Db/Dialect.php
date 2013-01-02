<?php 

namespace Phalcon\Db {

	/**
	 * Phalcon\Db\Dialect
	 */
	
	class Dialect {

		/**
		 * Generates the SQL for LIMIT clause
		 *
		 * @param string $sqlQuery
		 * @param int $number
		 * @return string
		 */
		public function limit($sqlQuery, $number){ }


		/**
		 * Returns a SQL modified with a FOR UPDATE clause
		 *
		 * @param string $sqlQuery
		 * @return string
		 */
		public function forUpdate($sqlQuery){ }


		/**
		 * Returns a SQL modified with a LOCK IN SHARE MODE clause
		 *
		 * @param string $sqlQuery
		 * @return string
		 */
		public function sharedLock($sqlQuery){ }


		/**
		 * Builds a SELECT statement
		 *
		 * @param array $definition
		 * @return string
		 */
		public function select($definition){ }

	}
}
