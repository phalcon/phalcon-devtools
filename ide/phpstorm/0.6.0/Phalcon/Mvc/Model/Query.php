<?php 

namespace Phalcon\Mvc\Model {

	/**
	 * Phalcon\Mvc\Model\Query
	 *
	 * This class takes a PHQL intermediate representation and executes it.
	 *
	 *<code>
	 *
	 * $phql  = "SELECT c.price*0.16 AS taxes, c.* FROM Cars AS c JOIN Brands AS b WHERE b.name = :name: ORDER BY c.name";
	 *
	 * $result = $manager->executeQuery($phql, array(
	 *   'name' => 'Lamborghini'
	 * ));
	 *
	 * foreach ($result as $row) {
	 *   echo "Name: ", $row->cars->name, "\n";
	 *   echo "Price: ", $row->cars->price, "\n";
	 *   echo "Taxes: ", $row->taxes, "\n";
	 * }
	 *
	 *</code>
	 *
	 */
	
	class Query {

		protected $_dependencyInjector;

		protected $_type;

		protected $_ast;

		protected $_tempSQLModels;

		protected $_tempSQLAliases;

		protected $_tempSQLAliasesModels;

		/**
		 * \Phalcon\Mvc\Model\Query constructor
		 *
		 * @param string $phql
		 */
		public function __construct($phql){ }


		/**
		 * Sets the dependency injection container
		 *
		 * @param \Phalcon\DI $dependencyInjector
		 */
		public function setDI($dependencyInjector){ }


		/**
		 * Returns the dependency injection container
		 *
		 * @return \Phalcon\DI
		 */
		public function getDI(){ }


		/**
		 * Replaces the model's name to its source name in a qualifed-name expression
		 *
		 * @return string
		 */
		protected function _getQualified(){ }


		/**
		 * Resolves a expression in a single call argument
		 *
		 * @return string
		 */
		protected function _getCallArgument(){ }


		/**
		 * Resolves a expression in a single call argument
		 *
		 * @return string
		 */
		protected function _getFunctionCall(){ }


		/**
		 * Resolves an expression from its intermediate code into a string
		 *
		 * @param array $expr
		 * @param array $sqlAliases
		 * @param boolean $quoting
		 * @param boolean $fullPlaceholder
		 * @return string
		 */
		protected function _getExpression(){ }


		/**
		 * Resolves a column from its intermediate representation into an array used to determine
		 * if the resulset produced will be simple or complex
		 *
		 * @param array $column
		 * @param array $models
		 * @param array $sqlAliases
		 * @param array $sqlAliasesModels
		 * @return array
		 */
		protected function _getSelectColumn(){ }


		/**
		 * Resolves a table in a SELECT statement checking if the model exists
		 *
		 * @param \Phalcon\Mvc\Model $manager
		 * @param array $qualifiedName
		 * @return string
		 */
		protected function _getTable(){ }


		/**
		 * Resolves a JOIN clause checking if the associated models exist
		 *
		 * @param \Phalcon\Mvc\Model $manager
		 * @param array $join
		 * @return array
		 */
		protected function _getJoin(){ }


		/**
		 * Resolves a JOIN type
		 *
		 * @param array $join
		 * @return string
		 */
		protected function _getJoinType(){ }


		/**
		 * Resolves all the JOINS in a SELECT statement
		 *
		 * @param array $select
		 * @param \Phalcon\Mvc\Model $manager
		 * @param array $models
		 * @param array $sqlModels
		 * @param array $sqlAliases
		 * @param array $sqlAliasesModels
		 * @return array
		 */
		protected function _getJoins(){ }


		/**
		 * Returns a processed limit clause for a SELECT statement
		 *
		 * @param array $limit
		 * @param array $sqlAliases
		 * @return string
		 */
		protected function _getLimitClause(){ }


		/**
		 * Returns a processed order clause for a SELECT statement
		 *
		 * @param array $order
		 * @param array $sqlAliases
		 * @return string
		 */
		protected function _getOrderClause(){ }


		/**
		 * Returns a processed group clause for a SELECT statement
		 *
		 * @param array $order
		 * @param array $sqlAliases
		 * @return string
		 */
		protected function _getGroupClause(){ }


		/**
		 * Analyzes a SELECT intermediate code and produces an array to be executed later
		 *
		 * @param \Phalcon\Mvc\Model $manager
		 * @param array $ast
		 */
		protected function _prepareSelect(){ }


		/**
		 * Analyzes an INSERT intermediate code and produces an array to be executed later
		 *
		 * @param \Phalcon\Mvc\Model $manager
		 * @param array $ast
		 * @return array
		 */
		protected function _prepareInsert(){ }


		/**
		 * Analyzes an UPDATE intermediate code and produces an array to be executed later
		 *
		 * @param \Phalcon\Mvc\Model $manager
		 * @param array $ast
		 * @return array
		 */
		protected function _prepareUpdate(){ }


		/**
		 * Analyzes a DELETE intermediate code and produces an array to be executed later
		 *
		 * @param \Phalcon\Mvc\Model $manager
		 * @param array $ast
		 * @return array
		 */
		protected function _prepareDelete(){ }


		/**
		 * Parses the intermediate code produced by \Phalcon\Mvc\Model\Query\Lang generating another
		 * intermediate representation that could be executed by \Phalcon\Mvc\Model\Query
		 *
		 * @param \Phalcon\Mvc\Model $manager
		 * @return array
		 */
		public function parse($manager=null){ }


		/**
		 * Executes the SELECT intermediate representation producing a \Phalcon\Mvc\Model\Resultset
		 *
		 * @param \Phalcon\Mvc\Model $manager
		 * @param \Phalcon\Mvc\Model\Metada $metaData
		 * @param array $intermediate
		 * @param array $placeholders
		 * @return \Phalcon\Mvc\Model\Resultset
		 */
		protected function _executeSelect(){ }


		/**
		 * Executes the INSERT intermediate representation producing a \Phalcon\Mvc\Model\Query\Status
		 *
		 * @param \Phalcon\Mvc\Model $manager
		 * @param \Phalcon\Mvc\Model\Metada $metaData
		 * @param array $intermediate
		 * @param array $placeholders
		 * @return \Phalcon\Mvc\Model\Query\Status
		 */
		protected function _executeInsert(){ }


		/**
		 * Executes the UPDATE intermediate representation producing a \Phalcon\Mvc\Model\Query\Status
		 *
		 * @param \Phalcon\Mvc\Model $manager
		 * @param \Phalcon\Mvc\Model\Metada $metaData
		 * @param array $intermediate
		 * @param array $placeholders
		 * @return \Phalcon\Mvc\Model\Query\Status
		 */
		protected function _executeUpdate(){ }


		/**
		 * Executes the DELETE intermediate representation producing a \Phalcon\Mvc\Model\Query\Status
		 *
		 * @param \Phalcon\Mvc\Model $manager
		 * @param \Phalcon\Mvc\Model\Metada $metaData
		 * @param array $intermediate
		 * @param array $placeholders
		 * @return \Phalcon\Mvc\Model\Query\Status
		 */
		protected function _executeDelete(){ }


		/**
		 * Executes a parsed PHQL statement
		 *
		 * @param array $placeholders
		 * @return mixed
		 */
		public function execute($placeholders=null){ }

	}
}
