<?php 

namespace Phalcon\Logger {

	/**
	 * Phalcon\Logger\Item
	 *
	 * Represents each item in a logging transaction
	 *
	 */
	
	class Item {

		protected $_type;

		protected $_message;

		protected $_time;

		protected $_context;

		/**
		 * Log type
		 *
		 * @var integer
		 */
		public function getType(){ }


		/**
		 * Log message
		 *
		 * @var string
		 */
		public function getMessage(){ }


		/**
		 * Log timestamp
		 *
		 * @var integer
		 */
		public function getTime(){ }


		public function getContext(){ }


		/**
		 * \Phalcon\Logger\Item constructor
		 *
		 * @param string $message
		 * @param integer $type
		 * @param integer $time
		 * @param array $context
		 */
		public function __construct($message, $type, $time=null, $context=null){ }

	}
}
