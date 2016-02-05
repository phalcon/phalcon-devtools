<?php

namespace Phalcon\Events;

/**
 * Phalcon\Events\Event
 * This class offers contextual information of a fired event in the EventsManager
 */
class Event
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
     * @param string $type 
     */
    public function setType($type) {}

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
     * @param mixed $data 
     */
    public function setData($data) {}

    /**
     * Event data
     *
     * @return mixed 
     */
    public function getData() {}

    /**
     * Is event cancelable?
     *
     * @return boolean 
     */
    public function getCancelable() {}

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
     * Stops the event preventing propagation
     */
    public function stop() {}

    /**
     * Check whether the event is currently stopped
     *
     * @return bool 
     */
    public function isStopped() {}

}
