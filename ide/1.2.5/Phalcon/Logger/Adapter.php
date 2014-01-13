<?php 

namespace Phalcon\Logger {

	/**
	 * Phalcon\Logger\Adapter
	 *
	 * Base class for Phalcon\Logger adapters
	 */
	
	abstract class Adapter {

		protected $_transaction;

		protected $_queue;

		protected $_formatter;

		protected $_logLevel;

		/**
		 * Filters the logs sent to the handlers that are less or equal than a specific level
		 *
		 * @param int $level
		 * @return \Phalcon\Logger\Adapter
		 */
		public function setLogLevel($level){ }


		/**
		 * Returns the current log level
		 *
		 * @return int
		 */
		public function getLogLevel(){ }


		/**
		 * Sets the message formatter
		 *
		 * @param \Phalcon\Logger\FormatterInterface $formatter
		 * @return \Phalcon\Logger\Adapter
		 */
		public function setFormatter($formatter){ }


		/**
		 * Starts a transaction
		 *
		 * @return \Phalcon\Logger\Adapter
		 */
		public function begin(){ }


		/**
		 * Commits the internal transaction
		 *
		 * @return \Phalcon\Logger\Adapter
		 */
		public function commit(){ }


		/**
		 * Rollbacks the internal transaction
		 *
		 * @return \Phalcon\Logger\Adapter
		 */
		public function rollback(){ }


		/**
		 * Sends/Writes an emergence message to the log
		 *
		 * @param string $message
		 * @return \Phalcon\Logger\Adapter
		 */
		public function emergence($message){ }


		/**
		 * Sends/Writes a debug message to the log
		 *
		 * @param string $message
		 * @param ing $type
		 * @return \Phalcon\Logger\Adapter
		 */
		public function debug($message){ }


		/**
		 * Sends/Writes an error message to the log
		 *
		 * @param string $message
		 * @return \Phalcon\Logger\Adapter
		 */
		public function error($message){ }


		/**
		 * Sends/Writes an info message to the log
		 *
		 * @param string $message
		 * @return \Phalcon\Logger\Adapter
		 */
		public function info($message){ }


		/**
		 * Sends/Writes a notice message to the log
		 *
		 * @param string $message
		 * @return \Phalcon\Logger\Adapter
		 */
		public function notice($message){ }


		/**
		 * Sends/Writes a warning message to the log
		 *
		 * @param string $message
		 * @return \Phalcon\Logger\Adapter
		 */
		public function warning($message){ }


		/**
		 * Sends/Writes an alert message to the log
		 *
		 * @param string $message
		 * @return \Phalcon\Logger\Adapter
		 */
		public function alert($message){ }


		/**
		 * Logs messages to the internal logger. Appends messages to the log
		 *
		 * @param string $message
		 * @param int $type
		 * @return \Phalcon\Logger\Adapter
		 */
		public function log($message, $type=null){ }

	}
}
