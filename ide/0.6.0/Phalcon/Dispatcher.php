<?php 

namespace Phalcon {

	/**
	 * Phalcon\Dispatcher
	 *
	 * This is the base class for Phalcon\Mvc\Dispatcher and Phalcon\CLI\Dispatcher
	 */
	
	abstract class Dispatcher {

		const EXCEPTION_NO_DI = 0;

		const EXCEPTION_CYCLIC_ROUTING = 1;

		const EXCEPTION_HANDLER_NOT_FOUND = 2;

		const EXCEPTION_INVALID_PARAMS = 3;

		const EXCEPTION_ACTION_NOT_FOUND = 4;

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
		 * Sets the default action suffix
		 *
		 * @param string $actionSuffix
		 */
		public function setActionSuffix($actionSuffix){ }


		/**
		 * Sets the default namespace
		 *
		 * @param string $namespace
		 */
		public function setDefaultNamespace($namespace){ }


		/**
		 * Sets the default action name
		 *
		 * @param string $actionName
		 */
		public function setDefaultAction($actionName){ }


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
		 * @param  string|array $filters
		 * @return mixed
		 */
		public function getParam($param, $filters=null){ }


		/**
		 * Checks if the dispatch loop is finished or have more pendent controllers/tasks to disptach
		 *
		 * @return boolean
		 */
		public function isFinished(){ }


		/**
		 * Returns value returned by the lastest dispatched action
		 *
		 * @return mixed
		 */
		public function getReturnedValue(){ }


		/**
		 * Dispatches a handle action taking into account the routing parameters
		 *
		 * @return object
		 */
		public function dispatch(){ }


		/**
		 * Forwards the execution flow to another controller/action
		 *
		 * @param array $forward
		 */
		public function forward($forward){ }

	}
}
