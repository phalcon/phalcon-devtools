<?php

namespace Phalcon\Mvc\Model;

use Phalcon\DiInterface;
use Phalcon\Mvc\Model\Relation;
use Phalcon\Mvc\Model\RelationInterface;
use Phalcon\Mvc\Model\Exception;
use Phalcon\Mvc\ModelInterface;
use Phalcon\Db\AdapterInterface;
use Phalcon\Mvc\Model\ResultsetInterface;
use Phalcon\Mvc\Model\ManagerInterface;
use Phalcon\Di\InjectionAwareInterface;
use Phalcon\Events\EventsAwareInterface;
use Phalcon\Mvc\Model\QueryInterface;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Mvc\Model\Query\BuilderInterface;
use Phalcon\Events\ManagerInterface as EventsManagerInterface;


class Manager implements ManagerInterface, InjectionAwareInterface, EventsAwareInterface
{

	protected $_dependencyInjector;

	protected $_eventsManager;

	protected $_customEventsManager;

	protected $_readConnectionServices;

	protected $_writeConnectionServices;

	protected $_aliases;

	/**
	 * Has many relations
	 */
	protected $_hasMany;

	/**
	 * Has many relations by model
	 */
	protected $_hasManySingle;

	/**
	 * Has one relations
	 */
	protected $_hasOne;

	/**
	 * Has one relations by model
	 */
	protected $_hasOneSingle;

	/**
	 * Belongs to relations
	 */
	protected $_belongsTo;

	/**
	 * All the relationships by model
	 */
	protected $_belongsToSingle;

	/**
	 * Has many-Through relations
	 */
	protected $_hasManyToMany;

	/**
	 * Has many-Through relations by model
	 */
	protected $_hasManyToManySingle;

	/**
	 * Mark initialized models
	 */
	protected $_initialized;

	protected $_sources;

	protected $_schemas;

	/**
	 * Models' behaviors
	 */
	protected $_behaviors;

	/**
	 * Last model initialized
	 */
	protected $_lastInitialized;

	/**
	 * Last query created/executed
	 */
	protected $_lastQuery;

	/**
	 * Stores a list of reusable instances
	 */
	protected $_reusable;

	protected $_keepSnapshots;

	/**
	 * Does the model use dynamic update, instead of updating all rows?
	 */
	protected $_dynamicUpdate;

	protected $_namespaceAliases;



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
	 * @return DiInterface
	 */
	public function getDI() {}

	/**
	 * Sets a global events manager
	 * 
	 * @param EventsManagerInterface $eventsManager
	 *
	 * @return Manager
	 */
	public function setEventsManager(EventsManagerInterface $eventsManager) {}

	/**
	 * Returns the internal event manager
	 *
	 * @return EventsManagerInterface
	 */
	public function getEventsManager() {}

	/**
	 * Sets a custom events manager for a specific model
	 * 
	 * @param ModelInterface $model
	 * @param EventsManagerInterface $eventsManager
	 *
	 * @return void
	 */
	public function setCustomEventsManager(ModelInterface $model, EventsManagerInterface $eventsManager) {}

	/**
	 * Returns a custom events manager related to a model
	 * 
	 * @param ModelInterface $model
	 *
	 * @return EventsManagerInterface|boolean
	 */
	public function getCustomEventsManager(ModelInterface $model) {}

	/**
	 * Initializes a model in the model manager
	 * 
	 * @param ModelInterface $model
	 *
	 * @return boolean
	 */
	public function initialize(ModelInterface $model) {}

	/**
		 * Models are just initialized once per request
	 * 
	 * @param string $modelName
		 *
	 * @return boolean
	 */
	public function isInitialized($modelName) {}

	/**
	 * Get last initialized model
	 *
	 * @return ModelInterface
	 */
	public function getLastInitialized() {}

	/**
	 * Loads a model throwing an exception if it doesn't exist
	 * 
	 * @param string $modelName
	 * @param boolean $newInstance
	 *
	 * @return ModelInterface
	 */
	public function load($modelName, $newInstance=false) {}

	/**
		 * Check if a model with the same is already loaded
	 * 
	 * @param ModelInterface $model
	 * @param string $source
		 *
	 * @return void
	 */
	public function setModelSource(ModelInterface $model, $source) {}

