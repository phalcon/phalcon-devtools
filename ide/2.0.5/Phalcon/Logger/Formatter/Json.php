<?php

namespace Phalcon\Logger\Formatter;

use Phalcon\Logger\Formatter;
use Phalcon\Logger\FormatterInterface;


class Json extends Formatter implements FormatterInterface
{

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
