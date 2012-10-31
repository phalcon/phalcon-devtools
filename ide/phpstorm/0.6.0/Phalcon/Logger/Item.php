<?php 

namespace Phalcon\Logger {

	/**
	 * Phalcon\Logger\Item
	 *
	 * Represents each item in a logger transaction
	 *
	 */
	
	class Item {

		protected $_type;

		protected $_message;

		protected $_time;

		/**
		 * \Phalcon\Logger\Item contructor
		 *
		 * @param string $message
		 * @param integer $type
		 * @param integer $time
		 */
		public function __construct($message, $type, $time=null){ }


		/**
		 * Returns the message
		 *
		 * @return string
		 */
		public function getMessage(){ }


		/**
		 * Returns the log type
		 *
		 * @return integer
		 */
		public function getType(){ }


		/**
		 * Returns log timestamp
		 *
		 * @return integer
		 */
		public function getTime(){ }

	}
}
