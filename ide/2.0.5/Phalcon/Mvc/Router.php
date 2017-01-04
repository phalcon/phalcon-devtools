<?php

namespace Phalcon\Mvc;

use Phalcon\DiInterface;
use Phalcon\Mvc\Router\Route;
use Phalcon\Mvc\Router\Exception;
use Phalcon\Http\RequestInterface;
use Phalcon\Events\ManagerInterface;
use Phalcon\Mvc\Router\GroupInterface;
use Phalcon\Mvc\Router\RouteInterface;
use Phalcon\Di\InjectionAwareInterface;
use Phalcon\Events\EventsAwareInterface;


class Router implements InjectionAwareInterface, RouterInterface, EventsAwareInterface
{

	const URI_SOURCE_GET_URL = 0;

	const URI_SOURCE_SERVER_REQUEST_URI = 1;

	const POSITION_FIRST = 0;

	const POSITION_LAST = 1;



	protected $_dependencyInjector;

	protected $_eventsManager;

	protected $_uriSource;

	protected $_namespace = null;

	protected $_module = null;

	protected $_controller = null;

	protected $_action = null;

	protected $_params;

	protected $_routes;

	protected $_matchedRoute;

	protected $_matches;

	protected $_wasMatched = false;

	protected $_defaultNamespace;

	protected $_defaultModule;

	protected $_defaultController;

	protected $_defaultAction;

	protected $_defaultParams;

	protected $_removeExtraSlashes;

	protected $_notFoundPaths;



	/**
	 * Phalcon\Mvc\Router constructor
	 * 
	 * @param boolean $defaultRoutes
	 */
	public function __construct($defaultRoutes=true) {}

	/**
	 * Sets the dependency injector
	 * 
	 * @param DiInterface $dependencyInjector
	 *
	 * @return void
	 */
	public function setDI(DiInterface $dependencyInjector) {}

	/**
	 * Returns the internal dependency injector
	 *
	 * @return DiInterface
	 */
	public function getDI() {}

	/**
	 * Sets the events manager
	 * 
	 * @param ManagerInterface $eventsManager
	 *
	 * @return void
	 */
	public function setEventsManager(ManagerInterface $eventsManager) {}

	/**
	 * Returns the internal event manager
	 *
	 * @return ManagerInterface
	 */
	public function getEventsManager() {}

	/**
	 * Get rewrite info. This info is read from $_GET['_url']. This returns '/' if the rewrite information cannot be read
	 *
	 * @return string
	 */
	public function getRewriteUri() {}

	/**
		 * By default we use $_GET['url'] to obtain the rewrite information
	 * 
	 * @param mixed $uriSource
		 *
	 * @return RouterInterface
	 */
	public function setUriSource($uriSource) {}

	/**
	 * Set whether router must remove the extra slashes in the handled routes
	 * 
	 * @param boolean $remove
	 *
	 * @return RouterInterface
	 */
	public function removeExtraSlashes($remove) {}

	/**
	 * Sets the name of the default namespace
	 * 
	 * @param string $namespaceName
	 *
	 * @return RouterInterface
	 */
	public function setDefaultNamespace($namespaceName) {}

	/**
	 * Sets the name of the default module
	 * 
	 * @param string $moduleName
	 *
	 * @return RouterInterface
	 */
	public function setDefaultModule($moduleName) {}

	/**
	 * Sets the default controller name
	 * 
	 * @param string $controllerName
	 *
	 * @return RouterInterface
	 */
	public function setDefaultController($controllerName) {}

	/**
	 * Sets the default action name
	 * 
	 * @param string $actionName
	 *
	 * @return RouterInterface
	 */
	public function setDefaultAction($actionName) {}

	/**
	 * Sets an array of default paths. If a route is missing a path the router will use the defined here
	 * This method must not be used to set a 404 route
	 *
	 *<code>
	 * $router->setDefaults(array(
	 *		'module' => 'common',
	 *		'action' => 'index'
	 * ));
	 *</code>
	 * 
	 * @param array $defaults
	 *
	 * @return RouterInterface
	 */
	public function setDefaults(array $defaults) {}

	/**
	 * Returns an array of default parameters
	 *
	 * @return array
	 */
	public function getDefaults() {}

	/**
	 * Handles routing information received from the rewrite engine
	 *
	 *<code>
	 * //Read the info from the rewrite engine
	 * $router->handle();
	 *
	 * //Manually passing an URL
	 * $router->handle('/posts/edit/1');
	 *</code>
	 * 
	 * @param string $uri
	 *
	 * @return void
	 */
	public function handle($uri=null) {}

