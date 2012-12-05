<?php 

namespace Phalcon\Logger {

	/**
	 * Phalcon\Logger\Adapter
	 *
	 * Base class for Phalcon\Logger adapters
	 */
	
	class Adapter {

		protected $_dateFormat;

		protected $_format;

		/**
		 * Set the log format
		 *
		 * @param string $format
		 */
		public function setFormat($format){ }


		/**
		 * Returns the log format
		 *
		 * @return format
		 */
		public function getFormat(){ }


		/**
		 * Applies the internal format to the message
		 *
		 * @param  string $message
		 * @param  int $type
		 * @param  int $time
		 * @return string
		 */
		protected function _applyFormat(){ }


		/**
		 * Sets the internal date format
		 *
		 * @param string $date
		 */
		public function setDateFormat($date){ }


		/**
		 * Returns the internal date format
		 *
		 * @return string
		 */
		public function getDateFormat(){ }


		/**
		 * Returns the string meaning of a logger constant
		 *
		 * @param  integer $type
		 * @return string
		 */
		public function getTypeString($type){ }


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
		  * @param ing $type
		  */
		public function error($message){ }


		/**
		  * Sends/Writes an info message to the log
		  *
		  * @param string $message
		  * @param ing $type
		  */
		public function info($message){ }


		/**
		  * Sends/Writes a notice message to the log
		  *
		  * @param string $message
		  * @param ing $type
		  */
		public function notice($message){ }


		/**
		  * Sends/Writes a warning message to the log
		  *
		  * @param string $message
		  * @param ing $type
		  */
		public function warning($message){ }


		/**
		  * Sends/Writes an alert message to the log
		  *
		  * @param string $message
		  * @param ing $type
		  */
		public function alert($message){ }


		/**
		 * Logs a message
		 *
		 * @param string $message
		 * @param int $type
		 */
		public function log($message, $type){ }

	}
}
