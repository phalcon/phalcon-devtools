<?php 

namespace Phalcon\Mvc\Micro {

	/**
	 * Phalcon\Mvc\Micro\Collection
	 *
	 * Groups handlers as controllers
	 *
	 *<code>
	 *
	 * $app = new Phalcon\Mvc\Micro();
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

		protected $_handler;

		protected $_handlers;

		protected function _addMap(){ }


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
		 */
		public function setHandler($handler){ }


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
