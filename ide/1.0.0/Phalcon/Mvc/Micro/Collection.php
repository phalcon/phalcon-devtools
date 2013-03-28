<?php 

namespace Phalcon\Mvc\Micro {

	/**
	 * Phalcon\Mvc\Micro\Collection
	 *
	 * Groups handlers as controllers
	 */
	
	class Collection {

		protected $_handlers;

		protected function _addMap(){ }


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
