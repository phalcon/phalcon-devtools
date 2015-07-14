<?php

namespace Phalcon\Logger;

class Item
{

	/**
	 * Log type
	 *
	 * @var integer
	 */
	protected $_type;

	public function getType() {
		return $this->_type;
	}

	/**
	 * Log message
	 *
	 * @var string
	 */
	protected $_message;

	public function getMessage() {
		return $this->_message;
	}

	/**
	 * Log timestamp
	 *
	 * @var integer
	 */
	protected $_time;

	public function getTime() {
		return $this->_time;
	}

	protected $_context;

	public function getContext() {
		return $this->_context;
	}



	/**
	 * Phalcon\Logger\Item constructor
	 * 
	 * @param string $message
	 * @param int $type
	 * @param int $time
	 * @param mixed $context
	 *
	 */
	public function __construct($message, $type, $time, $context=null) {}

}
