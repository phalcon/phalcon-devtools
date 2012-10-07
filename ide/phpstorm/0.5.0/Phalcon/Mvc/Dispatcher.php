<?php 

namespace Phalcon\Mvc {

	/**
	 * Phalcon\Mvc\Dispatcher
	 *
	 * Dispatching is the process of taking the request object, extracting the module name,
	 * controller name, action name, and optional parameters contained in it, and then
	 * instantiating a controller and calling an action of that controller.
	 *
	 *<code>
	 *
	 *	$di = new Phalcon\DI();
	 *
	 *	$dispatcher = new Phalcon\Mvc\Dispatcher();
	 *
	 *  $dispatcher->setDI($di);
	 *
	 *	$dispatcher->setControllerName('posts');
	 *	$dispatcher->setActionName('index');
	 *	$dispatcher->setParams(array());
	 *
	 *	$controller = $dispatcher->dispatch();
	 *
	 *</code>
	 */
	
	class Dispatcher extends \Phalcon\Dispatcher {

		protected $_dependencyInjector;

		protected $_eventsManager;

		protected $_activeHandler;

		protected $_finished;

		protected $_handlerName;

		protected $_actionName;

		protected $_params;

		protected $_returnedValue;

		protected $_lastHandler;

		protected $_defaultNamespace;

		protected $_defaultHandler;

		protected $_defaultAction;

		protected $_handlerSuffix;

		protected $_actionSuffix;

		/**
		 * Sets the default controller suffix
		 *
		 * @param string $controllerSuffix
		 */
		public function setControllerSuffix($controllerSuffix){ }


		/**
		 * Sets the default controller name
		 *
		 * @param string $controllerName
		 */
		public function setDefaultController($controllerName){ }


		/**
		 * Sets the controller name to be dispatched
		 *
		 * @param string $controllerName
		 */
		public function setControllerName($controllerName){ }


		/**
		 * Gets last dispatched controller name
		 *
		 * @return string
		 */
		public function getControllerName(){ }


		/**
		 * Throws an internal exception
		 *
		 * @param string $message
		 */
		protected function _throwDispatchException(){ }


		/**
		 * Returns the lastest dispatched controller
		 *
		 * @return \Phalcon\Mvc\Controller
		 */
		public function getLastController(){ }


		/**
		 * Returns the active controller in the dispatcher
		 *
		 * @return \Phalcon\Mvc\Controller
		 */
		public function getActiveController(){ }

	}
}
