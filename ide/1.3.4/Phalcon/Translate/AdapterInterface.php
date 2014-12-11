<?php 

namespace Phalcon\Translate {

	/**
	 * Phalcon\Translate\AdapterInterface initializer
	 */
	
	interface AdapterInterface {

		/**
		 * Returns the translation related to the given key
		 *
		 * @param string $index
		 * @param array $placeholders
		 * @return string
		 */
		public function query($index, $placeholders=null);


		/**
		 * Check whether is defined a translation key in the internal array
		 *
		 * @param 	string $index
		 * @return bool
		 */
		public function exists($index);

	}
}
