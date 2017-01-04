<?php

namespace Phalcon\Di;

use Phalcon\Di;
use Phalcon\DiInterface;
use Phalcon\Events\ManagerInterface;
use Phalcon\Di\InjectionAwareInterface;
use Phalcon\Events\EventsAwareInterface;
use Phalcon\Di\Exception;
use Phalcon\Session\BagInterface;


abstract class Injectable implements InjectionAwareInterface, EventsAwareInterface
{

	/**
	 * Dependency Injector
	 *
	 * @var \Phalcon\DiInterface
	 */
	protected $_dependencyInjector;

	/**
	 * Events Manager
	 *
	 * @var \Phalcon\Events\ManagerInterface
	 */
	protected $_eventsManager;



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
	 * Sets the event manager
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
	 * Magic method __get
	 * 
	 * @param string $propertyName
	 *
	 * @return mixed
	 */
	public function __get($propertyName) {}

}
