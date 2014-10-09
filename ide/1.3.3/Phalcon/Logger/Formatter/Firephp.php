<?php 

namespace Phalcon\Logger\Formatter {

	/**
	 * Phalcon\Logger\Formatter\Firephp
	 *
	 * Formats messages so that they can be sent to FirePHP
	 */
	
	class Firephp extends \Phalcon\Logger\Formatter implements \Phalcon\Logger\FormatterInterface {

		protected $_showBacktrace;

		protected $_enableLabels;

		/**
		 * Returns the string meaning of a logger constant
		 *
		 * @param  integer $type
		 * @return string
		 */
		public function getTypeString($type){ }


		public function getShowBacktrace(){ }


		public function setShowBacktrace($show=null){ }


		public function enableLabels($enable=null){ }


		public function labelsEnabled(){ }


		/**
		 * Applies a format to a message before sending it to the log
		 *
		 * @param string $message
		 * @param int $type
		 * @param int $timestamp
		 * @param array $context
		 * @return string
		 */
		public function format($message, $type, $timestamp, $context){ }

	}
}
