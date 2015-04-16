<?php

namespace Phalcon\Mvc\Router;

class Annotations extends \Phalcon\Mvc\Router
{

    protected $_handlers;


    protected $_processed = false;


    protected $_controllerSuffix = "Controller";


    protected $_actionSuffix = "Action";


    protected $_routePrefix;


    /**
     * Adds a resource to the annotations handler
     * A resource is a class that contains routing annotations
     *
     * @param string $handler 
     * @param string $prefix 
     * @return \Phalcon\Mvc\Router\Annotations 
     */
	public function addResource($handler, $prefix = null) {}

    /**
     * Adds a resource to the annotations handler
     * A resource is a class that contains routing annotations
     * The class is located in a module
     *
     * @param string $module 
     * @param string $handler 
     * @param string $prefix 
     * @return \Phalcon\Mvc\Router\Annotations 
     */
	public function addModuleResource($module, $handler, $prefix = null) {}

    /**
     * Produce the routing parameters from the rewrite information
     *
     * @param string $uri 
     */
	public function handle($uri = null) {}

    /**
     * Checks for annotations in the controller docblock
     *
     * @param string $handler 
     * @param mixed $annotation 
     * @param \Phalcon\Annotations\Annotation  
     */
	public function processControllerAnnotation($handler, \Phalcon\Annotations\Annotation $annotation) {}

    /**
     * Checks for annotations in the public methods of the controller
     *
     * @param string $module 
     * @param string $namespaceName 
     * @param string $controller 
     * @param string $action 
     * @param \Phalcon\Annotations\Annotation $annotation 
     */
	public function processActionAnnotation($module, $namespaceName, $controller, $action, \Phalcon\Annotations\Annotation $annotation) {}

    /**
     * Changes the controller class suffix
     *
     * @param string $controllerSuffix 
     */
	public function setControllerSuffix($controllerSuffix) {}

    /**
     * Changes the action method suffix
     *
     * @param string $actionSuffix 
     */
	public function setActionSuffix($actionSuffix) {}

    /**
     * Return the registered resources
     *
     * @return array 
     */
	public function getResources() {}

}
