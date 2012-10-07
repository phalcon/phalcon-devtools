<?php 

namespace Phalcon\Events {

	/**
	 * Phalcon\Events\Manager
	 *
	 * The new Phalcon Events Manager, offers an easy way to intercept and manipulate, if needed,
	 * the normal flow of operation. With the EventsManager the developer can create hooks or
	 * plugins that will offer monitoring of data, manipulation, conditional execution and much more.
	 *
	 */
	
	class Manager {

		protected $_events;

		public function __construct(){ }


		/**
		 * Attach a listener to the events manager
		 *
		 * @param string $eventType
		 * @param object $handler
		 */
		public function attach($eventType, $handler){ }


		/**
		 * Fires a event in the events manager causing that the acive listeners will be notified about it
		 *
		 * @param string $eventType
		 * @param object $source
		 * @return mixed
		 */
		public function fire($eventType, $source){ }


		/**
		 * Returns all the attached listeners of a certain type
		 *
		 * @param string $type
		 * @return array
		 */
		public function getListeners($type){ }

	}
}
