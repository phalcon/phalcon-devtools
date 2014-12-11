<?php 

namespace Phalcon\Logger {

	/**
	 * Phalcon\Logger\AdapterInterface initializer
	 */
	
	interface AdapterInterface {

		/**
		 * Sets the message formatter
		 *
		 * @param \Phalcon\Logger\FormatterInterface $formatter
		 * @return \Phalcon\Logger\Adapter
		 */
		public function setFormatter($formatter);


		/**
		 * Returns the internal formatter
		 *
		 * @return \Phalcon\Logger\FormatterInterface
		 */
		public function getFormatter();


		/**
		 * Filters the logs sent to the handlers to be greater or equals than a specific level
		 *
		 * @param int $level
		 * @return \Phalcon\Logger\Adapter
		 */
		public function setLogLevel($level);


		/**
		 * Returns the current log level
		 *
		 * @return int
		 */
		public function getLogLevel();


		/**
		 * Starts a transaction
		 *
		 * @return \Phalcon\Logger\Adapter
		 */
		public function begin();


		/**
		 * Commits the internal transaction
		 *
		 * @return \Phalcon\Logger\Adapter
		 */
		public function commit();


		/**
		 * Rollbacks the internal transaction
		 *
		 * @return \Phalcon\Logger\Adapter
		 */
		public function rollback();


		/**
		 * Closes the logger
		 *
		 * @return boolean
		 */
		public function close();


		/**
		 * Sends/Writes messages to the file log
		 *
		 * @param int|string $type
		 * @param string $message
		 * @param array $context
		 * @return \Phalcon\Logger\AdapterInterface
		 */
		public function log($type, $message, $context=null);


		/**
		 * Sends/Writes a debug message to the log
		 *
		 * @param string $message
		 * @param array $context
		 * @return \Phalcon\Logger\AdapterInterface
		 */
		public function debug($message, $context=null);


		/**
		 * Sends/Writes an info message to the log
		 *
		 * @param string $message
		 * @param array $context
		 * @return \Phalcon\Logger\AdapterInterface
		 */
		public function info($message, $context=null);


		/**
		 * Sends/Writes a notice message to the log
		 *
		 * @param string $message
		 * @return \Phalcon\Logger\AdapterInterface
		 */
		public function notice($message, $context=null);


		/**
		 * Sends/Writes a warning message to the log
		 *
		 * @param string $message
		 * @param array $context
		 * @return \Phalcon\Logger\AdapterInterface
		 */
		public function warning($message, $context=null);


		/**
		 * Sends/Writes an error message to the log
		 *
		 * @param string $message
		 * @param array $context
		 * @return \Phalcon\Logger\AdapterInterface
		 */
		public function error($message, $context=null);


		/**
		 * Sends/Writes a critical message to the log
		 *
		 * @param string $message
		 * @param array $context
		 * @return \Phalcon\Logger\AdapterInterface
		 */
		public function critical($message, $context=null);


		/**
		 * Sends/Writes an alert message to the log
		 *
		 * @param string $message
		 * @param array $context
		 * @return \Phalcon\Logger\AdapterInterface
		 */
		public function alert($message, $context=null);


		/**
		 * Sends/Writes an emergency message to the log
		 *
		 * @param string $message
		 * @param array $context
		 * @return \Phalcon\Logger\AdapterInterface
		 */
		public function emergency($message, $context=null);

	}
}