	/**
	 * Returns the mapped source for a model
	 * 
	 * @param ModelInterface $model
	 *
	 * @return string
	 */
	public function getModelSource(ModelInterface $model) {}

	/**
	 * Sets the mapped schema for a model
	 * 
	 * @param ModelInterface $model
	 * @param string $schema
	 *
	 * @return void
	 */
	public function setModelSchema(ModelInterface $model, $schema) {}

	/**
	 * Returns the mapped schema for a model
	 * 
	 * @param ModelInterface $model
	 *
	 * @return string
	 */
	public function getModelSchema(ModelInterface $model) {}

	/**
	 * Sets both write and read connection service for a model
	 * 
	 * @param ModelInterface $model
	 * @param string $connectionService
	 *
	 * @return void
	 */
	public function setConnectionService(ModelInterface $model, $connectionService) {}

	/**
	 * Sets write connection service for a model
	 * 
	 * @param ModelInterface $model
	 * @param string $connectionService
	 *
	 * @return void
	 */
	public function setWriteConnectionService(ModelInterface $model, $connectionService) {}

	/**
	 * Sets read connection service for a model
	 * 
	 * @param ModelInterface $model
	 * @param string $connectionService
	 *
	 * @return void
	 */
	public function setReadConnectionService(ModelInterface $model, $connectionService) {}

	/**
	 * Returns the connection to read data related to a model
	 * 
	 * @param ModelInterface $model
	 *
	 * @return AdapterInterface
	 */
	public function getReadConnection(ModelInterface $model) {}

	/**
	 * Returns the connection to write data related to a model
	 * 
	 * @param ModelInterface $model
	 *
	 * @return AdapterInterface
	 */
	public function getWriteConnection(ModelInterface $model) {}

	/**
	 * Returns the connection to read or write data related to a model depending on the connection services.
	 * 
	 * @param ModelInterface $model
	 * @param $connectionServices
	 *
	 * @return AdapterInterface
	 */
	protected function _getConnection(ModelInterface $model, $connectionServices) {}

	/**
		 * Check if the model has a custom connection service
	 * 
	 * @param ModelInterface $model
		 *
	 * @return string
	 */
	public function getReadConnectionService(ModelInterface $model) {}

	/**
	 * Returns the connection service name used to write data related to a model
	 * 
	 * @param ModelInterface $model
	 *
	 * @return string
	 */
	public function getWriteConnectionService(ModelInterface $model) {}

	/**
	 * Returns the connection service name used to read or write data related to a model depending on the connection services
	 * 
	 * @param ModelInterface $model
	 * @param $connectionServices
	 *
	 * @return string
	 */
	public function _getConnectionService(ModelInterface $model, $connectionServices) {}

	/**
	 * Receives events generated in the models and dispatches them to a events-manager if available
	 * Notify the behaviors that are listening in the model
	 * 
	 * @param string $eventName
	 * @param ModelInterface $model
	 *
	 * @return mixed
	 */
	public function notifyEvent($eventName, ModelInterface $model) {}

	/**
		 * Dispatch events to the global events manager
	 * 
	 * @param ModelInterface $model
	 * @param string $eventName
	 * @param mixed $data
		 *
	 * @return mixed
	 */
	public function missingMethod(ModelInterface $model, $eventName, $data) {}

	/**
		 * Dispatch events to the global events manager
	 * 
	 * @param ModelInterface $model
	 * @param \Phalcon\Mvc\Model\BehaviorInterface $behavior
		 *
	 * @return void
	 */
	public function addBehavior(ModelInterface $model, \Phalcon\Mvc\Model\BehaviorInterface $behavior) {}

	/**
		 * Get the current behaviors
	 * 
	 * @param ModelInterface $model
	 * @param boolean $keepSnapshots
		 *
	 * @return void
	 */
	public function keepSnapshots(ModelInterface $model, $keepSnapshots) {}

	/**
	 * Checks if a model is keeping snapshots for the queried records
	 * 
	 * @param ModelInterface $model
	 *
	 * @return boolean
	 */
	public function isKeepingSnapshots(ModelInterface $model) {}

