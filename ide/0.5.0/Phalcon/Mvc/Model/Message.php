<?php 

namespace Phalcon\Mvc\Model {

	/**
	 * Phalcon\Mvc\Model\Message
	 *
	 * Encapsulates validation info generated before save/delete records fails
	 *
	 * <code>
	 * use Phalcon\Mvc\Model\Message as Message;
	 *
	 * class Robots extends Phalcon\Mvc\Model
	 *{
	 *
	 *   public function beforeSave()
	 *   {
	 *     if (this->name == 'Peter') {
	 *        $text = "A robot cannot be named Peter";
	 *        $field = "name";
	 *        $type = "InvalidValue";
	 *        $message = new Message($text, $field, $type);
	 *        $this->appendMessage($message);
	 *     }
	 *   }
	 *
	 * }
	 * </code>
	 *
	 */
	
	class Message {

		protected $_type;

		protected $_message;

		protected $_field;

		/**
		 * \Phalcon\Mvc\Model\Message constructor
		 *
		 * @param string $message
		 * @param string $field
		 * @param string $type
		 */
		public function __construct($message, $field, $type){ }


		/**
		 * Sets message type
		 *
		 * @param string $type
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
