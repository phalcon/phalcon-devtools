<?php

namespace Phalcon\Mvc;

use Phalcon\DiInterface;
use Phalcon\Mvc\Micro\Exception;
use Phalcon\Mvc\Router\RouteInterface;
use Phalcon\Mvc\Micro\MiddlewareInterface;
use Phalcon\Mvc\Micro\Collection;
use Phalcon\Mvc\Micro\CollectionInterface;
use Phalcon\Mvc\Micro\LazyLoader;
use Phalcon\Http\ResponseInterface;
use Phalcon\Di\ServiceInterface;
use Phalcon\Di\FactoryDefault;
use Phalcon\Di\Injectable;


class Micro extends Injectable implements \ArrayAccess
{

	protected $_dependencyInjector;

	protected $_handlers;

	protected $_router;

	protected $_stopped;

	protected $_notFoundHandler;

	protected $_errorHandler;

	protected $_activeHandler;

	protected $_beforeHandlers;

	protected $_afterHandlers;

	protected $_finishHandlers;

	protected $_returnedValue;



	/**
	 * Phalcon\Mvc\Micro constructor
	 * 
	 * @param DiInterface $dependencyInjector
	 */
	public function __construct(DiInterface $dependencyInjector=null) {}

	/**
	 * Sets the DependencyInjector container
	 * 
	 * @param DiInterface $dependencyInjector
	 *
	 * @return void
	 */
	public function setDI(DiInterface $dependencyInjector) {}

	/**
		 * We automatically set ourselves as application service
	 * 
	 * @param string $routePattern
	 * @param $handler
		 *
	 * @return RouteInterface
	 */
	public function map($routePattern, $handler) {}

	/**
		 * We create a router even if there is no one in the DI
	 * 
	 * @param string $routePattern
	 * @param $handler
		 *
	 * @return RouteInterface
	 */
	public function get($routePattern, $handler) {}

	/**
		 * We create a router even if there is no one in the DI
	 * 
	 * @param string $routePattern
	 * @param $handler
		 *
	 * @return RouteInterface
	 */
	public function post($routePattern, $handler) {}

	/**
		 * We create a router even if there is no one in the DI
	 * 
	 * @param string $routePattern
	 * @param $handler
		 *
	 * @return RouteInterface
	 */
	public function put($routePattern, $handler) {}

	/**
		 * We create a router even if there is no one in the DI
	 * 
	 * @param string $routePattern
	 * @param $handler
		 *
	 * @return RouteInterface
	 */
	public function patch($routePattern, $handler) {}

	/**
		 * We create a router even if there is no one in the DI
	 * 
	 * @param string $routePattern
	 * @param $handler
		 *
	 * @return RouteInterface
	 */
	public function head($routePattern, $handler) {}

	/**
		 * We create a router even if there is no one in the DI
	 * 
	 * @param string $routePattern
	 * @param $handler
		 *
	 * @return RouteInterface
	 */
	public function delete($routePattern, $handler) {}

	/**
		 * We create a router even if there is no one in the DI
	 * 
	 * @param string $routePattern
	 * @param $handler
		 *
	 * @return RouteInterface
	 */
	public function options($routePattern, $handler) {}

	/**
		 * We create a router even if there is no one in the DI
	 * 
	 * @param CollectionInterface $collection
		 *
	 * @return Micro
	 */
	public function mount(CollectionInterface $collection) {}

	/**
		 * Get the main handler
	 * 
	 * @param mixed $handler
		 *
	 * @return Micro
	 */
	public function notFound($handler) {}

	/**
	 * Sets a handler that will be called when an exception is thrown handling the route
	 *
	 * @param mixed $handler
	 * 
	 * @return Micro
	 */
	public function error($handler) {}

	/**
	 * Returns the internal router used by the application
	 *
	 * @return RouterInterface
	 */
	public function getRouter() {}

	/**
			 * Clear the set routes if any
	 * 
	 * @param string $serviceName
	 * @param mixed $definition
	 * @param boolean $shared
			 *
	 * @return ServiceInterface
	 */
	public function setService($serviceName, $definition, $shared=false) {}

	/**
	 * Checks if a service is registered in the DI
	 * 
	 * @param string $serviceName
	 *
	 * @return boolean
	 */
	public function hasService($serviceName) {}

	/**
	 * Obtains a service from the DI
	 *
	 * @param string $serviceName
	 * 
	 * @return mixed
	 */
	public function getService($serviceName) {}

	/**
	 * Obtains a shared service from the DI
	 *
	 * @param string $serviceName
	 * 
	 * @return mixed
	 */
	public function getSharedService($serviceName) {}

	/**
	 * Handle the whole request
	 *
	 * @param mixed $uri
	 * 
	 * @return mixed
	 */
	public function handle($uri=null) {}

	/**
			 * Calling beforeHandle routing
			 *
	 * @return void
	 */
	public function stop() {}

	/**
	 * Sets externally the handler that must be called by the matched route
	 * 
	 * @param callable $activeHandler
	 *
	 *
	 * @return void
	 */
	public function setActiveHandler($activeHandler) {}

	/**
	 * Return the handler that will be called for the matched route
	 *
	 * @return mixed
	 */
	public function getActiveHandler() {}

	/**
	 * Returns the value returned by the executed handler
	 *
	 * @return mixed
	 */
	public function getReturnedValue() {}

	/**
	 * Check if a service is registered in the internal services container using the array syntax
	 *
	 * @param string $alias
	 * 
	 * @return boolean
	 */
	public function offsetExists($alias) {}

	/**
	 * Allows to register a shared service in the internal services container using the array syntax
	 *
	 *<code>
	 *	$app['request'] = new \Phalcon\Http\Request();
	 *</code>
	 * 
	 * @param string $alias
	 * @param mixed $definition
	 *
	 *
	 * @return void
	 */
	public function offsetSet($alias, $definition) {}

	/**
	 * Allows to obtain a shared service in the internal services container using the array syntax
	 *
	 *<code>
	 *	var_dump($di['request']);
	 *</code>
	 *
	 * @param string $alias
	 * 
	 * @return mixed
	 */
	public function offsetGet($alias) {}

	/**
	 * Removes a service from the internal services container using the array syntax
	 * 
	 * @param string $alias
	 *
	 *
	 * @return mixed
	 */
	public function offsetUnset($alias) {}

	/**
	 * Appends a before middleware to be called before execute the route
	 *
	 * @param callable $handler
	 * 
	 * @return Micro
	 */
	public function before($handler) {}

	/**
	 * Appends an 'after' middleware to be called after execute the route
	 *
	 * @param callable $handler
	 * 
	 * @return Micro
	 */
	public function after($handler) {}

	/**
	 * Appends a 'finish' middleware to be called when the request is finished
	 *
	 * @param callable $handler
	 * 
	 * @return Micro
	 */
	public function finish($handler) {}

	/**
	 * Returns the internal handlers attached to the application
	 *
	 * @return mixed
	 */
	public function getHandlers() {}

}
