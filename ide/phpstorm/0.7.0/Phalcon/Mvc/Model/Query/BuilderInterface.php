<?php 

namespace Phalcon\Mvc\Model\Query {

	/**
	 * Phalcon\Mvc\Model\Query\BuilderInterface initializer
	 */
	
	interface BuilderInterface {

		/**
		 * \Phalcon\Mvc\Model\Query\Builder
		 *
		 * @param array $params
		 */
		public function __construct($params=null);


		/**
		 * Sets the DependencyInjector container
		 *
		 * @param \Phalcon\DiInterface $dependencyInjector
		 * @return \Phalcon\Mvc\Model\Query\BuilderInterface
		 */
		public function setDI($dependencyInjector);


		/**
		 * Returns the DependencyInjector container
		 *
		 * @return \Phalcon\DiInterface
		 */
		public function getDI();


		/**
		 * Sets the columns to be queried
		 *
		 * @param string|array $columns
		 * @return \Phalcon\Mvc\Model\Query\BuilderInterface
		 */
		public function columns($columns);


		/**
		 * Return the columns to be queried
		 *
		 * @return string|array
		 */
		public function getColumns();


		/**
		 * Sets the models who makes part of the query
		 *
		 * @param string|array $models
		 * @return \Phalcon\Mvc\Model\Query\BuilderInterface
		 */
		public function from($models);


		/**
		 * Add a model to take part of the query
		 *
		 * @param string $model
		 * @param string $alias
		 * @return \Phalcon\Mvc\Model\Query\BuilderInterface
		 */
		public function addFrom($model, $alias=null);


		/**
		 * Return the models who makes part of the query
		 *
		 * @return string|array
		 */
		public function getFrom();


		/**
		 * Sets the models who makes part of the query
		 *
		 * @param string $model
		 * @param string $conditions
		 * @param string $alias
		 * @return \Phalcon\Mvc\Model\Query\BuilderInterface
		 */
		public function join($model, $conditions=null, $alias=null);


		/**
		 * Sets conditions for the query
		 *
		 * @param string $conditions
		 * @return \Phalcon\Mvc\Model\Query\BuilderInterface
		 */
		public function where($conditions);


		/**
		 * Return the conditions for the query
		 *
		 * @return string|array
		 */
		public function getWhere();


		/**
		 * Sets a ORDER BY condition clause
		 *
		 * @param string $orderBy
		 * @return \Phalcon\Mvc\Model\Query\BuilderInterface
		 */
		public function orderBy($orderBy);


		/**
		 * Return the set ORDER BY clause
		 *
		 * @return string|array
		 */
		public function getOrderBy();


		/**
		 * Sets a HAVING condition clause
		 *
		 * @param string $having
		 * @return \Phalcon\Mvc\Model\Query\BuilderInterface
		 */
		public function having($having);


		/**
		 * Return the columns to be queried
		 *
		 * @return string|array
		 */
		public function getHaving();


		/**
		 * Sets a LIMIT clause
		 *
		 * @param int $limit
		 * @param int $offset
		 * @return \Phalcon\Mvc\Model\Query\BuilderInterface
		 */
		public function limit($limit, $offset=null);


		/**
		 * Returns the current LIMIT clause
		 *
		 * @return string|array
		 */
		public function getLimit();


		/**
		 * Sets a LIMIT clause
		 *
		 * @param string $group
		 * @return \Phalcon\Mvc\Model\Query\BuilderInterface
		 */
		public function groupBy($group);


		/**
		 * Returns the GROUP BY clause
		 *
		 * @return string
		 */
		public function getGroupBy();


		/**
		 * Returns a PHQL statement built based on the builder parameters
		 *
		 * @return string
		 */
		public function getPhql();


		/**
		 * Returns the query built
		 *
		 * @return \Phalcon\Mvc\Model\QueryInterface
		 */
		public function getQuery();

	}
}
