<?php 

namespace Phalcon\Events {

	/**
	 * Phalcon\Events\EventsAwareInterface initializer
	 */
	
	interface EventsAwareInterface {

		/**
		 * Sets the events manager
		 *
		 * @param \Phalcon\Events\ManagerInterface $eventsManager
		 */
		public function setEventsManager($eventsManager);


		/**
		 * Returns the internal event manager
		 *
		 * @return \Phalcon\Events\ManagerInterface
		 */
		public function getEventsManager();

	}
}
