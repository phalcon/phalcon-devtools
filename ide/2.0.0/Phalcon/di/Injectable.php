<?php

namespace Phalcon\Di;

abstract class Injectable implements \Phalcon\Di\InjectionAwareInterface, \Phalcon\Events\EventsAwareInterface
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
     * @param mixed $dependencyInjector 
     */
	public function setDI(\Phalcon\DiInterface $dependencyInjector) {}

    /**
     * Returns the internal dependency injector
     *
     * @return \Phalcon\DiInterface 
     */
	public function getDI() {}

    /**
     * Sets the event manager
     *
     * @param mixed $eventsManager 
     */
	public function setEventsManager(\Phalcon\Events\ManagerInterface $eventsManager) {}

    /**
     * Returns the internal event manager
     *
     * @return \Phalcon\Events\ManagerInterface 
     */
	public function getEventsManager() {}

    /**
     * Magic method __get
     *
     * @param string $propertyName 
     */
	public function __get($propertyName) {}

}
