<?php

namespace Phalcon\Logger;

/**
 * Phalcon\Logger\Multiple
 * Handles multiples logger handlers
 */
class Multiple
{

    protected $_loggers;


    protected $_formatter;


    protected $_logLevel;



    public function getLoggers() {}


    public function getFormatter() {}


    public function getLogLevel() {}

    /**
     * Pushes a logger to the logger tail
     *
     * @param mixed $logger 
     */
    public function push(\Phalcon\Logger\AdapterInterface $logger) {}

    /**
     * Sets a global formatter
     *
     * @param mixed $formatter 
     */
    public function setFormatter(\Phalcon\Logger\FormatterInterface $formatter) {}

    /**
     * Sets a global level
     *
     * @param int $level 
     */
    public function setLogLevel($level) {}

    /**
     * Sends a message to each registered logger
     *
     * @param mixed $type 
     * @param mixed $message 
     * @param array $context 
     */
    public function log($type, $message = null, array $context = null) {}

    /**
     * Sends/Writes an critical message to the log
     *
     * @param string $message 
     * @param array $context 
     */
    public function critical($message, array $context = null) {}

    /**
     * Sends/Writes an emergency message to the log
     *
     * @param string $message 
     * @param array $context 
     */
    public function emergency($message, array $context = null) {}

    /**
     * Sends/Writes a debug message to the log
     *
     * @param string $message 
     * @param array $context 
     */
    public function debug($message, array $context = null) {}

    /**
     * Sends/Writes an error message to the log
     *
     * @param string $message 
     * @param array $context 
     */
    public function error($message, array $context = null) {}

    /**
     * Sends/Writes an info message to the log
     *
     * @param string $message 
     * @param array $context 
     */
    public function info($message, array $context = null) {}

    /**
     * Sends/Writes a notice message to the log
     *
     * @param string $message 
     * @param array $context 
     */
    public function notice($message, array $context = null) {}

    /**
     * Sends/Writes a warning message to the log
     *
     * @param string $message 
     * @param array $context 
     */
    public function warning($message, array $context = null) {}

    /**
     * Sends/Writes an alert message to the log
     *
     * @param string $message 
     * @param array $context 
     */
    public function alert($message, array $context = null) {}

}
