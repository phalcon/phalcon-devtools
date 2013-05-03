<?php 

namespace Phalcon\Annotations\Adapter {

	/**
	 * Phalcon\Annotations\Adapter\Apc
	 *
	 * Stores the parsed annotations in APC. This adapter is the suitable for production
	 *
	 *<code>
	 * $annotations = new \Phalcon\Annotations\Adapter\Apc();
	 *</code>
	 */
	
	class Apc extends \Phalcon\Annotations\Adapter implements \Phalcon\Annotations\AdapterInterface {

		/**
		 * Reads parsed annotations from Apc
		 *
		 * @param string $key
		 * @return array
		 */
		public function read($key){ }


		/**
		 * Writes parsed annotations to APC
		 *
		 * @param string $key
		 * @param array $data
		 */
		public function write($key, $data){ }

	}
}
