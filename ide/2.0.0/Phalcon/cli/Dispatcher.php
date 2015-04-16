<?php

namespace Phalcon\Cli;

class Dispatcher extends \Phalcon\Dispatcher
{

    protected $_handlerSuffix = "Task";


    protected $_defaultHandler = "main";


    protected $_defaultAction = "main";


    protected $_options;


    /**
     * Phalcon\Cli\Dispatcher constructor
     */
	public function __construct() {}

    /**
     * Sets the default task suffix
     *
     * @param string $taskSuffix 
     */
	public function setTaskSuffix($taskSuffix) {}

    /**
     * Sets the default task name
     *
     * @param string $taskName 
     */
	public function setDefaultTask($taskName) {}

    /**
     * Sets the task name to be dispatched
     *
     * @param string $taskName 
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
     */
	protected function _throwDispatchException($message, $exceptionCode = 0) {}

    /**
     * Handles a user exception
     *
     * @param \Exception $exception 
     */
	protected function _handleException(\Exception $exception) {}

    /**
     * Returns the lastest dispatched controller
     *
     * @return \Phalcon\CLI\Task 
     */
	public function getLastTask() {}

    /**
     * Returns the active task in the dispatcher
     *
     * @return \Phalcon\CLI\Task 
     */
	public function getActiveTask() {}

    /**
     * Set the options to be dispatched
     *
     * @param array $options 
     */
	public function setOptions($options) {}

    /**
     * Get dispatched options
     *
     * @return array 
     */
	public function getOptions() {}

}
