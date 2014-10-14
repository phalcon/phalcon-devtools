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
	 * $di = new Phalcon\DI();
	 *
	 * $di->set('collectionManager', function(){
	 *      return new Phalcon\Mvc\Collection\Manager();
	 * });
	 *
	 * $robot = new Robots($di);
	 * </code>
	 */
	
	class Manager implements \Phalcon\DI\InjectionAwareInterface, \Phalcon\Events\EventsAwareInterface, \Phalcon\Mvc\Collection\ManagerInterface {

		protected $_dependencyInjector;

		protected $_initialized;

		protected $_lastInitialized;

		protected $_eventsManager;

		protected $_customEventsManager;

		protected $_connectionServices;

		protected $_implicitObjectsIds;

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
		 * Initializes a model in the models manager
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
		 * Get the latest initialized model
		 *
		 * @return \Phalcon\Mvc\CollectionInterface
		 */
		public function getLastInitialized(){ }


		/**
		 * Sets a connection service for a specific model
		 *
		 * @param \Phalcon\Mvc\CollectionInterface $model
		 * @param string $connectionService
		 */
		public function setConnectionService($model, $connectionService){ }


		/**
		 * Sets if a model must use implicit objects ids
		 *
		 * @param \Phalcon\Mvc\CollectionInterface $model
		 * @param boolean $useImplicitObjectIds
		 */
		public function useImplicitObjectIds($model, $useImplicitObjectIds){ }


		/**
		 * Checks if a model is using implicit object ids
		 *
		 * @param \Phalcon\Mvc\CollectionInterface $model
		 * @return boolean
		 */
		public function isUsingImplicitObjectIds($model){ }


		/**
		 * Returns the connection related to a model
		 *
		 * @param \Phalcon\Mvc\CollectionInterface $model
		 * @return \Phalcon\Db\AdapterInterface(?) MongoDB
		 */
		public function getConnection($model){ }


		/**
		 * Receives events generated in the models and dispatches them to a events-manager if available
		 * Notify the behaviors that are listening in the model
		 *
		 * @param string $eventName
		 * @param \Phalcon\Mvc\CollectionInterface $model
		 */
		public function notifyEvent($eventName, $model){ }

	}
}
