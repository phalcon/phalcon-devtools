<?php

namespace Phalcon\Mvc;

/**
 * Phalcon\Mvc\Router
 *
 * Phalcon\Mvc\Router is the standard framework router. Routing is the
 * process of taking a URI endpoint (that part of the URI which comes after the base URL) and
 * decomposing it into parameters to determine which module, controller, and
 * action of that controller should receive the request
 *
 * <code>
 * use Phalcon\Mvc\Router;
 *
 * $router = new Router();
 *
 * $router->add(
 *     "/documentation/{chapter}/{name}\.{type:[a-z]+}",
 *     [
 *         "controller" => "documentation",
 *         "action"     => "show",
 *     ]
 * );
 *
 * $router->handle();
 *
 * echo $router->getControllerName();
 * </code>
 */
class Router implements \Phalcon\Di\InjectionAwareInterface, \Phalcon\Mvc\RouterInterface, \Phalcon\Events\EventsAwareInterface
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


    protected $_params = array();


    protected $_routes;


    protected $_matchedRoute;


    protected $_matches;


    protected $_wasMatched = false;


    protected $_defaultNamespace;


    protected $_defaultModule;


    protected $_defaultController;


    protected $_defaultAction;


    protected $_defaultParams = array();


    protected $_removeExtraSlashes;


    protected $_notFoundPaths;


    /**
     * Phalcon\Mvc\Router constructor
     *
     * @param bool $defaultRoutes
     */
    public function __construct($defaultRoutes = true) {}

    /**
     * Sets the dependency injector
     *
     * @param \Phalcon\DiInterface $dependencyInjector
     */
    public function setDI(\Phalcon\DiInterface $dependencyInjector) {}

    /**
     * Returns the internal dependency injector
     *
     * @return \Phalcon\DiInterface
     */
    public function getDI() {}

    /**
     * Sets the events manager
     *
     * @param \Phalcon\Events\ManagerInterface $eventsManager
     */
    public function setEventsManager(\Phalcon\Events\ManagerInterface $eventsManager) {}

    /**
     * Returns the internal event manager
     *
     * @return \Phalcon\Events\ManagerInterface
     */
    public function getEventsManager() {}

    /**
     * Get rewrite info. This info is read from $_GET["_url"]. This returns '/' if the rewrite information cannot be read
     *
     * @return string
     */
    public function getRewriteUri() {}

    /**
     * Sets the URI source. One of the URI_SOURCE_ constants
     *
     * <code>
     * $router->setUriSource(
     *     Router::URI_SOURCE_SERVER_REQUEST_URI
     * );
     * </code>
     *
     * @param mixed $uriSource
     * @return RouterInterface
     */
    public function setUriSource($uriSource) {}

    /**
     * Set whether router must remove the extra slashes in the handled routes
     *
     * @param bool $remove
     * @return RouterInterface
     */
    public function removeExtraSlashes($remove) {}

    /**
     * Sets the name of the default namespace
     *
     * @param string $namespaceName
     * @return RouterInterface
     */
    public function setDefaultNamespace($namespaceName) {}

    /**
     * Sets the name of the default module
     *
     * @param string $moduleName
     * @return RouterInterface
     */
    public function setDefaultModule($moduleName) {}

    /**
     * Sets the default controller name
     *
     * @param string $controllerName
     * @return RouterInterface
     */
    public function setDefaultController($controllerName) {}

    /**
     * Sets the default action name
     *
     * @param string $actionName
     * @return RouterInterface
     */
    public function setDefaultAction($actionName) {}

    /**
     * Sets an array of default paths. If a route is missing a path the router will use the defined here
     * This method must not be used to set a 404 route
     *
     * <code>
     * $router->setDefaults(
     *     [
     *         "module" => "common",
     *         "action" => "index",
     *     ]
     * );
     * </code>
     *
     * @param array $defaults
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
     * <code>
     * // Read the info from the rewrite engine
     * $router->handle();
     *
     * // Manually passing an URL
     * $router->handle("/posts/edit/1");
     * </code>
     *
     * @param string $uri
     */
    public function handle($uri = null) {}

    /**
     * Adds a route to the router without any HTTP constraint
     *
     * <code>
     * use Phalcon\Mvc\Router;
     *
     * $router->add("/about", "About::index");
     * $router->add("/about", "About::index", ["GET", "POST"]);
     * $router->add("/about", "About::index", ["GET", "POST"], Router::POSITION_FIRST);
     * </code>
     *
     * @param string $pattern
     * @param mixed $paths
     * @param mixed $httpMethods
     * @param mixed $position
     * @return \Phalcon\Mvc\Router\RouteInterface
     */
    public function add($pattern, $paths = null, $httpMethods = null, $position = Router::POSITION_LAST) {}

    /**
     * Adds a route to the router that only match if the HTTP method is GET
     *
     * @param string $pattern
     * @param mixed $paths
     * @param mixed $position
     * @return \Phalcon\Mvc\Router\RouteInterface
     */
    public function addGet($pattern, $paths = null, $position = Router::POSITION_LAST) {}

    /**
     * Adds a route to the router that only match if the HTTP method is POST
     *
     * @param string $pattern
     * @param mixed $paths
     * @param mixed $position
     * @return \Phalcon\Mvc\Router\RouteInterface
     */
    public function addPost($pattern, $paths = null, $position = Router::POSITION_LAST) {}

    /**
     * Adds a route to the router that only match if the HTTP method is PUT
     *
     * @param string $pattern
     * @param mixed $paths
     * @param mixed $position
     * @return \Phalcon\Mvc\Router\RouteInterface
     */
    public function addPut($pattern, $paths = null, $position = Router::POSITION_LAST) {}

    /**
     * Adds a route to the router that only match if the HTTP method is PATCH
     *
     * @param string $pattern
     * @param mixed $paths
     * @param mixed $position
     * @return \Phalcon\Mvc\Router\RouteInterface
     */
    public function addPatch($pattern, $paths = null, $position = Router::POSITION_LAST) {}

    /**
     * Adds a route to the router that only match if the HTTP method is DELETE
     *
     * @param string $pattern
     * @param mixed $paths
     * @param mixed $position
     * @return \Phalcon\Mvc\Router\RouteInterface
     */
    public function addDelete($pattern, $paths = null, $position = Router::POSITION_LAST) {}

    /**
     * Add a route to the router that only match if the HTTP method is OPTIONS
     *
     * @param string $pattern
     * @param mixed $paths
     * @param mixed $position
     * @return \Phalcon\Mvc\Router\RouteInterface
     */
    public function addOptions($pattern, $paths = null, $position = Router::POSITION_LAST) {}

    /**
     * Adds a route to the router that only match if the HTTP method is HEAD
     *
     * @param string $pattern
     * @param mixed $paths
     * @param mixed $position
     * @return \Phalcon\Mvc\Router\RouteInterface
     */
    public function addHead($pattern, $paths = null, $position = Router::POSITION_LAST) {}

    /**
     * Adds a route to the router that only match if the HTTP method is PURGE (Squid and Varnish support)
     *
     * @param string $pattern
     * @param mixed $paths
     * @param mixed $position
     * @return \Phalcon\Mvc\Router\RouteInterface
     */
    public function addPurge($pattern, $paths = null, $position = Router::POSITION_LAST) {}

    /**
     * Adds a route to the router that only match if the HTTP method is TRACE
     *
     * @param string $pattern
     * @param mixed $paths
     * @param mixed $position
     * @return \Phalcon\Mvc\Router\RouteInterface
     */
    public function addTrace($pattern, $paths = null, $position = Router::POSITION_LAST) {}

    /**
     * Adds a route to the router that only match if the HTTP method is CONNECT
     *
     * @param string $pattern
     * @param mixed $paths
     * @param mixed $position
     * @return \Phalcon\Mvc\Router\RouteInterface
     */
    public function addConnect($pattern, $paths = null, $position = Router::POSITION_LAST) {}

    /**
     * Mounts a group of routes in the router
     *
     * @param \Phalcon\Mvc\Router\GroupInterface $group
     * @return RouterInterface
     */
    public function mount(\Phalcon\Mvc\Router\GroupInterface $group) {}

    /**
     * Set a group of paths to be returned when none of the defined routes are matched
     *
     * @param mixed $paths
     * @return RouterInterface
     */
    public function notFound($paths) {}

    /**
     * Removes all the pre-defined routes
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
     * Returns the route that matches the handled URI
     *
     * @return \Phalcon\Mvc\Router\RouteInterface
     */
    public function getMatchedRoute() {}

    /**
     * Returns the sub expressions in the regular expression matched
     *
     * @return array
     */
    public function getMatches() {}

    /**
     * Checks if the router matches any of the defined routes
     *
     * @return bool
     */
    public function wasMatched() {}

    /**
     * Returns all the routes defined in the router
     *
     * @return \Phalcon\Mvc\Router\RouteInterface[]
     */
    public function getRoutes() {}

    /**
     * Returns a route object by its id
     *
     * @param mixed $id
     * @return bool|\Phalcon\Mvc\Router\RouteInterface
     */
    public function getRouteById($id) {}

    /**
     * Returns a route object by its name
     *
     * @param string $name
     * @return bool|\Phalcon\Mvc\Router\RouteInterface
     */
    public function getRouteByName($name) {}

    /**
     * Returns whether controller name should not be mangled
     *
     * @return bool
     */
    public function isExactControllerName() {}

}
