<?php

namespace Phalcon\Validation\Message;

use Phalcon\Validation\Message;
use Phalcon\Validation\Exception;
use Phalcon\Validation\MessageInterface;


class Group implements \Countable, \ArrayAccess, \Iterator
{

	protected $_position;

	protected $_messages;



	/**
	 * Phalcon\Validation\Message\Group constructor
	 * 
	 * @param array $messages
	 *
	 */
	public function __construct($messages=null) {}

	/**
	 * Gets an attribute a message using the array syntax
	 *
	 *<code>
	 * print_r($messages[0]);
	 *</code>
	 *
	 * @param int $index
	 * 
	 * @return Message|boolean
	 */
	public function offsetGet($index) {}

	/**
	 * Sets an attribute using the array-syntax
	 *
	 *<code>
	 * $messages[0] = new \Phalcon\Validation\Message('This is a message');
	 *</code>
	 * 
	 * @param int $index
	 * @param mixed $message
	 *
	 *
	 * @return void
	 */
	public function offsetSet($index, $message) {}

	/**
	 * Checks if an index exists
	 *
	 *<code>
	 * var_dump(isset($message['database']));
	 *</code>
	 *
	 * @param string $index
	 * 
	 * @return boolean
	 */
	public function offsetExists($index) {}

	/**
	 * Removes a message from the list
	 *
	 *<code>
	 * unset($message['database']);
	 *</code>
	 * 
	 * @param string $index
	 *
	 *
	 * @return mixed
	 */
	public function offsetUnset($index) {}

	/**
	 * Appends a message to the group
	 *
	 *<code>
	 * $messages->appendMessage(new \Phalcon\Validation\Message('This is a message'));
	 *</code>
	 * 
	 * @param MessageInterface $message
	 *
	 * @return void
	 */
	public function appendMessage(MessageInterface $message) {}

	/**
	 * Appends an array of messages to the group
	 *
	 *<code>
	 * $messages->appendMessages($messagesArray);
	 *</code>
	 * 
	 * @param \Phalcon\Validation\MessageInterface[] $messages
	 *
	 *
	 * @return void
	 */
	public function appendMessages($messages) {}

	/**
			 * An array of messages is simply merged into the current one
	 * 
	 * @param string $fieldName
			 *
	 * @return mixed
	 */
	public function filter($fieldName) {}

	/**
			 * A group of messages is iterated and appended one-by-one to the current list
			 *
	 * @return int
	 */
	public function count() {}

	/**
	 * Rewinds the internal iterator
	 *
	 * @return void
	 */
	public function rewind() {}

	/**
	 * Returns the current message in the iterator
	 *
	 * @return Message|boolean
	 */
	public function current() {}

	/**
	 * Returns the current position/key in the iterator
	 *
	 * @return int
	 */
	public function key() {}

	/**
	 * Moves the internal iteration pointer to the next position
	 *
	 * @return void
	 */
	public function next() {}

	/**
	 * Check if the current message in the iterator is valid
	 *
	 * @return boolean
	 */
	public function valid() {}

	/**
	 * Magic __set_state helps to re-build messages variable when exporting
	 *
	 * @param array $group
	 * 
	 * @return Group
	 */
	public static function __set_state($group) {}

}
