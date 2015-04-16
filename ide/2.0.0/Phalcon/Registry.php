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
     * @return bool 
     */
	public final function offsetExists($offset) {}

    /**
     * Returns an index in the registry
     *
     * @param string $offset 
     */
	public final function offsetGet($offset) {}

    /**
     * Sets an element in the registry
     *
     * @param string $offset 
     * @param mixed $value 
     */
	public final function offsetSet($offset, $value) {}

    /**
     * Unsets an element in the registry
     *
     * @param string $offset 
     */
	public final function offsetUnset($offset) {}

    /**
     * Sets an element in the registry
     *
     * @param string $offset 
     * @param mixed $value 
     */
	public final function __set($offset, $value) {}

    /**
     * Returns an index in the registry
     *
     * @param string $offset 
     */
	public final function __get($offset) {}

    /**
     * Checks how many elements are in the register
     *
     * @return int 
     */
	public final function count() {}

    /**
     * Moves cursor to next row in the registry
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
     */
	public final function rewind() {}

    /**
     * Checks if the iterator is valid
     *
     * @return bool 
     */
	public function valid() {}

    /**
     * Obtains the current value in the internal iterator
     */
	public function current() {}

}
