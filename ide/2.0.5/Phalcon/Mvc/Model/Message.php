<?php

namespace Phalcon\Mvc\Model;

use Phalcon\Mvc\ModelInterface;
use Phalcon\Mvc\Model\MessageInterface;


class Message implements MessageInterface
{

	protected $_type;

	protected $_message;

	protected $_field;

	protected $_model;



	/**
	 * Phalcon\Mvc\Model\Message constructor
	 * 
	 * @param string $message
	 * @param string|array $field
	 * @param string $type
	 * @param \Phalcon\Mvc\ModelInterface $model
	 *
	 */
	public function __construct($message, $field=null, $type=null, $model=null) {}

	/**
	 * Sets message type
	 * 
	 * @param string $type
	 *
	 * @return Message
	 */
	public function setType($type) {}

	/**
	 * Returns message type
	 *
	 * @return string
	 */
	public function getType() {}

	/**
	 * Sets verbose message
	 * 
	 * @param string $message
	 *
	 * @return Message
	 */
	public function setMessage($message) {}

	/**
	 * Returns verbose message
	 *
	 * @return string
	 */
	public function getMessage() {}

	/**
	 * Sets field name related to message
	 * 
	 * @param mixed $field
	 *
	 * @return Message
	 */
	public function setField($field) {}

	/**
	 * Returns field name related to message
	 *
	 * @return mixed
	 */
	public function getField() {}

	/**
	 * Set the model who generates the message
	 * 
	 * @param ModelInterface $model
	 *
	 * @return Message
	 */
	public function setModel(ModelInterface $model) {}

	/**
	 * Returns the model that produced the message
	 *
	 * @return ModelInterface
	 */
	public function getModel() {}

	/**
	 * Magic __toString method returns verbose message
	 *
	 * @return string
	 */
	public function __toString() {}

	/**
	 * Magic __set_state helps to re-build messages variable exporting
	 * 
	 * @param array $message
	 *
	 * @return Message
	 */
	public static function __set_state(array $message) {}

}
