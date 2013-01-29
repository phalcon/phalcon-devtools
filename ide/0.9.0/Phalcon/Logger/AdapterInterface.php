<?php 

namespace Phalcon\Logger {

	/**
	 * Phalcon\Logger\AdapterInterface initializer
	 */
	
	interface AdapterInterface {

		/**
		 * Sends/Writes messages to the file log
		 *
		 * @param string $message
		 * @param int $type
		 */
		public function log($message, $type=null);


		/**
		  * Starts a transaction
		  *
		  */
		public function begin();


		/**
		  * Commits the internal transaction
		  *
		  */
		public function commit();


		/**
		  * Rollbacks the internal transaction
		  *
		  */
		public function rollback();


		/**
		  * Closes the logger
		  *
		  * @return boolean
		  */
		public function close();


		/**
		  * Sends/Writes a debug message to the log
		  *
		  * @param string $message
		  * @param ing $type
		  */
		public function debug($message);


		/**
		  * Sends/Writes an error message to the log
		  *
		  * @param string $message
		  * @param ing $type
		  */
		public function error($message);


		/**
		  * Sends/Writes an info message to the log
		  *
		  * @param string $message
		  * @param ing $type
		  */
		public function info($message);


		/**
		  * Sends/Writes a notice message to the log
		  *
		  * @param string $message
		  * @param ing $type
		  */
		public function notice($message);


		/**
		  * Sends/Writes a warning message to the log
		  *
		  * @param string $message
		  * @param ing $type
		  */
		public function warning($message);


		/**
		  * Sends/Writes an alert message to the log
		  *
		  * @param string $message
		  * @param ing $type
		  */
		public function alert($message);

	}
}
