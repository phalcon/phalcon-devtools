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

		public function setType($type){ }


		public function getType(){ }


		public function getSource(){ }


		public function setData($data){ }


		public function getData(){ }


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
		 *
		 * @return boolean
		 */
		public function isStopped(){ }

	}
}
