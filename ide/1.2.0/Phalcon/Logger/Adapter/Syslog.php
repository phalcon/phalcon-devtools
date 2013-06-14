<?php 

namespace Phalcon\Logger\Adapter {

	/**
	 * Phalcon\Logger\Adapter\Syslog
	 *
	 * Sends logs to the system logger
	 *
	 *<code>
	 *	$logger = new \Phalcon\Logger\Adapter\Syslog("ident", array(
	 *		'option' => LOG_NDELAY,
	 *		'facility' => LOG_MAIL
	 *	));
	 *	$logger->log("This is a message");
	 *	$logger->log("This is an error", \Phalcon\Logger::ERROR);
	 *	$logger->error("This is another error");
	 *</code>
	 */
	
	class Syslog extends \Phalcon\Logger\Adapter implements \Phalcon\Logger\AdapterInterface {

		protected $_opened;

		/**
		 * \Phalcon\Logger\Adapter\Syslog constructor
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
		 */
		public function logInternal($message, $type, $time){ }


		/**
		 * Closes the logger
		 *
		 * @return boolean
		 */
		public function close(){ }

	}
}
