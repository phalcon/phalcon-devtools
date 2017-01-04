<?php

namespace Phalcon\Cli;

use Phalcon\Cli\Task;
use Phalcon\Events\ManagerInterface;
use Phalcon\Cli\Dispatcher\Exception;


class Dispatcher extends \Phalcon\Dispatcher
{

	protected $_handlerSuffix = 'Task';

	protected $_defaultHandler = 'main';

	protected $_defaultAction = 'main';

	protected $_options;



	/**
	 * Phalcon\Cli\Dispatcher constructor
	 */
	public function __construct() {}

	/**
	 * Sets the default task suffix
	 * 
	 * @param string $taskSuffix
	 *
	 * @return void
	 */
	public function setTaskSuffix($taskSuffix) {}

	/**
	 * Sets the default task name
	 * 
	 * @param string $taskName
	 *
	 * @return void
	 */
	public function setDefaultTask($taskName) {}

	/**
	 * Sets the task name to be dispatched
	 * 
	 * @param string $taskName
	 *
	 * @return void
	 */
	public function setTaskName($taskName) {}

	/**
	 * Gets last dispatched task name
	 *
	 * @return string
	 */
	public function getTaskName() {}

	/**
	 * Throws an internal exception
	 * 
	 * @param string $message
	 * @param int $exceptionCode
	 *
	 * @return mixed
	 */
	protected function _throwDispatchException($message, $exceptionCode) {}

	/**
	 * Handles a user exception
	 * 
	 * @param \Exception $exception
	 *
	 * @return mixed
	 */
	protected function _handleException(\Exception $exception) {}

	/**
	 * Returns the lastest dispatched controller
	 *
	 * @return Task
	 */
	public function getLastTask() {}

	/**
	 * Returns the active task in the dispatcher
	 *
	 * @return Task
	 */
	public function getActiveTask() {}

	/**
	 * Set the options to be dispatched
	 * 
	 * @param array $options
	 *
	 * @return void
	 */
	public function setOptions(array $options) {}

	/**
	 * Get dispatched options
	 *
	 * @return array
	 */
	public function getOptions() {}

}
