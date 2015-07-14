<?php

namespace Phalcon\Logger\Formatter;

use Phalcon\Logger;
use Phalcon\Logger\Formatter;
use Phalcon\Logger\FormatterInterface;


class Firephp extends Formatter implements FormatterInterface
{

	protected $_showBacktrace = true;

	protected $_enableLabels = true;



	/**
	 * Returns the string meaning of a logger constant
	 * 
	 * @param int $type
	 *
	 * @return string
	 */
	public function getTypeString($type) {}

	/**
	 * Returns the string meaning of a logger constant
	 * 
	 * @param boolean $isShow
	 *
	 * @return Firephp
	 */
	public function setShowBacktrace($isShow=null) {}

	/**
	 * Returns the string meaning of a logger constant
	 *
	 * @return boolean
	 */
	public function getShowBacktrace() {}

	/**
	 * Returns the string meaning of a logger constant
	 * 
	 * @param boolean $isEnable
	 *
	 * @return Firephp
	 */
	public function enableLabels($isEnable=null) {}

	/**
	 * Returns the labels enabled
	 *
	 * @return boolean
	 */
	public function labelsEnabled() {}

	/**
	 * Applies a format to a message before sending it to the log
	 *
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
