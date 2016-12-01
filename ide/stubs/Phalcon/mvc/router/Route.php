<?php

namespace Phalcon\Mvc\Router;

/**
 * Phalcon\Mvc\Router\Route
 *
 * This class represents every route added to the router
 */
class Route implements \Phalcon\Mvc\Router\RouteInterface
{

    protected $_pattern;


    protected $_compiledPattern;


    protected $_paths;


    protected $_methods;


    protected $_hostname;


    protected $_converters;


    protected $_id;


    protected $_name;


    protected $_beforeMatch;


    protected $_match;


    protected $_group;


    static protected $_uniqueId;


    /**
     * Phalcon\Mvc\Router\Route constructor
     *
     * @param string $pattern
     * @param mixed $paths
     * @param mixed $httpMethods
     */
    public function __construct($pattern, $paths = null, $httpMethods = null) {}

    /**
     * Replaces placeholders from pattern returning a valid PCRE regular expression
     *
     * @param string $pattern
     * @return string
     */
    public function compilePattern($pattern) {}

    /**
     * Set one or more HTTP methods that constraint the matching of the route
     *
     * <code>
     * $route->via("GET");
     *
     * $route->via(
     *     [
     *         "GET",
     *         "POST",
     *     ]
     * );
     * </code>
     *
     * @param mixed $httpMethods
     * @return Route
     */
    public function via($httpMethods) {}

    /**
     * Extracts parameters from a string
     *
     * @param string $pattern
     * @return array|bool
     */
    public function extractNamedParams($pattern) {}

    /**
     * Reconfigure the route adding a new pattern and a set of paths
     *
     * @param string $pattern
     * @param mixed $paths
     */
    public function reConfigure($pattern, $paths = null) {}

    /**
     * Returns routePaths
     *
     * @param mixed $paths
     * @return array
     */
    public static function getRoutePaths($paths = null) {}

    /**
     * Returns the route's name
     *
     * @return string
     */
    public function getName() {}

    /**
     * Sets the route's name
     *
     * <code>
     * $router->add(
     *     "/about",
     *     [
     *         "controller" => "about",
     *     ]
     * )->setName("about");
     * </code>
     *
     * @param string $name
     * @return Route
     */
    public function setName($name) {}

    /**
     * Sets a callback that is called if the route is matched.
     * The developer can implement any arbitrary conditions here
     * If the callback returns false the route is treated as not matched
     *
     * <code>
     * $router->add(
     *     "/login",
     *     [
     *         "module"     => "admin",
     *         "controller" => "session",
     *     ]
     * )->beforeMatch(
     *     function ($uri, $route) {
     *         // Check if the request was made with Ajax
     *         if ($_SERVER["HTTP_X_REQUESTED_WITH"] === "xmlhttprequest") {
     *             return false;
     *         }
     *
     *         return true;
     *     }
     * );
     * </code>
     *
     * @param mixed $callback
     * @return Route
     */
    public function beforeMatch($callback) {}

    /**
     * Returns the 'before match' callback if any
     *
     * @return callable
     */
    public function getBeforeMatch() {}

    /**
     * Allows to set a callback to handle the request directly in the route
     *
     * <code>
     * $router->add(
     *     "/help",
     *     []
     * )->match(
     *     function () {
     *         return $this->getResponse()->redirect("https://support.google.com/", true);
     *     }
     * );
     * </code>
     *
     * @param mixed $callback
     * @return Route
     */
    public function match($callback) {}

    /**
     * Returns the 'match' callback if any
     *
     * @return callable
     */
    public function getMatch() {}

    /**
     * Returns the route's id
     *
     * @return string
     */
    public function getRouteId() {}

    /**
     * Returns the route's pattern
     *
     * @return string
     */
    public function getPattern() {}

    /**
     * Returns the route's compiled pattern
     *
     * @return string
     */
    public function getCompiledPattern() {}

    /**
     * Returns the paths
     *
     * @return array
     */
    public function getPaths() {}

    /**
     * Returns the paths using positions as keys and names as values
     *
     * @return array
     */
    public function getReversedPaths() {}

    /**
     * Sets a set of HTTP methods that constraint the matching of the route (alias of via)
     *
     * <code>
     * $route->setHttpMethods("GET");
     * $route->setHttpMethods(["GET", "POST"]);
     * </code>
     *
     * @param mixed $httpMethods
     * @return Route
     */
    public function setHttpMethods($httpMethods) {}

    /**
     * Returns the HTTP methods that constraint matching the route
     *
     * @return array|string
     */
    public function getHttpMethods() {}

    /**
     * Sets a hostname restriction to the route
     *
     * <code>
     * $route->setHostname("localhost");
     * </code>
     *
     * @param string $hostname
     * @return Route
     */
    public function setHostname($hostname) {}

    /**
     * Returns the hostname restriction if any
     *
     * @return string
     */
    public function getHostname() {}

    /**
     * Sets the group associated with the route
     *
     * @param GroupInterface $group
     * @return Route
     */
    public function setGroup(GroupInterface $group) {}

    /**
     * Returns the group associated with the route
     *
     * @return null|GroupInterface
     */
    public function getGroup() {}

    /**
     * Adds a converter to perform an additional transformation for certain parameter
     *
     * @param string $name
     * @param mixed $converter
     * @return Route
     */
    public function convert($name, $converter) {}

    /**
     * Returns the router converter
     *
     * @return array
     */
    public function getConverters() {}

    /**
     * Resets the internal route id generator
     */
    public static function reset() {}

}
