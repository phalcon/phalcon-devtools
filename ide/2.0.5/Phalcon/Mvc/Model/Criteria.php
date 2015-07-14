<?php

namespace Phalcon\Mvc\Model;

use Phalcon\Mvc\Model\CriteriaInterface;
use Phalcon\Di\InjectionAwareInterface;
use Phalcon\Mvc\Model\Exception;
use Phalcon\DiInterface;
use Phalcon\Mvc\Model\ResultsetInterface;
use Phalcon\Db\Column;


class Criteria implements CriteriaInterface, InjectionAwareInterface
{

	protected $_model;

	protected $_params;

	protected $_bindParams;

	protected $_bindTypes;

	protected $_hiddenParamNumber;



	/**
	 * Sets the DependencyInjector container
	 * 
	 * @param DiInterface $dependencyInjector
	 *
	 * @return void
	 */
	public function setDI(DiInterface $dependencyInjector) {}

	/**
	 * Returns the DependencyInjector container
	 *
	 * @return DiInterface|null
	 */
	public function getDI() {}

	/**
	 * Set a model on which the query will be executed
	 * 
	 * @param string $modelName
	 *
	 * @return Criteria
	 */
	public function setModelName($modelName) {}

	/**
	 * Returns an internal model name on which the criteria will be applied
	 *
	 * @return string
	 */
	public function getModelName() {}

	/**
	 * Sets the bound parameters in the criteria
	 * This method replaces all previously set bound parameters
	 * 
	 * @param array $bindParams
	 *
	 * @return Criteria
	 */
	public function bind(array $bindParams) {}

	/**
	 * Sets the bind types in the criteria
	 * This method replaces all previously set bound parameters
	 * 
	 * @param array $bindTypes
	 *
	 * @return Criteria
	 */
	public function bindTypes(array $bindTypes) {}

	/**
	 * Sets SELECT DISTINCT / SELECT ALL flag
	 * 
	 * @param mixed $distinct
	 *
	 * @return Criteria
	 */
	public function distinct($distinct) {}

	/**
	 * Sets the columns to be queried
	 *
	 *<code>
	 *	$criteria->columns(array('id', 'name'));
	 *</code>
	 *
	 * @param mixed $columns
	 * 
	 * @return Criteria
	 */
	public function columns($columns) {}

	/**
	 * Adds a INNER join to the query
	 *
	 *<code>
	 *	$criteria->join('Robots');
	 *	$criteria->join('Robots', 'r.id = RobotsParts.robots_id');
	 *	$criteria->join('Robots', 'r.id = RobotsParts.robots_id', 'r');
	 *	$criteria->join('Robots', 'r.id = RobotsParts.robots_id', 'r', 'LEFT');
	 *</code>
	 * 
	 * @param string $model
	 * @param mixed $conditions
	 * @param mixed $alias
	 * @param mixed $type
	 *
	 * @return Criteria
	 */
	public function join($model, $conditions=null, $alias=null, $type=null) {}

	/**
	 * Adds a INNER join to the query
	 *
	 *<code>
	 *	$criteria->innerJoin('Robots');
	 *	$criteria->innerJoin('Robots', 'r.id = RobotsParts.robots_id');
	 *	$criteria->innerJoin('Robots', 'r.id = RobotsParts.robots_id', 'r');
	 *</code>
	 * 
	 * @param string $model
	 * @param mixed $conditions
	 * @param mixed $alias
	 *
	 * @return Criteria
	 */
	public function innerJoin($model, $conditions=null, $alias=null) {}

	/**
	 * Adds a LEFT join to the query
	 *
	 *<code>
	 *	$criteria->leftJoin('Robots', 'r.id = RobotsParts.robots_id', 'r');
	 *</code>
	 * 
	 * @param string $model
	 * @param mixed $conditions
	 * @param mixed $alias
	 *
	 * @return Criteria
	 */
	public function leftJoin($model, $conditions=null, $alias=null) {}

	/**
	 * Adds a RIGHT join to the query
	 *
	 *<code>
	 *	$criteria->rightJoin('Robots', 'r.id = RobotsParts.robots_id', 'r');
	 *</code>
	 * 
	 * @param string $model
	 * @param $conditions
	 * @param $alias
	 *
	 * @return Criteria
	 */
	public function rightJoin($model, $conditions=null, $alias=null) {}

	/**
	 * Sets the conditions parameter in the criteria
	 * 
	 * @param string $conditions
	 * @param mixed $bindParams
	 * @param mixed $bindTypes
	 *
	 * @return Criteria
	 */
	public function where($conditions, $bindParams=null, $bindTypes=null) {}

	/**
		 * Update or merge existing bound parameters
	 * 
	 * @param string $conditions
	 * @param mixed $bindParams
	 * @param mixed $bindTypes
		 *
	 * @return Criteria
	 */
	public function addWhere($conditions, $bindParams=null, $bindTypes=null) {}

