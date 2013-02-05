<?php 

namespace Phalcon\Mvc\Model {

	/**
	 * Phalcon\Mvc\Model\ManagerInterface initializer
	 */
	
	interface ManagerInterface {

		/**
		 * Initializes a model in the model manager
		 *
		 * @param \Phalcon\Mvc\ModelInterface $model
		 */
		public function initialize($model);


		/**
		 * Check of a model is already initialized
		 *
		 * @param string $modelName
		 * @return boolean
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
		 * @return \Phalcon\Mvc\ModelInterface
		 */
		public function load($modelName);


		/**
		 * Setup a 1-1 relation between two models
		 *
		 * @param 	Phalcon\Mvc\ModelInterface $model
		 * @param mixed $fields
		 * @param string $referenceModel
		 * @param mixed $referencedFields
		 * @param array $options
		 * @return 	Phalcon\Mvc\Model\RelationInterface
		 */
		public function addHasOne($model, $fields, $referenceModel, $referencedFields, $options=null);


		/**
		 * Setup a relation reverse 1-1  between two models
		 *
		 * @param 	Phalcon\Mvc\ModelInterface $model
		 * @param mixed $fields
		 * @param string $referenceModel
		 * @param mixed $referencedFields
		 * @param array $options
		 * @return 	Phalcon\Mvc\Model\RelationInterface
		 */
		public function addBelongsTo($model, $fields, $referenceModel, $referencedFields, $options=null);


		/**
		 * Setup a relation 1-n between two models
		 *
		 * @param 	Phalcon\Mvc\ModelInterface $model
		 * @param mixed $fields
		 * @param string $referenceModel
		 * @param mixed $referencedFields
		 * @param array $options
		 * @return 	Phalcon\Mvc\Model\RelationInterface
		 */
		public function addHasMany($model, $fields, $referenceModel, $referencedFields, $options=null);


		/**
		 * Checks whether a model has a belongsTo relation with another model
		 *
		 * @param 	string $modelName
		 * @param 	string $modelRelation
		 * @return 	boolean
		 */
		public function existsBelongsTo($modelName, $modelRelation);


		/**
		 * Checks whether a model has a hasMany relation with another model
		 *
		 * @param 	string $modelName
		 * @param 	string $modelRelation
		 * @return 	boolean
		 */
		public function existsHasMany($modelName, $modelRelation);


		/**
		 * Checks whether a model has a hasOne relation with another model
		 *
		 * @param 	string $modelName
		 * @param 	string $modelRelation
		 * @return 	boolean
		 */
		public function existsHasOne($modelName, $modelRelation);


		/**
		 * Gets belongsTo related records from a model
		 *
		 * @param string $method
		 * @param string $modelName
		 * @param string $modelRelation
		 * @param \Phalcon\Mvc\Model $record
		 * @param array $parameters
		 * @return \Phalcon\Mvc\Model\ResultsetInterface
		 */
		public function getBelongsToRecords($method, $modelName, $modelRelation, $record, $parameters=null);


		/**
		 * Gets hasMany related records from a model
		 *
		 * @param string $method
		 * @param string $modelName
		 * @param string $modelRelation
		 * @param \Phalcon\Mvc\Model $record
		 * @param array $parameters
		 * @return \Phalcon\Mvc\Model\ResultsetInterface
		 */
		public function getHasManyRecords($method, $modelName, $modelRelation, $record, $parameters=null);


		/**
		 * Gets belongsTo related records from a model
		 *
		 * @param string $method
		 * @param string $modelName
		 * @param string $modelRelation
		 * @param \Phalcon\Mvc\Model $record
		 * @param array $parameters
		 * @return \Phalcon\Mvc\Model\ResultsetInterface
		 */
		public function getHasOneRecords($method, $modelName, $modelRelation, $record, $parameters=null);


		/**
		 * Gets belongsTo relations defined on a model
		 *
		 * @param  \Phalcon\Mvc\ModelInterface $model
		 * @return array
		 */
		public function getBelongsTo($model);


		/**
		 * Gets hasMany relations defined on a model
		 *
		 * @param  \Phalcon\Mvc\ModelInterface $model
		 * @return array
		 */
		public function getHasMany($model);


		/**
		 * Gets hasOne relations defined on a model
		 *
		 * @param  \Phalcon\Mvc\ModelInterface $model
		 * @return array
		 */
		public function getHasOne($model);


		/**
		 * Gets hasOne relations defined on a model
		 *
		 * @param  \Phalcon\Mvc\ModelInterface $model
		 * @return array
		 */
		public function getHasOneAndHasMany($model);


		/**
		 * Query all the relationships defined on a model
		 *
		 * @param string $modelName
		 * @return \Phalcon\Mvc\Model\RelationInterface[]
		 */
		public function getRelations($modelName);


		/**
		 * Query the relations between two models
		 *
		 * @param string $firstModel
		 * @param string $secondModel
		 * @return array
		 */
		public function getRelationsBetween($firstModel, $secondModel);


		/**
		 * Creates a \Phalcon\Mvc\Model\Query without execute it
		 *
		 * @param string $phql
		 * @return \Phalcon\Mvc\Model\QueryInterface
		 */
		public function createQuery($phql);


		/**
		 * Creates a \Phalcon\Mvc\Model\Query and execute it
		 *
		 * @param string $phql
		 * @param array $placeholders
		 * @return \Phalcon\Mvc\Model\QueryInterface
		 */
		public function executeQuery($phql, $placeholders=null);


		/**
		 * Creates a \Phalcon\Mvc\Model\Query\Builder
		 *
		 * @param string $params
		 * @return \Phalcon\Mvc\Model\Query\BuilderInterface
		 */
		public function createBuilder($params=null);


		/**
		 * Binds a behavior to a model
		 *
		 * @param \Phalcon\Mvc\ModelInterface $model
		 * @param \Phalcon\Mvc\Model\BehaviorInterface $behavior
		 */
		public function addBehavior($model, $behavior);


		/**
		 * Receives events generated in the models and dispatches them to a events-manager if available
		 * Notify the behaviors that are listening in the model
		 *
		 * @param string $eventName
		 * @param \Phalcon\Mvc\ModelInterface $model
		 */
		public function notifyEvent($eventName, $model);


		/**
		 * Dispatch a event to the listeners and behaviors
		 * This method expects that the endpoint listeners/behaviors returns true
		 * meaning that a least one is implemented
		 *
		 * @param \Phalcon\Mvc\ModelInterface $model
		 * @param string $eventName
		 * @param aray $data
		 * @return boolean
		 */
		public function missingMethod($model, $eventName, $data);


		/**
		 * Returns the last query created or executed in the
		 *
		 * @return \Phalcon\Mvc\Model\QueryInterface
		 */
		public function getLastQuery();

	}
}
