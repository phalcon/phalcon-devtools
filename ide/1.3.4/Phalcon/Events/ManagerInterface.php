<?php 

namespace Phalcon\Events {

	/**
	 * Phalcon\Events\ManagerInterface initializer
	 */
	
	interface ManagerInterface {

		/**
		 * Attach a listener to the events manager
		 *
		 * @param string $eventType
		 * @param object $handler
		 */
		public function attach($eventType, $handler);


		/**
		 * Removes all events from the EventsManager
		 *
		 * @param string $type
		 */
		public function detachAll($type=null);


		/**
		 * Fires a event in the events manager causing that the acive listeners will be notified about it
		 *
		 * @param string $eventType
		 * @param object $source
		 * @param mixed  $data
		 * @return mixed
		 */
		public function fire($eventType, $source, $data=null);


		/**
		 * Returns all the attached listeners of a certain type
		 *
		 * @param string $type
		 * @return array
		 */
		public function getListeners($type);

	}
}
