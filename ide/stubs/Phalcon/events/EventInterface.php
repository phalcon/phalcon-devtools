<?php

namespace Phalcon\Events;

/**
 * Phalcon\Events\EventInterface
 *
 * Interface for Phalcon\Events\Event class
 */
interface EventInterface
{

    /**
     * Gets event data
     *
     * @return mixed
     */
    public function getData();

    /**
     * Sets event data
     *
     * @param mixed $data
     * @return EventInterface
     */
    public function setData($data = null);

    /**
     * Gets event type
     *
     * @return mixed
     */
    public function getType();

    /**
     * Sets event type
     *
     * @param string $type
     * @return EventInterface
     */
    public function setType($type);

    /**
     * Stops the event preventing propagation
     *
     * @return EventInterface
     */
    public function stop();

    /**
     * Check whether the event is currently stopped
     *
     * @return bool
     */
    public function isStopped();

    /**
     * Check whether the event is cancelable
     *
     * @return bool
     */
    public function isCancelable();

}
