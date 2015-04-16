<?php

namespace Phalcon\Logger\Adapter;

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
     * @return \Phalcon\Logger\Formatter\Line 
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
	public function logInternal($message, $type, $time, $context) {}

    /**
     * Closes the logger
     *
     * @return boolean 
     */
	public function close() {}

}
