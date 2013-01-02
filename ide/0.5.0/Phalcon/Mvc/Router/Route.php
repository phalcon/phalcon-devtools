<?php 

namespace Phalcon\Mvc\Router {

	/**
	 * Phalcon\Mvc\Router\Route
	 *
	 * This class represents every route defined in the router.
	 */
	
	class Route {

		protected $_pattern;

		protected $_compiledPattern;

		protected $_paths;

		protected $_methods;

		protected $_id;

		protected $_name;

		protected static $_uniqueId;

		/**
		 * \Phalcon\Mvc\Router\Route constructor
		 *
		 * @param string $pattern
		 * @param array $paths
		 * @param array|string $httpMethods
		 */
		public function __construct($pattern, $paths, $httpMethods){ }


		/**
		 * Replaces placeholders from pattern returning a valid PCRE regular expression
		 *
		 * @param string $pattern
		 * @return string
		 */
		public function compilePattern($pattern){ }


		/**
		 * Set one or more HTTP methods that constraint the matching of the route
		 *
		 * @param string|array $httpMethods
		 */
		public function via($httpMethods){ }


		/**
		 * Reconfigure the route adding a new pattern and a set of paths
		 *
		 * @param string $pattern
		 * @param array $paths
		 */
		public function reConfigure($pattern, $paths){ }


		/**
		 * Returns the route's name
		 *
		 * @return string
		 */
		public function getName(){ }


		/**
		 * Sets the route's name
		 *
		 * @param string $name
		 */
		public function setName($name){ }


		/**
		 * Sets a set of HTTP methods that constraint the matching of the route
		 *
		 * @param string|array $httpMethods
		 */
		public function setHttpMethods($httpMethods){ }


		/**
		 * Returns the route's id
		 *
		 * @return string
		 */
		public function getRouteId(){ }


		/**
		 * Returns the route's pattern
		 *
		 * @return string
		 */
		public function getPattern(){ }


		/**
		 * Returns the route's pattern
		 *
		 * @return string
		 */
		public function getCompiledPattern(){ }


		/**
		 * Returns the paths
		 *
		 * @return array
		 */
		public function getPaths(){ }


		/**
		 * Returns the HTTP methods that constraint matching the route
		 *
		 * @return string|array
		 */
		public function getHttpMethods(){ }


		/**
		 * Resets the internal route id generator
		 */
		public static function reset(){ }

	}
}
