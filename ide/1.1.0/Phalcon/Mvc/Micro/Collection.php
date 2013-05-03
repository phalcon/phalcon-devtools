<?php 

namespace Phalcon\Mvc\Micro {

	/**
	 * Phalcon\Mvc\Micro\Collection
	 *
	 * Groups Micro-Mvc handlers as controllers
	 *
	 *<code>
	 *
	 * $app = new Phalcon\Mvc\Micro();
	 *
	 * $collection = new Phalcon\Mvc\Micro\Collection();
	 *
	 * $collection->setHandler(new PostsController());
	 *
	 * $collection->get('/posts/edit/{id}', 'edit');
	 *
	 * $app->mount($collection);
	 *
	 *</code>
	 *
	 */
	
	class Collection {

		protected $_prefix;

		protected $_lazy;

		protected $_handler;

		protected $_handlers;

		/**
		 * Internal function to add a handler to the group
		 *
		 * @param string|array $method
		 * @param string $routePattern
		 * @param mixed $handler
		 */
		protected function _addMap(){ }


		/**
		 * Sets a prefix for all routes added to the collection
		 *
		 * @param string $prefix
		 * @return \Phalcon\Mvc\Micro\Collection
		 */
		public function setPrefix($prefix){ }


		/**
		 * Returns the collection prefix if any
		 *
		 * @return string
		 */
		public function getPrefix(){ }


		/**
		 * Returns the registered handlers
		 *
		 * @return array
		 */
		public function getHandlers(){ }


		/**
		 * Sets the main handler
		 *
		 * @param mixed $handler
		 * @param boolean $lazy
		 * @return \Phalcon\Mvc\Micro\Collection
		 */
		public function setHandler($handler, $lazy=null){ }


		/**
		 * Sets if the main handler must be lazy loaded
		 *
		 * @param boolean $lazy
		 * @return \Phalcon\Mvc\Micro\Collection
		 */
		public function setLazy($lazy){ }


		/**
		 * Returns if the main handler must be lazy loaded
		 *
		 * @return boolean
		 */
		public function isLazy(){ }


		/**
		 * Returns the main handler
		 *
		 * @return mixed
		 */
		public function getHandler(){ }


		/**
		 * Maps a route to a handler
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

	}
}
