<?php

namespace Phalcon\Logger;

/**
 * Phalcon\Logger\Adapter
 *
 * Base class for Phalcon\Logger adapters
 */
abstract class Adapter implements \Phalcon\Logger\AdapterInterface
{
    /**
     * Tells if there is an active transaction or not
     *
     * @var boolean
     */
    protected $_transaction = false;

    /**
     * Array with messages queued in the transaction
     *
     * @var array
     */
    protected $_queue = array();

    /**
     * Formatter
     *
     * @var object
     */
    protected $_formatter;

    /**
     * Log level
     *
     * @var int
     */
    protected $_logLevel = 9;


    /**
     * Filters the logs sent to the handlers that are less or equal than a specific level
     *
     * @param int $level
     * @return \Phalcon\Logger\AdapterInterface
     */
    public function setLogLevel($level) {}

    /**
     * Returns the current log level
     *
     * @return int
     */
    public function getLogLevel() {}

    /**
     * Sets the message formatter
     *
     * @param \Phalcon\Logger\FormatterInterface $formatter
     * @return \Phalcon\Logger\AdapterInterface
     */
    public function setFormatter(\Phalcon\Logger\FormatterInterface $formatter) {}

    /**
     * Starts a transaction
     *
     * @return \Phalcon\Logger\AdapterInterface
     */
    public function begin() {}

    /**
     * Commits the internal transaction
     *
     * @return \Phalcon\Logger\AdapterInterface
     */
    public function commit() {}

    /**
     * Rollbacks the internal transaction
     *
     * @return \Phalcon\Logger\AdapterInterface
     */
    public function rollback() {}

    /**
     * Returns the whether the logger is currently in an active transaction or not
     *
     * @return bool
     */
    public function isTransaction() {}

    /**
     * Sends/Writes a critical message to the log
     *
     * @param string $message
     * @param array $context
     * @return \Phalcon\Logger\AdapterInterface
     */
    public function critical($message, array $context = null) {}

    /**
     * Sends/Writes an emergency message to the log
     *
     * @param string $message
     * @param array $context
     * @return \Phalcon\Logger\AdapterInterface
     */
    public function emergency($message, array $context = null) {}

    /**
     * Sends/Writes a debug message to the log
     *
     * @param string $message
     * @param array $context
     * @return \Phalcon\Logger\AdapterInterface
     */
    public function debug($message, array $context = null) {}

    /**
     * Sends/Writes an error message to the log
     *
     * @param string $message
     * @param array $context
     * @return \Phalcon\Logger\AdapterInterface
     */
    public function error($message, array $context = null) {}

    /**
     * Sends/Writes an info message to the log
     *
     * @param string $message
     * @param array $context
     * @return \Phalcon\Logger\AdapterInterface
     */
    public function info($message, array $context = null) {}

    /**
     * Sends/Writes a notice message to the log
     *
     * @param string $message
     * @param array $context
     * @return \Phalcon\Logger\AdapterInterface
     */
    public function notice($message, array $context = null) {}

    /**
     * Sends/Writes a warning message to the log
     *
     * @param string $message
     * @param array $context
     * @return \Phalcon\Logger\AdapterInterface
     */
    public function warning($message, array $context = null) {}

    /**
     * Sends/Writes an alert message to the log
     *
     * @param string $message
     * @param array $context
     * @return \Phalcon\Logger\AdapterInterface
     */
    public function alert($message, array $context = null) {}

    /**
     * Logs messages to the internal logger. Appends logs to the logger
     *
     * @param mixed $type
     * @param mixed $message
     * @param array $context
     * @return \Phalcon\Logger\AdapterInterface
     */
    public function log($type, $message = null, array $context = null) {}

}
