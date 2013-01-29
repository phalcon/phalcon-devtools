<?php 

namespace Phalcon\Mvc\Router {

	/**
	 * Phalcon\Mvc\Router\Route
	 *
	 * This class represents every route added to the router
	 */
	
	class Route {

		protected $_pattern;

		protected $_compiledPattern;

		protected $_paths;

		protected $_methods;

		protected $_converters;

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
		public function __construct($pattern, $paths=null, $httpMethods=null){ }


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
		 * @return \Phalcon\Mvc\Router\RouteInterface
		 */
		public function via($httpMethods){ }


		/**
		 * Reconfigure the route adding a new pattern and a set of paths
		 *
		 * @param string $pattern
		 * @param array $paths
		 */
		public function reConfigure($pattern, $paths=null){ }


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
		 * @return \Phalcon\Mvc\Router\RouteInterface
		 */
		public function setName($name){ }


		/**
		 * Sets a set of HTTP methods that constraint the matching of the route
		 *
		 * @param string|array $httpMethods
		 * @return \Phalcon\Mvc\Router\RouteInterface
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
		 * Returns the route's compiled pattern
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
		 * Returns the paths using positions as keys and names as values
		 *
		 * @return array
		 */
		public function getReversedPaths(){ }


		/**
		 * Returns the HTTP methods that constraint matching the route
		 *
		 * @return string|array
		 */
		public function getHttpMethods(){ }


		/**
		 * Adds a converter to perform an additional transformation for certain parameter
		 *
		 * @param string $name
		 * @param callable $converter
		 * @return \Phalcon\Mvc\Router\RouteInterface
		 */
		public function convert($name, $converter){ }


		/**
		 * Returns the router converter
		 *
		 * @return array
		 */
		public function getConverters(){ }


		/**
		 * Resets the internal route id generator
		 */
		public static function reset(){ }

	}
}
