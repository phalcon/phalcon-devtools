<?php

namespace Phalcon\Mvc\Model;

use Phalcon\Db\AdapterInterface;
use Phalcon\Mvc\ModelInterface;


interface ManagerInterface
{

	/**
	 * Initializes a model in the model manager
	 * 
	 * @param ModelInterface $model
	 */
	public function initialize(ModelInterface $model);

	/**
	 * Sets the mapped source for a model
	 * 
	 * @param ModelInterface $model
	 * @param string $source
	 *
	 * @return void
	 */
	public function setModelSource(ModelInterface $model, $source);

	/**
	 * Returns the mapped source for a model
	 * 
	 * @param ModelInterface $model
	 *
	 * @return string
	 */
	public function getModelSource(ModelInterface $model);

	/**
	 * Sets the mapped schema for a model
	 * 
	 * @param ModelInterface $model
	 * @param string $schema
	 */
	public function setModelSchema(ModelInterface $model, $schema);

	/**
	 * Returns the mapped schema for a model
	 * 
	 * @param ModelInterface $model
	 *
	 * @return string
	 */
	public function getModelSchema(ModelInterface $model);

	/**
	 * Sets both write and read connection service for a model
	 * 
	 * @param ModelInterface $model
	 * @param string $connectionService
	 */
	public function setConnectionService(ModelInterface $model, $connectionService);

	/**
	 * Sets read connection service for a model
	 * 
	 * @param ModelInterface $model
	 * @param string $connectionService
	 */
	public function setReadConnectionService(ModelInterface $model, $connectionService);

	/**
	 * Returns the connection service name used to read data related to a model
	 * 
	 * @param ModelInterface $model
	 *
	 * @return string
	 */
	public function getReadConnectionService(ModelInterface $model);

	/**
	 * Sets write connection service for a model
	 * 
	 * @param ModelInterface $model
	 * @param string $connectionService
	 */
	public function setWriteConnectionService(ModelInterface $model, $connectionService);

	/**
	 * Returns the connection service name used to write data related to a model
	 * 
	 * @param ModelInterface $model
	 *
	 * @return string
	 */
	public function getWriteConnectionService(ModelInterface $model);

	/**
	 * Returns the connection to read data related to a model
	 * 
	 * @param ModelInterface $model
	 *
	 * @return AdapterInterface
	 */
	public function getReadConnection(ModelInterface $model);

	/**
	 * Returns the connection to write data related to a model
	 * 
	 * @param ModelInterface $model
	 *
	 * @return AdapterInterface
	 */
	public function getWriteConnection(ModelInterface $model);

	/**
	 * Check of a model is already initialized
	 * 
	 * @param string $modelName
	 *
	 * @return boolean
	 */
	public function isInitialized($modelName);

	/**
	 * Get last initialized model
	 *
	 * @return ModelInterface
	 */
	public function getLastInitialized();

	/**
	 * Loads a model throwing an exception if it doesn't exist
	 * 
	 * @param string $modelName
	 * @param boolean $newInstance
	 *
	 * @return ModelInterface
	 */
	public function load($modelName, $newInstance=false);

	/**
	 * Setup a 1-1 relation between two models
	 *
	 * @param ModelInterface $model
	 * @param mixed $fields
	 * @param string $referencedModel
	 * @param mixed $referencedFields
	 * @param array $options
	 * 
	 * @return  Phalcon\Mvc\Model\RelationInterface
	 */
	public function addHasOne(ModelInterface $model, $fields, $referencedModel, $referencedFields, $options=null);

	/**
	 * Setup a relation reverse 1-1  between two models
	 *
	 * @param ModelInterface $model
	 * @param mixed $fields
	 * @param string $referencedModel
	 * @param mixed $referencedFields
	 * @param array $options
	 * 
	 * @return 	Phalcon\Mvc\Model\RelationInterface
	 */
	public function addBelongsTo(ModelInterface $model, $fields, $referencedModel, $referencedFields, $options=null);

	/**
	 * Setup a relation 1-n between two models
	 *
	 * @param ModelInterface $model
	 * @param mixed $fields
	 * @param string $referencedModel
	 * @param mixed $referencedFields
	 * @param array $options
	 * 
	 * @return 	Phalcon\Mvc\Model\RelationInterface
	 */
	public function addHasMany(ModelInterface $model, $fields, $referencedModel, $referencedFields, $options=null);

	/**
	 * Checks whether a model has a belongsTo relation with another model
	 *
	 * @param string $modelName
	 * @param string $modelRelation
	 * 
	 * @return 	boolean
	 */
	public function existsBelongsTo($modelName, $modelRelation);

	/**
	 * Checks whether a model has a hasMany relation with another model
	 *
	 * @param string $modelName
	 * @param string $modelRelation
	 * 
	 * @return 	boolean
	 */
	public function existsHasMany($modelName, $modelRelation);

