<?php

namespace Phalcon\Mvc\Model\Query;

/**
 * Phalcon\Mvc\Model\Query\Builder
 * Helps to create PHQL queries using an OO interface
 * <code>
 * $params = array(
 * 'models'     => array('Users'),
 * 'columns'    => array('id', 'name', 'status'),
 * 'conditions' => array(
 * array(
 * "created > :min: AND created < :max:",
 * array("min" => '2013-01-01',   'max' => '2014-01-01'),
 * array("min" => PDO::PARAM_STR, 'max' => PDO::PARAM_STR),
 * ),
 * ),
 * // or 'conditions' => "created > '2013-01-01' AND created < '2014-01-01'",
 * 'group'      => array('id', 'name'),
 * 'having'     => "name = 'Kamil'",
 * 'order'      => array('name', 'id'),
 * 'limit'      => 20,
 * 'offset'     => 20,
 * // or 'limit' => array(20, 20),
 * );
 * $queryBuilder = new \Phalcon\Mvc\Model\Query\Builder($params);
 * </code>
 */
class Builder implements \Phalcon\Mvc\Model\Query\BuilderInterface, \Phalcon\Di\InjectionAwareInterface
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


    protected $_hiddenParamNumber = 0;


    /**
     * Phalcon\Mvc\Model\Query\Builder constructor
     *
     * @param mixed $params 
     * @param mixed $dependencyInjector 
     */
    public function __construct($params = null, \Phalcon\DiInterface $dependencyInjector = null) {}

    /**
     * Sets the DependencyInjector container
     *
     * @param mixed $dependencyInjector 
     * @return Builder 
     */
    public function setDI(\Phalcon\DiInterface $dependencyInjector) {}

    /**
     * Returns the DependencyInjector container
     *
     * @return \Phalcon\DiInterface 
     */
    public function getDI() {}

    /**
     * Sets SELECT DISTINCT / SELECT ALL flag
     * <code>
     * $builder->distinct("status");
     * $builder->distinct(null);
     * </code>
     *
     * @param mixed $distinct 
     * @return Builder 
     */
    public function distinct($distinct) {}

    /**
     * Returns SELECT DISTINCT / SELECT ALL flag
     *
     * @return bool 
     */
    public function getDistinct() {}

    /**
     * Sets the columns to be queried
     * <code>
     * $builder->columns("id, name");
     * $builder->columns(array('id', 'name'));
     * $builder->columns(array('name', 'number' => 'COUNT(*)'));
     * </code>
     *
     * @param mixed $columns 
     * @return Builder 
     */
    public function columns($columns) {}

    /**
     * Return the columns to be queried
     *
     * @return string|array 
     */
    public function getColumns() {}

    /**
     * Sets the models who makes part of the query
     * <code>
     * $builder->from('Robots');
     * $builder->from(array('Robots', 'RobotsParts'));
     * $builder->from(array('r' => 'Robots', 'rp' => 'RobotsParts'));
     * </code>
     *
     * @param mixed $models 
     * @return Builder 
     */
    public function from($models) {}

    /**
     * Add a model to take part of the query
     * <code>
     * // Load data from models Robots
     * $builder->addFrom('Robots');
     * // Load data from model 'Robots' using 'r' as alias in PHQL
     * $builder->addFrom('Robots', 'r');
     * // Load data from model 'Robots' using 'r' as alias in PHQL
     * // and eager load model 'RobotsParts'
     * $builder->addFrom('Robots', 'r', 'RobotsParts');
     * // Load data from model 'Robots' using 'r' as alias in PHQL
     * // and eager load models 'RobotsParts' and 'Parts'
     * $builder->addFrom('Robots', 'r', ['RobotsParts', 'Parts']);
     * </code>
     *
     * @param mixed $model 
     * @param mixed $alias 
     * @param mixed $with 
     * @return Builder 
     */
    public function addFrom($model, $alias = null, $with = null) {}

    /**
     * Return the models who makes part of the query
     *
     * @return string|array 
     */
    public function getFrom() {}

    /**
     * Adds an INNER join to the query
     * <code>
     * // Inner Join model 'Robots' with automatic conditions and alias
     * $builder->join('Robots');
     * // Inner Join model 'Robots' specifing conditions
     * $builder->join('Robots', 'Robots.id = RobotsParts.robots_id');
     * // Inner Join model 'Robots' specifing conditions and alias
     * $builder->join('Robots', 'r.id = RobotsParts.robots_id', 'r');
     * // Left Join model 'Robots' specifing conditions, alias and type of join
     * $builder->join('Robots', 'r.id = RobotsParts.robots_id', 'r', 'LEFT');
     * </code>
     *
     * @param string $model 
     * @param string $conditions 
     * @param string $alias 
     * @param string $type 
     * @return \Phalcon\Mvc\Model\Query\Builder 
     */
    public function join($model, $conditions = null, $alias = null, $type = null) {}

    /**
     * Adds an INNER join to the query
     * <code>
     * // Inner Join model 'Robots' with automatic conditions and alias
     * $builder->innerJoin('Robots');
     * // Inner Join model 'Robots' specifing conditions
     * $builder->innerJoin('Robots', 'Robots.id = RobotsParts.robots_id');
     * // Inner Join model 'Robots' specifing conditions and alias
     * $builder->innerJoin('Robots', 'r.id = RobotsParts.robots_id', 'r');
     * </code>
     *
     * @param string $model 
     * @param string $conditions 
     * @param string $alias 
     * @param string $type 
     * @return \Phalcon\Mvc\Model\Query\Builder 
     */
    public function innerJoin($model, $conditions = null, $alias = null) {}

    /**
     * Adds a LEFT join to the query
     * <code>
     * $builder->leftJoin('Robots', 'r.id = RobotsParts.robots_id', 'r');
     * </code>
     *
     * @param string $model 
     * @param string $conditions 
     * @param string $alias 
     * @return \Phalcon\Mvc\Model\Query\Builder 
     */
    public function leftJoin($model, $conditions = null, $alias = null) {}

    /**
     * Adds a RIGHT join to the query
     * <code>
     * $builder->rightJoin('Robots', 'r.id = RobotsParts.robots_id', 'r');
     * </code>
     *
     * @param string $model 
     * @param string $conditions 
     * @param string $alias 
     * @return \Phalcon\Mvc\Model\Query\Builder 
     */
    public function rightJoin($model, $conditions = null, $alias = null) {}

    /**
     * Return join parts of the query
     *
     * @return array 
     */
    public function getJoins() {}

    /**
     * Sets the query conditions
     * <code>
     * $builder->where(100);
     * $builder->where('name = "Peter"');
     * $builder->where('name = :name: AND id > :id:', array('name' => 'Peter', 'id' => 100));
     * </code>
     *
     * @param mixed $conditions 
     * @param array $bindParams 
     * @param array $bindTypes 
     * @return \Phalcon\Mvc\Model\Query\Builder 
     */
    public function where($conditions, $bindParams = null, $bindTypes = null) {}

    /**
     * Appends a condition to the current conditions using a AND operator
     * <code>
     * $builder->andWhere('name = "Peter"');
     * $builder->andWhere('name = :name: AND id > :id:', array('name' => 'Peter', 'id' => 100));
     * </code>
     *
     * @param string $conditions 
     * @param array $bindParams 
     * @param array $bindTypes 
     * @return \Phalcon\Mvc\Model\Query\Builder 
     */
    public function andWhere($conditions, $bindParams = null, $bindTypes = null) {}

    /**
     * Appends a condition to the current conditions using an OR operator
     * <code>
     * $builder->orWhere('name = "Peter"');
     * $builder->orWhere('name = :name: AND id > :id:', array('name' => 'Peter', 'id' => 100));
     * </code>
     *
     * @param string $conditions 
     * @param array $bindParams 
     * @param array $bindTypes 
     * @return \Phalcon\Mvc\Model\Query\Builder 
     */
    public function orWhere($conditions, $bindParams = null, $bindTypes = null) {}

    /**
     * Appends a BETWEEN condition to the current conditions
     * <code>
     * $builder->betweenWhere('price', 100.25, 200.50);
     * </code>
     *
     * @param string $expr 
     * @param mixed $minimum 
     * @param mixed $maximum 
     * @param string $operator 
     * @return Builder 
     */
    public function betweenWhere($expr, $minimum, $maximum, $operator = BuilderInterface::OPERATOR_AND) {}

    /**
     * Appends a NOT BETWEEN condition to the current conditions
     * <code>
     * $builder->notBetweenWhere('price', 100.25, 200.50);
     * </code>
     *
     * @param string $expr 
     * @param mixed $minimum 
     * @param mixed $maximum 
     * @param string $operator 
     * @return Builder 
     */
    public function notBetweenWhere($expr, $minimum, $maximum, $operator = BuilderInterface::OPERATOR_AND) {}

    /**
     * Appends an IN condition to the current conditions
     * <code>
     * $builder->inWhere('id', [1, 2, 3]);
     * </code>
     *
     * @param string $expr 
     * @param array $values 
     * @param string $operator 
     * @return Builder 
     */
    public function inWhere($expr, array $values, $operator = BuilderInterface::OPERATOR_AND) {}

    /**
     * Appends a NOT IN condition to the current conditions
     * <code>
     * $builder->notInWhere('id', [1, 2, 3]);
     * </code>
     *
     * @param string $expr 
     * @param array $values 
     * @param string $operator 
     * @return Builder 
     */
    public function notInWhere($expr, array $values, $operator = BuilderInterface::OPERATOR_AND) {}

    /**
     * Return the conditions for the query
     *
     * @return string|array 
     */
    public function getWhere() {}

    /**
     * Sets an ORDER BY condition clause
     * <code>
     * $builder->orderBy('Robots.name');
     * $builder->orderBy(array('1', 'Robots.name'));
     * </code>
     *
     * @param string|array $orderBy 
     * @return \Phalcon\Mvc\Model\Query\Builder 
     */
    public function orderBy($orderBy) {}

    /**
     * Returns the set ORDER BY clause
     *
     * @return string|array 
     */
    public function getOrderBy() {}

    /**
     * Sets a HAVING condition clause. You need to escape PHQL reserved words using [ and ] delimiters
     * <code>
     * $builder->having('SUM(Robots.price) > 0');
     * </code>
     *
     * @param string $having 
     * @return Builder 
     */
    public function having($having) {}

    /**
     * Sets a FOR UPDATE clause
     * <code>
     * $builder->forUpdate(true);
     * </code>
     *
     * @param bool $forUpdate 
     * @return Builder 
     */
    public function forUpdate($forUpdate) {}

    /**
     * Return the current having clause
     *
     * @return string|array 
     */
    public function getHaving() {}

    /**
     * Sets a LIMIT clause, optionally an offset clause
     * <code>
     * $builder->limit(100);
     * $builder->limit(100, 20);
     * </code>
     *
     * @param mixed $limit 
     * @param mixed $offset 
     * @return Builder 
     */
    public function limit($limit = null, $offset = null) {}

    /**
     * Returns the current LIMIT clause
     *
     * @return string|array 
     */
    public function getLimit() {}

    /**
     * Sets an OFFSET clause
     * <code>
     * $builder->offset(30);
     * </code>
     *
     * @param int $offset 
     * @return Builder 
     */
    public function offset($offset) {}

    /**
     * Returns the current OFFSET clause
     *
     * @return string|array 
     */
    public function getOffset() {}

    /**
     * Sets a GROUP BY clause
     * <code>
     * $builder->groupBy(array('Robots.name'));
     * </code>
     *
     * @param string|array $group 
     * @return \Phalcon\Mvc\Model\Query\Builder 
     */
    public function groupBy($group) {}

    /**
     * Returns the GROUP BY clause
     *
     * @return string 
     */
    public function getGroupBy() {}

    /**
     * Returns a PHQL statement built based on the builder parameters
     *
     * @return string 
     */
    public final function getPhql() {}

    /**
     * Returns the query built
     *
     * @return \Phalcon\Mvc\Model\QueryInterface 
     */
    public function getQuery() {}

    /**
     * Automatically escapes identifiers but only if they need to be escaped.
     *
     * @param string $identifier 
     * @return string 
     */
    final public function autoescape($identifier) {}

}
