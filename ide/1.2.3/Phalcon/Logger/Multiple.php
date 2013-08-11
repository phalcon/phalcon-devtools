<?php 

namespace Phalcon\Logger {

	/**
	 * Phalcon\Logger\Multiple
	 *
	 * Handles multiples logger handlers
	 */
	
	class Multiple {

		protected $_loggers;

		protected $_formatter;

		/**
		 * Pushes a logger to the logger tail
		 *
		 * @param \Phalcon\Logger\AdapterInterface $logger
		 */
		public function push($logger){ }


		/**
		 * Returns the registered loggers
		 *
		 * @return \Phalcon\Logger\AdapterInterface[]
		 */
		public function getLoggers(){ }


		/**
		 * Sets a global formatter
		 *
		 * @param \Phalcon\Logger\FormatterInterface $formatter
		 */
		public function setFormatter($formatter){ }


		/**
		 * Returns a formatter
		 *
		 * @return \Phalcon\Logger\FormatterInterface
		 */
		public function getFormatter(){ }


		/**
		 * Sends a message to each registered logger
		 *
		 * @param string $message
		 * @param int $type
		 */
		public function log($message, $type=null){ }


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

	}
}
