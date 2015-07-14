<?php

namespace Phalcon;

use Phalcon\DiInterface;
use Phalcon\Di\Service;
use Phalcon\Di\ServiceInterface;
use Phalcon\Di\Exception;
use Phalcon\Events\ManagerInterface;
use Phalcon\Di\InjectionAwareInterface;


class Di implements DiInterface
{

	/**
	 * List of registered services
	 */
	protected $_services;

	/**
	 * List of shared instances
	 */
	protected $_sharedInstances;

	/**
	 * To know if the latest resolved instance was shared or not
	 */
	protected $_freshInstance = false;

	/**
	 * Events Manager
	 *
	 * @var \Phalcon\Events\ManagerInterface
	 */
	protected $_eventsManager;

	/**
	 * Latest DI build
	 */
	protected static $_default;



	/**
	 * Phalcon\Di constructor
	 */
	public function __construct() {}

	/**
	 * Sets the internal event manager
	 * 
	 * @param ManagerInterface $eventsManager
	 *
	 * @return void
	 */
	public function setInternalEventsManager(ManagerInterface $eventsManager) {}

	/**
	 * Returns the internal event manager
	 *
	 * @return ManagerInterface
	 */
	public function getInternalEventsManager() {}

	/**
	 * Registers a service in the services container
	 * 
	 * @param string $name
	 * @param mixed $definition
	 * @param boolean $shared
	 *
	 * @return ServiceInterface
	 */
	public function set($name, $definition, $shared=false) {}

	/**
	 * Registers an "always shared" service in the services container
	 * 
	 * @param string $name
	 * @param mixed $definition
	 *
	 * @return ServiceInterface
	 */
	public function setShared($name, $definition) {}

	/**
	 * Removes a service in the services container
	 * 
	 * @param string $name
	 *
	 * @return void
	 */
	public function remove($name) {}

	/**
	 * Attempts to register a service in the services container
	 * Only is successful if a service hasn"t been registered previously
	 * with the same name
	 * 
	 * @param string $name
	 * @param $definition
	 * @param boolean $shared
	 *
	 * @return ServiceInterface|boolean
	 */
	public function attempt($name, $definition, $shared=false) {}

	/**
	 * Sets a service using a raw Phalcon\Di\Service definition
	 * 
	 * @param string $name
	 * @param ServiceInterface $rawDefinition
	 *
	 * @return ServiceInterface
	 */
	public function setRaw($name, ServiceInterface $rawDefinition) {}

	/**
	 * Returns a service definition without resolving
	 * 
	 * @param string $name
	 *
	 * @return mixed
	 */
	public function getRaw($name) {}

	/**
	 * Returns a Phalcon\Di\Service instance
	 * 
	 * @param string $name
	 *
	 * @return ServiceInterface
	 */
	public function getService($name) {}

	/**
	 * Resolves the service based on its configuration
	 * 
	 * @param string $name
	 * @param $parameters
	 *
	 * @return mixed
	 */
	public function get($name, $parameters=null) {}

	/**
			 * The service is registered in the DI
	 * 
	 * @param string $name
	 * @param $parameters
			 *
	 * @return mixed
	 */
	public function getShared($name, $parameters=null) {}

	/**
		 * This method provides a first level to shared instances allowing to use non-shared services as shared
	 * 
	 * @param string $name
		 *
	 * @return boolean
	 */
	public function has($name) {}

	/**
	 * Check whether the last service obtained via getShared produced a fresh instance or an existing one
	 *
	 * @return boolean
	 */
	public function wasFreshInstance() {}

	/**
	 * Return the services registered in the DI
	 *
	 * @return Service[]
	 */
	public function getServices() {}

	/**
	 * Check if a service is registered using the array syntax
	 * 
	 * @param string $name
	 *
	 * @return boolean
	 */
	public function offsetExists($name) {}

	/**
	 * Allows to register a shared service using the array syntax
	 *
	 *<code>
	 *	$di["request"] = new \Phalcon\Http\Request();
	 *</code>
	 *
	 * @param string $name
	 * @param mixed $definition
	 * 
	 * @return boolean
	 */
	public function offsetSet($name, $definition) {}

	/**
	 * Allows to obtain a shared service using the array syntax
	 *
	 *<code>
	 *	var_dump($di["request"]);
	 *</code>
	 *
	 * @param string $name
	 * 
	 * @return boolean
	 */
	public function offsetGet($name) {}

	/**
	 * Removes a service from the services container using the array syntax
	 * 
	 * @param string $name
	 *
	 * @return boolean
	 */
	public function offsetUnset($name) {}

	/**
	 * Magic method to get or set services using setters/getters
	 *
	 * @param string $method
	 * @param array $arguments
	 * 
	 * @return mixed
	 */
	public function __call($method, $arguments=null) {}

	/**
		 * If the magic method starts with "get" we try to get a service with that name
	 * 
	 * @param DiInterface $dependencyInjector
		 *
	 * @return void
	 */
	public static function setDefault(DiInterface $dependencyInjector) {}

	/**
	 * Return the lastest DI created
	 *
	 * @return DiInterface
	 */
	public static function getDefault() {}

	/**
	 * Resets the internal default DI
	 *
	 * @return void
	 */
	public static function reset() {}

}
