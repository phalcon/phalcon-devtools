<?php

namespace Phalcon\Cli;

/**
 * Phalcon\Cli\RouterInterface
 *
 * Interface for Phalcon\Cli\Router
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
     * Sets the default task name
     *
     * @param string $taskName
     */
    public function setDefaultTask($taskName);

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
     * @param array $arguments
     */
    public function handle($arguments = null);

    /**
     * Adds a route to the router on any HTTP method
     *
     * @param string $pattern
     * @param mixed $paths
     * @return \Phalcon\Cli\Router\RouteInterface
     */
    public function add($pattern, $paths = null);

    /**
     * Returns processed module name
     *
     * @return string
     */
    public function getModuleName();

    /**
     * Returns processed task name
     *
     * @return string
     */
    public function getTaskName();

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
     * @return \Phalcon\Cli\Router\RouteInterface
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
     * @return \Phalcon\Cli\Router\RouteInterface[]
     */
    public function getRoutes();

    /**
     * Returns a route object by its id
     *
     * @param mixed $id
     * @return \Phalcon\Cli\Router\RouteInterface
     */
    public function getRouteById($id);

    /**
     * Returns a route object by its name
     *
     * @param string $name
     * @return \Phalcon\Cli\Router\RouteInterface
     */
    public function getRouteByName($name);

}