	/**
	 * Sets if a model must use dynamic update instead of the all-field update
	 * 
	 * @param ModelInterface $model
	 * @param boolean $dynamicUpdate
	 *
	 * @return void
	 */
	public function useDynamicUpdate(ModelInterface $model, $dynamicUpdate) {}

	/**
	 * Checks if a model is using dynamic update instead of all-field update
	 * 
	 * @param ModelInterface $model
	 *
	 * @return boolean
	 */
	public function isUsingDynamicUpdate(ModelInterface $model) {}

	/**
	 * Setup a 1-1 relation between two models
	 *
	 * @param ModelInterface $model
	 * @param mixed $fields
	 * @param string $referencedModel
	 * @param mixed $referencedFields
	 * @param mixed $options
	 * 
	 * @return Relation
	 */
	public function addHasOne(ModelInterface $model, $fields, $referencedModel, $referencedFields, $options=null) {}

	/**
		 * Check if the number of fields are the same
	 * 
	 * @param ModelInterface $model
	 * @param mixed $fields
	 * @param string $referencedModel
	 * @param mixed $referencedFields
	 * @param mixed $options
		 *
	 * @return Relation
	 */
	public function addBelongsTo(ModelInterface $model, $fields, $referencedModel, $referencedFields, $options=null) {}

	/**
		 * Check if the number of fields are the same
	 * 
	 * @param ModelInterface $model
	 * @param mixed $fields
	 * @param string $referencedModel
	 * @param mixed $referencedFields
	 * @param mixed $options
		 *
	 * @return Relation
	 */
	public function addHasMany(ModelInterface $model, $fields, $referencedModel, $referencedFields, $options=null) {}

	/**
		 * Check if the number of fields are the same
	 * 
	 * @param ModelInterface $model
	 * @param mixed $fields
	 * @param string $intermediateModel
	 * @param mixed $intermediateFields
	 * @param mixed $intermediateReferencedFields
	 * @param string $referencedModel
	 * @param mixed $referencedFields
	 * @param mixed $options
		 *
	 * @return Relation
	 */
	public function addHasManyToMany(ModelInterface $model, $fields, $intermediateModel, $intermediateFields, $intermediateReferencedFields, $referencedModel, $referencedFields, $options=null) {}

	/**
		 * Check if the number of fields are the same from the model to the intermediate model
	 * 
	 * @param string $modelName
	 * @param string $modelRelation
		 *
	 * @return boolean
	 */
	public function existsBelongsTo($modelName, $modelRelation) {}

	/**
		 * Relationship unique key
	 * 
	 * @param string $modelName
	 * @param string $modelRelation
		 *
	 * @return boolean
	 */
	public function existsHasMany($modelName, $modelRelation) {}

	/**
		 * Relationship unique key
	 * 
	 * @param string $modelName
	 * @param string $modelRelation
		 *
	 * @return boolean
	 */
	public function existsHasOne($modelName, $modelRelation) {}

	/**
		 * Relationship unique key
	 * 
	 * @param string $modelName
	 * @param string $modelRelation
		 *
	 * @return boolean
	 */
	public function existsHasManyToMany($modelName, $modelRelation) {}

	/**
		 * Relationship unique key
	 * 
	 * @param string $modelName
	 * @param string $alias
		 *
	 * @return Relation|boolean
	 */
	public function getRelationByAlias($modelName, $alias) {}

	/**
	 * Merge two arrays of find parameters
	 * 
	 * @param mixed $findParamsOne
	 * @param mixed $findParamsTwo
	 *
	 * @return array
	 */
	protected final function _mergeFindParameters($findParamsOne, $findParamsTwo) {}

	/**
	 * Helper method to query records based on a relation definition
	 *
	 * @param RelationInterface $relation
	 * @param string $method
	 * @param ModelInterface $record
	 * @param mixed $parameters
	 * 
	 * @return mixed
	 */
	public function getRelationRecords(RelationInterface $relation, $method, ModelInterface $record, $parameters=null) {}

	/**
		 * Re-use bound parameters
	 * 
	 * @param string $modelName
	 * @param string $key
		 *
	 * @return mixed
	 */
	public function getReusableRecords($modelName, $key) {}

