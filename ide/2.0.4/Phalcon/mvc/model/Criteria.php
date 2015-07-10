<?php

namespace Phalcon\Mvc\Model;

/**
 * Phalcon\Mvc\Model\Criteria
 * This class is used to build the array parameter required by
 * Phalcon\Mvc\Model::find() and Phalcon\Mvc\Model::findFirst()
 * using an object-oriented interface.
 * <code>
 * $robots = Robots::query()
 * ->where("type = :type:")
 * ->andWhere("year < 2000")
 * ->bind(array("type" => "mechanical"))
 * ->limit(5, 10)
 * ->orderBy("name")
 * ->execute();
 * </code>
 */
class Criteria implements \Phalcon\Mvc\Model\CriteriaInterface, \Phalcon\Di\InjectionAwareInterface
{

    protected $_model;


    protected $_params;


    protected $_bindParams;


    protected $_bindTypes;


    protected $_hiddenParamNumber = 0;


    /**
     * Sets the DependencyInjector container
     *
     * @param mixed $dependencyInjector 
     */
    public function setDI(\Phalcon\DiInterface $dependencyInjector) {}

    /**
     * Returns the DependencyInjector container
     *
     * @return null|\Phalcon\DiInterface 
     */
    public function getDI() {}

    /**
     * Set a model on which the query will be executed
     *
     * @param string $modelName 
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
     * @return Criteria 
     */
    public function bind($bindParams) {}

    /**
     * Sets the bind types in the criteria
     * This method replaces all previously set bound parameters
     *
     * @param array $bindTypes 
     * @return Criteria 
     */
    public function bindTypes($bindTypes) {}

    /**
<<<<<<< HEAD
     * Sets SELECT DISTINCT / SELECT ALL flag
     *
     * @param mixed $distinct 
     * @return Criteria 
     */
    public function distinct($distinct) {}

    /**
=======
>>>>>>> 5cd73180ea748c3d5e180a24610161d9730cd146
     * Sets the columns to be queried
     * <code>
     * $criteria->columns(array('id', 'name'));
     * </code>
     *
     * @param string|array $columns 
     * @return \Phalcon\Mvc\Model\Criteria 
     */
    public function columns($columns) {}

    /**
     * Adds a INNER join to the query
     * <code>
     * $criteria->join('Robots');
     * $criteria->join('Robots', 'r.id = RobotsParts.robots_id');
     * $criteria->join('Robots', 'r.id = RobotsParts.robots_id', 'r');
     * $criteria->join('Robots', 'r.id = RobotsParts.robots_id', 'r', 'LEFT');
     * </code>
     *
     * @param string $model 
<<<<<<< HEAD
     * @param mixed $conditions 
     * @param mixed $alias 
     * @param mixed $type 
     * @return Criteria 
=======
     * @param string $conditions 
     * @param string $alias 
     * @param string $type 
     * @return \Phalcon\Mvc\Model\Criteria 
>>>>>>> 5cd73180ea748c3d5e180a24610161d9730cd146
     */
    public function join($model, $conditions = null, $alias = null, $type = null) {}

    /**
     * Adds a INNER join to the query
     * <code>
     * $criteria->innerJoin('Robots');
     * $criteria->innerJoin('Robots', 'r.id = RobotsParts.robots_id');
     * $criteria->innerJoin('Robots', 'r.id = RobotsParts.robots_id', 'r');
     * </code>
     *
     * @param string $model 
<<<<<<< HEAD
     * @param mixed $conditions 
     * @param mixed $alias 
     * @return Criteria 
=======
     * @param string $conditions 
     * @param string $alias 
     * @return \Phalcon\Mvc\Model\Criteria 
>>>>>>> 5cd73180ea748c3d5e180a24610161d9730cd146
     */
    public function innerJoin($model, $conditions = null, $alias = null) {}

    /**
     * Adds a LEFT join to the query
     * <code>
     * $criteria->leftJoin('Robots', 'r.id = RobotsParts.robots_id', 'r');
     * </code>
     *
     * @param string $model 
<<<<<<< HEAD
     * @param mixed $conditions 
     * @param mixed $alias 
     * @return Criteria 
=======
     * @param string $conditions 
     * @param string $alias 
     * @return \Phalcon\Mvc\Model\Criteria 
>>>>>>> 5cd73180ea748c3d5e180a24610161d9730cd146
     */
    public function leftJoin($model, $conditions = null, $alias = null) {}

