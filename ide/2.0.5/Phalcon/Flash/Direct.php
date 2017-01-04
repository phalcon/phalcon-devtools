<?php

namespace Phalcon\Flash;

use Phalcon\FlashInterface;
use Phalcon\Flash as FlashBase;


class Direct extends FlashBase implements FlashInterface
{

	/**
	 * Outputs a message
	 * 
	 * @param string $type
	 * @param mixed $message
	 *
	 * @return string
	 */
	public function message($type, $message) {}

	/**
	 * Prints the messages accumulated in the flasher
	 * 
	 * @param boolean $remove
	 *
	 * @return void
	 */
	public function output($remove=true) {}

}
