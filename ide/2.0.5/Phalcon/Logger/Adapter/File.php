<?php

namespace Phalcon\Logger\Adapter;

use Phalcon\Logger\Adapter;
use Phalcon\Logger\AdapterInterface;
use Phalcon\Logger\Exception;
use Phalcon\Logger\FormatterInterface;
use Phalcon\Logger\Formatter\Line as LineFormatter;


class File extends Adapter implements AdapterInterface
{

	/**
	 * File handler resource
	 *
	 * @var resource
	 */
	protected $_fileHandler;

	/**
	 * File Path
	 */
	protected $_path;

	public function getPath() {
		return $this->_path;
	}

	/**
	 * Path options
	 */
	protected $_options;



	/**
	 * Phalcon\Logger\Adapter\File constructor
	 * 
	 * @param string $name
	 * @param array $options
	 *
	 */
	public function __construct($name, $options=null) {}

	/**
		 * We use 'fopen' to respect to open-basedir directive
		 *
	 * @return FormatterInterface
	 */
	public function getFormatter() {}

	/**
	 * Writes the log to the file itself
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

	/**
	 * Opens the internal file handler after unserialization
	 *
	 * @return void
	 */
	public function __wakeup() {}

}
