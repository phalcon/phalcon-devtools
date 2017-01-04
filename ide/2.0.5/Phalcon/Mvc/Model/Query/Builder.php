<?php

namespace Phalcon\Mvc\Model\Query;

use Phalcon\Di;
use Phalcon\Db\Column;
use Phalcon\DiInterface;
use Phalcon\Mvc\Model\Query;
use Phalcon\Mvc\Model\Exception;
use Phalcon\Mvc\Model\Query\BuilderInterface;
use Phalcon\Di\InjectionAwareInterface;


class Builder implements BuilderInterface, InjectionAwareInterface
{

	protected $_dependencyInjector;

	protected $_columns;

	protected $_models;

	protected $_joins;

	protected $_with;

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
	 * Phalcon\Mvc\Model\Query\Builder constructor
	 * 
	 * @param mixed $params
	 * @param DiInterface $dependencyInjector
	 */
	public function __construct($params=null, DiInterface $dependencyInjector=null) {}

	/**
			 * Process conditions
	 * 
	 * @param DiInterface $dependencyInjector
			 *
	 * @return Builder
	 */
	public function setDI(DiInterface $dependencyInjector) {}

	/**
	 * Returns the DependencyInjector container
	 *
	 * @return DiInterface
	 */
	public function getDI() {}

	/**
	 * Sets SELECT DISTINCT / SELECT ALL flag
	 *
	 * @param mixed $distinct
	 * 
	 * @return Builder
	 */
	public function distinct($distinct) {}

	/**
	 * Returns SELECT DISTINCT / SELECT ALL flag
	 *
	 * @return boolean
	 */
	public function getDistinct() {}

	/**
	 * Sets the columns to be queried
	 *
	 *<code>
	 *	$builder->columns(array('id', 'name'));
	 *</code>
	 *
	 * @param mixed $columns
	 * 
	 * @return Builder
	 */
	public function columns($columns) {}

	/**
	 * Return the columns to be queried
	 *
	 * @return mixed
	 */
	public function getColumns() {}

	/**
	 * Sets the models who makes part of the query
	 *
	 *<code>
	 *	$builder->from('Robots');
	 *	$builder->from(array('Robots', 'RobotsParts'));
	 *</code>
	 *
	 * @param mixed $models
	 * 
	 * @return Builder
	 */
	public function from($models) {}

	/**
	 * Add a model to take part of the query
	 *
	 *<code>
	 *	$builder->addFrom('Robots', 'r');
	 *</code>
	 *
	 * @param mixed $model
	 * @param mixed $alias
	 * 
	 * @return Builder
	 */
	public function addFrom($model, $alias=null) {}

	/**
	 * Return the models who makes part of the query
	 *
	 * @return mixed
	 */
	public function getFrom() {}

	/**
	 * Adds a INNER join to the query
	 *
	 *<code>
	 *	$builder->join('Robots');
	 *	$builder->join('Robots', 'r.id = RobotsParts.robots_id');
	 *	$builder->join('Robots', 'r.id = RobotsParts.robots_id', 'r');
	 *	$builder->join('Robots', 'r.id = RobotsParts.robots_id', 'r', 'INNER');
	 *</code>
	 *
	 * @param string $model
	 * @param mixed $conditions
	 * @param mixed $alias
	 * @param mixed $type
	 * 
	 * @return Builder
	 */
	public function join($model, $conditions=null, $alias=null, $type=null) {}

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
	 * @param mixed $conditions
	 * @param mixed $alias
	 * @param string $type
	 * 
	 * @return Builder
	 */
	public function innerJoin($model, $conditions=null, $alias=null) {}

	/**
	 * Adds a LEFT join to the query
	 *
	 *<code>
	 *	$builder->leftJoin('Robots', 'r.id = RobotsParts.robots_id', 'r');
	 *</code>
	 *
	 * @param string $model
	 * @param mixed $conditions
	 * @param mixed $alias
	 * 
	 * @return Builder
	 */
	public function leftJoin($model, $conditions=null, $alias=null) {}

	/**
	 * Adds a RIGHT join to the query
	 *
	 *<code>
	 *	$builder->rightJoin('Robots', 'r.id = RobotsParts.robots_id', 'r');
	 *</code>
	 *
	 * @param string $model
	 * @param mixed $conditions
	 * @param mixed $alias
	 * 
	 * @return Builder
	 */
	public function rightJoin($model, $conditions=null, $alias=null) {}

