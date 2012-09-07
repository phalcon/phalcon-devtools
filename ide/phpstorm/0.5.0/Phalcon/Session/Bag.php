<?php 

namespace Phalcon\Session {

	/**
	 * Phalcon\Session\Bag
	 *
	 * This component helps to separate session data into namespaces. Working by this way
	 * you can easily create groups of session variables into the application
	 */
	
	class Bag {

		protected $_dependencyInjector;

		protected $_name;

		protected $_data;

		protected $_initalized;

		protected $_session;

		public function __construct(){ }


		public function setDI($dependencyInjector){ }


		public function getDI(){ }


		public function initialize(){ }


		/**
		 * Setter of values
		 *
		 * @param string $property
		 * @param string $value
		 */
		public function __set($property, $value){ }


		/**
		 * Getter of values
		 *
		 * @param string $property
		 * @return string
		 */
		public function __get($property){ }

	}
}
