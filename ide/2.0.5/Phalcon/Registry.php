<?php

namespace Phalcon;

final class Registry implements \ArrayAccess, \Countable, \Iterator
{

	protected $_data;



	/**
	 * Registry constructor
	 */
	public final function __construct() {}

	/**
	 * Checks if the element is present in the registry
	 * 
	 * @param string $offset
	 *
	 * @return boolean
	 */
	public final function offsetExists($offset) {}

	/**
	 * Returns an index in the registry
	 * 
	 * @param string $offset
	 *
	 * @return 
	 */
	public final function offsetGet($offset) {}

	/**
	 * Sets an element in the registry
	 * 
	 * @param string $offset
	 * @param mixed $value
	 *
	 * @return void
	 */
	public final function offsetSet($offset, $value) {}

	/**
	 * Unsets an element in the registry
	 * 
	 * @param string $offset
	 *
	 * @return void
	 */
	public final function offsetUnset($offset) {}

	/**
	 * Checks how many elements are in the register
	 *
	 * @return int
	 */
	public final function count() {}

	/**
	 * Moves cursor to next row in the registry
	 *
	 * @return void
	 */
	public final function next() {}

	/**
	 * Gets pointer number of active row in the registry
	 *
	 * @return int
	 */
	public final function key() {}

	/**
	 * Rewinds the registry cursor to its beginning
	 *
	 * @return void
	 */
	public final function rewind() {}

	/**
	 * Checks if the iterator is valid
	 *
	 * @return boolean
	 */
	public function valid() {}

	/**
	 * Obtains the current value in the internal iterator
	 *
	 * @return mixed
	 */
	public function current() {}

	/**
	 * Sets an element in the registry
	 * 
	 * @param string $key
	 * @param mixed $value
	 *
	 * @return void
	 */
	public final function __set($key, $value) {}

	/**
	 * Returns an index in the registry
	 * 
	 * @param string $key
	 *
	 * @return 
	 */
	public final function __get($key) {}

	/**
	 * 
	 * @param string $key
	 *
	 * @return boolean
	 */
	public final function __isset($key) {}

	/**
	 * 
	 * @param string $key
	 *
	 * @return void
	 */
	public final function __unset($key) {}

}
