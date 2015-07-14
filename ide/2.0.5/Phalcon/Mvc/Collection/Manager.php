<?php

namespace Phalcon\Mvc\Collection;

use Phalcon\DiInterface;
use Phalcon\Di\InjectionAwareInterface;
use Phalcon\Events\EventsAwareInterface;
use Phalcon\Events\ManagerInterface;
use Phalcon\Mvc\CollectionInterface;
use Phalcon\Mvc\Collection\BehaviorInterface;


class Manager implements InjectionAwareInterface, EventsAwareInterface
{

	protected $_dependencyInjector;

	protected $_initialized;

	protected $_lastInitialized;

	protected $_eventsManager;

	protected $_customEventsManager;

	protected $_connectionServices;

	protected $_implicitObjectsIds;

	protected $_behaviors;



	/**
	 * Sets the DependencyInjector container
	 * 
	 * @param DiInterface $dependencyInjector
	 *
	 * @return void
	 */
	public function setDI(DiInterface $dependencyInjector) {}

	/**
	 * Returns the DependencyInjector container
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
	 * Sets a custom events manager for a specific model
	 * 
	 * @param CollectionInterface $model
	 * @param ManagerInterface $eventsManager
	 *
	 * @return void
	 */
	public function setCustomEventsManager(CollectionInterface $model, ManagerInterface $eventsManager) {}

	/**
	 * Returns a custom events manager related to a model
	 *
	 * @param CollectionInterface $model
	 * 
 	 * @return mixed
	 */
	public function getCustomEventsManager(CollectionInterface $model) {}

	/**
	 * Initializes a model in the models manager
	 * 
	 * @param CollectionInterface $model
	 *
	 * @return void
	 */
	public function initialize(CollectionInterface $model) {}

	/**
		* Models are just initialized once per request
	 * 
	 * @param string $modelName
		*
	 * @return boolean
	 */
	public function isInitialized($modelName) {}

	/**
	 * Get the latest initialized model
	 *
	 * @return CollectionInterface
	 */
	public function getLastInitialized() {}

	/**
	 * Sets a connection service for a specific model
	 * 
	 * @param CollectionInterface $model
	 * @param string $connectionService
	 *
	 * @return void
	 */
	public function setConnectionService(CollectionInterface $model, $connectionService) {}

	/**
	 * Sets whether a model must use implicit objects ids
	 * 
	 * @param CollectionInterface $model
	 * @param boolean $useImplicitObjectIds
	 *
	 * @return void
	 */
	public function useImplicitObjectIds(CollectionInterface $model, $useImplicitObjectIds) {}

	/**
	 * Checks if a model is using implicit object ids
	 * 
	 * @param CollectionInterface $model
	 *
	 * @return boolean
	 */
	public function isUsingImplicitObjectIds(CollectionInterface $model) {}

	/**
		* All collections use by default are using implicit object ids
	 * 
	 * @param CollectionInterface $model
		*
	 * @return mixed
	 */
	public function getConnection(CollectionInterface $model) {}

	/**
			* Check if the model has a custom connection service
	 * 
	 * @param string $eventName
	 * @param CollectionInterface $model
			*
	 * @return mixed
	 */
	public function notifyEvent($eventName, CollectionInterface $model) {}

	/**
				 * Notify all the events on the behavior
	 * 
	 * @param CollectionInterface $model
	 * @param string $eventName
	 * @param mixed $data
				 *
	 * @return boolean
	 */
	public function missingMethod(CollectionInterface $model, $eventName, $data) {}

	/**
		 * Dispatch events to the global events manager
	 * 
	 * @param CollectionInterface $model
	 * @param BehaviorInterface $behavior
		 *
	 * @return void
	 */
	public function addBehavior(CollectionInterface $model, BehaviorInterface $behavior) {}

}