    /**
     * Adds a RIGHT join to the query
     * <code>
     * $criteria->rightJoin('Robots', 'r.id = RobotsParts.robots_id', 'r');
     * </code>
     *
     * @param string $model 
<<<<<<< HEAD
     * @param mixed $conditions 
     * @param mixed $alias 
     * @return Criteria 
=======
     * @param string $conditions 
     * @param string $alias 
     * @return \Phalcon\Mvc\Model\Criteria 
>>>>>>> 5cd73180ea748c3d5e180a24610161d9730cd146
     */
    public function rightJoin($model, $conditions = null, $alias = null) {}

    /**
     * Sets the conditions parameter in the criteria
     *
     * @param string $conditions 
<<<<<<< HEAD
     * @param mixed $bindParams 
     * @param mixed $bindTypes 
     * @return Criteria 
=======
     * @param array $bindParams 
     * @param array $bindTypes 
     * @return \Phalcon\Mvc\Model\Criteria 
>>>>>>> 5cd73180ea748c3d5e180a24610161d9730cd146
     */
    public function where($conditions, $bindParams = null, $bindTypes = null) {}

    /**
     * Appends a condition to the current conditions using an AND operator (deprecated)
     *
     * @deprecated 1.0.0
     * @see \Phalcon\Mvc\Model\Criteria::andWhere()
     * @param string $conditions 
<<<<<<< HEAD
     * @param mixed $bindParams 
     * @param mixed $bindTypes 
     * @return Criteria 
=======
     * @param array $bindParams 
     * @param array $bindTypes 
     * @return \Phalcon\Mvc\Model\Criteria 
>>>>>>> 5cd73180ea748c3d5e180a24610161d9730cd146
     */
    public function addWhere($conditions, $bindParams = null, $bindTypes = null) {}

    /**
     * Appends a condition to the current conditions using an AND operator
     *
     * @param string $conditions 
<<<<<<< HEAD
     * @param mixed $bindParams 
     * @param mixed $bindTypes 
     * @return Criteria 
=======
     * @param array $bindParams 
     * @param array $bindTypes 
     * @return \Phalcon\Mvc\Model\Criteria 
>>>>>>> 5cd73180ea748c3d5e180a24610161d9730cd146
     */
    public function andWhere($conditions, $bindParams = null, $bindTypes = null) {}

    /**
     * Appends a condition to the current conditions using an OR operator
     *
     * @param string $conditions 
<<<<<<< HEAD
     * @param mixed $bindParams 
     * @param mixed $bindTypes 
     * @return Criteria 
=======
     * @param array $bindParams 
     * @param array $bindTypes 
     * @return \Phalcon\Mvc\Model\Criteria 
>>>>>>> 5cd73180ea748c3d5e180a24610161d9730cd146
     */
    public function orWhere($conditions, $bindParams = null, $bindTypes = null) {}

    /**
     * Appends a BETWEEN condition to the current conditions
     * <code>
     * $criteria->betweenWhere('price', 100.25, 200.50);
     * </code>
     *
     * @param string $expr 
     * @param mixed $minimum 
     * @param mixed $maximum 
<<<<<<< HEAD
     * @return Criteria 
=======
     * @return \Phalcon\Mvc\Model\Criteria 
>>>>>>> 5cd73180ea748c3d5e180a24610161d9730cd146
     */
    public function betweenWhere($expr, $minimum, $maximum) {}

    /**
     * Appends a NOT BETWEEN condition to the current conditions
     * <code>
     * $criteria->notBetweenWhere('price', 100.25, 200.50);
     * </code>
     *
     * @param string $expr 
     * @param mixed $minimum 
     * @param mixed $maximum 
<<<<<<< HEAD
     * @return Criteria 
=======
     * @return \Phalcon\Mvc\Model\Criteria 
>>>>>>> 5cd73180ea748c3d5e180a24610161d9730cd146
     */
    public function notBetweenWhere($expr, $minimum, $maximum) {}