	/**
	 * Stores a reusable record in the internal list
	 * 
	 * @param string $modelName
	 * @param string $key
	 * @param mixed $records
	 *
	 * @return void
	 */
	public function setReusableRecords($modelName, $key, $records) {}

	/**
	 * Clears the internal reusable list
	 *
	 * @return void
	 */
	public function clearReusableObjects() {}

	/**
	 * Gets belongsTo related records from a model
	 * 
	 * @param string $method
	 * @param string $modelName
	 * @param mixed $modelRelation
	 * @param ModelInterface $record
	 * @param $parameters
	 *
	 * @return ResultsetInterface|boolean
	 */
	public function getBelongsToRecords($method, $modelName, $modelRelation, ModelInterface $record, $parameters=null) {}

	/**
			 * Check if there is a relation between them
	 * 
	 * @param string $method
	 * @param string $modelName
	 * @param mixed $modelRelation
	 * @param ModelInterface $record
	 * @param $parameters
			 *
	 * @return ResultsetInterface|boolean
	 */
	public function getHasManyRecords($method, $modelName, $modelRelation, ModelInterface $record, $parameters=null) {}

	/**
			 * Check if there is a relation between them
	 * 
	 * @param string $method
	 * @param string $modelName
	 * @param mixed $modelRelation
	 * @param ModelInterface $record
	 * @param $parameters
			 *
	 * @return ModelInterface|boolean
	 */
	public function getHasOneRecords($method, $modelName, $modelRelation, ModelInterface $record, $parameters=null) {}

	/**
			 * Check if there is a relation between them
	 * 
	 * @param ModelInterface $model
			 *
	 * @return RelationInterface[]|array
	 */
	public function getBelongsTo(ModelInterface $model) {}

	/**
	 * Gets hasMany relations defined on a model
	 * 
	 * @param ModelInterface $model
	 *
	 * @return RelationInterface[]|array
	 */
	public function getHasMany(ModelInterface $model) {}

	/**
	 * Gets hasOne relations defined on a model
	 * 
	 * @param ModelInterface $model
	 *
	 * @return array
	 */
	public function getHasOne(ModelInterface $model) {}

	/**
	 * Gets hasManyToMany relations defined on a model
	 * 
	 * @param ModelInterface $model
	 *
	 * @return RelationInterface[]|array
	 */
	public function getHasManyToMany(ModelInterface $model) {}

	/**
	 * Gets hasOne relations defined on a model
	 * 
	 * @param ModelInterface $model
	 *
	 * @return RelationInterface[]
	 */
	public function getHasOneAndHasMany(ModelInterface $model) {}

	/**
	 * Query all the relationships defined on a model
	 * 
	 * @param string $modelName
	 *
	 * @return RelationInterface[]
	 */
	public function getRelations($modelName) {}

	/**
		 * Get belongs-to relations
	 * 
	 * @param string $first
	 * @param string $second
		 *
	 * @return RelationInterface[]|boolean
	 */
	public function getRelationsBetween($first, $second) {}

	/**
		 * Check if it's a belongs-to relationship
	 * 
	 * @param string $phql
		 *
	 * @return QueryInterface
	 */
	public function createQuery($phql) {}

	/**
		 * Create a query
	 * 
	 * @param string $phql
	 * @param mixed $placeholders
	 * @param mixed $types
		 *
	 * @return QueryInterface
	 */
	public function executeQuery($phql, $placeholders=null, $types=null) {}

	/**
		 * Gets Query instance from DI container
	 * 
	 * @param mixed $params
		 *
	 * @return BuilderInterface
	 */
	public function createBuilder($params=null) {}

	/**
		 * Gets Builder instance from DI container
		 *
	 * @return QueryInterface
	 */
	public function getLastQuery() {}

	/**
	 * Registers shorter aliases for namespaces in PHQL statements
	 * 
	 * @param string $alias
	 * @param string $namespaceName
	 *
	 * @return void
	 */
	public function registerNamespaceAlias($alias, $namespaceName) {}

	/**
	 * Returns a real namespace from its alias
	 * 
	 * @param string $alias
	 *
	 * @return string
	 */
	public function getNamespaceAlias($alias) {}

	/**
	 * Returns all the registered namespace aliases
	 *
	 * @return array
	 */
	public function getNamespaceAliases() {}

}
