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
		public function __set($property, $value);


		/**
		 * Getter of values
		 *
		 * @param string $property
		 * @return string
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
