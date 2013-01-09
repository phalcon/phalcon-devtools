<?php 

namespace Phalcon\Mvc\Model {

	/**
	 * Phalcon\Mvc\Model\Manager
	 *
	 * This components controls the initialization of models, keeping record of relations
	 * between the different models of the application.
	 *
	 * A ModelsManager is injected to a model via a Dependency Injector Container such as Phalcon\DI.
	 *
	 * <code>
	 * $dependencyInjector = new Phalcon\DI();
	 *
	 * $dependencyInjector->set('modelsManager', function(){
	 *      return new Phalcon\Mvc\Model\Manager();
	 * });
	 *
	 * $robot = new Robots($dependencyInjector);
	 * </code>
	 */
	
	class Manager {

		protected $_dependencyInjector;

		protected $_eventsManager;

		protected $_customEventsManager;

		protected $_connectionServices;

		protected $_aliases;

		protected $_hasMany;

		protected $_hasManySingle;

		protected $_hasOne;

		protected $_hasOneSingle;

		protected $_belongsTo;

		protected $_belongsToSingle;

		protected $_initialized;

		protected $_behaviors;

		protected $_lastInitialized;

		protected $_lastQuery;

		/**
		 * Sets the DependencyInjector container
		 *
		 * @param \Phalcon\DiInterface $dependencyInjector
		 */
		public function setDI($dependencyInjector){ }


		/**
		 * Returns the DependencyInjector container
		 *
		 * @return \Phalcon\DiInterface
		 */
		public function getDI(){ }


		/**
		 * Sets a global events manager
		 *
		 * @param \Phalcon\Events\ManagerInterface $eventsManager
		 */
		public function setEventsManager($eventsManager){ }


		/**
		 * Returns the internal event manager
		 *
		 * @return \Phalcon\Events\ManagerInterface
		 */
		public function getEventsManager(){ }


		/**
		 * Sets a custom events manager for a specific model
		 *
		 * @param \Phalcon\Mvc\ModelInterface $model
		 * @param \Phalcon\Events\ManagerInterface $eventsManager
		 */
		public function setCustomEventsManager($model, $eventsManager){ }


		/**
		 * Returns a custom events manager related to a model
		 *
		 * @param \Phalcon\Mvc\ModelInterface $model
		 * @return \Phalcon\Events\ManagerInterface
		 */
		public function getCustomEventsManager($model){ }


		/**
		 * Initializes a model in the model manager
		 *
		 * @param \Phalcon\Mvc\ModelInterface $model
		 */
		public function initialize($model){ }


		/**
		 * Check whether a model is already initialized
		 *
		 * @param string $modelName
		 * @return bool
		 */
		public function isInitialized($modelName){ }


		/**
		 * Get last initialized model
		 *
		 * @return \Phalcon\Mvc\ModelInterface
		 */
		public function getLastInitialized(){ }


		/**
		 * Loads a model throwing an exception if it doesn't exist
		 *
		 * @param  string $modelName
		 * @param  boolean $newInstance
		 * @return \Phalcon\Mvc\ModelInterface
		 */
		public function load($modelName, $newInstance=null){ }


		/**
		 * Set a connection service for a model
		 *
		 * @param \Phalcon\Mvc\ModelInterface $model
		 * @param string $connectionService
		 */
		public function setConnectionService($model, $connectionService){ }


		/**
		 * Returns the connection related to a model
		 *
		 * @param \Phalcon\Mvc\ModelInterface $model
		 * @return \Phalcon\Db\AdapterInterface
		 */
		public function getConnection($model){ }


		/**
		 * Returns the service name related to a model
		 *
		 * @param \Phalcon\Mvc\ModelInterface $model
		 * @param string
		 */
		public function getConnectionService($model){ }


		/**
		 * Receives events generated in the models and dispatches them to a events-manager if available
		 * Notify the behaviors that are listening in the model
		 *
		 * @param string $eventName
		 * @param \Phalcon\Mvc\ModelInterface $model
		 */
		public function notifyEvent($eventName, $model){ }


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
		public function missingMethod($model, $eventName, $data){ }


		/**
		 * Binds a behavior to a model
		 *
		 * @param \Phalcon\Mvc\ModelInterface $model
		 * @param \Phalcon\Mvc\Model\BehaviorInterface $behavior
		 */
		public function addBehavior($model, $behavior){ }


		/**
		 * Setup a 1-1 relation between two models
		 *
		 * @param 	Phalcon\Mvc\Model $model
		 * @param mixed $fields
		 * @param string $referencedModel
		 * @param mixed $referencedFields
		 * @param array $options
		 * @return  \Phalcon\Mvc\Model\Relation
		 */
		public function addHasOne($model, $fields, $referencedModel, $referencedFields, $options=null){ }


