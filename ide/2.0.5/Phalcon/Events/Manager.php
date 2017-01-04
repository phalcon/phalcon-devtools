<?php

namespace Phalcon\Events;

use Phalcon\Events\Event;
use SplPriorityQueue as PriorityQueue;


class Manager implements ManagerInterface
{

	protected $_events = null;

	protected $_collect = false;

	protected $_enablePriorities = false;

	protected $_responses;



	/**
	 * Attach a listener to the events manager
	 * 
	 * @param string $eventType
	 * @param mixed $handler
	 * @param int $priority
	 *
	 *
	 * @return void
	 */
	public function attach($eventType, $handler, $priority=100) {}

	/**
	 * Detach the listener from the events manager
	 * 
	 * @param string $eventType
	 * @param mixed $handler
	 *
	 *
	 * @return void
	 */
	public function detach($eventType, $handler) {}

	/**
	 * Set if priorities are enabled in the EventsManager
	 * 
	 * @param boolean $enablePriorities
	 *
	 * @return void
	 */
	public function enablePriorities($enablePriorities) {}

	/**
	 * Returns if priorities are enabled
	 *
	 * @return boolean
	 */
	public function arePrioritiesEnabled() {}

	/**
	 * Tells the event manager if it needs to collect all the responses returned by every
	 * registered listener in a single fire
	 * 
	 * @param boolean $collect
	 *
	 * @return void
	 */
	public function collectResponses($collect) {}

	/**
	 * Check if the events manager is collecting all all the responses returned by every
	 * registered listener in a single fire
	 *
	 * @return boolean
	 */
	public function isCollecting() {}

	/**
	 * Returns all the responses returned by every handler executed by the last 'fire' executed
	 *
	 * @return mixed
	 */
	public function getResponses() {}

	/**
	 * Removes all events from the EventsManager
	 * 
	 * @param string $type
	 *
	 * @return void
	 */
	public function detachAll($type=null) {}

	/**
	 * Alias of detachAll
	 * 
	 * @param string $type
	 *
	 * @return void
	 */
	public function dettachAll($type=null) {}

	/**
	 * Internal handler to call a queue of events
	 *
	 * @param mixed $queue
	 * @param Event $event
	 * 
	 * @return mixed
	 */
	public final function fireQueue($queue, Event $event) {}

	/**
	 * Fires an event in the events manager causing that active listeners be notified about it
	 *
	 *<code>
	 *	$eventsManager->fire('db', $connection);
	 *</code>
	 *
	 * @param string $eventType
	 * @param object $source
	 * @param mixed $data
	 * @param boolean $cancelable
	 * 
	 * @return mixed
	 */
	public function fire($eventType, $source, $data=null, $cancelable=true) {}

	/**
	 * Check whether certain type of event has listeners
	 * 
	 * @param string $type
	 *
	 * @return boolean
	 */
	public function hasListeners($type) {}

	/**
	 * Returns all the attached listeners of a certain type
	 *
	 * @param string $type
	 * 
	 * @return mixed
	 */
	public function getListeners($type) {}

}
