<?php

namespace Phalcon\Mvc;

/**
 * Phalcon\Mvc\RouterInterface
 * Interface for Phalcon\Mvc\Router
 */
interface RouterInterface
{

    /**
     * Sets the name of the default module
     *
     * @param string $moduleName 
     */
    public function setDefaultModule($moduleName);

    /**
     * Sets the default controller name
     *
     * @param string $controllerName 
     */
    public function setDefaultController($controllerName);

    /**
     * Sets the default action name
     *
     * @param string $actionName 
     */
    public function setDefaultAction($actionName);

    /**
     * Sets an array of default paths
     *
     * @param array $defaults 
     */
    public function setDefaults(array $defaults);

    /**
     * Handles routing information received from the rewrite engine
     *
     * @param string $uri 
     */
    public function handle($uri = null);

    /**
     * Adds a route to the router on any HTTP method
     *
     * @param string $pattern 
     * @param mixed $paths 
     * @param mixed $httpMethods 
     * @return \Phalcon\Mvc\Router\RouteInterface 
     */
    public function add($pattern, $paths = null, $httpMethods = null);

    /**
     * Adds a route to the router that only match if the HTTP method is GET
     *
     * @param string $pattern 
     * @param mixed $paths 
     * @return \Phalcon\Mvc\Router\RouteInterface 
     */
    public function addGet($pattern, $paths = null);

    /**
     * Adds a route to the router that only match if the HTTP method is POST
     *
     * @param string $pattern 
     * @param mixed $paths 
     * @return \Phalcon\Mvc\Router\RouteInterface 
     */
    public function addPost($pattern, $paths = null);

    /**
     * Adds a route to the router that only match if the HTTP method is PUT
     *
     * @param string $pattern 
     * @param mixed $paths 
     * @return \Phalcon\Mvc\Router\RouteInterface 
     */
    public function addPut($pattern, $paths = null);

    /**
     * Adds a route to the router that only match if the HTTP method is PATCH
     *
     * @param string $pattern 
     * @param mixed $paths 
     * @return \Phalcon\Mvc\Router\RouteInterface 
     */
    public function addPatch($pattern, $paths = null);

    /**
     * Adds a route to the router that only match if the HTTP method is DELETE
     *
     * @param string $pattern 
     * @param mixed $paths 
     * @return \Phalcon\Mvc\Router\RouteInterface 
     */
    public function addDelete($pattern, $paths = null);

    /**
     * Add a route to the router that only match if the HTTP method is OPTIONS
     *
     * @param string $pattern 
     * @param mixed $paths 
     * @return \Phalcon\Mvc\Router\RouteInterface 
     */
    public function addOptions($pattern, $paths = null);

    /**
     * Adds a route to the router that only match if the HTTP method is HEAD
     *
     * @param string $pattern 
     * @param mixed $paths 
     * @return \Phalcon\Mvc\Router\RouteInterface 
     */
    public function addHead($pattern, $paths = null);

    /**
     * Adds a route to the router that only match if the HTTP method is PURGE (Squid and Varnish support)
     *
     * @param string $pattern 
     * @param mixed $paths 
     * @return \Phalcon\Mvc\Router\RouteInterface 
     */
    public function addPurge($pattern, $paths = null);

    /**
     * Adds a route to the router that only match if the HTTP method is TRACE
     *
     * @param string $pattern 
     * @param mixed $paths 
     * @return \Phalcon\Mvc\Router\RouteInterface 
     */
    public function addTrace($pattern, $paths = null);

    /**
     * Adds a route to the router that only match if the HTTP method is CONNECT
     *
     * @param string $pattern 
     * @param mixed $paths 
     * @return \Phalcon\Mvc\Router\RouteInterface 
     */
    public function addConnect($pattern, $paths = null);

    /**
     * Mounts a group of routes in the router
     *
     * @param mixed $group 
     * @return RouterInterface 
     */
    public function mount(\Phalcon\Mvc\Router\GroupInterface $group);

    /**
     * Removes all the defined routes
     */
    public function clear();

    /**
     * Returns processed module name
     *
     * @return string 
     */
    public function getModuleName();

    /**
     * Returns processed namespace name
     *
     * @return string 
     */
    public function getNamespaceName();

    /**
     * Returns processed controller name
     *
     * @return string 
     */
    public function getControllerName();

    /**
     * Returns processed action name
     *
     * @return string 
     */
    public function getActionName();

    /**
     * Returns processed extra params
     *
     * @return array 
     */
    public function getParams();

    /**
     * Returns the route that matches the handled URI
     *
     * @return \Phalcon\Mvc\Router\RouteInterface 
     */
    public function getMatchedRoute();

    /**
     * Return the sub expressions in the regular expression matched
     *
     * @return array 
     */
    public function getMatches();

    /**
     * Check if the router matches any of the defined routes
     *
     * @return bool 
     */
    public function wasMatched();

    /**
     * Return all the routes defined in the router
     *
     * @return RouteInterface[] 
     */
    public function getRoutes();

    /**
     * Returns a route object by its id
     *
     * @param mixed $id 
     * @return \Phalcon\Mvc\Router\RouteInterface 
     */
    public function getRouteById($id);

    /**
     * Returns a route object by its name
     *
     * @param string $name 
     * @return \Phalcon\Mvc\Router\RouteInterface 
     */
    public function getRouteByName($name);

}
