<?php 

namespace Phalcon\DI {

	/**
	 * Phalcon\DI\Injectable
	 *
	 * This class allows to access services in the services container by just only accessing a public property
	 * with the same name of a registered service
	 */
	
	abstract class Injectable {

		protected $_dependencyInjector;

		protected $_eventsManager;

		/**
 		 * @var \Phalcon\Mvc\View
 		 */
		public $view;

		/**
		 * @var \Phalcon\Mvc\Router
	 	 */
		public $router;

		/**
		 * @var \Phalcon\Mvc\Dispatcher
	 	 */
		public $dispatcher;

		/**
		 * @var \Phalcon\Mvc\Url
	 	 */
		public $url;

		/**
		 * @var \Phalcon\DI
	 	 */
		public $di;

		/**
		 * @var \Phalcon\HTTP\Request
	 	 */
		public $request;

		/**
		 * @var \Phalcon\HTTP\Response
	 	 */
		public $response;

		/**
		 * @var \Phalcon\Flash\Direct
	 	 */
		public $flash;

		/**
		 * @var \Phalcon\Flash\Session
	 	 */
		public $session;

		/**
		 * @var \Phalcon\Session\Bag
	 	 */
		public $persistent;

		/**
		 * @var \Phalcon\Mvc\Model\Manager
	 	 */
		public $modelsManager;

		/**
		 * @var \Phalcon\Mvc\Model\Metadata
	 	 */
		public $modelsMetadata;
		
		/**
		 * Sets the dependency injector
		 *
		 * @param \Phalcon\DI $dependencyInjector
		 */
		public function setDI($dependencyInjector){ }


		/**
		 * Returns the internal dependency injector
		 *
		 * @return \Phalcon\DI
		 */
		public function getDI(){ }


		/**
		 * Sets the event manager
		 *
		 * @param \Phalcon\Events\Manager $eventsManager
		 */
		public function setEventsManager($eventsManager){ }


		/**
		 * Returns the internal event manager
		 *
		 * @return \Phalcon\Events\Manager
		 */
		public function getEventsManager(){ }


		/**
		 * Magic method __get
		 *
		 * @param string $propertyName
		 */
		public function __get($propertyName){ }

	}
}
