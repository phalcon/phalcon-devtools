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

		protected $_data;

		protected $_stopped;

		protected $_cancelable;

		/**
		 * \Phalcon\Events\Event constructor
		 *
		 * @param string $type
		 * @param object $source
		 * @param mixed $data
		 * @param boolean $cancelable
		 */
		public function __construct($type, $source, $data=null, $cancelable=null){ }


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


		/**
		 * Set the event's data
		 *
		 * @param string $data
		 */
		public function setData($data){ }


		/**
		 * Returns the event's data
		 *
		 * @return mixed
		 */
		public function getData(){ }


		/**
		 * Sets if the event is cancelable
		 *
		 * @param boolean $cancelable
		 */
		public function setCancelable($cancelable){ }


		/**
		 * Check whether the event is cancelable
		 *
		 * @return boolean
		 */
		public function getCancelable(){ }


		/**
		 * Stops the event preventing propagation
		 */
		public function stop(){ }


		/**
		 * Check whether the event is currently stopped
		 */
		public function isStopped(){ }

	}
}
