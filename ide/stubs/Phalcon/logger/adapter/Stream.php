<?php

namespace Phalcon\Logger\Adapter;

/**
 * Phalcon\Logger\Adapter\Stream
 * Sends logs to a valid PHP stream
 * <code>
 * $logger = new \Phalcon\Logger\Adapter\Stream("php://stderr");
 * $logger->log("This is a message");
 * $logger->log(\Phalcon\Logger::ERROR, "This is an error");
 * $logger->error("This is another error");
 * </code>
 */
class Stream extends \Phalcon\Logger\Adapter implements \Phalcon\Logger\AdapterInterface
{
    /**
     * File handler resource
     *
     * @var resource
     */
    protected $_stream;


    /**
     * Phalcon\Logger\Adapter\Stream constructor
     *
     * @param string $name 
     * @param array $options 
     */
    public function __construct($name, $options = null) {}

    /**
     * Returns the internal formatter
     *
     * @return \Phalcon\Logger\FormatterInterface 
     */
    public function getFormatter() {}

    /**
     * Writes the log to the stream itself
     *
     * @param string $message 
     * @param int $type 
     * @param int $time 
     * @param array $context 
     */
    public function logInternal($message, $type, $time, array $context) {}

    /**
     * Closes the logger
     *
     * @return bool 
     */
    public function close() {}

}
