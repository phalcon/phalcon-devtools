<?php

namespace Phalcon\Mvc\Router;

use Phalcon\DiInterface;
use Phalcon\Mvc\Router;
use Phalcon\Annotations\Annotation;
use Phalcon\Mvc\Router\Exception;


class Annotations extends Router
{

	protected $_handlers;

	protected $_processed = false;

	protected $_controllerSuffix = 'Controller';

	protected $_actionSuffix = 'Action';

	protected $_routePrefix;



	/**
	 * Adds a resource to the annotations handler
	 * A resource is a class that contains routing annotations
	 * 
	 * @param string $handler
	 * @param string $prefix
	 *
	 * @return Annotations
	 */
	public function addResource($handler, $prefix=null) {}

	/**
	 * Adds a resource to the annotations handler
	 * A resource is a class that contains routing annotations
	 * The class is located in a module
	 * 
	 * @param string $module
	 * @param string $handler
	 * @param string $prefix
	 *
	 * @return Annotations
	 */
	public function addModuleResource($module, $handler, $prefix=null) {}

	/**
	 * Produce the routing parameters from the rewrite information
	 * 
	 * @param string $uri
	 *
	 * @return void
	 */
	public function handle($uri=null) {}

	/**
			 * If 'uri' isn't passed as parameter it reads _GET['_url']
	 * 
	 * @param string $handler
	 * @param Annotation $annotation
			 *
	 * @return void
	 */
	public function processControllerAnnotation($handler, Annotation $annotation) {}

	/**
		 * @RoutePrefix add a prefix for all the routes defined in the model
	 * 
	 * @param string $module
	 * @param string $namespaceName
	 * @param string $controller
	 * @param string $action
	 * @param Annotation $annotation
		 *
	 * @return mixed
	 */
	public function processActionAnnotation($module, $namespaceName, $controller, $action, Annotation $annotation) {}

	/**
		 * Find if the route is for adding routes
	 * 
	 * @param string $controllerSuffix
		 *
	 * @return void
	 */
	public function setControllerSuffix($controllerSuffix) {}

	/**
	 * Changes the action method suffix
	 * 
	 * @param string $actionSuffix
	 *
	 * @return void
	 */
	public function setActionSuffix($actionSuffix) {}

	/**
	 * Return the registered resources
	 *
	 * @return mixed
	 */
	public function getResources() {}

}