	/**
			 * If 'uri' isn't passed as parameter it reads _GET['_url']
	 * 
	 * @param string $pattern
	 * @param mixed $paths
	 * @param mixed $httpMethods
	 * @param mixed $position
			 *
	 * @return RouteInterface
	 */
	public function add($pattern, $paths=null, $httpMethods=null, $position=Router::POSITION_LAST) {}

	/**
		 * Every route is internally stored as a Phalcon\Mvc\Router\Route
	 * 
	 * @param string $pattern
	 * @param mixed $paths
	 * @param mixed $position
		 *
	 * @return RouteInterface
	 */
	public function addGet($pattern, $paths=null, $position=Router::POSITION_LAST) {}

	/**
	 * Adds a route to the router that only match if the HTTP method is POST
	 * 
	 * @param string $pattern
	 * @param mixed $paths
	 * @param mixed $position
	 *
	 * @return RouteInterface
	 */
	public function addPost($pattern, $paths=null, $position=Router::POSITION_LAST) {}

	/**
	 * Adds a route to the router that only match if the HTTP method is PUT
	 * 
	 * @param string $pattern
	 * @param mixed $paths
	 * @param mixed $position
	 *
	 * @return RouteInterface
	 */
	public function addPut($pattern, $paths=null, $position=Router::POSITION_LAST) {}

	/**
	 * Adds a route to the router that only match if the HTTP method is PATCH
	 * 
	 * @param string $pattern
	 * @param mixed $paths
	 * @param mixed $position
	 *
	 * @return RouteInterface
	 */
	public function addPatch($pattern, $paths=null, $position=Router::POSITION_LAST) {}

	/**
	 * Adds a route to the router that only match if the HTTP method is DELETE
	 * 
	 * @param string $pattern
	 * @param mixed $paths
	 * @param mixed $position
	 *
	 * @return RouteInterface
	 */
	public function addDelete($pattern, $paths=null, $position=Router::POSITION_LAST) {}

	/**
	 * Add a route to the router that only match if the HTTP method is OPTIONS
	 * 
	 * @param string $pattern
	 * @param mixed $paths
	 * @param mixed $position
	 *
	 * @return RouteInterface
	 */
	public function addOptions($pattern, $paths=null, $position=Router::POSITION_LAST) {}

	/**
	 * Adds a route to the router that only match if the HTTP method is HEAD
	 * 
	 * @param string $pattern
	 * @param mixed $paths
	 * @param mixed $position
	 *
	 * @return RouteInterface
	 */
	public function addHead($pattern, $paths=null, $position=Router::POSITION_LAST) {}

	/**
	 * Mounts a group of routes in the router
	 * 
	 * @param GroupInterface $group
	 *
	 * @return RouterInterface
	 */
	public function mount(GroupInterface $group) {}

	/**
		 * Get the before-match condition
	 * 
	 * @param mixed $paths
		 *
	 * @return RouterInterface
	 */
	public function notFound($paths) {}

	/**
	 * Removes all the pre-defined routes
	 *
	 * @return void
	 */
	public function clear() {}

	/**
	 * Returns the processed namespace name
	 *
	 * @return string
	 */
	public function getNamespaceName() {}

	/**
	 * Returns the processed module name
	 *
	 * @return string
	 */
	public function getModuleName() {}

	/**
	 * Returns the processed controller name
	 *
	 * @return string
	 */
	public function getControllerName() {}

	/**
	 * Returns the processed action name
	 *
	 * @return string
	 */
	public function getActionName() {}

	/**
	 * Returns the processed parameters
	 *
	 * @return array
	 */
	public function getParams() {}

	/**
	 * Returns the route that matchs the handled URI
	 *
	 * @return RouteInterface
	 */
	public function getMatchedRoute() {}

	/**
	 * Returns the sub expressions in the regular expression matched
	 *
	 * @return array
	 */
	public function getMatches() {}

	/**
	 * Checks if the router macthes any of the defined routes
	 *
	 * @return boolean
	 */
	public function wasMatched() {}

	/**
	 * Returns all the routes defined in the router
	 *
	 * @return RouteInterface[]
	 */
	public function getRoutes() {}

	/**
	 * Returns a route object by its id
	 * 
	 * @param mixed $id
	 *
	 * @return RouteInterface|boolean
	 */
	public function getRouteById($id) {}

	/**
	 * Returns a route object by its name
	 * 
	 * @param string $name
	 *
	 * @return RouteInterface|boolean
	 */
	public function getRouteByName($name) {}

	/**
	 * Returns whether controller name should not be mangled
	 *
	 * @return boolean
	 */
	public function isExactControllerName() {}

}
