<?php 

namespace Phalcon\Events {

	/**
	 * Phalcon\Events\Manager
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

	}
}
