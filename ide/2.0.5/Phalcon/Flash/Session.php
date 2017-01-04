<?php

namespace Phalcon\Flash;

use Phalcon\Flash as FlashBase;
use Phalcon\DiInterface;
use Phalcon\FlashInterface;
use Phalcon\Di\InjectionAwareInterface;
use Phalcon\Flash\Exception;
use Phalcon\Session\AdapterInterface as SessionInterface;


class Session extends FlashBase implements FlashInterface, InjectionAwareInterface
{

	protected $_dependencyInjector;



	/**
	 * Sets the dependency injector
	 * 
	 * @param DiInterface $dependencyInjector
	 *
	 * @return void
	 */
	public function setDI(DiInterface $dependencyInjector) {}

	/**
	 * Returns the internal dependency injector
	 *
	 * @return DiInterface
	 */
	public function getDI() {}

	/**
	 * Returns the messages stored in session
	 * 
	 * @param boolean $remove
	 *
	 * @return array
	 */
	protected function _getSessionMessages($remove) {}

	/**
	 * Stores the messages in session
	 * 
	 * @param array $messages
	 *
	 * @return array
	 */
	protected function _setSessionMessages(array $messages) {}

	/**
	 * Adds a message to the session flasher
	 * 
	 * @param string $type
	 * @param string $message
	 *
	 * @return void
	 */
	public function message($type, $message) {}

	/**
	 * Checks whether there are messages
	 * 
	 * @param $type
	 *
	 * @return boolean
	 */
	public function has($type=null) {}

	/**
	 * Returns the messages in the session flasher
	 * 
	 * @param $type
	 * @param boolean $remove
	 *
	 * @return array
	 */
	public function getMessages($type=null, $remove=true) {}

	/**
	 * Prints the messages in the session flasher
	 * 
	 * @param boolean $remove
	 *
	 * @return void
	 */
	public function output($remove=true) {}

	/**
	 * Clear messages in the session messenger
	 *
	 * @return void
	 */
	public function clear() {}

}
