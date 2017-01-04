<?php

namespace Phalcon\Logger\Formatter;

use Phalcon\Logger\Formatter;
use Phalcon\Logger\FormatterInterface;


class Line extends Formatter implements FormatterInterface
{

	/**
	 * Default date format
	 *
	 * @var string
	 */
	protected $_dateFormat = 'D, d M y H:i:s O';

	public function getDateFormat() {
		return $this->_dateFormat;
	}

	public function setDateFormat($value) {
		$this->_dateFormat = $value;
	}

	/**
	 * Format applied to each message
	 *
	 * @var string
	 */
	protected $_format = '[%date%][%type%] %message%';

	public function getFormat() {
		return $this->_format;
	}

	public function setFormat($value) {
		$this->_format = $value;
	}



	/**
	 * Phalcon\Logger\Formatter\Line construct
	 * 
	 * @param string $format
	 * @param string $dateFormat
	 *
	 */
	public function __construct($format=null, $dateFormat=null) {}

	/**
	 * Applies a format to a message before sent it to the internal log
	 *
	 * @param string $message
	 * @param int $type
	 * @param int $timestamp
	 * @param mixed $context
	 * 
	 * @return string
	 */
	public function format($message, $type, $timestamp, $context=null) {}

}
