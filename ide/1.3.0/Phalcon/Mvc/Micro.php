<?php 

namespace Phalcon\Mvc {

	/**
	 * Phalcon\Mvc\Micro
	 *
	 * With Phalcon you can create "Micro-Framework like" applications. By doing this, you only need to
	 * write a minimal amount of code to create a PHP application. Micro applications are suitable
	 * to small applications, APIs and prototypes in a practical way.
	 *
	 *<code>
	 *
	 * $app = new Phalcon\Mvc\Micro();
	 *
	 * $app->get('/say/welcome/{name}', function ($name) {
	 *    echo "<h1>Welcome $name!</h1>";
	 * });
	 *
	 * $app->handle();
	 *
	 *</code>
	 */
	
	class Micro extends \Phalcon\DI\Injectable implements \Phalcon\Events\EventsAwareInterface, \Phalcon\DI\InjectionAwareInterface, \ArrayAccess {

		protected $_dependencyInjector;

		protected $_handlers;

		protected $_router;

		protected $_stopped;

		protected $_notFoundHandler;

		protected $_activeHandler;

		protected $_beforeHandlers;

		protected $_afterHandlers;

		protected $_finishHandlers;

		protected $_returnedValue;

		/**
		 * \Phalcon\Mvc\Micro constructor
		 *
		 * @param \Phalcon\DiInterface $dependencyInjector
		 */
		public function __construct($dependencyInjector=null){ }


		/**
		 * Sets the DependencyInjector container
		 *
		 * @param \Phalcon\DiInterface $dependencyInjector
		 */
		public function setDI($dependencyInjector){ }


		/**
		 * Maps a route to a handler without any HTTP method constraint
		 *
		 * @param string $routePattern
		 * @param callable $handler
		 * @return \Phalcon\Mvc\Router\RouteInterface
		 */
		public function map($routePattern, $handler){ }


		/**
		 * Maps a route to a handler that only matches if the HTTP method is GET
		 *
		 * @param string $routePattern
		 * @param callable $handler
		 * @return \Phalcon\Mvc\Router\RouteInterface
		 */
		public function get($routePattern, $handler){ }


		/**
		 * Maps a route to a handler that only matches if the HTTP method is POST
		 *
		 * @param string $routePattern
		 * @param callable $handler
		 * @return \Phalcon\Mvc\Router\RouteInterface
		 */
		public function post($routePattern, $handler){ }


		/**
		 * Maps a route to a handler that only matches if the HTTP method is PUT
		 *
		 * @param string $routePattern
		 * @param callable $handler
		 * @return \Phalcon\Mvc\Router\RouteInterface
		 */
		public function put($routePattern, $handler){ }


		/**
		 * Maps a route to a handler that only matches if the HTTP method is PATCH
		 *
		 * @param string $routePattern
		 * @param callable $handler
		 * @return \Phalcon\Mvc\Router\RouteInterface
		 */
		public function patch($routePattern, $handler){ }


		/**
		 * Maps a route to a handler that only matches if the HTTP method is HEAD
		 *
		 * @param string $routePattern
		 * @param callable $handler
		 * @return \Phalcon\Mvc\Router\RouteInterface
		 */
		public function head($routePattern, $handler){ }


		/**
		 * Maps a route to a handler that only matches if the HTTP method is DELETE
		 *
		 * @param string $routePattern
		 * @param callable $handler
		 * @return \Phalcon\Mvc\Router\RouteInterface
		 */
		public function delete($routePattern, $handler){ }


		/**
		 * Maps a route to a handler that only matches if the HTTP method is OPTIONS
		 *
		 * @param string $routePattern
		 * @param callable $handler
		 * @return \Phalcon\Mvc\Router\RouteInterface
		 */
		public function options($routePattern, $handler){ }


		/**
		 * Mounts a collection of handlers
		 *
		 * @param \Phalcon\Mvc\Collection $collection
		 * @return \Phalcon\Mvc\Micro
		 */
		public function mount($collection){ }


		/**
		 * Sets a handler that will be called when the router doesn't match any of the defined routes
		 *
		 * @param callable $handler
		 * @return \Phalcon\Mvc\Micro
		 */
		public function notFound($handler){ }


		/**
		 * Returns the internal router used by the application
		 *
		 * @return \Phalcon\Mvc\RouterInterface
		 */
		public function getRouter(){ }


		/**
		 * Sets a service from the DI
		 *
		 * @param string $serviceName
		 * @param mixed $definition
		 * @param boolean $shared
		 * @return \Phalcon\DI\ServiceInterface
		 */
		public function setService($serviceName, $definition, $shared=null){ }


		/**
		 * Checks if a service is registered in the DI
		 *
		 * @param string $serviceName
		 * @return boolean
		 */
		public function hasService($serviceName){ }


		/**
		 * Obtains a service from the DI
		 *
		 * @param string $serviceName
		 * @return object
		 */
		public function getService($serviceName){ }


		/**
		 * Obtains a shared service from the DI
		 *
		 * @param string $serviceName
		 * @return mixed
		 */
		public function getSharedService($serviceName){ }


		/**
		 * Handle the whole request
		 *
		 * @param string $uri
		 * @return mixed
		 */
		public function handle($uri=null){ }


		/**
		 * Stops the middleware execution avoiding than other middlewares be executed
		 */
		public function stop(){ }


		/**
		 * Sets externally the handler that must be called by the matched route
		 *
		 * @param callable $activeHandler
		 */
		public function setActiveHandler($activeHandler){ }


		/**
		 * Return the handler that will be called for the matched route
		 *
		 * @return callable
		 */
		public function getActiveHandler(){ }


		/**
		 * Returns the value returned by the executed handler
		 *
		 * @return mixed
		 */
		public function getReturnedValue(){ }


		/**
		 * Check if a service is registered in the internal services container using the array syntax.
		 * Alias for \Phalcon\Mvc\Micro::hasService()
		 *
		 * @param string $alias
		 * @return boolean
		 */
		public function offsetExists($serviceName){ }


		/**
		 * Allows to register a shared service in the internal services container using the array syntax.
		 * Alias for \Phalcon\Mvc\Micro::setService()
		 *
		 *<code>
		 *	$app['request'] = new \Phalcon\Http\Request();
		 *</code>
		 *
		 * @param string $alias
		 * @param mixed $definition
		 */
		public function offsetSet($serviceName, $definition, $shared=null){ }


		/**
		 * Allows to obtain a shared service in the internal services container using the array syntax.
		 * Alias for \Phalcon\Mvc\Micro::getService()
		 *
		 *<code>
		 *	var_dump($app['request']);
		 *</code>
		 *
		 * @param string $alias
		 * @return mixed
		 */
		public function offsetGet($serviceName){ }


		/**
		 * Removes a service from the internal services container using the array syntax
		 *
		 * @param string $alias
		 * @todo Not implemented
		 */
		public function offsetUnset($alias){ }


		/**
		 * Appends a before middleware to be called before execute the route
		 *
		 * @param callable $handler
		 * @return \Phalcon\Mvc\Micro
		 */
		public function before($handler){ }


		/**
		 * Appends an 'after' middleware to be called after execute the route
		 *
		 * @param callable $handler
		 * @return \Phalcon\Mvc\Micro
		 */
		public function after($handler){ }


		/**
		 * Appends a 'finish' middleware to be called when the request is finished
		 *
		 * @param callable $handler
		 * @return \Phalcon\Mvc\Micro
		 */
		public function finish($handler){ }


		/**
		 * Returns the internal handlers attached to the application
		 *
		 * @return array
		 */
		public function getHandlers(){ }

	}
}
