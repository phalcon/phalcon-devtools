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
	
	class Builder implements \Phalcon\Mvc\Model\Query\BuilderInterface, \Phalcon\DI\InjectionAwareInterface {

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

		protected $_bindParams;

		protected $_bindTypes;

		protected $_distinct;

		protected $_hiddenParamNumber;

		/**
		 * \Phalcon\Mvc\Model\Query\Builder constructor
		 *
		 *<code>
		 * $params = array(
		 *    'models'     => array('Users'),
		 *    'columns'    => array('id', 'name', 'status'),
		 *    'conditions' => array(
		 *        array(
		 *            "created > :min: AND created < :max:",
		 *            array("min" => '2013-01-01',   'max' => '2014-01-01'),
		 *            array("min" => PDO::PARAM_STR, 'max' => PDO::PARAM_STR),
		 *        ),
		 *    ),
		 *    // or 'conditions' => "created > '2013-01-01' AND created < '2014-01-01'",
		 *    'group'      => array('id', 'name'),
		 *    'having'     => "name = 'Kamil'",
		 *    'order'      => array('name', 'id'),
		 *    'limit'      => 20,
		 *    'offset'     => 20,
		 *    // or 'limit' => array(20, 20),
		 *);
		 *$queryBuilder = new \Phalcon\Mvc\Model\Query\Builder($params);
		 *</code> 
		 *
		 * @param array $params
		 * @param \Phalcon\DI $dependencyInjector
		 */
		public function __construct($params=null){ }


		/**
		 * Sets SELECT DISTINCT / SELECT ALL flag
		 *
		 * @param bool|null distinct
		 * @return \Phalcon\Mvc\Model\Query\BuilderInterface
		 */
		public function distinct($distinct){ }


		/**
		 * Returns SELECT DISTINCT / SELECT ALL flag
		 *
		 * @return bool
		 */
		public function getDistinct(){ }


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
		 *	$builder->columns(array('id', 'name'));
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
		 *	$builder->from('Robots');
		 *	$builder->from(array('Robots', 'RobotsParts'));
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
		 *	$builder->addFrom('Robots', 'r');
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
		 *	$builder->join('Robots');
		 *	$builder->join('Robots', 'r.id = RobotsParts.robots_id');
		 *	$builder->join('Robots', 'r.id = RobotsParts.robots_id', 'r');
		 *	$builder->join('Robots', 'r.id = RobotsParts.robots_id', 'r', 'LEFT');
		 *</code>
		 *
		 * @param string $model
		 * @param string $conditions
		 * @param string $alias
		 * @param string $type
		 * @return \Phalcon\Mvc\Model\Query\Builder
		 */
		public function join($model, $conditions=null, $alias=null){ }


		/**
		 * Adds a INNER join to the query
		 *
		 *<code>
		 *	$builder->innerJoin('Robots');
		 *	$builder->innerJoin('Robots', 'r.id = RobotsParts.robots_id');
		 *	$builder->innerJoin('Robots', 'r.id = RobotsParts.robots_id', 'r');
		 *</code>
		 *
		 * @param string $model
		 * @param string $conditions
		 * @param string $alias
		 * @return \Phalcon\Mvc\Model\Query\Builder
		 */
		public function innerJoin($model, $conditions=null, $alias=null){ }


		/**
		 * Adds a LEFT join to the query
		 *
		 *<code>
		 *	$builder->leftJoin('Robots', 'r.id = RobotsParts.robots_id', 'r');
		 *</code>
		 *
		 * @param string $model
		 * @param string $conditions
		 * @param string $alias
		 * @return \Phalcon\Mvc\Model\Query\Builder
		 */
		public function leftJoin($model, $conditions=null, $alias=null){ }


		/**
		 * Adds a RIGHT join to the query
		 *
		 *<code>
		 *	$builder->rightJoin('Robots', 'r.id = RobotsParts.robots_id', 'r');
		 *</code>
		 *
		 * @param string $model
		 * @param string $conditions
		 * @param string $alias
		 * @return \Phalcon\Mvc\Model\Query\Builder
		 */
		public function rightJoin($model, $conditions=null, $alias=null){ }


		/**
		 * Sets the query conditions
		 *
		 *<code>
		 *	$builder->where('name = "Peter"');
		 *	$builder->where('name = :name: AND id > :id:', array('name' => 'Peter', 'id' => 100));
		 *</code>
		 *
		 * @param string $conditions
		 * @param array $bindParams
		 * @param array $bindTypes
		 * @return \Phalcon\Mvc\Model\Query\Builder
		 */
		public function where($conditions, $bindParams=null, $bindTypes=null){ }


		/**
		 * Appends a condition to the current conditions using a AND operator
		 *
		 *<code>
		 *	$builder->andWhere('name = "Peter"');
		 *	$builder->andWhere('name = :name: AND id > :id:', array('name' => 'Peter', 'id' => 100));
		 *</code>
		 *
		 * @param string $conditions
		 * @param array $bindParams
		 * @param array $bindTypes
		 * @return \Phalcon\Mvc\Model\Query\Builder
		 */
		public function andWhere($conditions, $bindParams=null, $bindTypes=null){ }


		/**
		 * Appends a condition to the current conditions using a OR operator
		 *
		 *<code>
		 *	$builder->orWhere('name = "Peter"');
		 *	$builder->orWhere('name = :name: AND id > :id:', array('name' => 'Peter', 'id' => 100));
		 *</code>
		 *
		 * @param string $conditions
		 * @param array $bindParams
		 * @param array $bindTypes
		 * @return \Phalcon\Mvc\Model\Query\Builder
		 */
		public function orWhere($conditions, $bindParams=null, $bindTypes=null){ }


		/**
		 * Appends a BETWEEN condition to the current conditions
		 *
		 *<code>
		 *	$builder->betweenWhere('price', 100.25, 200.50);
		 *</code>
		 *
		 * @param string $expr
		 * @param mixed $minimum
		 * @param mixed $maximum
		 * @return \Phalcon\Mvc\Model\Query\Builder
		 */
		public function betweenWhere($expr, $minimum, $maximum){ }


		/**
		 * Appends a NOT BETWEEN condition to the current conditions
		 *
		 *<code>
		 *	$builder->notBetweenWhere('price', 100.25, 200.50);
		 *</code>
		 *
		 * @param string $expr
		 * @param mixed $minimum
		 * @param mixed $maximum
		 * @return \Phalcon\Mvc\Model\Query\Builder
		 */
		public function notBetweenWhere($expr, $minimum, $maximum){ }


		/**
		 * Appends an IN condition to the current conditions
		 *
		 *<code>
		 *	$builder->inWhere('id', [1, 2, 3]);
		 *</code>
		 *
		 * @param string $expr
		 * @param array $values
		 * @return \Phalcon\Mvc\Model\Query\Builder
		 */
		public function inWhere($expr, $values){ }


		/**
		 * Appends a NOT IN condition to the current conditions
		 *
		 *<code>
		 *	$builder->notInWhere('id', [1, 2, 3]);
		 *</code>
		 *
		 * @param string $expr
		 * @param array $values
		 * @return \Phalcon\Mvc\Model\Query\Builder
		 */
		public function notInWhere($expr, $values){ }


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
		 *	$builder->having('SUM(Robots.price) > 0');
		 *</code>
		 *
		 * @param string $having
		 * @return \Phalcon\Mvc\Model\Query\Builder
		 */
		public function having($having){ }


		/**
		 * Return the current having clause
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
		 * Sets an OFFSET clause
		 *
		 *<code>
		 *	$builder->offset(30);
		 *</code>
		 *
		 * @param int $limit
		 * @param int $offset
		 * @return \Phalcon\Mvc\Model\Query\Builder
		 */
		public function offset($offset){ }


		/**
		 * Returns the current OFFSET clause
		 *
		 * @return string|array
		 */
		public function getOffset(){ }


		/**
		 * Sets a GROUP BY clause
		 *
		 *<code>
		 *	$builder->groupBy(array('Robots.name'));
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
