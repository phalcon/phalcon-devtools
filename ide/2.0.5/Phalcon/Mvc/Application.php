<?php

namespace Phalcon\Mvc;

use Phalcon\Di\Injectable;
use Phalcon\Mvc\ViewInterface;
use Phalcon\Mvc\Application\Exception;
use Phalcon\Mvc\ModuleDefinitionInterface;
use Phalcon\Mvc\RouterInterface;
use Phalcon\DiInterface;
use Phalcon\Http\ResponseInterface;
use Phalcon\Events\ManagerInterface;
use Phalcon\Mvc\DispatcherInterface;


class Application extends Injectable
{

	protected $_defaultModule;

	protected $_modules;

	protected $_implicitView = true;



	/**
	 * Phalcon\Mvc\Application
	 * 
	 * @param DiInterface $dependencyInjector
	 */
	public function __construct(DiInterface $dependencyInjector=null) {}

	/**
	 * By default. The view is implicitly buffering all the output
	 * You can full disable the view component using this method
	 * 
	 * @param boolean $implicitView
	 *
	 * @return Application
	 */
	public function useImplicitView($implicitView) {}

	/**
	 * Register an array of modules present in the application
	 *
	 *<code>
	 *	$this->registerModules(array(
	 *		'frontend' => array(
	 *			'className' => 'Multiple\Frontend\Module',
	 *			'path' => '../apps/frontend/Module.php'
	 *		),
	 *		'backend' => array(
	 *			'className' => 'Multiple\Backend\Module',
	 *			'path' => '../apps/backend/Module.php'
	 *		)
	 *	));
	 *</code>
	 * 
	 * @param array $modules
	 * @param boolean $merge
	 *
	 * @return Application
	 */
	public function registerModules(array $modules, $merge=false) {}

	/**
	 * Return the modules registered in the application
	 *
	 * @return mixed
	 */
	public function getModules() {}

	/**
	 * Gets the module definition registered in the application via module name
	 *
	 * @param string $name
	 * 
	 * @return mixed
	 */
	public function getModule($name) {}

	/**
	 * Sets the module name to be used if the router doesn't return a valid module
	 * 
	 * @param string $defaultModule
	 *
	 * @return Application
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
	 * 
	 * @return ResponseInterface|boolean
	 */
	public function handle($uri=null) {}

}
