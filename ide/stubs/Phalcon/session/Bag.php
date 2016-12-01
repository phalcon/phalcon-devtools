<?php

namespace Phalcon\Session;

/**
 * Phalcon\Session\Bag
 *
 * This component helps to separate session data into "namespaces". Working by this way
 * you can easily create groups of session variables into the application
 *
 * <code>
 * $user = new \Phalcon\Session\Bag("user");
 *
 * $user->name = "Kimbra Johnson";
 * $user->age  = 22;
 * </code>
 */
class Bag implements \Phalcon\Di\InjectionAwareInterface, \Phalcon\Session\BagInterface, \IteratorAggregate, \ArrayAccess, \Countable
{

    protected $_dependencyInjector;


    protected $_name = null;


    protected $_data;


    protected $_initialized = false;


    protected $_session;


    /**
     * Phalcon\Session\Bag constructor
     *
     * @param string $name
     */
    public function __construct($name) {}

    /**
     * Sets the DependencyInjector container
     *
     * @param \Phalcon\DiInterface $dependencyInjector
     */
    public function setDI(\Phalcon\DiInterface $dependencyInjector) {}

    /**
     * Returns the DependencyInjector container
     *
     * @return \Phalcon\DiInterface
     */
    public function getDI() {}

    /**
     * Initializes the session bag. This method must not be called directly, the
     * class calls it when its internal data is accessed
     */
    public function initialize() {}

    /**
     * Destroys the session bag
     *
     * <code>
     * $user->destroy();
     * </code>
     */
    public function destroy() {}

    /**
     * Sets a value in the session bag
     *
     * <code>
     * $user->set("name", "Kimbra");
     * </code>
     *
     * @param string $property
     * @param mixed $value
     */
    public function set($property, $value) {}

    /**
     * Magic setter to assign values to the session bag
     *
     * <code>
     * $user->name = "Kimbra";
     * </code>
     *
     * @param string $property
     * @param mixed $value
     */
    public function __set($property, $value) {}

    /**
     * Obtains a value from the session bag optionally setting a default value
     *
     * <code>
     * echo $user->get("name", "Kimbra");
     * </code>
     *
     * @param string $property
     * @param mixed $defaultValue
     */
    public function get($property, $defaultValue = null) {}

    /**
     * Magic getter to obtain values from the session bag
     *
     * <code>
     * echo $user->name;
     * </code>
     *
     * @param string $property
     * @return mixed
     */
    public function __get($property) {}

    /**
     * Check whether a property is defined in the internal bag
     *
     * <code>
     * var_dump(
     *     $user->has("name")
     * );
     * </code>
     *
     * @param string $property
     * @return bool
     */
    public function has($property) {}

    /**
     * Magic isset to check whether a property is defined in the bag
     *
     * <code>
     * var_dump(
     *     isset($user["name"])
     * );
     * </code>
     *
     * @param string $property
     * @return bool
     */
    public function __isset($property) {}

    /**
     * Removes a property from the internal bag
     *
     * <code>
     * $user->remove("name");
     * </code>
     *
     * @param string $property
     * @return bool
     */
    public function remove($property) {}

    /**
     * Magic unset to remove items using the array syntax
     *
     * <code>
     * unset($user["name"]);
     * </code>
     *
     * @param string $property
     * @return bool
     */
    public function __unset($property) {}

    /**
     * Return length of bag
     *
     * <code>
     * echo $user->count();
     * </code>
     *
     * @return int
     */
    public final function count() {}

    /**
     *  Returns the bag iterator
     *
     * @return \ArrayIterator
     */
    public final function getIterator() {}

    /**
     * @param string $property
     * @param mixed $value
     */
    public final function offsetSet($property, $value) {}

    /**
     * @param string $property
     * @return bool
     */
    public final function offsetExists($property) {}

    /**
     * @param string $property
     */
    public final function offsetUnset($property) {}

    /**
     * @param string $property
     * @return mixed
     */
    public final function offsetGet($property) {}

}
