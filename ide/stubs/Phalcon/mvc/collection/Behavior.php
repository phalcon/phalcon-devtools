<?php

namespace Phalcon\Mvc\Collection;

/**
 * Phalcon\Mvc\Collection\Behavior
 * This is an optional base class for ORM behaviors
 */
abstract class Behavior
{

    protected $_options;


    /**
     * Phalcon\Mvc\Collection\Behavior
     *
     * @param array $options 
     */
    public function __construct($options = null) {}

    /**
     * Checks whether the behavior must take action on certain event
     *
     * @param string $eventName 
     * @return bool 
     */
    protected function mustTakeAction($eventName) {}

    /**
     * Returns the behavior options related to an event
     *
     * @param string $eventName 
     * @return array 
     */
    protected function getOptions($eventName = null) {}

    /**
     * This method receives the notifications from the EventsManager
     *
     * @param string $type 
     * @param mixed $model 
     */
    public function notify($type, \Phalcon\Mvc\CollectionInterface $model) {}

    /**
     * Acts as fallbacks when a missing method is called on the collection
     *
     * @param mixed $model 
     * @param string $method 
     * @param mixed $arguments 
     */
    public function missingMethod(\Phalcon\Mvc\CollectionInterface $model, $method, $arguments = null) {}

}
