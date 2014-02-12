<?php 

namespace Phalcon\Mvc\Router {

	/**
	 * Phalcon\Mvc\Router\Group
	 *
	 * Helper class to create a group of routes with common attributes
	 *
	 *<code>
	 * $router = new Phalcon\Mvc\Router();
	 *
	 * //Create a group with a common module and controller
	 * $blog = new Phalcon\Mvc\Router\Group(array(
	 * 	'module' => 'blog',
	 * 	'controller' => 'index'
	 * ));
	 *
	 * //All the routes start with /blog
	 * $blog->setPrefix('/blog');
	 *
	 * //Add a route to the group
	 * $blog->add('/save', array(
	 * 	'action' => 'save'
	 * ));
	 *
	 * //Add another route to the group
	 * $blog->add('/edit/{id}', array(
	 * 	'action' => 'edit'
	 * ));
	 *
	 * //This route maps to a controller different than the default
	 * $blog->add('/blog', array(
	 * 	'controller' => 'about',
	 * 	'action' => 'index'
	 * ));
	 *
	 * //Add the group to the router
	 * $router->mount($blog);
	 *</code>
	 *
	 */
	
	class Group {

		protected $_prefix;

		protected $_hostname;

		protected $_paths;

		protected $_routes;

		protected $_beforeMatch;

		protected $_converters;

		protected $_name;

		/**
		 * \Phalcon\Mvc\Router\Group constructor
		 *
		 * @param array $paths
		 */
		public function __construct($paths=null){ }


		/**
		 * Set a hostname restriction for all the routes in the group
		 *
		 * @param string $hostname
		 * @return \Phalcon\Mvc\Router\Group
		 */
		public function setHostname($hostname){ }


		/**
		 * Returns the hostname restriction
		 *
		 * @return string
		 */
		public function getHostname(){ }


		/**
		 * Set a common uri prefix for all the routes in this group
		 *
		 * @param string $prefix
		 * @return \Phalcon\Mvc\Router\Group
		 */
		public function setPrefix($prefix){ }


		/**
		 * Returns the common prefix for all the routes
		 *
		 * @return string
		 */
		public function getPrefix(){ }


		/**
		 * Set a before-match condition for the whole group
		 *
		 * @param string $prefix
		 * @return \Phalcon\Mvc\Router\Group
		 */
		public function beforeMatch($beforeMatch){ }


		/**
		 * Returns the before-match condition if any
		 *
		 * @return string
		 */
		public function getBeforeMatch(){ }


		/**
		 * Set common paths for all the routes in the group
		 *
		 * @param array $paths
		 * @return \Phalcon\Mvc\Router\Group
		 */
		public function setPaths($paths){ }


		/**
		 * Returns the common paths defined for this group
		 *
		 * @return array|string
		 */
		public function getPaths(){ }


		/**
		 * Returns the routes added to the group
		 *
		 * @return \Phalcon\Mvc\Router\Route[]
		 */
		public function getRoutes(){ }


		/**
		 * Adds a route applying the common attributes
		 *
		 * @param string $pattern
		 * @param array $paths
		 * @param array $httpMethods
		 * @return \Phalcon\Mvc\Router\Route
		 */
		protected function _addRoute(){ }


		/**
		 * Adds a route to the router on any HTTP method
		 *
		 *<code>
		 * $router->add('/about', 'About::index');
		 *</code>
		 *
		 * @param string $pattern
		 * @param string/array $paths
		 * @param string $httpMethods
		 * @return \Phalcon\Mvc\Router\Route
		 */
		public function add($pattern, $paths=null, $httpMethods=null){ }


		/**
		 * Adds a route to the router that only match if the HTTP method is GET
		 *
		 * @param string $pattern
		 * @param string/array $paths
		 * @return \Phalcon\Mvc\Router\Route
		 */
		public function addGet($pattern, $paths=null){ }


		/**
		 * Adds a route to the router that only match if the HTTP method is POST
		 *
		 * @param string $pattern
		 * @param string/array $paths
		 * @return \Phalcon\Mvc\Router\Route
		 */
		public function addPost($pattern, $paths=null){ }


		/**
		 * Adds a route to the router that only match if the HTTP method is PUT
		 *
		 * @param string $pattern
		 * @param string/array $paths
		 * @return \Phalcon\Mvc\Router\Route
		 */
		public function addPut($pattern, $paths=null){ }


		/**
		 * Adds a route to the router that only match if the HTTP method is PATCH
		 *
		 * @param string $pattern
		 * @param string/array $paths
		 * @return \Phalcon\Mvc\Router\Route
		 */
		public function addPatch($pattern, $paths=null){ }


		/**
		 * Adds a route to the router that only match if the HTTP method is DELETE
		 *
		 * @param string $pattern
		 * @param string/array $paths
		 * @return \Phalcon\Mvc\Router\Route
		 */
		public function addDelete($pattern, $paths=null){ }


		/**
		 * Add a route to the router that only match if the HTTP method is OPTIONS
		 *
		 * @param string $pattern
		 * @param string/array $paths
		 * @return \Phalcon\Mvc\Router\Route
		 */
		public function addOptions($pattern, $paths=null){ }


		/**
		 * Adds a route to the router that only match if the HTTP method is HEAD
		 *
		 * @param string $pattern
		 * @param string/array $paths
		 * @return \Phalcon\Mvc\Router\Route
		 */
		public function addHead($pattern, $paths=null){ }


		/**
		 * Removes all the pre-defined routes
		 */
		public function clear(){ }


		/**
		 * Adds a converter to perform an additional transformation for certain parameter
		 *
		 * @param string $name
		 * @param callable $converter
		 * @return \Phalcon\Mvc\Router\Group
		 */
		public function convert($name, $converter){ }


		/**
		 * Returns the router converter
		 *
		 * @return array|null
		 */
		public function getConverters(){ }


		/**
		 * Set the name of the group
		 *
		 * @param string $hostname
		 * @return \Phalcon\Mvc\Router\Group
		 */
		public function setName($name){ }


		/**
		 * Returns the name of this group
		 *
		 * @return string
		 */
		public function getName(){ }

	}
}
