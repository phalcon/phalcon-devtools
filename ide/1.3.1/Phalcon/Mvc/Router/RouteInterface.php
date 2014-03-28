<?php 

namespace Phalcon\Mvc\Router {

	/**
	 * Phalcon\Mvc\Router\RouteInterface initializer
	 */
	
	interface RouteInterface {

		/**
		 * Replaces placeholders from pattern returning a valid PCRE regular expression
		 *
		 * @param string $pattern
		 * @return string
		 */
		public function compilePattern($pattern);


		/**
		 * Set one or more HTTP methods that constraint the matching of the route
		 *
		 * @param string|array $httpMethods
		 */
		public function via($httpMethods);


		/**
		 * Reconfigure the route adding a new pattern and a set of paths
		 *
		 * @param string $pattern
		 * @param array $paths
		 */
		public function reConfigure($pattern, $paths=null);


		/**
		 * Returns the route's name
		 *
		 * @return string
		 */
		public function getName();


		/**
		 * Sets the route's name
		 *
		 * @param string $name
		 */
		public function setName($name);


		/**
		 * Sets a set of HTTP methods that constraint the matching of the route
		 *
		 * @param string|array $httpMethods
		 */
		public function setHttpMethods($httpMethods);


		/**
		 * Returns the route's id
		 *
		 * @return string
		 */
		public function getRouteId();


		/**
		 * Returns the route's pattern
		 *
		 * @return string
		 */
		public function getPattern();


		/**
		 * Returns the route's pattern
		 *
		 * @return string
		 */
		public function getCompiledPattern();


		/**
		 * Returns the paths
		 *
		 * @return array
		 */
		public function getPaths();


		/**
		 * Returns the HTTP methods that constraint matching the route
		 *
		 * @return string|array
		 */
		public function getHttpMethods();


		/**
		 * Resets the internal route id generator
		 */
		public static function reset();

	}
}
