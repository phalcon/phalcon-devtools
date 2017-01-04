<?php

namespace Phalcon\Events;

class Event
{

	/**
	 * Event type
	 *
	 * @var string
	 */
	protected $_type;

	public function setType($value) {
		$this->_type = $value;
	}

	public function getType() {
		return $this->_type;
	}

	/**
	 * Event source
	 *
	 * @var object
	 */
	protected $_source;

	public function getSource() {
		return $this->_source;
	}

	/**
	 * Event data
	 *
	 * @var mixed
	 */
	protected $_data;

	public function setData($value) {
		$this->_data = $value;
	}

	public function getData() {
		return $this->_data;
	}

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

	public function getCancelable() {
		return $this->_cancelable;
	}



	/**
	 * Phalcon\Events\Event constructor
	 * 
	 * @param string $type
	 * @param object $source
	 * @param mixed $data
	 * @param boolean $cancelable
	 *
	 */
	public function __construct($type, $source, $data=null, $cancelable=true) {}

	/**
	 * Stops the event preventing propagation
	 *
	 * @return void
	 */
	public function stop() {}

	/**
	 * Check whether the event is currently stopped
	 *
	 * @return boolean
	 */
	public function isStopped() {}

}
