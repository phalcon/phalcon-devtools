<?php 

namespace Phalcon\Session {

	/**
	 * Phalcon\Session\Bag
	 *
	 * This component helps to separate session data into "namespaces". Working by this way
	 * you can easily create groups of session variables into the application
	 *
	 *<code>
	 *	$user = new \Phalcon\Session\Bag();
	 *	$user->name = "Kimbra Johnson";
	 *	$user->age = 22;
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
		 *
		 * @param string $name
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
		 *
		 *<code>
		 * $user->destroy();
		 *</code>
		 */
		public function destroy(){ }


		/**
		 * Sets a value in the session bag
		 *
		 *<code>
		 * $user->set('name', 'Kimbra');
		 *</code>
		 *
		 * @param string $property
		 * @param string $value
		 */
		public function set($property, $value){ }


		/**
		 * Magic setter to assign values to the session bag
		 *
		 *<code>
		 * $user->name = Kimbra;
		 *</code>
		 *
		 * @param string $property
		 * @param string $value
		 */
		public function __set($property, $value){ }


		/**
		 * Obtains a value from the session bag optionally setting a default value
		 *
		 *<code>
		 * echo $user->get('name', 'Kimbra');
		 *</code>
		 *
		 * @param string $property
		 * @param string $defaultValue
		 * @return mixed
		 */
		public function get($property, $defaultValue=null){ }


		/**
		 * Magic getter to obtain values from the session bag
		 *
		 *<code>
		 * echo $user->name;
		 *</code>
		 *
		 * @param string $property
		 * @return string
		 */
		public function __get($property){ }


		/**
		 * Check whether a property is defined in the internal bag
		 *
		 *<code>
		 * var_dump($user->has('name'));
		 *</code>
		 *
		 * @param string $property
		 * @return boolean
		 */
		public function has($property){ }


		/**
		 * Magic isset to check whether a property is defined in the bag
		 *
		 *<code>
		 * var_dump(isset($user['name']));
		 *</code>
		 *
		 * @param string $property
		 * @return boolean
		 */
		public function __isset($property){ }

	}
}
