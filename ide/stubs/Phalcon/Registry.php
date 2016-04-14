<?php

namespace Phalcon;

/**
 * Phalcon\Registry
 * A registry is a container for storing objects and values in the application space.
 * By storing the value in a registry, the same object is always available throughout
 * your application.
 * <code>
 * $registry = new \Phalcon\Registry();
 * // Set value
 * $registry->something = 'something';
 * // or
 * $registry['something'] = 'something';
 * // Get value
 * $value = $registry->something;
 * // or
 * $value = $registry['something'];
 * // Check if the key exists
 * $exists = isset($registry->something);
 * // or
 * $exists = isset($registry['something']);
 * // Unset
 * unset($registry->something);
 * // or
 * unset($registry['something']);
 * </code>
 * In addition to ArrayAccess, Phalcon\Registry also implements Countable
 * (count($registry) will return the number of elements in the registry),
 * Serializable and Iterator (you can iterate over the registry
 * using a foreach loop) interfaces. For PHP 5.4 and higher, JsonSerializable
 * interface is implemented.
 * Phalcon\Registry is very fast (it is typically faster than any userspace
 * implementation of the registry); however, this comes at a price:
 * Phalcon\Registry is a final class and cannot be inherited from.
 * Though Phalcon\Registry exposes methods like __get(), offsetGet(), count() etc,
 * it is not recommended to invoke them manually (these methods exist mainly to
 * match the interfaces the registry implements): $registry->__get('property')
 * is several times slower than $registry->property.
 * Internally all the magic methods (and interfaces except JsonSerializable)
 * are implemented using object handlers or similar techniques: this allows
 * to bypass relatively slow method calls.
 */
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
     * @return mixed 
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

    /**
     * Sets an element in the registry
     *
     * @param string $key 
     * @param mixed $value 
     */
    public final function __set($key, $value) {}

    /**
     * Returns an index in the registry
     *
     * @param string $key 
     * @return mixed 
     */
    public final function __get($key) {}

    /**
     * @param string $key 
     * @return bool 
     */
    public final function __isset($key) {}

    /**
     * @param string $key 
     */
    public final function __unset($key) {}

}
