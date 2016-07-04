<?php

namespace Phalcon\Logger\Adapter;

/**
 * Phalcon\Logger\Adapter\Syslog
 * Sends logs to the system logger
 * <code>
 * $logger = new \Phalcon\Logger\Adapter\Syslog("ident", array(
 * 'option' => LOG_NDELAY,
 * 'facility' => LOG_MAIL
 * ));
 * $logger->log("This is a message");
 * $logger->log(\Phalcon\Logger::ERROR, "This is an error");
 * $logger->error("This is another error");
 * </code>
 */
class Syslog extends \Phalcon\Logger\Adapter implements \Phalcon\Logger\AdapterInterface
{

    protected $_opened = false;


    /**
     * Phalcon\Logger\Adapter\Syslog constructor
     *
     * @param string $name 
     * @param array $options 
     */
    public function __construct($name, $options = null) {}

    /**
     * Returns the internal formatter
     *
     * @return \Phalcon\Logger\Formatter\Syslog 
     */
    public function getFormatter() {}

    /**
     * Writes the log to the stream itself
     *
     * @param string $message 
     * @param int $type 
     * @param int $time 
     * @param array $context 
     * @param array $$context 
     */
    public function logInternal($message, $type, $time, array $context) {}

    /**
     * Closes the logger
     *
     * @return bool 
     */
    public function close() {}

}
