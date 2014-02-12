<?php 

namespace Phalcon\Mvc\Model {

	/**
	 * Phalcon\Mvc\Model\MessageInterface initializer
	 */
	
	interface MessageInterface {

		/**
		 * Sets message type
		 *
		 * @param string $type
		 */
		public function setType($type);


		/**
		 * Returns message type
		 *
		 * @return string
		 */
		public function getType();


		/**
		 * Sets verbose message
		 *
		 * @param string $message
		 */
		public function setMessage($message);


		/**
		 * Returns verbose message
		 *
		 * @return string
		 */
		public function getMessage();


		/**
		 * Sets field name related to message
		 *
		 * @param string $field
		 */
		public function setField($field);


		/**
		 * Returns field name related to message
		 *
		 * @return string
		 */
		public function getField();

	}
}
