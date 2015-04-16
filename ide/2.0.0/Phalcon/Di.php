<?php

namespace Phalcon;

class Di implements \Phalcon\DiInterface, \Phalcon\Events\EventsAwareInterface
{

    protected $_services;


    protected $_sharedInstances;


    protected $_freshInstance = false;

    /**
     * Events Manager
     *
     * @var Phalcon\Events\ManagerInterface
     */
    protected $_eventsManager;


    static protected $_default;


    /**
     * Phalcon\Di constructor
     */
	public function __construct() {}

    /**
     * Registers a service in the services container
     *
     * @param string $name 
     * @param mixed $definition 
     * @param boolean $shared 
     * @return \Phalcon\Di\ServiceInterface 
     */
	public function set($name, $definition, $shared = false) {}

    /**
     * Registers an "always shared" service in the services container
     *
     * @param string $name 
     * @param mixed $definition 
     * @return \Phalcon\Di\ServiceInterface 
     */
	public function setShared($name, $definition) {}

    /**
     * Removes a service in the services container
     *
     * @param string $name 
     */
	public function remove($name) {}

    /**
     * Attempts to register a service in the services container
     * Only is successful if a service hasn"t been registered previously
     * with the same name
     *
     * @param string $name 
     * @param mixed $definition 
     * @param boolean $shared 
     * @return \Phalcon\Di\ServiceInterface|false 
     */
	public function attempt($name, $definition, $shared = false) {}

    /**
     * Sets a service using a raw Phalcon\Di\Service definition
     *
     * @param string $name 
     * @param mixed $rawDefinition 
     * @return \Phalcon\Di\ServiceInterface 
     */
	public function setRaw($name, \Phalcon\Di\ServiceInterface $rawDefinition) {}

    /**
     * Returns a service definition without resolving
     *
     * @param string $name 
     * @return mixed 
     */
	public function getRaw($name) {}

    /**
     * Returns a Phalcon\Di\Service instance
     *
     * @param string $name 
     * @return \Phalcon\Di\ServiceInterface 
     */
	public function getService($name) {}

    /**
     * Resolves the service based on its configuration
     *
     * @param string $name 
     * @param array $parameters 
     * @return mixed 
     */
	public function get($name, $parameters = null) {}

    /**
     * Resolves a service, the resolved service is stored in the DI, subsequent requests for this service will return the same instance
     *
     * @param string $name 
     * @param array $parameters 
     * @return mixed 
     */
	public function getShared($name, $parameters = null) {}

    /**
     * Check whether the DI contains a service by a name
     *
     * @param string $name 
     * @return bool 
     */
	public function has($name) {}

    /**
     * Check whether the last service obtained via getShared produced a fresh instance or an existing one
     *
     * @return bool 
     */
	public function wasFreshInstance() {}

    /**
     * Return the services registered in the DI
     *
     * @return \Phalcon\Di\Service 
     */
	public function getServices() {}

    /**
     * Check if a service is registered using the array syntax
     *
     * @param string $name 
     * @return bool 
     */
	public function offsetExists($name) {}

    /**
     * Allows to register a shared service using the array syntax
     * <code>
     * $di["request"] = new \Phalcon\Http\Request();
     * </code>
     *
     * @param string $name 
     * @param mixed $definition 
     * @return boolean 
     */
	public function offsetSet($name, $definition) {}

    /**
     * Allows to obtain a shared service using the array syntax
     * <code>
     * var_dump($di["request"]);
     * </code>
     *
     * @param string $name 
     * @return mixed 
     */
	public function offsetGet($name) {}

    /**
     * Removes a service from the services container using the array syntax
     *
     * @param string $name 
     * @return bool 
     */
	public function offsetUnset($name) {}

    /**
     * Sets the event manager
     *
     * @param mixed $eventsManager 
     */
	public function setEventsManager(\Phalcon\Events\ManagerInterface $eventsManager) {}

    /**
     * Returns the internal event manager
     *
     * @return \Phalcon\Events\ManagerInterface 
     */
	public function getEventsManager() {}

    /**
     * Magic method to get or set services using setters/getters
     *
     * @param string $method 
     * @param array $arguments 
     * @return mixed 
     */
	public function __call($method, $arguments = null) {}

    /**
     * Set a default dependency injection container to be obtained into static methods
     *
     * @param mixed $dependencyInjector 
     */
	public static function setDefault(\Phalcon\DiInterface $dependencyInjector) {}

    /**
     * Return the lastest DI created
     *
     * @return \Phalcon\DiInterface 
     */
	public static function getDefault() {}

    /**
     * Resets the internal default DI
     */
	public static function reset() {}

}
