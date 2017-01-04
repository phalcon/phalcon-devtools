<?php

namespace Phalcon\Cli;

use Phalcon\DiInterface;
use Phalcon\Cli\Router\Route;
use Phalcon\CLi\Router\Exception;


class Router implements \Phalcon\Di\InjectionAwareInterface
{

	protected $_dependencyInjector;

	protected $_module;

	protected $_task;

	protected $_action;

	protected $_params;

	protected $_defaultModule = null;

	protected $_defaultTask = null;

	protected $_defaultAction = null;

	protected $_defaultParams;

	protected $_routes;

	protected $_matchedRoute;

	protected $_matches;

	protected $_wasMatched = false;



	/**
	 * Phalcon\Cli\Router constructor
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
	 * Sets the name of the default module
	 * 
	 * @param string $moduleName
	 *
	 * @return void
	 */
	public function setDefaultModule($moduleName) {}

	/**
	 * Sets the default controller name
	 * 
	 * @param string $taskName
	 *
	 * @return void
	 */
	public function setDefaultTask($taskName) {}

	/**
	 * Sets the default action name
	 * 
	 * @param string $actionName
	 *
	 * @return void
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
	 * @return Router
	 */
	public function setDefaults(array $defaults) {}

	/**
	 * Handles routing information received from command-line arguments
	 * 
	 * @param array $arguments
	 *
	 *
	 * @return mixed
	 */
	public function handle($arguments=null) {}

	/**
				 * If the route has parentheses use preg_match
	 * 
	 * @param string $pattern
	 * @param $paths
				 *
	 * @return Route
	 */
	public function add($pattern, $paths=null) {}

	/**
	 * Returns proccesed module name
	 *
	 * @return string
	 */
	public function getModuleName() {}

	/**
	 * Returns proccesed task name
	 *
	 * @return string
	 */
	public function getTaskName() {}

	/**
	 * Returns proccesed action name
	 *
	 * @return string
	 */
	public function getActionName() {}

	/**
	 * Returns proccesed extra params
	 *
	 * @return mixed
	 */
	public function getParams() {}

	/**
	 * Returns the route that matchs the handled URI
	 *
	 * @return Route
	 */
	public function getMatchedRoute() {}

	/**
	 * Returns the sub expressions in the regular expression matched
	 *
	 * @return mixed
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
	 * @return Route[]
	 */
	public function getRoutes() {}

	/**
	 * Returns a route object by its id
	 *
	 * @param mixed $id
	 * 
	 * @return Route|boolean
	 */
	public function getRouteById($id) {}

	/**
	 * Returns a route object by its name
	 * 
	 * @param string $name
	 *
	 * @return Route|boolean
	 */
	public function getRouteByName($name) {}

}
