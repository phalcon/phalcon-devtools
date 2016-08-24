<?php

namespace Phalcon\Mvc\Model;

/**
 * Phalcon\Mvc\Model\ManagerInterface
 * Interface for Phalcon\Mvc\Model\Manager
 */
interface ManagerInterface
{

    /**
     * Initializes a model in the model manager
     *
     * @param mixed $model 
     */
    public function initialize(\Phalcon\Mvc\ModelInterface $model);

    /**
     * Sets the mapped source for a model
     *
     * @param mixed $model 
     * @param string $source 
     */
    public function setModelSource(\Phalcon\Mvc\ModelInterface $model, $source);

    /**
     * Returns the mapped source for a model
     *
     * @param mixed $model 
     * @return string 
     */
    public function getModelSource(\Phalcon\Mvc\ModelInterface $model);

    /**
     * Sets the mapped schema for a model
     *
     * @param mixed $model 
     * @param string $schema 
     */
    public function setModelSchema(\Phalcon\Mvc\ModelInterface $model, $schema);

    /**
     * Returns the mapped schema for a model
     *
     * @param mixed $model 
     * @return string 
     */
    public function getModelSchema(\Phalcon\Mvc\ModelInterface $model);

    /**
     * Sets both write and read connection service for a model
     *
     * @param mixed $model 
     * @param string $connectionService 
     */
    public function setConnectionService(\Phalcon\Mvc\ModelInterface $model, $connectionService);

    /**
     * Sets read connection service for a model
     *
     * @param mixed $model 
     * @param string $connectionService 
     */
    public function setReadConnectionService(\Phalcon\Mvc\ModelInterface $model, $connectionService);

    /**
     * Returns the connection service name used to read data related to a model
     *
     * @param mixed $model 
     * @return string 
     */
    public function getReadConnectionService(\Phalcon\Mvc\ModelInterface $model);

    /**
     * Sets write connection service for a model
     *
     * @param mixed $model 
     * @param string $connectionService 
     */
    public function setWriteConnectionService(\Phalcon\Mvc\ModelInterface $model, $connectionService);

    /**
     * Returns the connection service name used to write data related to a model
     *
     * @param mixed $model 
     * @return string 
     */
    public function getWriteConnectionService(\Phalcon\Mvc\ModelInterface $model);

    /**
     * Returns the connection to read data related to a model
     *
     * @param mixed $model 
     * @return \Phalcon\Db\AdapterInterface 
     */
    public function getReadConnection(\Phalcon\Mvc\ModelInterface $model);

    /**
     * Returns the connection to write data related to a model
     *
     * @param mixed $model 
     * @return \Phalcon\Db\AdapterInterface 
     */
    public function getWriteConnection(\Phalcon\Mvc\ModelInterface $model);

    /**
     * Check of a model is already initialized
     *
     * @param string $modelName 
     * @return bool 
     */
    public function isInitialized($modelName);

    /**
     * Get last initialized model
     *
     * @return \Phalcon\Mvc\ModelInterface 
     */
    public function getLastInitialized();

    /**
     * Loads a model throwing an exception if it doesn't exist
     *
     * @param string $modelName 
     * @param bool $newInstance 
     * @return \Phalcon\Mvc\ModelInterface 
     */
    public function load($modelName, $newInstance = false);

    /**
     * Setup a 1-1 relation between two models
     *
     * @param	mixed $fields
     * @param	string $referencedModel
     * @param	mixed $referencedFields
     * @param	array $options
     * @param mixed $model 
     * @param mixed $fields 
     * @param mixed $referencedModel 
     * @param mixed $referencedFields 
     * @param mixed $options 
     * @param \Phalcon\Mvc\ModelInterface $$model 
     * @return \Phalcon\Mvc\Model\RelationInterface 
     */
    public function addHasOne(\Phalcon\Mvc\ModelInterface $model, $fields, $referencedModel, $referencedFields, $options = null);

    /**
     * Setup a relation reverse 1-1  between two models
     *
     * @param	mixed $fields
     * @param	string $referencedModel
     * @param	mixed $referencedFields
     * @param	array $options
     * @param mixed $model 
     * @param mixed $fields 
     * @param mixed $referencedModel 
     * @param mixed $referencedFields 
     * @param mixed $options 
     * @param  $\Phalcon\Mvc\ModelInterface $model
     * @return  
     */
    public function addBelongsTo(\Phalcon\Mvc\ModelInterface $model, $fields, $referencedModel, $referencedFields, $options = null);

    /**
     * Setup a relation 1-n between two models
     *
     * @param	mixed $fields
     * @param	string $referencedModel
     * @param	mixed $referencedFields
     * @param	array $options
     * @param mixed $model 
     * @param mixed $fields 
     * @param mixed $referencedModel 
     * @param mixed $referencedFields 
     * @param mixed $options 
     * @param  $\Phalcon\Mvc\ModelInterface $model
     * @return  
     */
    public function addHasMany(\Phalcon\Mvc\ModelInterface $model, $fields, $referencedModel, $referencedFields, $options = null);

    /**
     * Checks whether a model has a belongsTo relation with another model
     *
     * @param mixed $modelName 
     * @param mixed $modelRelation 
     * @param  $string $modelRelation
     * @return  
     */
    public function existsBelongsTo($modelName, $modelRelation);

    /**
     * Checks whether a model has a hasMany relation with another model
     *
     * @param mixed $modelName 
     * @param mixed $modelRelation 
     * @param  $string $modelRelation
     * @return  
     */
    public function existsHasMany($modelName, $modelRelation);

    /**
     * Checks whether a model has a hasOne relation with another model
     *
     * @param mixed $modelName 
     * @param mixed $modelRelation 
     * @param  $string $modelRelation
     * @return  
     */
    public function existsHasOne($modelName, $modelRelation);

