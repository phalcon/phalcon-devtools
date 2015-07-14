<?php

namespace Phalcon;

use Phalcon\Flash\Exception;
use Phalcon\FlashInterface;


abstract class Flash
{

	protected $_cssClasses;

	protected $_implicitFlush = true;

	protected $_automaticHtml = true;

	protected $_messages;



	/**
	 * Phalcon\Flash constructor
	 * 
	 * @param $cssClasses
	 */
	public function __construct($cssClasses=null) {}

	/**
	 * Set whether the output must be implicitly flushed to the output or returned as string
	 * 
	 * @param boolean $implicitFlush
	 *
	 * @return FlashInterface
	 */
	public function setImplicitFlush($implicitFlush) {}

	/**
	 * Set if the output must be implicitly formatted with HTML
	 * 
	 * @param boolean $automaticHtml
	 *
	 * @return FlashInterface
	 */
	public function setAutomaticHtml($automaticHtml) {}

	/**
	 * Set an array with CSS classes to format the messages
	 * 
	 * @param array $cssClasses
	 *
	 * @return FlashInterface
	 */
	public function setCssClasses(array $cssClasses) {}

	/**
	 * Shows a HTML error message
	 *
	 *<code>
	 * $flash->error('This is an error');
	 *</code>
	 * 
	 * @param mixed $message
	 *
	 * @return string
	 */
	public function error($message) {}

	/**
	 * Shows a HTML notice/information message
	 *
	 *<code>
	 * $flash->notice('This is an information');
	 *</code>
	 * 
	 * @param mixed $message
	 *
	 * @return string
	 */
	public function notice($message) {}

	/**
	 * Shows a HTML success message
	 *
	 *<code>
	 * $flash->success('The process was finished successfully');
	 *</code>
	 * 
	 * @param string $message
	 *
	 * @return string
	 */
	public function success($message) {}

	/**
	 * Shows a HTML warning message
	 *
	 *<code>
	 * $flash->warning('Hey, this is important');
	 *</code>
	 * 
	 * @param mixed $message
	 *
	 * @return string
	 */
	public function warning($message) {}

	/**
	 * Outputs a message formatting it with HTML
	 *
	 *<code>
	 * $flash->outputMessage('error', message);
	 *</code>
	 * 
	 * @param string $type
	 * @param mixed $message
	 *
	 *
	 * @return mixed
	 */
	public function outputMessage($type, $message) {}

	/**
			 * We create the message with implicit flush or other
			 *
	 * @return void
	 */
	public function clear() {}

}
