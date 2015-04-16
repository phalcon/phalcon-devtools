<?php

namespace Phalcon\Mvc;

class Application extends \Phalcon\Di\Injectable
{

    protected $_defaultModule;


    protected $_modules;


    protected $_implicitView = true;


    /**
     * Phalcon\Mvc\Application
     *
     * @param \Phalcon\DiInterface $dependencyInjector 
     */
	public function __construct(\Phalcon\DiInterface $dependencyInjector = null) {}

    /**
     * By default. The view is implicitly buffering all the output
     * You can full disable the view component using this method
     *
     * @param boolean $implicitView 
     * @return \Phalcon\Mvc\Application 
     */
	public function useImplicitView($implicitView) {}

    /**
     * Register an array of modules present in the application
     * <code>
     * $this->registerModules(array(
     * 'frontend' => array(
     * 'className' => 'Multiple\Frontend\Module',
     * 'path' => '../apps/frontend/Module.php'
     * ),
     * 'backend' => array(
     * 'className' => 'Multiple\Backend\Module',
     * 'path' => '../apps/backend/Module.php'
     * )
     * ));
     * </code>
     *
     * @param array $modules 
     * @param boolean $merge 
     * @param \Phalcon\Mvc\Application  
     * @return Application 
     */
	public function registerModules($modules, $merge = false) {}

    /**
     * Return the modules registered in the application
     *
     * @return array 
     */
	public function getModules() {}

    /**
     * Gets the module definition registered in the application via module name
     *
     * @param string $name 
     * @return array|object 
     */
	public function getModule($name) {}

    /**
     * Sets the module name to be used if the router doesn't return a valid module
     *
     * @param string $defaultModule 
     * @return \Phalcon\Mvc\Application 
     */
	public function setDefaultModule($defaultModule) {}

    /**
     * Returns the default module name
     *
     * @return string 
     */
	public function getDefaultModule() {}

    /**
     * Handles a MVC request
     *
     * @param string $uri 
     * @return \Phalcon\Http\ResponseInterface|boolean 
     */
	public function handle($uri = null) {}

}
