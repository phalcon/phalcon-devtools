<?php 

namespace Phalcon\Validation {

	/**
	 * Phalcon\Validation\MessageInterface initializer
	 */
	
	interface MessageInterface {

		/**
		 * Sets message type
		 *
		 * @param string $type
		 * @return \Phalcon\Validation\MessageInterface
		 */
		public function setType($type);


		/**
		 * Returns message type
		 *
		 * @return string
		 */
		public function getType();


		/**
		 * Sets message code
		 *
		 * @param string $code
		 * @return \Phalcon\Validation\MessageInterface
		 */
		public function setCode($code);


		/**
		 * Returns message code
		 *
		 * @return string
		 */
		public function getCode();


		/**
		 * Sets verbose message
		 *
		 * @param string $message
		 * @return \Phalcon\Validation\MessageInterface
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
		 * @return \Phalcon\Validation\MessageInterface
		 */
		public function setField($field);


		/**
		 * Returns field name related to message
		 *
		 * @return string
		 */
		public function getField();


		/**
		 * Magic __toString method returns verbose message
		 *
		 * @return string
		 */
		public function __toString();

	}
}
