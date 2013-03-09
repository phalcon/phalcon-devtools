<?php 

namespace Phalcon\Annotations\Adapter {

	/**
	 * Phalcon\Annotations\Adapter\Memory
	 *
	 * Stores the parsed annotations in memory. This adapter is the suitable for development/testing
	 */
	
	class Memory extends \Phalcon\Annotations\Adapter implements \Phalcon\Annotations\AdapterInterface {

		protected $_data;

		/**
		 * Reads meta-data from memory
		 *
		 * @param string $key
		 * @return array
		 */
		public function read($key){ }


		/**
		 * Writes the meta-data to files
		 *
		 * @param string $key
		 * @param array $data
		 */
		public function write($key, $data){ }

	}
}