		/**
		 * Setup a relation reverse many to one between two models
		 *
		 * @param 	Phalcon\Mvc\Model $model
		 * @param mixed $fields
		 * @param string $referencedModel
		 * @param mixed $referencedFields
		 * @param array $options
		 * @return  \Phalcon\Mvc\Model\Relation
		 */
		public function addBelongsTo($model, $fields, $referencedModel, $referencedFields, $options=null){ }


		/**
		 * Setup a relation 1-n between two models
		 *
		 * @param 	Phalcon\Mvc\ModelInterface $model
		 * @param mixed $fields
		 * @param string $referencedModel
		 * @param mixed $referencedFields
		 * @param array $options
		 */
		public function addHasMany($model, $fields, $referencedModel, $referencedFields, $options=null){ }


		public function addHasManyThrough(){ }


		/**
		 * Checks whether a model has a belongsTo relation with another model
		 *
		 * @param 	string $modelName
		 * @param 	string $modelRelation
		 * @return 	boolean
		 */
		public function existsBelongsTo($modelName, $modelRelation){ }


		/**
		 * Checks whether a model has a hasMany relation with another model
		 *
		 * @param 	string $modelName
		 * @param 	string $modelRelation
		 * @return 	boolean
		 */
		public function existsHasMany($modelName, $modelRelation){ }


		/**
		 * Checks whether a model has a hasOne relation with another model
		 *
		 * @param 	string $modelName
		 * @param 	string $modelRelation
		 * @return 	boolean
		 */
		public function existsHasOne($modelName, $modelRelation){ }


		/**
		 * Returns a relation by its alias
		 *
		 * @param string $modelName
		 * @param string $alias
		 * @return \Phalcon\Mvc\Model\Relation
		 */
		public function getRelationByAlias($modelName, $alias){ }


		/**
		 * Helper method to query records based on a relation definition
		 *
		 * @param \Phalcon\Mvc\Model\Relation $relation
		 * @param string $method
		 * @param \Phalcon\Mvc\ModelInterface $record
		 * @param array $parameters
		 * @return \Phalcon\Mvc\Model\Resultset\Simple
		 */
		public function getRelationRecords($relation, $method, $record, $parameters=null){ }


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
		public function getBelongsToRecords($method, $modelName, $modelRelation, $record, $parameters=null){ }


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
		public function getHasManyRecords($method, $modelName, $modelRelation, $record, $parameters=null){ }


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
		public function getHasOneRecords($method, $modelName, $modelRelation, $record, $parameters=null){ }


		/**
		 * Gets all the belongsTo relations defined in a model
		 *
		 *<code>
		 *	$relations = $modelsManager->getBelongsTo(new Robots());
		 *</code>
		 *
		 * @param  \Phalcon\Mvc\ModelInterface $model
		 * @return \Phalcon\Mvc\Model\RelationInterface[]
		 */
		public function getBelongsTo($model){ }


		/**
		 * Gets hasMany relations defined on a model
		 *
		 * @param  \Phalcon\Mvc\ModelInterface $model
		 * @return \Phalcon\Mvc\Model\RelationInterface[]
		 */
		public function getHasMany($model){ }


		/**
		 * Gets hasOne relations defined on a model
		 *
		 * @param  \Phalcon\Mvc\ModelInterface $model
		 * @return array
		 */
		public function getHasOne($model){ }


		/**
		 * Gets hasOne relations defined on a model
		 *
		 * @param  \Phalcon\Mvc\ModelInterface $model
		 * @return array
		 */
		public function getHasOneAndHasMany($model){ }


		/**
		 * Query all the relationships defined on a model
		 *
		 * @param string $modelName
		 * @return \Phalcon\Mvc\RelationInterface[]
		 */
		public function getRelations($modelName){ }


		/**
		 * Query the first relationship defined between two models
		 *
		 * @param string $first
		 * @param string $second
		 * @return \Phalcon\Mvc\RelationInterface
		 */
		public function getRelationsBetween($first, $second){ }


		/**
		 * Creates a \Phalcon\Mvc\Model\Query without execute it
		 *
		 * @param string $phql
		 * @return \Phalcon\Mvc\Model\QueryInterface
		 */
		public function createQuery($phql){ }


		/**
		 * Creates a \Phalcon\Mvc\Model\Query and execute it
		 *
		 * @param string $phql
		 * @param array $placeholders
		 * @return \Phalcon\Mvc\Model\QueryInterface
		 */
		public function executeQuery($phql, $placeholders=null){ }


		/**
		 * Creates a \Phalcon\Mvc\Model\Query\Builder
		 *
		 * @param string $params
		 * @return \Phalcon\Mvc\Model\Query\BuilderInterface
		 */
		public function createBuilder($params=null){ }


		/**
		 * Returns the last query created or executed in the models manager
		 *
		 * @return \Phalcon\Mvc\Model\QueryInterface
		 */
		public function getLastQuery(){ }

	}
}
