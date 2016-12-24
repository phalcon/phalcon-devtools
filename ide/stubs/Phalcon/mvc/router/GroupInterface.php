<?php

namespace Phalcon\Mvc\Router;

/**
 * Phalcon\Mvc\Router\GroupInterface
 *
 * <code>
 * $router = new \Phalcon\Mvc\Router();
 *
 * // Create a group with a common module and controller
 * $blog = new Group(
 *     [
 *         "module"     => "blog",
 *         "controller" => "index",
 *     ]
 * );
 *
 * // All the routes start with /blog
 * $blog->setPrefix("/blog");
 *
 * // Add a route to the group
 * $blog->add(
 *     "/save",
 *     [
 *         "action" => "save",
 *     ]
 * );
 *
 * // Add another route to the group
 * $blog->add(
 *     "/edit/{id}",
 *     [
 *         "action" => "edit",
 *     ]
 * );
 *
 * // This route maps to a controller different than the default
 * $blog->add(
 *     "/blog",
 *     [
 *         "controller" => "about",
 *         "action"     => "index",
 *     ]
 * );
 *
 * // Add the group to the router
 * $router->mount($blog);
 * </code>
 */
interface GroupInterface
{

    /**
     * Set a hostname restriction for all the routes in the group
     *
     * @param string $hostname
     * @return GroupInterface
     */
    public function setHostname($hostname);

    /**
     * Returns the hostname restriction
     *
     * @return string
     */
    public function getHostname();

    /**
     * Set a common uri prefix for all the routes in this group
     *
     * @param string $prefix
     * @return GroupInterface
     */
    public function setPrefix($prefix);

    /**
     * Returns the common prefix for all the routes
     *
     * @return string
     */
    public function getPrefix();

    /**
     * Sets a callback that is called if the route is matched.
     * The developer can implement any arbitrary conditions here
     * If the callback returns false the route is treated as not matched
     *
     * @param callable $beforeMatch
     * @return GroupInterface
     */
    public function beforeMatch($beforeMatch);

    /**
     * Returns the 'before match' callback if any
     *
     * @return callable
     */
    public function getBeforeMatch();

    /**
     * Set common paths for all the routes in the group
     *
     * @param array $paths
     * @return GroupInterface
     */
    public function setPaths($paths);

    /**
     * Returns the common paths defined for this group
     *
     * @return array|string
     */
    public function getPaths();

    /**
     * Returns the routes added to the group
     *
     * @return \Phalcon\Mvc\Router\RouteInterface[]
     */
    public function getRoutes();

    /**
     * Adds a route to the router on any HTTP method
     *
     * <code>
     * router->add("/about", "About::index");
     * </code>
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
     * Removes all the pre-defined routes
     */
    public function clear();

}
