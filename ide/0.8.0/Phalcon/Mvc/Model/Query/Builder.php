<?php 

namespace Phalcon\Mvc\Model\Query {

	/**
	 * Phalcon\Mvc\Model\Query\Builder
	 *
	 * Helps to create PHQL queries using an OO interface
	 *
	 *<code>
	 *$resultset = $this->modelsManager->createBuilder()
	 *   ->from('Robots')
	 *   ->join('RobotsParts')
	 *   ->limit(20)
	 *   ->orderBy('Robots.name')
	 *   ->getQuery()
	 *   ->execute();
	 *</code>
	 */
	
	class Builder {

		protected $_dependencyInjector;

		protected $_columns;

		protected $_models;

		protected $_joins;

		protected $_conditions;

		protected $_group;

		protected $_having;

		protected $_order;

		protected $_limit;

		protected $_offset;

		protected $_forUpdate;

		protected $_sharedLock;

		/**
		 * \Phalcon\Mvc\Model\Query\Builder constructor
		 *
		 * @param array $params
		 */
		public function __construct($params=null){ }


		/**
		 * Sets the DependencyInjector container
		 *
		 * @param \Phalcon\DiInterface $dependencyInjector
		 * @return \Phalcon\Mvc\Model\Query\Builder
		 */
		public function setDI($dependencyInjector){ }


		/**
		 * Returns the DependencyInjector container
		 *
		 * @return \Phalcon\DiInterface
		 */
		public function getDI(){ }


		/**
		 * Sets the columns to be queried
		 *
		 *<code>
		 *$builder->columns(array('id', 'name'));
		 *</code>
		 *
		 * @param string|array $columns
		 * @return \Phalcon\Mvc\Model\Query\Builder
		 */
		public function columns($columns){ }


		/**
		 * Return the columns to be queried
		 *
		 * @return string|array
		 */
		public function getColumns(){ }


		/**
		 * Sets the models who makes part of the query
		 *
		 *<code>
		 *$builder->from(array('Robots', 'RobotsParts'));
		 *</code>
		 *
		 * @param string|array $models
		 * @return \Phalcon\Mvc\Model\Query\Builder
		 */
		public function from($models){ }


		/**
		 * Add a model to take part of the query
		 *
		 *<code>
		 *$builder->addFrom('Robots', 'r');
		 *</code>
		 *
		 * @param string $model
		 * @param string $alias
		 * @return \Phalcon\Mvc\Model\Query\Builder
		 */
		public function addFrom($model, $alias=null){ }


		/**
		 * Return the models who makes part of the query
		 *
		 * @return string|array
		 */
		public function getFrom(){ }


		/**
		 * Adds a join to the query
		 *
		 *<code>
		 *$builder->join('Robots', 'r.id = RobotsParts.robots_id', 'r');
		 *</code>
		 *
		 * @param string $model
		 * @param string $conditions
		 * @param string $alias
		 * @return \Phalcon\Mvc\Model\Query\Builder
		 */
		public function join($model, $conditions=null, $alias=null){ }


		/**
		 * Sets the query conditions
		 *
		 *<code>
		 *	$builder->where('name = :name: AND id > :id:');
		 *</code>
		 *
		 * @param string $conditions
		 * @return \Phalcon\Mvc\Model\Query\Builder
		 */
		public function where($conditions){ }


		/**
		 * Appends a condition to the current conditions using a AND operator
		 *
		 *<code>
		 *	$builder->andWhere('name = :name: AND id > :id:');
		 *</code>
		 *
		 * @param string $conditions
		 * @return \Phalcon\Mvc\Model\Query\Builder
		 */
		public function andWhere($conditions){ }


		/**
		 * Appends a condition to the current conditions using a OR operator
		 *
		 *<code>
		 *	$builder->orWhere('name = :name: AND id > :id:');
		 *</code>
		 *
		 * @param string $conditions
		 * @return \Phalcon\Mvc\Model\Query\Builder
		 */
		public function orWhere($conditions){ }


		/**
		 * Return the conditions for the query
		 *
		 * @return string|array
		 */
		public function getWhere(){ }


		/**
		 * Sets a ORDER BY condition clause
		 *
		 *<code>
		 *	$builder->orderBy('Robots.name');
		 *	$builder->orderBy(array('1', 'Robots.name'));
		 *</code>
		 *
		 * @param string $orderBy
		 * @return \Phalcon\Mvc\Model\Query\Builder
		 */
		public function orderBy($orderBy){ }


		/**
		 * Returns the set ORDER BY clause
		 *
		 * @return string|array
		 */
		public function getOrderBy(){ }


		/**
		 * Sets a HAVING condition clause. You need to escape PHQL reserved words using [ and ] delimiters
		 *
		 *<code>
		 *$builder->having('SUM(Robots.price) > 0');
		 *</code>
		 *
		 * @param string $having
		 * @return \Phalcon\Mvc\Model\Query\Builder
		 */
		public function having($having){ }


		/**
		 * Return the columns to be queried
		 *
		 * @return string|array
		 */
		public function getHaving(){ }


		/**
		 * Sets a LIMIT clause, optionally a offset clause
		 *
		 *<code>
		 *	$builder->limit(100);
		 *	$builder->limit(100, 20);
		 *</code>
		 *
		 * @param int $limit
		 * @param int $offset
		 * @return \Phalcon\Mvc\Model\Query\Builder
		 */
		public function limit($limit, $offset=null){ }


		/**
		 * Returns the current LIMIT clause
		 *
		 * @return string|array
		 */
		public function getLimit(){ }


		/**
		 * Sets a GROUP BY clause
		 *
		 *<code>
		 *$builder->groupBy(array('Robots.name'));
		 *</code>
		 *
		 * @param string $group
		 * @return \Phalcon\Mvc\Model\Query\Builder
		 */
		public function groupBy($group){ }


		/**
		 * Returns the GROUP BY clause
		 *
		 * @return string
		 */
		public function getGroupBy(){ }


		/**
		 * Returns a PHQL statement built based on the builder parameters
		 *
		 * @return string
		 */
		public function getPhql(){ }


		/**
		 * Returns the query built
		 *
		 * @return \Phalcon\Mvc\Model\Query
		 */
		public function getQuery(){ }

	}
}
