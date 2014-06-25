<?php 

namespace Phalcon\Logger\Formatter {

	/**
	 * Phalcon\Logger\Formatter\Line
	 *
	 * Formats messages using an one-line string
	 */
	
	class Line extends \Phalcon\Logger\Formatter implements \Phalcon\Logger\FormatterInterface {

		protected $_dateFormat;

		protected $_format;

		/**
		 * \Phalcon\Logger\Formatter\Line construct
		 *
		 * @param string $format
		 * @param string $dateFormat
		 */
		public function __construct($format=null, $dateFormat=null){ }


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
		 * Applies a format to a message before sent it to the internal log
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
