<?php 

namespace Phalcon\Validation {

	/**
	 * Phalcon\Validation\Message
	 *
	 * Encapsulates validation info generated in the validation process
	 */
	
	class Message {

		protected $_type;

		protected $_message;

		protected $_field;

		/**
		 * \Phalcon\Validation\Message constructor
		 *
		 * @param string $message
		 * @param string $field
		 * @param string $type
		 */
		public function __construct($message, $field=null, $type=null){ }


		/**
		 * Sets message type
		 *
		 * @param string $type
		 * @return \Phalcon\Mvc\Model\Message
		 */
		public function setType($type){ }


		/**
		 * Returns message type
		 *
		 * @return string
		 */
		public function getType(){ }


		/**
		 * Sets verbose message
		 *
		 * @param string $message
		 * @return \Phalcon\Mvc\Model\Message
		 */
		public function setMessage($message){ }


		/**
		 * Returns verbose message
		 *
		 * @return string
		 */
		public function getMessage(){ }


		/**
		 * Sets field name related to message
		 *
		 * @param string $field
		 * @return \Phalcon\Mvc\Model\Message
		 */
		public function setField($field){ }


		/**
		 * Returns field name related to message
		 *
		 * @return string
		 */
		public function getField(){ }


		/**
		 * Magic __toString method returns verbose message
		 *
		 * @return string
		 */
		public function __toString(){ }


		/**
		 * Magic __set_state helps to recover messsages from serialization
		 *
		 * @param array $message
		 * @return \Phalcon\Mvc\Model\Message
		 */
		public static function __set_state($message){ }

	}
}
