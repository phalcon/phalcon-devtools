<?php 

namespace Phalcon\Logger\Adapter {

	/**
	 * Phalcon\Logger\Adapter\File
	 *
	 * Adapter to store logs in plain text files
	 *
	 *<code>
	 *	$logger = new \Phalcon\Logger\Adapter\File("app/logs/test.log");
	 *	$logger->log("This is a message");
	 *	$logger->log("This is an error", \Phalcon\Logger::ERROR);
	 *	$logger->error("This is another error");
	 *	$logger->close();
	 *</code>
	 */
	
	class File extends \Phalcon\Logger\Adapter implements \Phalcon\Logger\AdapterInterface {

		protected $_fileHandler;

		protected $_path;

		protected $_options;

		/**
		 * \Phalcon\Logger\Adapter\File constructor
		 *
		 * @param string $name
		 * @param array $options
		 */
		public function __construct($name, $options=null){ }


		/**
		 * Returns the internal formatter
		 *
		 * @return \Phalcon\Logger\Formatter\Line
		 */
		public function getFormatter(){ }


		/**
		 * Writes the log to the file itself
		 *
		 * @param string $message
		 * @param int $type
		 * @param int $time
		 * @param array $context
		 */
		protected function logInternal($message, $type, $time, $context){ }


		/**
		 * Closes the logger
		 *
		 * @return boolean
		 */
		public function close(){ }


		/**
		 * Returns the file path
		 *
		 */
		public function getPath(){ }


		/**
		 * Opens the internal file handler after unserialization
		 *
		 */
		public function __wakeup(){ }

	}
}
