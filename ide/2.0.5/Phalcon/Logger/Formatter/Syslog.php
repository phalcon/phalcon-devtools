<?php

namespace Phalcon\Logger\Formatter;

use Phalcon\Logger\Formatter;
use Phalcon\Logger\FormatterInterface;


class Syslog extends Formatter implements FormatterInterface
{

	/**
	 * Applies a format to a message before sent it to the internal log
	 *
	 * @param string $message
	 * @param int $type
	 * @param int $timestamp
	 * @param mixed $context
	 * 
	 * @return array
	 */
	public function format($message, $type, $timestamp, $context=null) {}

}
