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
	
	class Dispatcher {

		protected $_dependencyInjector;

		protected $_eventsManager;

		protected $_finished;

		protected $_activeController;

		protected $_controllerName;

		protected $_actionName;

		protected $_params;

		protected $_returnedValue;

		protected $_lastController;

		protected $_defaultNamespace;

		protected $_defaultController;

		protected $_defaultAction;

		public function __construct(){ }


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
		 * Sets the events manager
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
		 * Sets the default namespace
		 *
		 * @param string $namespace
		 */
		public function setDefaultNamespace($namespace){ }


		/**
		 * Sets the default controller name
		 *
		 * @param string $controllerName
		 */
		public function setDefaultController($controllerName){ }


		/**
		 * Sets the default action name
		 *
		 * @param string $actionName
		 */
		public function setDefaultAction($actionName){ }


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
		 * Sets the action name to be dispatched
		 *
		 * @param string $actionName
		 */
		public function setActionName($actionName){ }


		/**
		 * Gets last dispatched action name
		 *
		 * @return string
		 */
		public function getActionName(){ }


		/**
		 * Sets action params to be dispatched
		 *
		 * @param array $params
		 */
		public function setParams($params){ }


		/**
		 * Gets action params
		 *
		 * @return array
		 */
		public function getParams(){ }


		/**
		 * Set a param by its name or numeric index
		 *
		 * @param  mixed $param
		 * @param  mixed $value
		 */
		public function setParam($param, $value){ }


		/**
		 * Gets a param by its name or numeric index
		 *
		 * @param  mixed $param
		 * @return mixed
		 */
		public function getParam($param){ }


		/**
		 * Dispatches a controller action taking into account the routing parameters
		 *
		 * @return \Phalcon\Mvc\Controller
		 */
		public function dispatch(){ }


		/**
		 * Throws an internal exception
		 *
		 * @param string $message
		 */
		protected function _throwDispatchException(){ }


		/**
		 * @param array $forward
		 */
		public function forward($forward){ }


		/**
		 * Checks if the dispatch loop is finished or have more pendent controller to disptach
		 *
		 * @return boolean
		 */
		public function isFinished(){ }


		/**
		 * Returns the lastest dispatched controller
		 *
		 * @return \Phalcon\Mvc\Controller
		 */
		public function getLastController(){ }


		/**
		 * Returns value returned by the lastest dispatched action
		 *
		 * @return mixed
		 */
		public function getReturnedValue(){ }


		/**
		 * Returns the active controller in the dispatcher
		 *
		 * @return \Phalcon\Mvc\Controller
		 */
		public function getActiveController(){ }

	}
}