	/**
	 * Sets the query conditions
	 *
	 *<code>
	 *	$builder->where(100);
	 *	$builder->where('name = "Peter"');
	 *	$builder->where('name = :name: AND id > :id:', array('name' => 'Peter', 'id' => 100));
	 *</code>
	 *
	 * @param mixed $conditions
	 * @param mixed $bindParams
	 * @param mixed $bindTypes
	 * 
	 * @return Builder
	 */
	public function where($conditions, $bindParams=null, $bindTypes=null) {}

	/**
		 * Merge the bind params to the current ones
	 * 
	 * @param string $conditions
	 * @param mixed $bindParams
	 * @param mixed $bindTypes
		 *
	 * @return Builder
	 */
	public function andWhere($conditions, $bindParams=null, $bindTypes=null) {}

	/**
		 * Nest the condition to current ones or set as unique
	 * 
	 * @param string $conditions
	 * @param mixed $bindParams
	 * @param mixed $bindTypes
		 *
	 * @return Builder
	 */
	public function orWhere($conditions, $bindParams=null, $bindTypes=null) {}

	/**
		 * Nest the condition to current ones or set as unique
	 * 
	 * @param string $expr
	 * @param mixed $minimum
	 * @param mixed $maximum
		 *
	 * @return Builder
	 */
	public function betweenWhere($expr, $minimum, $maximum) {}

	/**
		 * Minimum key with auto bind-params and
		 * Maximum key with auto bind-params
	 * 
	 * @param string $expr
	 * @param mixed $minimum
	 * @param mixed $maximum
		 *
	 * @return Builder
	 */
	public function notBetweenWhere($expr, $minimum, $maximum) {}

	/**
		 * Minimum key with auto bind-params and
		 * Maximum key with auto bind-params
	 * 
	 * @param string $expr
	 * @param array $values
		 *
	 * @return Builder
	 */
	public function inWhere($expr, array $values) {}

	/**
			 * Key with auto bind-params
	 * 
	 * @param string $expr
	 * @param array $values
			 *
	 * @return Builder
	 */
	public function notInWhere($expr, array $values) {}

	/**
			 * Key with auto bind-params
			 *
	 * @return mixed
	 */
	public function getWhere() {}

	/**
	 * Sets a ORDER BY condition clause
	 *
	 *<code>
	 *	$builder->orderBy('Robots.name');
	 *	$builder->orderBy(array('1', 'Robots.name'));
	 *</code>
	 *
	 * @param mixed $orderBy
	 * 
	 * @return Builder
	 */
	public function orderBy($orderBy) {}

	/**
	 * Returns the set ORDER BY clause
	 *
	 * @return mixed
	 */
	public function getOrderBy() {}

	/**
	 * Sets a HAVING condition clause. You need to escape PHQL reserved words using [ and ] delimiters
	 *
	 *<code>
	 *	$builder->having('SUM(Robots.price) > 0');
	 *</code>
	 * 
	 * @param string $having
	 *
	 * @return Builder
	 */
	public function having($having) {}

	/**
	 * Sets a FOR UPDATE clause
	 *
	 *<code>
	 *	$builder->forUpdate(true);
	 *</code>
	 * 
	 * @param boolean $forUpdate
	 *
	 * @return Builder
	 */
	public function forUpdate($forUpdate) {}

	/**
	 * Return the current having clause
	 *
	 * @return mixed
	 */
	public function getHaving() {}

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
	 *
	 * @return Builder
	 */
	public function limit($limit=null, $offset=null) {}

	/**
	 * Returns the current LIMIT clause
	 *
	 * @return mixed
	 */
	public function getLimit() {}

	/**
	 * Sets an OFFSET clause
	 *
	 *<code>
	 *	$builder->offset(30);
	 *</code>
	 * 
	 * @param int $offset
	 *
	 * @return Builder
	 */
	public function offset($offset) {}

	/**
	 * Returns the current OFFSET clause
	 *
	 * @return mixed
	 */
	public function getOffset() {}

	/**
	 * Sets a GROUP BY clause
	 *
	 *<code>
	 *	$builder->groupBy(array('Robots.name'));
	 *</code>
	 *
	 * @param mixed $group
	 * 
	 * @return Builder
	 */
	public function groupBy($group) {}

	/**
	 * Returns the GROUP BY clause
	 *
	 * @return mixed
	 */
	public function getGroupBy() {}

	/**
	 * Returns a PHQL statement built based on the builder parameters
	 *
	 * @return string
	 */
	public final function getPhql() {}

	/**
			 * If the conditions is a single numeric field. We internally create a condition using the related primary key
			 *
	 * @return Query
	 */
	public function getQuery() {}

}
