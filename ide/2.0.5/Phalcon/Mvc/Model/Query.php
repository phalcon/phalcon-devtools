<?php

namespace Phalcon\Mvc\Model;

use Phalcon\Db\Column;
use Phalcon\Db\RawValue;
use Phalcon\DiInterface;
use Phalcon\Mvc\Model\Row;
use Phalcon\Mvc\ModelInterface;
use Phalcon\Mvc\Model\Exception;
use Phalcon\Mvc\Model\ManagerInterface;
use Phalcon\Mvc\Model\QueryInterface;
use Phalcon\Cache\BackendInterface;
use Phalcon\Mvc\Model\Query\Status;
use Phalcon\Mvc\Model\Resultset\Complex;
use Phalcon\Mvc\Model\Query\StatusInterface;
use Phalcon\Mvc\Model\ResultsetInterface;
use Phalcon\Mvc\Model\Resultset\Simple;
use Phalcon\Di\InjectionAwareInterface;
use Phalcon\Mvc\Model\RelationInterface;


class Query implements QueryInterface, InjectionAwareInterface
{

	const TYPE_SELECT = 309;

	const TYPE_INSERT = 306;

	const TYPE_UPDATE = 300;

	const TYPE_DELETE = 303;



	protected $_dependencyInjector;

	protected $_manager;

	protected $_metaData;

	protected $_type;

	protected $_phql;

	protected $_ast;

	protected $_intermediate;

	protected $_models;

	protected $_sqlAliases;

	protected $_sqlAliasesModels;

	protected $_sqlModelsAliases;

	protected $_sqlAliasesModelsInstances;

	protected $_sqlColumnAliases;

	protected $_modelsInstances;

	protected $_cache;

	protected $_cacheOptions;

	protected $_uniqueRow;

	protected $_bindParams;

	protected $_bindTypes;

	static protected $_irPhqlCache;



	/**
	 * Phalcon\Mvc\Model\Query constructor
	 * 
	 * @param string $phql
	 * @param DiInterface $dependencyInjector
	 *
	 */
	public function __construct($phql=null, DiInterface $dependencyInjector=null) {}

	/**
	 * Sets the dependency injection container
	 * 
	 * @param DiInterface $dependencyInjector
	 *
	 * @return void
	 */
	public function setDI(DiInterface $dependencyInjector) {}

	/**
	 * Returns the dependency injection container
	 *
	 * @return DiInterface
	 */
	public function getDI() {}

	/**
	 * Tells to the query if only the first row in the resultset must be returned
	 * 
	 * @param boolean $uniqueRow
	 *
	 * @return Query
	 */
	public function setUniqueRow($uniqueRow) {}

	/**
	 * Check if the query is programmed to get only the first row in the resultset
	 *
	 * @return boolean
	 */
	public function getUniqueRow() {}

	/**
	 * Replaces the model's name to its source name in a qualifed-name expression
	 * 
	 * @param array $expr
	 *
	 * @return array
	 */
	protected final function _getQualified(array $expr) {}

	/**
		 * Check if the qualified name is a column alias
	 * 
	 * @param array $argument
		 *
	 * @return array
	 */
	protected final function _getCallArgument(array $argument) {}

	/**
	 * Resolves a expression in a single call argument
	 * 
	 * @param array $expr
	 *
	 * @return array
	 */
	protected final function _getCaseExpression(array $expr) {}

	/**
	 * Resolves a expression in a single call argument
	 * 
	 * @param array $expr
	 *
	 * @return array
	 */
	protected final function _getFunctionCall(array $expr) {}

	/**
	 * Resolves an expression from its intermediate code into a string
	 *
	 * @param array $expr
	 * @param boolean $quoting
	 * 
	 * @return string
	 */
	protected final function _getExpression($expr, $quoting=true) {}

	/**
				 * Resolving the left part of the expression if any
	 * 
	 * @param array $column
				 *
	 * @return mixed
	 */
	protected final function _getSelectColumn(array $column) {}

	/**
		 * Check for select * (all)
	 * 
	 * @param ManagerInterface $manager
	 * @param $qualifiedName
		 *
	 * @return mixed
	 */
	protected final function _getTable(ManagerInterface $manager, $qualifiedName) {}

	/**
	 * Resolves a JOIN clause checking if the associated models exist
	 *
	 * @param ManagerInterface $manager
	 * @param array $join
	 * 
	 * @return array
	 */
	protected final function _getJoin(ManagerInterface $manager, $join) {}

	/**
	 * Resolves a JOIN type
	 *
	 * @param array $join
	 * 
	 * @return string
	 */
	protected final function _getJoinType($join) {}

	/**
	 * Resolves joins involving has-one/belongs-to/has-many relations
	 *
	 * @param string $joinType
	 * @param string $joinSource
	 * @param string $modelAlias
	 * @param string $joinAlias
	 * @param RelationInterface $relation
	 * 
	 * @return array
	 */
	protected final function _getSingleJoin($joinType, $joinSource, $modelAlias, $joinAlias, RelationInterface $relation) {}

	/**
		 * Local fields in the 'from' relation
	 * 
	 * @param $joinType
	 * @param $joinSource
	 * @param $modelAlias
	 * @param $joinAlias
	 * @param RelationInterface $relation
		 *
	 * @return array
	 */
	protected final function _getMultiJoin($joinType, $joinSource, $modelAlias, $joinAlias, RelationInterface $relation) {}

	/**
		 * Local fields in the 'from' relation
	 * 
	 * @param $select
		 *
	 * @return mixed
	 */
	protected final function _getJoins($select) {}

