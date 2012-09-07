<?php 

namespace Phalcon\Translate\Adapter {

	/**
	 * Phalcon\Translate\Adapter\NativeArray
	 *
	 * Allows to define translation lists using PHP arrays
	 *
	 */
	
	class NativeArray extends \Phalcon\Translate {

		protected $_translate;

		/**
		 * \Phalcon\Translate\Adapter\NativeArray constructor
		 *
		 * @param array $data
		 */
		public function __construct($options){ }


		/**
		 * Returns the translation related to the given key
		 *
		 * @param string $index
		 * @param array $placeholders
		 * @return string
		 */
		public function query($index, $placeholders){ }


		/**
		 * Check whether is defined a translation key in the internal array
		 *
		 * @param 	string $index
		 * @return bool
		 */
		public function exists($index){ }

	}
}