    /**
     * Gets belongsTo related records from a model
     *
     * @param mixed $method 
     * @param mixed $modelName 
     * @param mixed $modelRelation 
     * @param mixed $record 
     * @param mixed $parameters 
     * @param string $$method 
     * @param string $$modelName 
     * @param string $$modelRelation 
     * @param \Phalcon\Mvc\Model $$record 
     * @param array $$parameters 
     * @return \Phalcon\Mvc\Model\ResultsetInterface 
     */
    public function getBelongsToRecords($method, $modelName, $modelRelation, \Phalcon\Mvc\ModelInterface $record, $parameters = null);

    /**
     * Gets hasMany related records from a model
     *
     * @param mixed $method 
     * @param mixed $modelName 
     * @param mixed $modelRelation 
     * @param mixed $record 
     * @param mixed $parameters 
     * @param string $$method 
     * @param string $$modelName 
     * @param string $$modelRelation 
     * @param \Phalcon\Mvc\Model $$record 
     * @param array $$parameters 
     * @return \Phalcon\Mvc\Model\ResultsetInterface 
     */
    public function getHasManyRecords($method, $modelName, $modelRelation, \Phalcon\Mvc\ModelInterface $record, $parameters = null);

    /**
     * Gets belongsTo related records from a model
     *
     * @param mixed $method 
     * @param mixed $modelName 
     * @param mixed $modelRelation 
     * @param mixed $record 
     * @param mixed $parameters 
     * @param string $$method 
     * @param string $$modelName 
     * @param string $$modelRelation 
     * @param \Phalcon\Mvc\Model $$record 
     * @param array $$parameters 
     * @return \Phalcon\Mvc\Model\ResultsetInterface 
     */
    public function getHasOneRecords($method, $modelName, $modelRelation, \Phalcon\Mvc\ModelInterface $record, $parameters = null);

    /**
     * Gets belongsTo relations defined on a model
     *
     * @param mixed $model 
     * @param \Phalcon\Mvc\ModelInterface $$model 
     * @return array 
     */
    public function getBelongsTo(\Phalcon\Mvc\ModelInterface $model);

    /**
     * Gets hasMany relations defined on a model
     *
     * @param mixed $model 
     * @param \Phalcon\Mvc\ModelInterface $$model 
     * @return array 
     */
    public function getHasMany(\Phalcon\Mvc\ModelInterface $model);

    /**
     * Gets hasOne relations defined on a model
     *
     * @param mixed $model 
     * @param \Phalcon\Mvc\ModelInterface $$model 
     * @return array 
     */
    public function getHasOne(\Phalcon\Mvc\ModelInterface $model);

    /**
     * Gets hasOne relations defined on a model
     *
     * @param mixed $model 
     * @param \Phalcon\Mvc\ModelInterface $$model 
     * @return array 
     */
    public function getHasOneAndHasMany(\Phalcon\Mvc\ModelInterface $model);

    /**
     * Query all the relationships defined on a model
     *
     * @param mixed $modelName 
     * @param string $$modelName 
     * @return \Phalcon\Mvc\Model\RelationInterface[] 
     */
    public function getRelations($modelName);

    /**
     * Query the relations between two models
     *
     * @param mixed $first 
     * @param mixed $second 
     * @param string $$first 
     * @param string $$second 
     * @return array 
     */
    public function getRelationsBetween($first, $second);

    /**
     * Creates a Phalcon\Mvc\Model\Query without execute it
     *
     * @param mixed $phql 
     * @param string $$phql 
     * @return \Phalcon\Mvc\Model\QueryInterface 
     */
    public function createQuery($phql);

    /**
     * Creates a Phalcon\Mvc\Model\Query and execute it
     *
     * @param mixed $phql 
     * @param mixed $placeholders 
     * @param string $$phql 
     * @param array $$placeholders 
     * @return \Phalcon\Mvc\Model\QueryInterface 
     */
    public function executeQuery($phql, $placeholders = null);

    /**
     * Creates a Phalcon\Mvc\Model\Query\Builder
     *
     * @param mixed $params 
     * @param string $$params 
     * @return \Phalcon\Mvc\Model\Query\BuilderInterface 
     */
    public function createBuilder($params = null);

    /**
     * Binds a behavior to a model
     *
     * @param mixed $model 
     * @param mixed $behavior 
     */
    public function addBehavior(\Phalcon\Mvc\ModelInterface $model, \Phalcon\Mvc\Model\BehaviorInterface $behavior);

    /**
     * Receives events generated in the models and dispatches them to an events-manager if available
     * Notify the behaviors that are listening in the model
     *
     * @param mixed $eventName 
     * @param \Phalcon\Mvc\ModelInterface $model 
     * @param string $$eventName 
     */
    public function notifyEvent($eventName, \Phalcon\Mvc\ModelInterface $model);

    /**
     * Dispatch an event to the listeners and behaviors
     * This method expects that the endpoint listeners/behaviors returns true
     * meaning that a least one is implemented
     *
     * @param \Phalcon\Mvc\ModelInterface $model 
     * @param mixed $eventName 
     * @param mixed $data 
     * @param string $$eventName 
     * @param array $$data 
     * @return boolean 
     */
    public function missingMethod(\Phalcon\Mvc\ModelInterface $model, $eventName, $data);

    /**
     * Returns the last query created or executed in the models manager
     *
     * @return \Phalcon\Mvc\Model\QueryInterface 
     */
    public function getLastQuery();

    /**
     * Returns a relation by its alias
     *
     * @param string $modelName 
     * @param string $alias 
     * @param string $$modelName 
     * @param string $$alias 
     * @return \Phalcon\Mvc\Model\Relation 
     */
    public function getRelationByAlias($modelName, $alias);

}
