<?php

namespace Phalcon\Events;

/**
 * Phalcon\Events\EventsAwareInterface
 * This interface must for those classes that accept an EventsManager and dispatch events
 */
interface EventsAwareInterface
{

    /**
     * Sets the events manager
     *
     * @param mixed $eventsManager 
     */
    public function setEventsManager(ManagerInterface $eventsManager);

    /**
     * Returns the internal event manager
     *
     * @return ManagerInterface 
     */
    public function getEventsManager();

}
