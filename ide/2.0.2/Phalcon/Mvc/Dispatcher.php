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
	 *	$di = new \Phalcon\Di();
	 *
	 *	$dispatcher = new \Phalcon\Mvc\Dispatcher();
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
	
	class Dispatcher extends \Phalcon\Dispatcher implements \Phalcon\Events\EventsAwareInterface, \Phalcon\Di\InjectionAwareInterface, \Phalcon\DispatcherInterface, \Phalcon\Mvc\DispatcherInterface {

		const EXCEPTION_NO_DI = 0;

		const EXCEPTION_CYCLIC_ROUTING = 1;

		const EXCEPTION_HANDLER_NOT_FOUND = 2;

		const EXCEPTION_INVALID_HANDLER = 3;

		const EXCEPTION_INVALID_PARAMS = 4;

		const EXCEPTION_ACTION_NOT_FOUND = 5;

		protected $_handlerSuffix;

		protected $_defaultHandler;

		protected $_defaultAction;

		/**
		 * Sets the default controller suffix
		 */
		public function setControllerSuffix($controllerSuffix){ }


		/**
		 * Sets the default controller name
		 */
		public function setDefaultController($controllerName){ }


		/**
		 * Sets the controller name to be dispatched
		 */
		public function setControllerName($controllerName){ }


		/**
		 * Gets last dispatched controller name
		 */
		public function getControllerName(){ }


		/**
		 * Gets previous dispatched controller name
		 */
		public function getPreviousControllerName(){ }


		/**
		 * Gets previous dispatched action name
		 */
		public function getPreviousActionName(){ }


		/**
		 * Throws an internal exception
		 */
		protected function _throwDispatchException($message, $exceptionCode=null){ }


		/**
		 * Handles a user exception
		 */
		protected function _handleException(\Exception $exception){ }


		/**
		 * Possible controller class name that will be located to dispatch the request
		 */
		public function getControllerClass(){ }


		/**
		 * Returns the lastest dispatched controller
		 */
		public function getLastController(){ }


		/**
		 * Returns the active controller in the dispatcher
		 */
		public function getActiveController(){ }

	}
}
