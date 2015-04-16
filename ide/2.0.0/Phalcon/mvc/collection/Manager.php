<?php

namespace Phalcon\Mvc\Collection;

class Manager implements \Phalcon\Di\InjectionAwareInterface, \Phalcon\Events\EventsAwareInterface
{

    protected $_dependencyInjector;


    protected $_initialized;


    protected $_lastInitialized;


    protected $_eventsManager;


    protected $_customEventsManager;


    protected $_connectionServices;


    protected $_implicitObjectsIds;


    /**
     * Sets the DependencyInjector container
     *
     * @param mixed $dependencyInjector 
     * @param \Phalcon\DiInterface $$dependencyInjector 
     */
	public function setDI(\Phalcon\DiInterface $dependencyInjector) {}

    /**
     * Returns the DependencyInjector container
     *
     * @return \Phalcon\DiInterface 
     */
	public function getDI() {}

    /**
     * Sets the event manager
     *
     * @param mixed $eventsManager 
     * @param \Phalcon\Events\ManagerInterface $$eventsManager 
     */
	public function setEventsManager(\Phalcon\Events\ManagerInterface $eventsManager) {}

    /**
     * Returns the internal event manager
     *
     * @return \Phalcon\Events\ManagerInterface 
     */
	public function getEventsManager() {}

    /**
     * Sets a custom events manager for a specific model
     *
     * @param mixed $model 
     * @param mixed $eventsManager 
     * @param \Phalcon\Mvc\CollectionInterface $$model 
     * @param \Phalcon\Events\ManagerInterface $$eventsManager 
     */
	public function setCustomEventsManager(\Phalcon\Mvc\CollectionInterface $model, \Phalcon\Events\ManagerInterface $eventsManager) {}

    /**
     * Returns a custom events manager related to a model
     *
     * @param mixed $model 
     * @param \Phalcon\Mvc\CollectionInterface $$model 
     * @return \Phalcon\Events\ManagerInterface 
     */
	public function getCustomEventsManager(\Phalcon\Mvc\CollectionInterface $model) {}

    /**
     * Initializes a model in the models manager
     *
     * @param \Phalcon\Mvc\CollectionInterface $model 
     */
	public function initialize(\Phalcon\Mvc\CollectionInterface $model) {}

    /**
     * Check whether a model is already initialized
     *
     * @param mixed $modelName 
     * @param string $$modelName 
     * @return bool 
     */
	public function isInitialized($modelName) {}

    /**
     * Get the latest initialized model
     *
     * @return \Phalcon\Mvc\CollectionInterface 
     */
	public function getLastInitialized() {}

    /**
     * Sets a connection service for a specific model
     *
     * @param \Phalcon\Mvc\CollectionInterface $model 
     * @param string $connectionService 
     */
	public function setConnectionService(\Phalcon\Mvc\CollectionInterface $model, $connectionService) {}

    /**
     * Sets whether a model must use implicit objects ids
     *
     * @param \Phalcon\Mvc\CollectionInterface $model 
     * @param boolean $useImplicitObjectIds 
     */
	public function useImplicitObjectIds(\Phalcon\Mvc\CollectionInterface $model, $useImplicitObjectIds) {}

    /**
     * Checks if a model is using implicit object ids
     *
     * @param \Phalcon\Mvc\CollectionInterface $model 
     * @return boolean 
     */
	public function isUsingImplicitObjectIds(\Phalcon\Mvc\CollectionInterface $model) {}

    /**
     * Returns the connection related to a model
     *
     * @param mixed $model 
     * @param \Phalcon\Mvc\CollectionInterface $$model 
     * @return \Mongo 
     */
	public function getConnection(\Phalcon\Mvc\CollectionInterface $model) {}

    /**
     * Receives events generated in the models and dispatches them to a events-manager if available
     * Notify the behaviors that are listening in the model
     *
     * @param string $eventName 
     * @param \Phalcon\Mvc\CollectionInterface $model 
     */
	public function notifyEvent($eventName, \Phalcon\Mvc\CollectionInterface $model) {}

}
