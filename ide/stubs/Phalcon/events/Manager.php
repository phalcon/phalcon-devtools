<?php

namespace Phalcon\Events;

/**
 * Phalcon\Events\Manager
 *
 * Phalcon Events Manager, offers an easy way to intercept and manipulate, if needed,
 * the normal flow of operation. With the EventsManager the developer can create hooks or
 * plugins that will offer monitoring of data, manipulation, conditional execution and much more.
 */
class Manager implements \Phalcon\Events\ManagerInterface
{

    protected $_events = null;


    protected $_collect = false;


    protected $_enablePriorities = false;


    protected $_responses;


    /**
     * Attach a listener to the events manager
     *
     * @param string $eventType
     * @param object|callable $handler
     * @param int $priority
     */
    public function attach($eventType, $handler, $priority = 100) {}

    /**
     * Detach the listener from the events manager
     *
     * @param string $eventType
     * @param object $handler
     */
    public function detach($eventType, $handler) {}

    /**
     * Set if priorities are enabled in the EventsManager
     *
     * @param bool $enablePriorities
     */
    public function enablePriorities($enablePriorities) {}

    /**
     * Returns if priorities are enabled
     *
     * @return bool
     */
    public function arePrioritiesEnabled() {}

    /**
     * Tells the event manager if it needs to collect all the responses returned by every
     * registered listener in a single fire
     *
     * @param bool $collect
     */
    public function collectResponses($collect) {}

    /**
     * Check if the events manager is collecting all all the responses returned by every
     * registered listener in a single fire
     *
     * @return bool
     */
    public function isCollecting() {}

    /**
     * Returns all the responses returned by every handler executed by the last 'fire' executed
     *
     * @return array
     */
    public function getResponses() {}

    /**
     * Removes all events from the EventsManager
     *
     * @param string $type
     */
    public function detachAll($type = null) {}

    /**
     * Internal handler to call a queue of events
     *
     * @param \SplPriorityQueue|array $queue
     * @param \Phalcon\Events\Event $event
     * @return mixed
     */
    public final function fireQueue($queue, EventInterface $event) {}

    /**
     * Fires an event in the events manager causing the active listeners to be notified about it
     *
     * <code>
     * $eventsManager->fire("db", $connection);
     * </code>
     *
     * @param string $eventType
     * @param object $source
     * @param mixed $data
     * @param boolean $cancelable
     * @return mixed
     */
    public function fire($eventType, $source, $data = null, $cancelable = true) {}

    /**
     * Check whether certain type of event has listeners
     *
     * @param string $type
     * @return bool
     */
    public function hasListeners($type) {}

    /**
     * Returns all the attached listeners of a certain type
     *
     * @param string $type
     * @return array
     */
    public function getListeners($type) {}

}
