<?php 

namespace Phalcon\Events {

	/**
	 * Phalcon\Events\Manager
	 *
	 * Phalcon Events Manager, offers an easy way to intercept and manipulate, if needed,
	 * the normal flow of operation. With the EventsManager the developer can create hooks or
	 * plugins that will offer monitoring of data, manipulation, conditional execution and much more.
	 *
	 */
	
	class Manager implements \Phalcon\Events\ManagerInterface {

		protected $_events;

		protected $_collect;

		protected $_enablePriorities;

		protected $_responses;

		/**
		 * Attach a listener to the events manager
		 *
		 * @param string $eventType
		 * @param object|callable $handler
		 * @param int $priority
		 */
		public function attach($eventType, $handler, $priority=null){ }


		/**
		 * Set if priorities are enabled in the EventsManager
		 *
		 * @param boolean $enablePriorities
		 */
		public function enablePriorities($enablePriorities){ }


		/**
		 * Returns if priorities are enabled
		 *
		 * @return boolean
		 */
		public function arePrioritiesEnabled(){ }


		/**
		 * Tells the event manager if it needs to collect all the responses returned by every
		 * registered listener in a single fire
		 *
		 * @param boolean $collect
		 */
		public function collectResponses($collect){ }


		/**
		 * Check if the events manager is collecting all all the responses returned by every
		 * registered listener in a single fire
		 */
		public function isCollecting(){ }


		/**
		 * Returns all the responses returned by every handler executed by the last 'fire' executed
		 *
		 * @return array
		 */
		public function getResponses(){ }


		/**
		 * Removes all events from the EventsManager
		 *
		 * @param string $type
		 */
		public function detachAll($type=null){ }


		/**
		 * Removes all events from the EventsManager; alias of detachAll
		 *
		 * @deprecated
		 * @param string $type
		 */
		public function dettachAll($type=null){ }


		/**
		 * Internal handler to call a queue of events
		 *
		 * @param \SplPriorityQueue $queue
		 * @param \Phalcon\Events\Event $event
		 * @return mixed
		 */
		public function fireQueue($queue, $event){ }


		/**
		 * Fires an event in the events manager causing that active listeners be notified about it
		 *
		 *<code>
		 *	$eventsManager->fire('db', $connection);
		 *</code>
		 *
		 * @param string $eventType
		 * @param object $source
		 * @param mixed  $data
		 * @param int $cancelable
		 * @return mixed
		 */
		public function fire($eventType, $source, $data=null, $cancelable=null){ }


		/**
		 * Check whether certain type of event has listeners
		 *
		 * @param string $type
		 * @return boolean
		 */
		public function hasListeners($type){ }


		/**
		 * Returns all the attached listeners of a certain type
		 *
		 * @param string $type
		 * @return array
		 */
		public function getListeners($type){ }

	}
}
