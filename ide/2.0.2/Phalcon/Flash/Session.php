<?php 

namespace Phalcon\Flash {

	/**
	 * Phalcon\Flash\Session
	 *
	 * Temporarily stores the messages in session, then messages can be printed in the next request
	 */
	
	class Session extends \Phalcon\Flash implements \Phalcon\FlashInterface, \Phalcon\Di\InjectionAwareInterface {

		protected $_dependencyInjector;

		/**
		 * Sets the dependency injector
		 */
		public function setDI(\Phalcon\DiInterface $dependencyInjector){ }


		/**
		 * Returns the internal dependency injector
		 */
		public function getDI(){ }


		/**
		 * Returns the messages stored in session
		 */
		protected function _getSessionMessages($remove){ }


		/**
		 * Stores the messages in session
		 */
		protected function _setSessionMessages($messages){ }


		/**
		 * Adds a message to the session flasher
		 */
		public function message($type, $message){ }


		/**
		 * Checks whether there are messages
		 */
		public function has($type=null){ }


		/**
		 * Returns the messages in the session flasher
		 */
		public function getMessages($type=null, $remove=null){ }


		/**
		 * Prints the messages in the session flasher
		 */
		public function output($remove=null){ }


		/**
		 * Clear messages in the session messenger
		 */
		public function clear(){ }

	}
}
