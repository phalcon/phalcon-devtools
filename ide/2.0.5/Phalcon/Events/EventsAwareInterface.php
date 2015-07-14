<?php

namespace Phalcon\Events;

interface EventsAwareInterface
{

	/**
	 * Sets the events manager
	 * 
	 * @param ManagerInterface $eventsManager
	 */
	public function setEventsManager(ManagerInterface $eventsManager);

	/**
	 * Returns the internal event manager
	 *
	 * @return ManagerInterface
	 */
	public function getEventsManager();

}