	/**
			 * Check join alias
	 * 
	 * @param $order
			 *
	 * @return array
	 */
	protected final function _getOrderClause($order) {}

	/**
			 * Check if the order has a predefined ordering mode
	 * 
	 * @param array $group
			 *
	 * @return array
	 */
	protected final function _getGroupClause(array $group) {}

	/**
			 * The select is gruped by several columns
	 * 
	 * @param array $limitClause
			 *
	 * @return array
	 */
	protected final function _getLimitClause(array $limitClause) {}

	/**
	 * Analyzes a SELECT intermediate code and produces an array to be executed later
	 * 
	 * @param mixed $ast
	 * @param mixed $merge
	 *
	 * @return array
	 */
	protected final function _prepareSelect($ast=null, $merge=null) {}

	/**
		 * sql_models are all the models that are using in the query
		 *
	 * @return array
	 */
	protected final function _prepareInsert() {}

	/**
	 * Analyzes an UPDATE intermediate code and produces an array to be executed later
	 *
	 * @return array
	 */
	protected final function _prepareUpdate() {}

	/**
		 * We use these arrays to store info related to models, alias and its sources. With them we can rename columns later
		 *
	 * @return array
	 */
	protected final function _prepareDelete() {}

	/**
		 * We use these arrays to store info related to models, alias and its sources. With them we can rename columns later
		 *
	 * @return array
	 */
	public function parse() {}

	/**
		 * This function parses the PHQL statement
		 *
	 * @return BackendInterface
	 */
	public function getCache() {}

	/**
	 * Executes the SELECT intermediate representation producing a Phalcon\Mvc\Model\Resultset
	 * 
	 * @param mixed $intermediate
	 * @param mixed $bindParams
	 * @param mixed $bindTypes
	 * @param boolean $simulate
	 *
	 * @return ResultsetInterface|array
	 */
	protected final function _executeSelect($intermediate, $bindParams, $bindTypes, $simulate=false) {}

	/**
		 * Get a database connection
	 * 
	 * @param mixed $intermediate
	 * @param mixed $bindParams
	 * @param mixed $bindTypes
		 *
	 * @return StatusInterface
	 */
	protected final function _executeInsert($intermediate, $bindParams, $bindTypes) {}

	/**
		 * Get the model connection
	 * 
	 * @param mixed $intermediate
	 * @param mixed $bindParams
	 * @param mixed $bindTypes
		 *
	 * @return StatusInterface
	 */
	protected final function _executeUpdate($intermediate, $bindParams, $bindTypes) {}

	/**
		 * Load the model from the modelsManager or from the _modelsInstances property
	 * 
	 * @param mixed $intermediate
	 * @param mixed $bindParams
	 * @param mixed $bindTypes
		 *
	 * @return StatusInterface
	 */
	protected final function _executeDelete($intermediate, $bindParams, $bindTypes) {}

	/**
		 * Load the model from the modelsManager or from the _modelsInstances property
	 * 
	 * @param ModelInterface $model
	 * @param mixed $intermediate
	 * @param mixed $bindParams
	 * @param mixed $bindTypes
		 *
	 * @return ResultsetInterface
	 */
	protected final function _getRelatedRecords(ModelInterface $model, $intermediate, $bindParams, $bindTypes) {}

	/**
		 * Instead of create a PHQL string statement we manually create the IR representation
	 * 
	 * @param mixed $bindParams
	 * @param mixed $bindTypes
		 *
	 * @return mixed
	 */
	public function execute($bindParams=null, $bindTypes=null) {}

	/**
			 * The user must set a cache key
	 * 
	 * @param mixed $bindParams
	 * @param mixed $bindTypes
			 *
	 * @return mixed
	 */
	public function getSingleResult($bindParams=null, $bindTypes=null) {}

	/**
		 * The query is already programmed to return just one row
	 * 
	 * @param int $type
		 *
	 * @return Query
	 */
	public function setType($type) {}

	/**
	 * Gets the type of PHQL statement executed
	 *
	 * @return int
	 */
	public function getType() {}

	/**
	 * Set default bind parameters
	 * 
	 * @param array $bindParams
	 * @param boolean $merge
	 *
	 * @return Query
	 */
	public function setBindParams(array $bindParams, $merge=false) {}

	/**
	 * Returns default bind params
	 *
	 * @return mixed
	 */
	public function getBindParams() {}

	/**
	 * Set default bind parameters
	 * 
	 * @param array $bindTypes
	 * @param boolean $merge
	 *
	 * @return Query
	 */
	public function setBindTypes(array $bindTypes, $merge=false) {}

	/**
	 * Returns default bind types
	 *
	 * @return mixed
	 */
	public function getBindTypes() {}

	/**
	 * Allows to set the IR to be executed
	 * 
	 * @param array $intermediate
	 *
	 * @return Query
	 */
	public function setIntermediate(array $intermediate) {}

	/**
	 * Returns the intermediate representation of the PHQL statement
	 *
	 * @return mixed
	 */
	public function getIntermediate() {}

	/**
	 * Sets the cache parameters of the query
	 * 
	 * @param $cacheOptions
	 *
	 * @return Query
	 */
	public function cache($cacheOptions) {}

	/**
	 * Returns the current cache options
	 *
	 * @param array
	 *
	 * @return mixed
	 */
	public function getCacheOptions() {}

	/**
	 * Returns the SQL to be generated by the internal PHQL (only works in SELECT statements)
	 *
	 * @return array
	 */
	public function getSql() {}

}
