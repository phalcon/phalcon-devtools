<?php

namespace Phalcon\Mvc\Collection;

/**
 * Phalcon\Mvc\Collection\Manager
 *
 * This components controls the initialization of models, keeping record of relations
 * between the different models of the application.
 *
 * A CollectionManager is injected to a model via a Dependency Injector Container such as Phalcon\Di.
 *
 * <code>
 * $di = new \Phalcon\Di();
 *
 * $di->set(
 *     "collectionManager",
 *     function() {
 *         return new \Phalcon\Mvc\Collection\Manager();
 *     }
 * );
 *
 * $robot = new Robots(di);
 * </code>
 */
interface ManagerInterface
{

    /**
     * Sets a custom events manager for a specific model
     *
     * @param \Phalcon\Mvc\CollectionInterface $model
     * @param \Phalcon\Events\ManagerInterface $eventsManager
     */
    public function setCustomEventsManager(\Phalcon\Mvc\CollectionInterface $model, \Phalcon\Events\ManagerInterface $eventsManager);

    /**
     * Returns a custom events manager related to a model
     *
     * @param \Phalcon\Mvc\CollectionInterface $model
     * @return \Phalcon\Events\ManagerInterface
     */
    public function getCustomEventsManager(\Phalcon\Mvc\CollectionInterface $model);

    /**
     * Initializes a model in the models manager
     *
     * @param \Phalcon\Mvc\CollectionInterface $model
     */
    public function initialize(\Phalcon\Mvc\CollectionInterface $model);

    /**
     * Check whether a model is already initialized
     *
     * @param string $modelName
     * @return bool
     */
    public function isInitialized($modelName);

    /**
     * Get the latest initialized model
     *
     * @return \Phalcon\Mvc\CollectionInterface
     */
    public function getLastInitialized();

    /**
     * Sets a connection service for a specific model
     *
     * @param \Phalcon\Mvc\CollectionInterface $model
     * @param string $connectionService
     */
    public function setConnectionService(\Phalcon\Mvc\CollectionInterface $model, $connectionService);

    /**
     * Sets if a model must use implicit objects ids
     *
     * @param \Phalcon\Mvc\CollectionInterface $model
     * @param bool $useImplicitObjectIds
     */
    public function useImplicitObjectIds(\Phalcon\Mvc\CollectionInterface $model, $useImplicitObjectIds);

    /**
     * Checks if a model is using implicit object ids
     *
     * @param \Phalcon\Mvc\CollectionInterface $model
     * @return bool
     */
    public function isUsingImplicitObjectIds(\Phalcon\Mvc\CollectionInterface $model);

    /**
     * Returns the connection related to a model
     *
     * @param \Phalcon\Mvc\CollectionInterface $model
     * @return \Phalcon\Db\AdapterInterface
     */
    public function getConnection(\Phalcon\Mvc\CollectionInterface $model);

    /**
     * Receives events generated in the models and dispatches them to an events-manager if available
     * Notify the behaviors that are listening in the model
     *
     * @param string $eventName
     * @param \Phalcon\Mvc\CollectionInterface $model
     */
    public function notifyEvent($eventName, \Phalcon\Mvc\CollectionInterface $model);

    /**
     * Binds a behavior to a collection
     *
     * @param \Phalcon\Mvc\CollectionInterface $model
     * @param \Phalcon\Mvc\Collection\BehaviorInterface $behavior
     */
    public function addBehavior(\Phalcon\Mvc\CollectionInterface $model, \Phalcon\Mvc\Collection\BehaviorInterface $behavior);

}
