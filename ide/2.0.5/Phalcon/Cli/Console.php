<?php

namespace Phalcon\Cli;

use Phalcon\DiInterface;
use Phalcon\Cli\Router\Route;
use Phalcon\Events\ManagerInterface;
use Phalcon\Cli\Console\Exception;
use Phalcon\Di\InjectionAwareInterface;
use Phalcon\Events\EventsAwareInterface;


class Console implements InjectionAwareInterface, EventsAwareInterface
{

	protected $_dependencyInjector;

	protected $_eventsManager;

	protected $_modules;

	protected $_moduleObject;

	protected $_arguments;

	protected $_options;



	/**
	 * Phalcon\Cli\Console constructor
	 * 
	 * @param DiInterface $dependencyInjector
	 */
	public function __construct(DiInterface $dependencyInjector=null) {}

	/**
	 * Sets the DependencyInjector container
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
	 * Sets the events manager
	 * 
	 * @param ManagerInterface $eventsManager
	 *
	 * @return void
	 */
	public function setEventsManager(ManagerInterface $eventsManager) {}

	/**
	 * Returns the internal event manager
	 *
	 * @return ManagerInterface
	 */
	public function getEventsManager() {}

	/**
	 * Register an array of modules present in the console
	 *
	 *<code>
	 *	$application->registerModules(array(
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
	 *
	 * @return void
	 */
	public function registerModules(array $modules) {}

	/**
	 * Merge modules with the existing ones
	 *
	 *<code>
	 *	application->addModules(array(
	 *		'admin' => array(
	 *			'className' => 'Multiple\Admin\Module',
	 *			'path' => '../apps/admin/Module.php'
	 *		)
	 *	));
	 *</code>
	 * 
	 * @param array $modules
	 *
	 * @return void
	 */
	public function addModules(array $modules) {}

	/**
	 * Return the modules registered in the console
	 *
	 * @return array
	 */
	public function getModules() {}

	/**
	 * Handle the whole command-line tasks
	 * 
	 * @param array $arguments
	 *
	 * @return mixed
	 */
	public function handle(array $arguments=null) {}

	/**
	 * Set an specific argument
	 * 
	 * @param array $arguments
	 * @param boolean $str
	 * @param boolean $shift
	 *
	 * @return Console
	 */
	public function setArgument(array $arguments=null, $str=true, $shift=true) {}

}
