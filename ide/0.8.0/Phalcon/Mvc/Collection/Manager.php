<?php 

namespace Phalcon\Mvc\Collection {

	/**
	 * Phalcon\Mvc\Collection\Manager
	 *
	 * This components controls the initialization of models, keeping record of relations
	 * between the different models of the application.
	 *
	 * A CollectionManager is injected to a model via a Dependency Injector Container such as Phalcon\DI.
	 *
	 * <code>
	 * $dependencyInjector = new Phalcon\DI();
	 *
	 * $dependencyInjector->set('collectionManager', function(){
	 *      return new Phalcon\Mvc\Collection\Manager();
	 * });
	 *
	 * $robot = new Robots($dependencyInjector);
	 * </code>
	 */
	
	class Manager {

		protected $_dependencyInjector;

		protected $_initialized;

		protected $_lastInitialized;

		protected $_eventsManager;

		protected $_customEventsManager;

		protected $_connectionServices;

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
		 * Sets the event manager
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
		 * @param \Phalcon\Mvc\CollectionInterface $model
		 * @param \Phalcon\Events\ManagerInterface $eventsManager
		 */
		public function setCustomEventsManager($model, $eventsManager){ }


		/**
		 * Returns a custom events manager related to a model
		 *
		 * @param \Phalcon\Mvc\CollectionInterface $model
		 * @return \Phalcon\Events\ManagerInterface
		 */
		public function getCustomEventsManager($model){ }


		/**
		 * Initializes a model in the model manager
		 *
		 * @param \Phalcon\Mvc\CollectionInterface $model
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
		 * Get the lastest initialized model
		 *
		 * @return \Phalcon\Mvc\ModelInterface
		 */
		public function getLastInitialized(){ }


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
		 * Receives events generated in the models and dispatches them to a events-manager if available
		 * Notify the behaviors that are listening in the model
		 *
		 * @param string $eventName
		 * @param \Phalcon\Mvc\ModelInterface $model
		 */
		public function notifyEvent($eventName, $model){ }

	}
}