    /**
     * Appends an IN condition to the current conditions
     * <code>
     * $criteria->inWhere('id', [1, 2, 3]);
     * </code>
     *
     * @param string $expr 
     * @param array $values 
     * @return Criteria 
     */
    public function inWhere($expr, $values) {}

    /**
     * Appends a NOT IN condition to the current conditions
     * <code>
     * $criteria->notInWhere('id', [1, 2, 3]);
     * </code>
     *
     * @param string $expr 
     * @param array $values 
     * @return Criteria 
     */
    public function notInWhere($expr, $values) {}

    /**
     * Adds the conditions parameter to the criteria
     *
     * @param string $conditions 
     * @return Criteria 
     */
    public function conditions($conditions) {}

    /**
     * Adds the order-by parameter to the criteria (deprecated)
     *
     * @deprecated 1.2.1
     * @see \Phalcon\Mvc\Model\Criteria::orderBy()
     * @param string $orderColumns 
     * @return Criteria 
     */
    public function order($orderColumns) {}

    /**
<<<<<<< HEAD
     * Adds the order-by clause to the criteria
=======
     * Adds the order-by parameter to the criteria
>>>>>>> 5cd73180ea748c3d5e180a24610161d9730cd146
     *
     * @param string $orderColumns 
     * @return Criteria 
     */
    public function orderBy($orderColumns) {}

    /**
<<<<<<< HEAD
     * Adds the group-by clause to the criteria
     *
     * @param mixed $group 
     * @return Criteria 
     */
    public function groupBy($group) {}

    /**
     * Adds the having clause to the criteria
     *
     * @param mixed $having 
     * @return Criteria 
     */
    public function having($having) {}

    /**
     * Adds the limit parameter to the criteria
     *
     * @param mixed $limit 
     * @param mixed $offset 
     * @return Criteria 
=======
     * Adds the limit parameter to the criteria
     *
     * @param int $limit 
     * @param int $offset 
     * @return \Phalcon\Mvc\Model\Criteria 
>>>>>>> 5cd73180ea748c3d5e180a24610161d9730cd146
     */
    public function limit($limit, $offset = null) {}

    /**
     * Adds the "for_update" parameter to the criteria
     *
     * @param bool $forUpdate 
     * @return Criteria 
     */
    public function forUpdate($forUpdate = true) {}

    /**
     * Adds the "shared_lock" parameter to the criteria
     *
     * @param bool $sharedLock 
     * @return Criteria 
     */
    public function sharedLock($sharedLock = true) {}

    /**
     * Sets the cache options in the criteria
     * This method replaces all previously set cache options
     *
     * @param array $cache 
     * @return Criteria 
     */
    public function cache($cache) {}

    /**
     * Returns the conditions parameter in the criteria
     *
     * @return string|null 
     */
    public function getWhere() {}

    /**
     * Returns the columns to be queried
     *
     * @return string|array|null 
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
     * @return int|array|null 
     */
    public function getLimit() {}

    /**
<<<<<<< HEAD
     * Returns the order clause in the criteria
=======
     * Returns the order parameter in the criteria
>>>>>>> 5cd73180ea748c3d5e180a24610161d9730cd146
     *
     * @return string|null 
     */
    public function getOrder() {}

    /**
<<<<<<< HEAD
     * Returns the group clause in the criteria
     */
    public function getGroupBy() {}

    /**
     * Returns the having clause in the criteria
     */
    public function getHaving() {}

    /**
=======
>>>>>>> 5cd73180ea748c3d5e180a24610161d9730cd146
     * Returns all the parameters defined in the criteria
     *
     * @return array 
     */
    public function getParams() {}

    /**
     * Builds a Phalcon\Mvc\Model\Criteria based on an input array like _POST
     *
     * @param mixed $dependencyInjector 
     * @param string $modelName 
     * @param array $data 
     * @return Criteria 
     */
    public static function fromInput(\Phalcon\DiInterface $dependencyInjector, $modelName, $data) {}

    /**
     * Executes a find using the parameters built with the criteria
     *
     * @return \Phalcon\Mvc\Model\ResultsetInterface 
     */
    public function execute() {}

}
