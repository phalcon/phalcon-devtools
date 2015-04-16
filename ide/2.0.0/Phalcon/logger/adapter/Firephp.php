<?php

namespace Phalcon\Logger\Adapter;

class Firephp extends \Phalcon\Logger\Adapter implements \Phalcon\Logger\AdapterInterface
{

    static private $_initialized;


    static private $_index;


    /**
     * Returns the internal formatter
     *
     * @return \Phalcon\Logger\FormatterInterface 
     */
	public function getFormatter() {}

    /**
     * Writes the log to the stream itself
     *
     * @see http://www.firephp.org/Wiki/Reference/Protocol
     * @param string $message 
     * @param int $type 
     * @param int $time 
     * @param array $context 
     * @param string $$message 
     * @param int $$type 
     * @param int $$time 
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
