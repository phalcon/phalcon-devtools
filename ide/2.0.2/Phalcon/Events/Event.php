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
		 * Event type
		 *
		 * @var string
		 */
		public function setType($type){ }


		/**
		 * Event type
		 *
		 * @var string
		 */
		public function getType(){ }


		/**
		 * Event source
		 *
		 * @var object
		 */
		public function getSource(){ }


		/**
		 * Event data
		 *
		 * @var mixed
		 */
		public function setData($data){ }


		/**
		 * Event data
		 *
		 * @var mixed
		 */
		public function getData(){ }


		/**
		 * Is event cancelable?
		 *
		 * @var boolean
		 */
		public function getCancelable(){ }


		/**
		 * \Phalcon\Events\Event constructor
		 *
		 * @param string type
		 * @param object source
		 * @param mixed data
		 * @param boolean cancelable
		 */
		public function __construct($type, $source, $data=null, $cancelable=null){ }


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
