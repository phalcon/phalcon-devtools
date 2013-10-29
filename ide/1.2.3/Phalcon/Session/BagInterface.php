<?php 

namespace Phalcon\Session {

	/**
	 * Phalcon\Session\BagInterface initializer
	 */
	
	interface BagInterface {

		/**
		 * Initializes the session bag. This method must not be called directly, the class calls it when its internal data is accesed
		 */
		public function initialize();


		/**
		 * Destroyes the session bag
		 */
		public function destroy();


		/**
		 * Setter of values
		 *
		 * @param string $property
		 * @param string $value
		 */
		public function set($property, $value);


		/**
		 * Getter of values
		 *
		 * @param string $property
		 * @param mixed $defaultValue
		 * @return mixed
		 */
		public function get($property, $defaultValue=null);


		/**
		 * Isset property
		 *
		 * @param string $property
		 * @return boolean
		 */
		public function has($property);


		/**
		 * Setter of values
		 *
		 * @param string $property
		 * @param string $value
		 */
		public function __set($property, $value);


		/**
		 * Getter of values
		 *
		 * @param string $property
		 * @return mixed
		 */
		public function __get($property);


		/**
		 * Isset property
		 *
		 * @param string $property
		 * @return boolean
		 */
		public function __isset($property);

	}
}
