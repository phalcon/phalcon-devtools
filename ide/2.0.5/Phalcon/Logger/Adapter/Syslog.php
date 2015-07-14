<?php

namespace Phalcon\Logger\Adapter;

use Phalcon\Logger\Exception;
use Phalcon\Logger\Adapter;
use Phalcon\Logger\AdapterInterface;
use Phalcon\Logger\Formatter\Syslog as SyslogFormatter;


class Syslog extends Adapter implements AdapterInterface
{

	protected $_opened = false;



	/**
	 * Phalcon\Logger\Adapter\Syslog constructor
	 * 
	 * @param string $name
	 * @param array $options
	 *
	 */
	public function __construct($name, $options=null) {}

	/**
	 * Returns the internal formatter
	 *
	 * @return SyslogFormatter
	 */
	public function getFormatter() {}

	/**
	 * Writes the log to the stream itself
	 * 
	 * @param string $message
	 * @param int $type
	 * @param int $time
	 * @param array $context
	 *
	 *
	 * @return void
	 */
	public function logInternal($message, $type, $time, array $context) {}

	/**
 	 * Closes the logger
 	 *
 	 * @return void
	 */
	public function close() {}

}
