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
	
	class Micro extends \Phalcon\DI\Injectable {

		protected $_dependencyInjector;

		protected $_eventsManager;

		protected $_handlers;

		protected $_router;

		protected $_notFoundHandler;

		protected $_activeHandler;

		protected $_returnedValue;

		public function __construct(){ }


		/**
		 * Sets the DependencyInjector container
		 *
		 * @param \Phalcon\DI $dependencyInjector
		 */
		public function setDI($dependencyInjector){ }


		/**
		 * Returns the DependencyInjector container
		 *
		 * @return \Phalcon\DI
		 */
		public function getDI(){ }


		/**
		 * Sets the events manager
		 *
		 * @param \Phalcon\Events\Manager $eventsManager
		 */
		public function setEventsManager($eventsManager){ }


		/**
		 * Returns the internal event manager
		 *
		 * @return \Phalcon\Events\Manager
		 */
		public function getEventsManager(){ }


		/**
		 * Maps a route to a handler without any HTTP method constraint
		 *
		 * @param string $routePattern
		 * @param callable $handler
		 */
		public function map($routePattern, $handler){ }


		/**
		 * Maps a route to a handler that only matches if the HTTP method is GET
		 *
		 * @param string $routePattern
		 * @param callable $handler
		 */
		public function get($routePattern, $handler){ }


		/**
		 * Maps a route to a handler that only matches if the HTTP method is POST
		 *
		 * @param string $routePattern
		 * @param callable $handler
		 */
		public function post($routePattern, $handler){ }


		/**
		 * Maps a route to a handler that only matches if the HTTP method is PUT
		 *
		 * @param string $routePattern
		 * @param callable $handler
		 */
		public function put($routePattern, $handler){ }


		/**
		 * Maps a route to a handler that only matches if the HTTP method is HEAD
		 *
		 * @param string $routePattern
		 * @param callable $handler
		 */
		public function head($routePattern, $handler){ }


		/**
		 * Maps a route to a handler that only matches if the HTTP method is DELETE
		 *
		 * @param string $routePattern
		 * @param callable $handler
		 */
		public function delete($routePattern, $handler){ }


		/**
		 * Maps a route to a handler that only matches if the HTTP method is GET
		 *
		 * @param string $routePattern
		 * @param callable $handler
		 */
		public function options($routePattern, $handler){ }


		/**
		 * Sets a handler that will be called when the router doesn't match any of the defined routes
		 *
		 * @param callable $handler
		 */
		public function notFound($handler){ }


		/**
		 * Returns the internal router used by the application
		 *
		 * @return \Phalcon\Mvc\Router
		 */
		public function getRouter(){ }


		/**
		 * Obtains a service from the DI
		 *
		 * @return object
		 */
		public function getService($serviceName){ }


		/**
		 * Obtains a shared service from the DI
		 */
		public function getSharedService($serviceName){ }


		/**
		 * Handle the whole request
		 *
		 * @return mixed
		 */
		public function handle(){ }


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
		 */
		public function getReturnedValue(){ }

	}
}