	/**
	 * Checks whether a model has a hasOne relation with another model
	 *
	 * @param string $modelName
	 * @param string $modelRelation
	 * 
	 * @return 	boolean
	 */
	public function existsHasOne($modelName, $modelRelation);

	/**
	 * Gets belongsTo related records from a model
	 *
	 * @param string $method
	 * @param string $modelName
	 * @param string $modelRelation
	 * @param ModelInterface $record
	 * @param array $parameters
	 * 
	 * @return Phalcon\Mvc\Model\ResultsetInterface
	 */
	public function getBelongsToRecords($method, $modelName, $modelRelation, ModelInterface $record, $parameters=null);

	/**
	 * Gets hasMany related records from a model
	 *
	 * @param string $method
	 * @param string $modelName
	 * @param string $modelRelation
	 * @param ModelInterface $record
	 * @param array $parameters
	 * 
	 * @return Phalcon\Mvc\Model\ResultsetInterface
	 */
	public function getHasManyRecords($method, $modelName, $modelRelation, ModelInterface $record, $parameters=null);

	/**
	 * Gets belongsTo related records from a model
	 *
	 * @param string $method
	 * @param string $modelName
	 * @param string $modelRelation
	 * @param ModelInterface $record
	 * @param array $parameters
	 * 
	 * @return Phalcon\Mvc\Model\ResultsetInterface
	 */
	public function getHasOneRecords($method, $modelName, $modelRelation, ModelInterface $record, $parameters=null);

	/**
	 * Gets belongsTo relations defined on a model
	 *
	 * @param ModelInterface $model
	 * 
	 * @return array
	 */
	public function getBelongsTo(ModelInterface $model);

	/**
	 * Gets hasMany relations defined on a model
	 *
	 * @param ModelInterface $model
	 * 
	 * @return array
	 */
	public function getHasMany(ModelInterface $model);

	/**
	 * Gets hasOne relations defined on a model
	 *
	 * @param ModelInterface $model
	 * 
	 * @return array
	 */
	public function getHasOne(ModelInterface $model);

	/**
	 * Gets hasOne relations defined on a model
	 *
	 * @param ModelInterface $model
	 * 
	 * @return array
	 */
	public function getHasOneAndHasMany(ModelInterface $model);

	/**
	 * Query all the relationships defined on a model
	 *
	 * @param string $modelName
	 * 
	 * @return Phalcon\Mvc\Model\RelationInterface[]
	 */
	public function getRelations($modelName);

	/**
	 * Query the relations between two models
	 *
	 * @param string $first
	 * @param string $second
	 * 
	 * @return array
	 */
	public function getRelationsBetween($first, $second);

	/**
	 * Creates a Phalcon\Mvc\Model\Query without execute it
	 *
	 * @param string $phql
	 * 
	 * @return Phalcon\Mvc\Model\QueryInterface
	 */
	public function createQuery($phql);

	/**
	 * Creates a Phalcon\Mvc\Model\Query and execute it
	 *
	 * @param string $phql
	 * @param array $placeholders
	 * 
	 * @return Phalcon\Mvc\Model\QueryInterface
	 */
	public function executeQuery($phql, $placeholders=null);

	/**
	 * Creates a Phalcon\Mvc\Model\Query\Builder
	 *
	 * @param string $params
	 * 
	 * @return Phalcon\Mvc\Model\Query\BuilderInterface
	 */
	public function createBuilder($params=null);

	/**
	 * Binds a behavior to a model
	 * 
	 * @param ModelInterface $model
	 * @param \Phalcon\Mvc\Model\BehaviorInterface $behavior
	 */
	public function addBehavior(ModelInterface $model, \Phalcon\Mvc\Model\BehaviorInterface $behavior);

	/**
	 * Receives events generated in the models and dispatches them to a events-manager if available
	 * Notify the behaviors that are listening in the model
	 * 
	 * @param string $eventName
	 * @param ModelInterface $model
	 *
	 */
	public function notifyEvent($eventName, ModelInterface $model);

	/**
	 * Dispatch a event to the listeners and behaviors
	 * This method expects that the endpoint listeners/behaviors returns true
	 * meaning that a least one is implemented
	 *
	 * @param ModelInterface $model
	 * @param string $eventName
	 * @param array $data
	 * 
	 * @return boolean
	 */
	public function missingMethod(ModelInterface $model, $eventName, $data);

	/**
	 * Returns the last query created or executed in the
	 *
	 * @return Phalcon\Mvc\Model\QueryInterface
	 */
	public function getLastQuery();

	/**
	 * Returns a relation by its alias
	 *
	 * @param string $modelName
	 * @param string $alias
	 * 
	 * @return Phalcon\Mvc\Model\Relation
	 */
	public function getRelationByAlias($modelName, $alias);

}
