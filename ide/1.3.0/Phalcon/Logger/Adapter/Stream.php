<?php 

namespace Phalcon\Logger\Adapter {

	/**
	 * Phalcon\Logger\Adapter\Stream
	 *
	 * Sends logs to a valid PHP stream
	 *
	 *<code>
	 *	$logger = new \Phalcon\Logger\Adapter\Stream("php://stderr");
	 *	$logger->log("This is a message");
	 *	$logger->log("This is an error", \Phalcon\Logger::ERROR);
	 *	$logger->error("This is another error");
	 *</code>
	 */
	
	class Stream extends \Phalcon\Logger\Adapter implements \Phalcon\Logger\AdapterInterface {

		protected $_stream;

		/**
		 * \Phalcon\Logger\Adapter\Stream constructor
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
		 * Writes the log to the stream itself
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

	}
}
