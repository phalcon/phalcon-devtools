<?php 

namespace Phalcon\Flash {

	/**
	 * Phalcon\Flash\Session
	 *
	 * Temporarily stores the messages in session, then messages can be printed in the next request
	 */
	
	class Session extends \Phalcon\Flash implements \Phalcon\FlashInterface, \Phalcon\DI\InjectionAwareInterface {

		protected $_dependencyInjector;

		/**
		 * Sets the dependency injector
		 *
		 * @param \Phalcon\DiInterface $dependencyInjector
		 */
		public function setDI($dependencyInjector){ }


		/**
		 * Returns the internal dependency injector
		 *
		 * @return \Phalcon\DiInterface
		 */
		public function getDI(){ }


		/**
		 * Returns the messages stored in session
		 *
		 * @param boolean $remove
		 * @return array
		 */
		protected function _getSessionMessages(){ }


		/**
		 * Stores the messages in session
		 *
		 * @param array $messages
		 */
		protected function _setSessionMessages(){ }


		/**
		 * Adds a message to the session flasher
		 *
		 * @param string $type
		 * @param string $message
		 */
		public function message($type, $message){ }


		/**
		 * Returns the messages in the session flasher
		 *
		 * @param string $type
		 * @param boolean $remove
		 * @return array
		 */
		public function getMessages($type=null, $remove=null){ }


		/**
		 * Prints the messages in the session flasher
		 *
		 * @param string $type
		 * @param boolean $remove
		 */
		public function output($remove=null){ }

	}
}
