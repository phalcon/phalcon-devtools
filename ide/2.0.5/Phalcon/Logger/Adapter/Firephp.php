<?php

namespace Phalcon\Logger\Adapter;

use Phalcon\Logger\Adapter;
use Phalcon\Logger\AdapterInterface;
use Phalcon\Logger\Exception;
use Phalcon\Logger\FormatterInterface;
use Phalcon\Logger\Formatter\Firephp as FirePhpFormatter;


class Firephp extends Adapter implements AdapterInterface
{

	private static $_initialized;

	private static $_index;



	/**
	 * Returns the internal formatter
	 *
	 * @return FormatterInterface
	 */
	public function getFormatter() {}

	/**
	 * Writes the log to the stream itself
	 *
	 * @see http://www.firephp.org/Wiki/Reference/Protocol
	 * 
	 * @param string $message
	 * @param int $type
	 * @param int $time
	 * @param array $context
	 *
	 * @return void
	 */
	public function logInternal($message, $type, $time, array $context) {}

	/**
	 * Closes the logger
	 *
	 * @return boolean
	 */
	public function close() {}

}
