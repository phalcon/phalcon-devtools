<?php

namespace Phalcon\Events;

interface EventsAwareInterface
{

    /**
     * Sets the events manager
     *
     * @param \Phalcon\Events\ManagerInterface $eventsManager 
     */
	public function setEventsManager(ManagerInterface $eventsManager);

    /**
     * Returns the internal event manager
     *
     * @return \Phalcon\Events\ManagerInterface 
     */
	public function getEventsManager();

}
