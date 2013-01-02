<?php 

namespace Phalcon {

	/**
	 * Phalcon\Translate
	 *
	 * Translate component allows the creation of multi-language applications using
	 * different adapters for translation lists.
	 */
	
	abstract class Translate {

		/**
		 * Returns the translation string of the given key
		 *
		 * @param string $translateKey
		 * @param array $placeholders
		 * @return string
		 */
		public function _($translateKey, $placeholders){ }


		/**
		 * Sets a translation value
		 *
		 * @param 	string $offset
		 * @param 	string $value
		 */
		public function offsetSet($offset, $value){ }


		/**
		 * Check whether a translation key exists
		 *
		 * @param string $translateKey
		 * @return boolean
		 */
		public function offsetExists($translateKey){ }


		/**
		 * Elimina un indice del diccionario
		 *
		 * @param string $offset
		 */
		public function offsetUnset($offset){ }


		/**
		 * Returns the translation related to the given key
		 *
		 * @param string $traslateKey
		 * @return string
		 */
		public function offsetGet($traslateKey){ }

	}
}
