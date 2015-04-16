<?php

namespace Phalcon\Logger;

class Multiple
{

    protected $_loggers;


    protected $_formatter;



	public function getLoggers() {}


	public function getFormatter() {}

    /**
     * Pushes a logger to the logger tail
     *
     * @param \Phalcon\Logger\AdapterInterface $logger 
     */
	public function push(\Phalcon\Logger\AdapterInterface $logger) {}

    /**
     * Sets a global formatter
     *
     * @param \Phalcon\Logger\FormatterInterface $formatter 
     */
	public function setFormatter(\Phalcon\Logger\FormatterInterface $formatter) {}

    /**
     * Sends a message to each registered logger
     *
     * @param string $message 
     * @param int $type 
     */
	public function log($message, $type = 7) {}

    /**
     * Sends/Writes an emergency message to the log
     *
     * @param string $message 
     */
	public function emergency($message) {}

    /**
     * Sends/Writes a debug message to the log
     *
     * @param string $message 
     * @param ing $type 
     */
	public function debug($message) {}

    /**
     * Sends/Writes an error message to the log
     *
     * @param string $message 
     */
	public function error($message) {}

    /**
     * Sends/Writes an info message to the log
     *
     * @param string $message 
     */
	public function info($message) {}

    /**
     * Sends/Writes a notice message to the log
     *
     * @param string $message 
     */
	public function notice($message) {}

    /**
     * Sends/Writes a warning message to the log
     *
     * @param string $message 
     */
	public function warning($message) {}

    /**
     * Sends/Writes an alert message to the log
     *
     * @param string $message 
     */
	public function alert($message) {}

}
