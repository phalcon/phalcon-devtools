<?php

namespace Phalcon\Logger;

/**
 * Phalcon\Logger\AdapterInterface
 * Interface for Phalcon\Logger adapters
 */
interface AdapterInterface
{

    /**
     * Sets the message formatter
     *
     * @param mixed $formatter 
     * @return AdapterInterface 
     */
    public function setFormatter(FormatterInterface $formatter);

    /**
     * Returns the internal formatter
     *
     * @return FormatterInterface 
     */
    public function getFormatter();

    /**
     * Filters the logs sent to the handlers to be greater or equals than a specific level
     *
     * @param int $level 
     * @return AdapterInterface 
     */
    public function setLogLevel($level);

    /**
     * Returns the current log level
     *
     * @return int 
     */
    public function getLogLevel();

    /**
     * Sends/Writes messages to the file log
     *
     * @param mixed $type 
     * @param mixed $message 
     * @param array $context 
     * @return AdapterInterface 
     */
    public function log($type, $message = null, array $context = null);

    /**
     * Starts a transaction
     *
     * @return AdapterInterface 
     */
    public function begin();

    /**
     * Commits the internal transaction
     *
     * @return AdapterInterface 
     */
    public function commit();

    /**
     * Rollbacks the internal transaction
     *
     * @return AdapterInterface 
     */
    public function rollback();

    /**
     * Closes the logger
     *
     * @return bool 
     */
    public function close();

    /**
     * Sends/Writes a debug message to the log
     *
     * @param string $message 
     * @param array $context 
     * @return AdapterInterface 
     */
    public function debug($message, array $context = null);

    /**
     * Sends/Writes an error message to the log
     *
     * @param string $message 
     * @param array $context 
     * @return AdapterInterface 
     */
    public function error($message, array $context = null);

    /**
     * Sends/Writes an info message to the log
     *
     * @param string $message 
     * @param array $context 
     * @return AdapterInterface 
     */
    public function info($message, array $context = null);

    /**
     * Sends/Writes a notice message to the log
     *
     * @param string $message 
     * @param array $context 
     * @return AdapterInterface 
     */
    public function notice($message, array $context = null);

    /**
     * Sends/Writes a warning message to the log
     *
     * @param string $message 
     * @param array $context 
     * @return AdapterInterface 
     */
    public function warning($message, array $context = null);

    /**
     * Sends/Writes an alert message to the log
     *
     * @param string $message 
     * @param array $context 
     * @return AdapterInterface 
     */
    public function alert($message, array $context = null);

    /**
     * Sends/Writes an emergency message to the log
     *
     * @param string $message 
     * @param array $context 
     * @return AdapterInterface 
     */
    public function emergency($message, array $context = null);

}