	/**
	 * Appends a condition to the current conditions using an AND operator
	 * 
	 * @param string $conditions
	 * @param mixed $bindParams
	 * @param mixed $bindTypes
	 *
	 * @return Criteria
	 */
	public function andWhere($conditions, $bindParams=null, $bindTypes=null) {}

	/**
		 * Update or merge existing bound parameters
	 * 
	 * @param string $conditions
	 * @param mixed $bindParams
	 * @param mixed $bindTypes
		 *
	 * @return Criteria
	 */
	public function orWhere($conditions, $bindParams=null, $bindTypes=null) {}

	/**
		 * Update or merge existing bound parameters
	 * 
	 * @param string $expr
	 * @param mixed $minimum
	 * @param mixed $maximum
		 *
	 * @return Criteria
	 */
	public function betweenWhere($expr, $minimum, $maximum) {}

	/**
		 * Minimum key with auto bind-params
	 * 
	 * @param string $expr
	 * @param mixed $minimum
	 * @param mixed $maximum
		 *
	 * @return Criteria
	 */
	public function notBetweenWhere($expr, $minimum, $maximum) {}

	/**
		 * Minimum key with auto bind-params
	 * 
	 * @param string $expr
	 * @param array $values
		 *
	 * @return Criteria
	 */
	public function inWhere($expr, array $values) {}

	/**
			 * Key with auto bind-params
	 * 
	 * @param string $expr
	 * @param array $values
			 *
	 * @return Criteria
	 */
	public function notInWhere($expr, array $values) {}

	/**
			 * Key with auto bind-params
	 * 
	 * @param string $conditions
			 *
	 * @return Criteria
	 */
	public function conditions($conditions) {}

	/**
	 * Adds the order-by parameter to the criteria (deprecated)
	 *
	 * @deprecated 1.2.1
	 * @see \Phalcon\Mvc\Model\Criteria::orderBy()
	 * 
	 * @param string $orderColumns
	 *
	 * @return Criteria
	 */
	public function order($orderColumns) {}

	/**
	 * Adds the order-by clause to the criteria
	 * 
	 * @param string $orderColumns
	 *
	 * @return Criteria
	 */
	public function orderBy($orderColumns) {}

	/**
	 * Adds the group-by clause to the criteria
	 * 
	 * @param mixed $group
	 *
	 * @return Criteria
	 */
	public function groupBy($group) {}

	/**
	 * Adds the having clause to the criteria
	 * 
	 * @param mixed $having
	 *
	 * @return Criteria
	 */
	public function having($having) {}

	/**
	 * Adds the limit parameter to the criteria
	 * 
	 * @param mixed $limit
	 * @param mixed $offset
	 *
	 * @return Criteria
	 */
	public function limit($limit, $offset=null) {}

	/**
	 * Adds the "for_update" parameter to the criteria
	 * 
	 * @param boolean $forUpdate
	 *
	 * @return Criteria
	 */
	public function forUpdate($forUpdate=true) {}

	/**
	 * Adds the "shared_lock" parameter to the criteria
	 * 
	 * @param boolean $sharedLock
	 *
	 * @return Criteria
	 */
	public function sharedLock($sharedLock=true) {}

	/**
	 * Sets the cache options in the criteria
	 * This method replaces all previously set cache options
	 * 
	 * @param array $cache
	 *
	 * @return Criteria
	 */
	public function cache(array $cache) {}

	/**
	 * Returns the conditions parameter in the criteria
	 *
	 * @return string|null
	 */
	public function getWhere() {}

	/**
	 * Returns the columns to be queried
	 *
	 * @return string|null
	 */
	public function getColumns() {}

	/**
	 * Returns the conditions parameter in the criteria
	 *
	 * @return string|null
	 */
	public function getConditions() {}

	/**
	 * Returns the limit parameter in the criteria, which will be
	 * an integer if limit was set without an offset,
	 * an array with 'number' and 'offset' keys if an offset was set with the limit,
	 * or null if limit has not been set.
	 *
	 * @return string|null
	 */
	public function getLimit() {}

	/**
	 * Returns the order clause in the criteria
	 *
	 * @return string|null
	 */
	public function getOrder() {}

	/**
	 * Returns the group clause in the criteria
	 *
	 * @return mixed
	 */
	public function getGroupBy() {}

	/**
	 * Returns the having clause in the criteria
	 *
	 * @return mixed
	 */
	public function getHaving() {}

	/**
	 * Returns all the parameters defined in the criteria
	 *
	 * @return mixed
	 */
	public function getParams() {}

	/**
	 * Builds a Phalcon\Mvc\Model\Criteria based on an input array like _POST
	 * 
	 * @param DiInterface $dependencyInjector
	 * @param string $modelName
	 * @param array $data
	 *
	 * @return Criteria
	 */
	public static function fromInput(DiInterface $dependencyInjector, $modelName, array $data) {}

	/**
			 * We look for attributes in the array passed as data
			 *
	 * @return ResultsetInterface
	 */
	public function execute() {}

}
