<?php 

namespace Phalcon\Mvc {

	/**
	 * Phalcon\Mvc\Router
	 *
	 * <p>Phalcon\Mvc\Router is the standard framework router. Routing is the
	 * process of taking a URI endpoint (that part of the URI which comes after the base URL) and
	 * decomposing it into parameters to determine which module, controller, and
	 * action of that controller should receive the request</p>
	 *
	 *<code>
	 *
	 *	$router = new Phalcon\Mvc\Router();
	 *
	 *  $router->add(
	 *		"/documentation/{chapter}/{name}.{type:[a-z]+}",
	 *		array(
	 *			"controller" => "documentation",
	 *			"action"     => "show"
	 *		)
	 *	);
	 *
	 *	$router->handle();
	 *
	 *	echo $router->getControllerName();
	 *</code>
	 *
	 */
	
	class Router {

		protected $_dependencyInjector;

		protected $_namespace;

		protected $_module;

		protected $_controller;

		protected $_action;

		protected $_params;

		protected $_routes;

		protected $_matchedRoute;

		protected $_matches;

		protected $_wasMatched;

		protected $_defaultNamespace;

		protected $_defaultModule;

		protected $_defaultController;

		protected $_defaultAction;

		protected $_defaultParams;

		protected $_removeExtraSlashes;

		/**
		 * \Phalcon\Mvc\Router constructor
		 *
		 * @param boolean $defaultRoutes
		 */
		public function __construct($defaultRoutes=null){ }


		/**
		 * Sets the dependency injector
		 *
		 * @param \Phalcon\DiInterface $dependencyInjector
		 */
		public function setDI($dependencyInjector){ }


		/**
		 * Returns the internal dependency injector
		 *
		 * @return \Phalcon\DiInterface
		 */
		public function getDI(){ }


		/**
		 * Get rewrite info. This info is read from $_GET['_url']. This returns '/' if the rewrite information cannot be read
		 *
		 * @return string
		 */
		protected function _getRewriteUri(){ }


		/**
		 * Set whether router must remove the extra slashes in the handled routes
		 *
		 * @param boolean $remove
		 */
		public function removeExtraSlashes($remove){ }


		/**
		 * Sets the name of the default namespace
		 *
		 * @param string $namespaceName
		 */
		public function setDefaultNamespace($namespaceName){ }


		/**
		 * Sets the name of the default module
		 *
		 * @param string $moduleName
		 */
		public function setDefaultModule($moduleName){ }


		/**
		 * Sets the default controller name
		 *
		 * @param string $controllerName
		 */
		public function setDefaultController($controllerName){ }


		/**
		 * Sets the default action name
		 *
		 * @param string $actionName
		 */
		public function setDefaultAction($actionName){ }


		/**
		 * Sets an array of default paths. This defaults apply for all the routes
		 *
		 *<code>
		 * $router->setDefaults(array(
		 *		'module' => 'common',
		 *		'action' => 'index'
		 * ));
		 *</code>
		 *
		 * @param array $defaults
		 */
		public function setDefaults($defaults){ }


		/**
		 * Handles routing information received from the rewrite engine
		 *
		 *<code>
		 * $router->handle('/posts/edit/1');
		 *</code>
		 *
		 * @param string $uri
		 */
		public function handle($uri=null){ }


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
		 * Mounts a group of routes in the router
		 *
		 * @param \Phalcon\Mvc\Router\Group $route
		 */
		public function mount($group){ }


		/**
		 * Removes all the pre-defined routes
		 */
		public function clear(){ }


		/**
		 * Returns the processed namespace name
		 *
		 * @return string
		 */
		public function getNamespaceName(){ }


		/**
		 * Returns the processed module name
		 *
		 * @return string
		 */
		public function getModuleName(){ }


		/**
		 * Returns the processed controller name
		 *
		 * @return string
		 */
		public function getControllerName(){ }


		/**
		 * Returns the processed action name
		 *
		 * @return string
		 */
		public function getActionName(){ }


		/**
		 * Returns the processed parameters
		 *
		 * @return array
		 */
		public function getParams(){ }


		/**
		 * Returns the route that matchs the handled URI
		 *
		 * @return \Phalcon\Mvc\Router\Route
		 */
		public function getMatchedRoute(){ }


		/**
		 * Returns the sub expressions in the regular expression matched
		 *
		 * @return array
		 */
		public function getMatches(){ }


		/**
		 * Checks if the router macthes any of the defined routes
		 *
		 * @return bool
		 */
		public function wasMatched(){ }


		/**
		 * Returns all the routes defined in the router
		 *
		 * @return \Phalcon\Mvc\Router\Route[]
		 */
		public function getRoutes(){ }


		/**
		 * Returns a route object by its id
		 *
		 * @param string $id
		 * @return \Phalcon\Mvc\Router\Route
		 */
		public function getRouteById($id){ }


		/**
		 * Returns a route object by its name
		 *
		 * @param string $name
		 * @return \Phalcon\Mvc\Router\Route
		 */
		public function getRouteByName($name){ }

	}
}
