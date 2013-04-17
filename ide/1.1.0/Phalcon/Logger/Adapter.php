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
		 * Filters the logs sent to the handlers to be less or equals than a specific level
		 *
		 * @param int $level
		 */
		public function setLogLevel($level){ }


		/**
		 * Returns the current log level
		 */
		public function getLogLevel(){ }


		/**
		 * Sets the message formatter
		 *
		 * @param \Phalcon\Logger\FormatterInterface $formatter
		 */
		public function setFormatter($formatter){ }


		/**
		  * Starts a transaction
		  *
		  */
		public function begin(){ }


		/**
		  * Commits the internal transaction
		  *
		  */
		public function commit(){ }


		/**
		  * Rollbacks the internal transaction
		  *
		  */
		public function rollback(){ }


		/**
		  * Sends/Writes an emergence message to the log
		  *
		  * @param string $message
		  */
		public function emergence($message){ }


		/**
		  * Sends/Writes a debug message to the log
		  *
		  * @param string $message
		  * @param ing $type
		  */
		public function debug($message){ }


		/**
		  * Sends/Writes an error message to the log
		  *
		  * @param string $message
		  */
		public function error($message){ }


		/**
		  * Sends/Writes an info message to the log
		  *
		  * @param string $message
		  */
		public function info($message){ }


		/**
		  * Sends/Writes a notice message to the log
		  *
		  * @param string $message
		  */
		public function notice($message){ }


		/**
		  * Sends/Writes a warning message to the log
		  *
		  * @param string $message
		  */
		public function warning($message){ }


		/**
		  * Sends/Writes an alert message to the log
		  *
		  * @param string $message
		  */
		public function alert($message){ }


		/**
		 * Logs messages to the internal loggger. Appends logs to the
		 *
		 * @param string $message
		 * @param int $type
		 */
		public function log($message, $type=null){ }

	}
}
