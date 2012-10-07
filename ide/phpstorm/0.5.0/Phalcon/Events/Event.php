<?php 

namespace Phalcon\Events {

	/**
	 * Phalcon\Events\Event
	 *
	 * This class offers contextual information of a fired event in the EventsManager
	 */
	
	class Event {

		protected $_type;

		protected $_source;

		/**
		 * \Phalcon\Events\Event constructor
		 *
		 * @param string $type
		 * @param object $source
		 */
		public function __construct($type, $source){ }


		/**
		 * Set the event's type
		 *
		 * @param string $eventType
		 */
		public function setType($eventType){ }


		/**
		 * Returns the event's type
		 *
		 * @return string
		 */
		public function getType(){ }


		/**
		 * Returns the event's source
		 *
		 * @return object
		 */
		public function getSource(){ }

	}
}
