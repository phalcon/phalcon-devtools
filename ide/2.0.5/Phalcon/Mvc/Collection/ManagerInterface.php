<?php

namespace Phalcon\Mvc\Collection;

use Phalcon\Db\AdapterInterface;
use Phalcon\Mvc\CollectionInterface;
use Phalcon\Mvc\Collection\BehaviorInterface;
use Phalcon\Events\ManagerInterface as EventsManagerInterface;


interface ManagerInterface
{

	/**
	 * Sets a custom events manager for a specific model
	 * 
	 * @param CollectionInterface $model
	 * @param EventsManagerInterface $eventsManager
	 */
	public function setCustomEventsManager(CollectionInterface $model, EventsManagerInterface $eventsManager);

	/**
	 * Returns a custom events manager related to a model
	 * 
	 * @param CollectionInterface $model
	 *
	 * @return EventsManagerInterface
	 */
	public function getCustomEventsManager(CollectionInterface $model);

	/**
	 * Initializes a model in the models manager
	 * 
	 * @param CollectionInterface $model
	 */
	public function initialize(CollectionInterface $model);

	/**
	 * Check whether a model is already initialized
	 * 
	 * @param string $modelName
	 *
	 * @return boolean
	 */
	public function isInitialized($modelName);

	/**
	 * Get the latest initialized model
	 *
	 * @return CollectionInterface
	 */
	public function getLastInitialized();

	/**
	 * Sets a connection service for a specific model
	 * 
	 * @param CollectionInterface $model
	 * @param string $connectionService
	 */
	public function setConnectionService(CollectionInterface $model, $connectionService);

	/**
	 * Sets if a model must use implicit objects ids
	 * 
	 * @param CollectionInterface $model
	 * @param boolean $useImplicitObjectIds
	 */
	public function useImplicitObjectIds(CollectionInterface $model, $useImplicitObjectIds);

	/**
	 * Checks if a model is using implicit object ids
	 * 
	 * @param CollectionInterface $model
	 *
	 * @return boolean
	 */
	public function isUsingImplicitObjectIds(CollectionInterface $model);

	/**
	 * Returns the connection related to a model
	 * 
	 * @param CollectionInterface $model
	 *
	 * @return AdapterInterface
	 */
	public function getConnection(CollectionInterface $model);

	/**
	 * Receives events generated in the models and dispatches them to a events-manager if available
	 * Notify the behaviors that are listening in the model
	 * 
	 * @param string $eventName
	 * @param CollectionInterface $model
	 */
	public function notifyEvent($eventName, CollectionInterface $model);

	/**
	 * Binds a behavior to a collection
	 * 
	 * @param CollectionInterface $model
	 * @param BehaviorInterface $behavior
	 */
	public function addBehavior(CollectionInterface $model, BehaviorInterface $behavior);

}
