<?php 

namespace Phalcon\Mvc\Model {

	/**
	 * Phalcon\Mvc\Model\Message
	 *
	 * Encapsulates validation info generated before save/delete records fails
	 *
	 *<code>
	 *	use Phalcon\Mvc\Model\Message as Message;
	 *
	 *  class Robots extends Phalcon\Mvc\Model
	 *  {
	 *
	 *    public function beforeSave()
	 *    {
	 *      if ($this->name == 'Peter') {
	 *        $text = "A robot cannot be named Peter";
	 *        $field = "name";
	 *        $type = "InvalidValue";
	 *        $code = 103;
	 *        $message = new Message($text, $field, $type, $code);
	 *        $this->appendMessage($message);
	 *     }
	 *   }
	 *
	 * }
	 * </code>
	 *
	 */
	
	class Message implements \Phalcon\Mvc\Model\MessageInterface {

		protected $_type;

		protected $_message;

		protected $_field;

		protected $_model;

		protected $_code;

		/**
		 * \Phalcon\Mvc\Model\Message constructor
		 *
		 * @param string $message
		 * @param string $field
		 * @param string $type
		 * @param \Phalcon\Mvc\ModelInterface $model
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
		 * Sets message code
		 *
		 * @param string $code
		 * @return \Phalcon\Mvc\Model\Message
		 */
		public function setCode($code){ }


		/**
		 * Returns message code
		 *
		 * @return string
		 */
		public function getCode(){ }


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
		 * Set the model who generates the message
		 *
		 * @param \Phalcon\Mvc\ModelInterface $model
		 * @return \Phalcon\Mvc\Model\Message
		 */
		public function setModel($model){ }


		/**
		 * Returns the model that produced the message
		 *
		 * @return \Phalcon\Mvc\ModelInterface
		 */
		public function getModel(){ }


		/**
		 * Magic __toString method returns verbose message
		 *
		 * @return string
		 */
		public function __toString(){ }


		/**
		 * Magic __set_state helps to re-build messages variable exporting
		 *
		 * @param array $message
		 * @return \Phalcon\Mvc\Model\Message
		 */
		public static function __set_state($properties=null){ }

	}
}
