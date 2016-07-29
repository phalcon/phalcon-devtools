<?php

namespace Phalcon\Cli\Router;

/**
 * Phalcon\Cli\Router\RouteInterface
 * Interface for Phalcon\Cli\Router\Route
 */
interface RouteInterface
{

    /**
     * Replaces placeholders from pattern returning a valid PCRE regular expression
     *
     * @param string $pattern 
     * @return string 
     */
    public function compilePattern($pattern);

    /**
     * Reconfigure the route adding a new pattern and a set of paths
     *
     * @param string $pattern 
     * @param mixed $paths 
     */
    public function reConfigure($pattern, $paths = null);

    /**
     * Returns the route's name
     *
     * @return string 
     */
    public function getName();

    /**
     * Sets the route's name
     *
     * @param string $name 
     */
    public function setName($name);

    /**
     * Returns the route's id
     *
     * @return string 
     */
    public function getRouteId();

    /**
     * Returns the route's pattern
     *
     * @return string 
     */
    public function getPattern();

    /**
     * Returns the route's pattern
     *
     * @return string 
     */
    public function getCompiledPattern();

    /**
     * Returns the paths
     *
     * @return array 
     */
    public function getPaths();

    /**
     * Returns the paths using positions as keys and names as values
     *
     * @return array 
     */
    public function getReversedPaths();

    /**
     * Resets the internal route id generator
     */
    public static function reset();

}
