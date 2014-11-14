<?php 

namespace Phalcon\Cli {

	/**
	 * Phalcon\Cli\Dispatcher
	 *
	 * Dispatching is the process of taking the command-line arguments, extracting the module name,
	 * task name, action name, and optional parameters contained in it, and then
	 * instantiating a task and calling an action on it.
	 *
	 *<code>
	 *
	 *	$di = new \Phalcon\Di();
	 *
	 *	$dispatcher = new \Phalcon\Cli\Dispatcher();
	 *
	 *  $dispatcher->setDi(di);
	 *
	 *	$dispatcher->setTaskName('posts');
	 *	$dispatcher->setActionName('index');
	 *	$dispatcher->setParams(array());
	 *
	 *	$handle = dispatcher->dispatch();
	 *
	 *</code>
	 */
	
	class Dispatcher extends \Phalcon\Dispatcher implements \Phalcon\Events\EventsAwareInterface, \Phalcon\Di\InjectionAwareInterface, \Phalcon\DispatcherInterface {

		const EXCEPTION_NO_DI = 0;

		const EXCEPTION_CYCLIC_ROUTING = 1;

		const EXCEPTION_HANDLER_NOT_FOUND = 2;

		const EXCEPTION_INVALID_HANDLER = 3;

		const EXCEPTION_INVALID_PARAMS = 4;

		const EXCEPTION_ACTION_NOT_FOUND = 5;

		protected $_handlerSuffix;

		protected $_defaultHandler;

		protected $_defaultAction;

		protected $_options;

		/**
		 * \Phalcon\Cli\Dispatcher constructor
		 *
		 */
		public function __construct(){ }


		/**
		 * Sets the default task suffix
		 *
		 * @param string taskSuffix
		 */
		public function setTaskSuffix($taskSuffix){ }


		/**
		 * Sets the default task name
		 *
		 * @param string taskName
		 */
		public function setDefaultTask($taskName){ }


		/**
		 * Sets the task name to be dispatched
		 *
		 * @param string taskName
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
		 * @param string message
		 * @param int exceptionCode
		 */
		protected function _throwDispatchException($message, $exceptionCode=null){ }


		/**
		 * Handles a user exception
		 *
		 * @param \Exception exception
		 */
		protected function _handleException(\Exception $exception){ }


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


		/**
		 * Set the options to be dispatched
		 *
		 * @param array options
		 */
		public function setOptions($options){ }


		/**
		 * Get dispatched options
		 *
		 * @return array
		 */
		public function getOptions(){ }

	}
}
