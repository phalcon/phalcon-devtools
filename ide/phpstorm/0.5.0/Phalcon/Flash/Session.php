<?php 

namespace Phalcon\Flash {

	class Session extends \Phalcon\Flash {

		protected $_cssClasses;

		protected $_implicitFlush;

		protected $_automaticHtml;

		protected $_dependencyInjector;

		/**
		 * Sets the dependency injector
		 *
		 * @param Phalcon\DI $dependencyInjector
		 */
		public function setDI($dependencyInjector){ }


		/**
		 * Returns the internal dependency injector
		 *
		 * @return Phalcon\DI
		 */
		public function getDI(){ }


		protected function _getSessionMessages(){ }


		protected function _setSessionMessages(){ }


		public function message($type, $message){ }


		public function getMessages($type, $remove){ }


		public function output($remove){ }

	}
}
