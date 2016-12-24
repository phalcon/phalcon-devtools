<?php

namespace Phalcon\Events;

/**
 * Phalcon\Events\Event
 *
 * This class offers contextual information of a fired event in the EventsManager
 */
class Event implements \Phalcon\Events\EventInterface
{
    /**
     * Event type
     *
     * @var string
     */
    protected $_type;

    /**
     * Event source
     *
     * @var object
     */
    protected $_source;

    /**
     * Event data
     *
     * @var mixed
     */
    protected $_data;

    /**
     * Is event propagation stopped?
     *
     * @var boolean
     */
    protected $_stopped = false;

    /**
     * Is event cancelable?
     *
     * @var boolean
     */
    protected $_cancelable = true;


    /**
     * Event type
     *
     * @return string
     */
    public function getType() {}

    /**
     * Event source
     *
     * @return object
     */
    public function getSource() {}

    /**
     * Event data
     *
     * @return mixed
     */
    public function getData() {}

    /**
     * Phalcon\Events\Event constructor
     *
     * @param string $type
     * @param object $source
     * @param mixed $data
     * @param boolean $cancelable
     */
    public function __construct($type, $source, $data = null, $cancelable = true) {}

    /**
     * Sets event data.
     *
     * @param mixed $data
     * @return EventInterface
     */
    public function setData($data = null) {}

    /**
     * Sets event type.
     *
     * @param string $type
     * @return EventInterface
     */
    public function setType($type) {}

    /**
     * Stops the event preventing propagation.
     *
     * <code>
     * if ($event->isCancelable()) {
     *     $event->stop();
     * }
     * </code>
     *
     * @return EventInterface
     */
    public function stop() {}

    /**
     * Check whether the event is currently stopped.
     *
     * @return bool
     */
    public function isStopped() {}

    /**
     * Check whether the event is cancelable.
     *
     * <code>
     * if ($event->isCancelable()) {
     *     $event->stop();
     * }
     * </code>
     *
     * @return bool
     */
    public function isCancelable() {}

}
