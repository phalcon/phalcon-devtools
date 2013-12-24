<?php 

namespace Phalcon\Mvc\Router {

	/**
	 * Phalcon\Mvc\Router\Route
	 *
	 * This class represents every route added to the router
	 */
	
	class Route implements \Phalcon\Mvc\Router\RouteInterface {

		protected $_pattern;

		protected $_compiledPattern;

		protected $_paths;

		protected $_methods;

		protected $_hostname;

		protected $_converters;

		protected $_id;

		protected $_name;

		protected $_beforeMatch;

		protected $_group;

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
		 *<code>
		 * $route->via('GET');
		 * $route->via(array('GET', 'POST'));
		 *</code>
		 *
		 * @param string|array $httpMethods
		 * @return \Phalcon\Mvc\Router\Route
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
		 *<code>
		 * $router->add('/about', array(
		 *     'controller' => 'about'
		 * ))->setName('about');
		 *</code>
		 *
		 * @param string $name
		 * @return \Phalcon\Mvc\Router\Route
		 */
		public function setName($name){ }


		/**
		 * Sets a callback that is called if the route is matched.
		 * The developer can implement any arbitrary conditions here
		 * If the callback returns false the route is treaded as not matched
		 *
		 * @param callback $callback
		 * @return \Phalcon\Mvc\Router\Route
		 */
		public function beforeMatch($callback){ }


		/**
		 * Returns the 'before match' callback if any
		 *
		 * @return mixed
		 */
		public function getBeforeMatch(){ }


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
		 * Sets a set of HTTP methods that constraint the matching of the route (alias of via)
		 *
		 *<code>
		 * $route->setHttpMethods('GET');
		 * $route->setHttpMethods(array('GET', 'POST'));
		 *</code>
		 *
		 * @param string|array $httpMethods
		 * @return \Phalcon\Mvc\Router\Route
		 */
		public function setHttpMethods($httpMethods){ }


		/**
		 * Returns the HTTP methods that constraint matching the route
		 *
		 * @return string|array
		 */
		public function getHttpMethods(){ }


		/**
		 * Sets a hostname restriction to the route
		 *
		 *<code>
		 * $route->setHostname('localhost');
		 *</code>
		 *
		 * @param string|array $httpMethods
		 * @return \Phalcon\Mvc\Router\Route
		 */
		public function setHostname($hostname){ }


		/**
		 * Returns the hostname restriction if any
		 *
		 * @return string
		 */
		public function getHostname(){ }


		/**
		 * Sets the group associated with the route
		 *
		 * @param \Phalcon\Mvc\Router\Group $group
		 * @return \Phalcon\Mvc\RouteInterface
		 */
		public function setGroup($group){ }


		/**
		 * Returns the group associated with the route
		 *
		 * @return \Phalcon\Mvc\Router\Group|null
		 */
		public function getGroup(){ }


		/**
		 * Adds a converter to perform an additional transformation for certain parameter
		 *
		 * @param string $name
		 * @param callable $converter
		 * @return \Phalcon\Mvc\Router\Route
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
