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
	
	class Manager {

		protected $_events;

		/**
		 * Attach a listener to the events manager
		 *
		 * @param string $eventType
		 * @param object $handler
		 */
		public function attach($eventType, $handler){ }


		/**
		 * Removes all events from the EventsManager
		 */
		public function dettachAll($type=null){ }


		/**
		 * Fires a event in the events manager causing that the acive listeners will be notified about it
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
