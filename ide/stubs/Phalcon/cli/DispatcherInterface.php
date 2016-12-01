<?php

namespace Phalcon\Cli;

/**
 * Phalcon\Cli\DispatcherInterface
 *
 * Interface for Phalcon\Cli\Dispatcher
 */
interface DispatcherInterface extends \Phalcon\DispatcherInterface
{

    /**
     * Sets the default task suffix
     *
     * @param string $taskSuffix
     */
    public function setTaskSuffix($taskSuffix);

    /**
     * Sets the default task name
     *
     * @param string $taskName
     */
    public function setDefaultTask($taskName);

    /**
     * Sets the task name to be dispatched
     *
     * @param string $taskName
     */
    public function setTaskName($taskName);

    /**
     * Gets last dispatched task name
     *
     * @return string
     */
    public function getTaskName();

    /**
     * Returns the latest dispatched controller
     *
     * @return TaskInterface
     */
    public function getLastTask();

    /**
     * Returns the active task in the dispatcher
     *
     * @return TaskInterface
     */
    public function getActiveTask();

}
