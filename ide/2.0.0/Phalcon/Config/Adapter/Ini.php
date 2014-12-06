<?php 

namespace Phalcon\Config\Adapter {

	class Ini extends \Phalcon\Config implements \Countable, \ArrayAccess {

		/**
		 * \Phalcon\Config\Adapter\Ini constructor
		 *
		 * @param string filePath
		 */
		public function __construct($filePath){ }

	}
}
