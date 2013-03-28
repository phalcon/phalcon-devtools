<?php 

namespace Phalcon\Logger {

	/**
	 * Phalcon\Logger\FormatterInterface initializer
	 */
	
	interface FormatterInterface {

		/**
		 * Applies a format to a message before sent it to the internal log
		 *
		 * @param string $message
		 * @param int $type
		 * @param int $timestamp
		 */
		public function format($message, $type, $timestamp);

	}
}
