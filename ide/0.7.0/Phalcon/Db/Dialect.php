<?php 

namespace Phalcon\Db {

	/**
	 * Phalcon\Db\Dialect
	 *
	 * This is the base class to each database dialect. This implements
	 * common methods to transform intermediate code into its RDBM related syntax
	 */
	
	class Dialect {

		protected $_escapeChar;

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
		 * Gets a list of columns
		 *
		 * @param array $columnList
		 * @return string
		 */
		public function getColumnList($columnList){ }


		/**
		 * Transform an intermediate representation for a expression into a database system valid expression
		 *
		 * @param array $expression
		 * @param string $escapeChar
		 * @return string
		 */
		public function getSqlExpression($expression, $escapeChar=null){ }


		/**
		 * Transform an intermediate representation for a schema/table into a database system valid expression
		 *
		 * @param array $expression
		 * @param string $escapeChar
		 * @return string
		 */
		public function getSqlTable($table, $escapeChar=null){ }


		/**
		 * Builds a SELECT statement
		 *
		 * @param array $definition
		 * @return string
		 */
		public function select($definition){ }

	}
}
