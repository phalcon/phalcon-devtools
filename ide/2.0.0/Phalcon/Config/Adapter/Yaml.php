<?php 

namespace Phalcon\Config\Adapter {

	class Yaml extends \Phalcon\Config implements \Countable, \ArrayAccess {

		/**
		 * \Phalcon\Config\Adapter\Yaml constructor
		 *
		 * @param  string                    $filePath
		 * @param  array                     $callbacks
		 * @throws \Phalcon\Config\Exception
		 */
		public function __construct($filePath, $callbacks=null){ }

	}
}
