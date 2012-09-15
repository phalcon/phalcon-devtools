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
		 */
		protected function _throwDispatchException(){ }


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
