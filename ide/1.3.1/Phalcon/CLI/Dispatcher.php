<?php 

namespace Phalcon\CLI {

	/**
	 * Phalcon\CLI\Dispatcher
	 *
	 * Dispatching is the process of taking the command-line arguments, extracting the module name,
	 * task name, action name, and optional parameters contained in it, and then
	 * instantiating a task and calling an action on it.
	 *
	 *<code>
	 *
	 *	$di = new Phalcon\DI();
	 *
	 *	$dispatcher = new Phalcon\CLI\Dispatcher();
	 *
	 *  $dispatcher->setDI($di);
	 *
	 *	$dispatcher->setTaskName('posts');
	 *	$dispatcher->setActionName('index');
	 *	$dispatcher->setParams(array());
	 *
	 *	$handle = $dispatcher->dispatch();
	 *
	 *</code>
	 */
	
	class Dispatcher extends \Phalcon\Dispatcher implements \Phalcon\Events\EventsAwareInterface, \Phalcon\DI\InjectionAwareInterface, \Phalcon\DispatcherInterface {

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
		 * Sets the default task suffix
		 *
		 * @param string $taskSuffix
		 */
		public function setTaskSuffix($taskSuffix){ }


		/**
		 * Sets the default task name
		 *
		 * @param string $taskName
		 */
		public function setDefaultTask($taskName){ }


		/**
		 * Sets the task name to be dispatched
		 *
		 * @param string $taskName
		 */
		public function setTaskName($taskName){ }


		/**
		 * Gets last dispatched task name
		 *
		 * @return string
		 */
		public function getTaskName(){ }


		/**
		 * Throws an internal exception
		 *
		 * @param string $message
		 * @param int $exceptionCode
		 */
		protected function _throwDispatchException(){ }


		/**
		 * Handles a user exception
		 *
		 * @param \Exception $exception
		 */
		protected function _handleException(){ }


		/**
		 * Possible task class name that will be located to dispatch the request
		 *
		 * @return string
		 */
		public function getTaskClass(){ }


		/**
		 * Returns the lastest dispatched controller
		 *
		 * @return \Phalcon\CLI\Task
		 */
		public function getLastTask(){ }


		/**
		 * Returns the active task in the dispatcher
		 *
		 * @return \Phalcon\CLI\Task
		 */
		public function getActiveTask(){ }

	}
}
