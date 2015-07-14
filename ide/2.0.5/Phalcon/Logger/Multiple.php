<?php

namespace Phalcon\Logger;

use Phalcon\Logger;
use Phalcon\Logger\AdapterInterface;
use Phalcon\Logger\FormatterInterface;
use Phalcon\Logger\Exception;


class Multiple
{

	protected $_loggers;

	public function getLoggers() {
		return $this->_loggers;
	}

	protected $_formatter;

	public function getFormatter() {
		return $this->_formatter;
	}



	/**
	 * Pushes a logger to the logger tail
	 * 
	 * @param AdapterInterface $logger
	 *
	 * @return void
	 */
	public function push(AdapterInterface $logger) {}

	/**
	 * Sets a global formatter
	 * 
	 * @param FormatterInterface $formatter
	 *
	 * @return void
	 */
	public function setFormatter(FormatterInterface $formatter) {}

	/**
	 * Sends a message to each registered logger
	 * 
	 * @param mixed $type
	 * @param mixed $message
	 * @param array $context
	 *
	 * @return void
	 */
	public function log($type, $message=null, array $context=null) {}

	/**
 	 * Sends/Writes an critical message to the log
	 * 
	 * @param string $message
	 * @param array $context
 	 *
	 * @return void
	 */
	public function critical($message, array $context=null) {}

	/**
 	 * Sends/Writes an emergency message to the log
	 * 
	 * @param string $message
	 * @param array $context
 	 *
	 * @return void
	 */
	public function emergency($message, array $context=null) {}

	/**
 	 * Sends/Writes a debug message to the log
	 * 
	 * @param string $message
	 * @param array $context
 	 *
	 * @return void
	 */
	public function debug($message, array $context=null) {}

	/**
 	 * Sends/Writes an error message to the log
	 * 
	 * @param string $message
	 * @param array $context
 	 *
	 * @return void
	 */
	public function error($message, array $context=null) {}

	/**
 	 * Sends/Writes an info message to the log
	 * 
	 * @param string $message
	 * @param array $context
 	 *
	 * @return void
	 */
	public function info($message, array $context=null) {}

	/**
 	 * Sends/Writes a notice message to the log
	 * 
	 * @param string $message
	 * @param array $context
 	 *
	 * @return void
	 */
	public function notice($message, array $context=null) {}

	/**
 	 * Sends/Writes a warning message to the log
	 * 
	 * @param string $message
	 * @param array $context
 	 *
	 * @return void
	 */
	public function warning($message, array $context=null) {}

	/**
 	 * Sends/Writes an alert message to the log
	 * 
	 * @param string $message
	 * @param array $context
 	 *
	 * @return void
	 */
	public function alert($message, array $context=null) {}

}
