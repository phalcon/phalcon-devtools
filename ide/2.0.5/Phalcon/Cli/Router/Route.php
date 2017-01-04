<?php

namespace Phalcon\Cli\Router;

class Route
{

	const DEFAULT_DELIMITER = " ";



	protected $_pattern;

	protected $_compiledPattern;

	protected $_paths;

	protected $_converters;

	protected $_id;

	protected $_name;

	protected $_beforeMatch;

	protected $_delimiter;

	protected static $_uniqueId;

	protected static $_delimiterPath;



	/**
	 * Phalcon\Cli\Router\Route constructor
	 * 
	 * @param string $pattern
	 * @param array $paths
	 *
	 */
	public function __construct($pattern, $paths=null) {}

	/**
	 * Replaces placeholders from pattern returning a valid PCRE regular expression
	 * 
	 * @param string $pattern
	 *
	 * @return string
	 */
	public function compilePattern($pattern) {}

	/**
	 * Extracts parameters from a string
	 *
	 * @param string $pattern
	 * 
	 * @return mixed
	 */
	public function extractNamedParams($pattern) {}

	/**
	 * Reconfigure the route adding a new pattern and a set of paths
	 * 
	 * @param string $pattern
	 * @param array $paths
	 *
	 *
	 * @return void
	 */
	public function reConfigure($pattern, $paths=null) {}

	/**
		 * If the route starts with '#' we assume that it is a regular expression
		 *
	 * @return string
	 */
	public function getName() {}

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
	 *
	 * @return Route
	 */
	public function setName($name) {}

	/**
	 * Sets a callback that is called if the route is matched.
	 * The developer can implement any arbitrary conditions here
	 * If the callback returns false the route is treated as not matched
	 *
	 * @param mixed $callback
	 * 
	 * @return Route
	 */
	public function beforeMatch($callback) {}

	/**
	 * Returns the 'before match' callback if any
	 *
	 * @return mixed
	 */
	public function getBeforeMatch() {}

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
	 * Adds a converter to perform an additional transformation for certain parameter
	 *
	 * @param string $name
	 * @param callable $converter
	 * 
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
	 *
	 * @return void
	 */
	public static function reset() {}

	/**
	 * Set the routing delimiter
	 * 
	 * @param string $delimiter
	 *
	 * @return void
	 */
	public static function delimiter($delimiter=null) {}

	/**
	 * Get routing delimiter
	 *
	 * @return string
	 */
	public static function getDelimiter() {}

}
