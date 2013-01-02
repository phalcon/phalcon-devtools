<?php 

namespace Phalcon\Session {

	/**
	 * Phalcon\Session\Bag
	 *
	 * This component helps to separate session data into "namespaces". Working by this way
	 * you can easily create groups of session variables into the application
	 *
	 *<code>
	 * $user = new Phalcon\Session\Bag();
	 * $user->name = "Kimbra Johnson";
	 * $user->age = 22;
	 *</code>
	 */
	
	class Bag {

		protected $_dependencyInjector;

		protected $_name;

		protected $_data;

		protected $_initalized;

		protected $_session;

		/**
		 * \Phalcon\Session\Bag constructor
		 */
		public function __construct($name){ }


		/**
		 * Sets the DependencyInjector container
		 *
		 * @param \Phalcon\DiInterface $dependencyInjector
		 */
		public function setDI($dependencyInjector){ }


		/**
		 * Returns the DependencyInjector container
		 *
		 * @return \Phalcon\DiInterface
		 */
		public function getDI(){ }


		/**
		 * Initializes the session bag. This method must not be called directly, the class calls it when its internal data is accesed
		 */
		public function initialize(){ }


		/**
		 * Destroyes the session bag
		 */
		public function destroy(){ }


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


		/**
		 * Isset property
		 *
		 * @param string $property
		 * @return boolean
		 */
		public function __isset($property){ }

	}
}
