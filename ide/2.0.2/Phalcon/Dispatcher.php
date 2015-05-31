<?php 

namespace Phalcon {

	/**
	 * Phalcon\Dispatcher
	 *
	 * This is the base class for Phalcon\Mvc\Dispatcher and Phalcon\CLI\Dispatcher.
	 * This class can't be instantiated directly, you can use it to create your own dispatchers
	 */
	
	abstract class Dispatcher implements \Phalcon\DispatcherInterface, \Phalcon\Di\InjectionAwareInterface, \Phalcon\Events\EventsAwareInterface {

		const EXCEPTION_NO_DI = 0;

		const EXCEPTION_CYCLIC_ROUTING = 1;

		const EXCEPTION_HANDLER_NOT_FOUND = 2;

		const EXCEPTION_INVALID_HANDLER = 3;

		const EXCEPTION_INVALID_PARAMS = 4;

		const EXCEPTION_ACTION_NOT_FOUND = 5;

		protected $_dependencyInjector;

		protected $_eventsManager;

		protected $_activeHandler;

		protected $_finished;

		protected $_forwarded;

		protected $_moduleName;

		protected $_namespaceName;

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

		protected $_previousHandlerName;

		protected $_previousActionName;

		/**
		 * \Phalcon\Dispatcher constructor
		 */
		public function __construct(){ }


		/**
		 * Sets the dependency injector
		 */
		public function setDI(\Phalcon\DiInterface $dependencyInjector){ }


		/**
		 * Returns the internal dependency injector
		 */
		public function getDI(){ }


		/**
		 * Sets the events manager
		 */
		public function setEventsManager(\Phalcon\Events\ManagerInterface $eventsManager){ }


		/**
		 * Returns the internal event manager
		 */
		public function getEventsManager(){ }


		/**
		 * Sets the default action suffix
		 */
		public function setActionSuffix($actionSuffix){ }


		/**
		 * Sets the module where the controller is (only informative)
		 */
		public function setModuleName($moduleName){ }


		/**
		 * Gets the module where the controller class is
		 */
		public function getModuleName(){ }


		/**
		 * Sets the namespace where the controller class is
		 */
		public function setNamespaceName($namespaceName){ }


		/**
		 * Gets a namespace to be prepended to the current handler name
		 */
		public function getNamespaceName(){ }


		/**
		 * Sets the default namespace
		 */
		public function setDefaultNamespace($namespaceName){ }


		/**
		 * Returns the default namespace
		 */
		public function getDefaultNamespace(){ }


		/**
		 * Sets the default action name
		 */
		public function setDefaultAction($actionName){ }


		/**
		 * Sets the action name to be dispatched
		 */
		public function setActionName($actionName){ }


		/**
		 * Gets the latest dispatched action name
		 */
		public function getActionName(){ }


		/**
		 * Sets action params to be dispatched
		 *
		 * @param array params
		 */
		public function setParams($params){ }


		/**
		 * Gets action params
		 */
		public function getParams(){ }


		/**
		 * Set a param by its name or numeric index
		 *
		 * @param  mixed param
		 * @param  mixed value
		 */
		public function setParam($param, $value){ }


		/**
		 * Gets a param by its name or numeric index
		 *
		 * @param  mixed param
		 * @param  string|array filters
		 * @param  mixed defaultValue
		 * @return mixed
		 */
		public function getParam($param, $filters=null, $defaultValue=null){ }


		/**
		 * Returns the current method to be/executed in the dispatcher
		 */
		public function getActiveMethod(){ }


		/**
		 * Checks if the dispatch loop is finished or has more pendent controllers/tasks to dispatch
		 */
		public function isFinished(){ }


		/**
		 * Sets the latest returned value by an action manually
		 *
		 * @param mixed value
		 */
		public function setReturnedValue($value){ }


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
		 * Dispatchers are unique per module. Forwarding between modules is not allowed
		 *
		 *<code>
		 *  $this->dispatcher->forward(array("controller" => "posts", "action" => "index"));
		 *</code>
		 *
		 * @param array forward
		 */
		public function forward($forward){ }


		/**
		 * Check if the current executed action was forwarded by another one
		 */
		public function wasForwarded(){ }


		/**
		 * Possible class name that will be located to dispatch the request
		 */
		public function getHandlerClass(){ }


		/**
		 * Set empty properties to their defaults (where defaults are available)
		 */
		protected function _resolveEmptyProperties(){ }

	}
}
