<?php 

namespace Phalcon\Logger\Formatter {

	/**
	 * Phalcon\Logger\Formatter\Syslog
	 *
	 * Prepares a message to be used in a Syslog backend
	 */
	
	class Syslog extends \Phalcon\Logger\Formatter {

		/**
		 * Applies a format to a message before sent it to the internal log
		 *
		 * @param string $message
		 * @param int $type
		 * @param int $timestamp
		 */
		public function format($message, $type, $timestamp){ }

	}
}
