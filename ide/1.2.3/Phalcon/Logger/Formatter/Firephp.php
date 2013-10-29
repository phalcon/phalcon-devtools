<?php 

namespace Phalcon\Logger\Formatter {

	/**
	 * Phalcon\Logger\Formatter\Firephp
	 *
	 * Formats messages so that they can be sent to FirePHP
	 */
	
	class Firephp extends \Phalcon\Logger\Formatter implements \Phalcon\Logger\FormatterInterface {

		/**
		 * Returns the string meaning of a logger constant
		 *
		 * @param  integer $type
		 * @return string
		 */
		public function getTypeString($type){ }


		/**
		 * Applies a format to a message before sending it to the log
		 *
		 * @param string $message
		 * @param int $type
		 * @param int $timestamp
		 * @return string
		 */
		public function format($message, $type, $timestamp){ }

	}
}
