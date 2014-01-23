<?php 

namespace Phalcon\Db {

	/**
	 * Phalcon\Db\Dialect
	 *
	 * This is the base class to each database dialect. This implements
	 * common methods to transform intermediate code into its RDBM related syntax
	 */
	
	abstract class Dialect implements \Phalcon\Db\DialectInterface {

		protected $_escapeChar;

		/**
		 * Generates the SQL for LIMIT clause
		 *
		 *<code>
		 * $sql = $dialect->limit('SELECT * FROM robots', 10);
		 * echo $sql; // SELECT * FROM robots LIMIT 10
		 *</code>
		 *
		 * @param string $sqlQuery
		 * @param int $number
		 * @return string
		 */
		public function limit($sqlQuery, $number){ }


		/**
		 * Returns a SQL modified with a FOR UPDATE clause
		 *
		 *<code>
		 * $sql = $dialect->forUpdate('SELECT * FROM robots');
		 * echo $sql; // SELECT * FROM robots FOR UPDATE
		 *</code>
		 *
		 * @param string $sqlQuery
		 * @return string
		 */
		public function forUpdate($sqlQuery){ }


		/**
		 * Returns a SQL modified with a LOCK IN SHARE MODE clause
		 *
		 *<code>
		 * $sql = $dialect->sharedLock('SELECT * FROM robots');
		 * echo $sql; // SELECT * FROM robots LOCK IN SHARE MODE
		 *</code>
		 *
		 * @param string $sqlQuery
		 * @return string
		 */
		public function sharedLock($sqlQuery){ }


		/**
		 * Gets a list of columns with escaped identifiers
		 *
		 *<code>
		 * echo $dialect->getColumnList(array('column1', 'column'));
		 *</code>
		 *
		 * @param array $columnList
		 * @return string
		 */
		public function getColumnList($columnList){ }


		/**
		 * Transforms an intermediate representation for a expression into a database system valid expression
		 *
		 * @param array $expression
		 * @param string $escapeChar
		 * @return string
		 */
		public function getSqlExpression($expression, $escapeChar=null){ }


		/**
		 * Transform an intermediate representation for a schema/table into a database system valid expression
		 *
		 * @param array $table
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


		/**
		 * Checks whether the platform supports savepoints
		 *
		 * @return boolean
		 */
		public function supportsSavepoints(){ }


		/**
		 * Checks whether the platform supports releasing savepoints.
		 *
		 * @return boolean
		 */
		public function supportsReleaseSavepoints(){ }


		/**
		 * Generate SQL to create a new savepoint
		 *
		 * @param string $name
		 * @return string
		 */
		public function createSavepoint($name){ }


		/**
		 * Generate SQL to release a savepoint
		 *
		 * @param string $name
		 * @return string
		 */
		public function releaseSavepoint($name){ }


		/**
		 * Generate SQL to rollback a savepoint
		 *
		 * @param string $name
		 * @return string
		 */
		public function rollbackSavepoint($name){ }

	}
}
