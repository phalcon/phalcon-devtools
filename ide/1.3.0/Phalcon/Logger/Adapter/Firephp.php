<?php 

namespace Phalcon\Logger\Adapter {

	/**
	 * Phalcon\Logger\Adapter\Firephp
	 *
	 * Sends logs to FirePHP
	 *
	 *<code>
	 *	$logger = new \Phalcon\Logger\Adapter\Firephp("");
	 *	$logger->log("This is a message");
	 *	$logger->log("This is an error", \Phalcon\Logger::ERROR);
	 *	$logger->error("This is another error");
	 *</code>
	 */
	
	class Firephp extends \Phalcon\Logger\Adapter implements \Phalcon\Logger\AdapterInterface {

		private static $_initialized;

		private static $_index;

		/**
		 * Returns the internal formatter
		 *
		 * @return \Phalcon\Logger\FormatterInterface
		 */
		public function getFormatter(){ }


		/**
		 * Writes the log to the stream itself
		 *
		 * @param string $message
		 * @param int $type
		 * @param int $time
		 * @param array $context
		 * @see http://www.firephp.org/Wiki/Reference/Protocol
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
