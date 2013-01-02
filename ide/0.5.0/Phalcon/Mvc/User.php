<?php 

namespace Phalcon\Mvc {

	abstract class User {

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
		 * @var \Phalcon\Session\Bag
	 	 */
		public $persistent;
		
		/**
		 * Sets the dependency injector
		 *
		 * @param \Phalcon\DI $dependencyInjector
		 */
		public function setDI($dependencyInjector){ }


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
