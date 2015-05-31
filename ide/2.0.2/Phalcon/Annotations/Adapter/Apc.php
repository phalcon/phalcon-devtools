<?php 

namespace Phalcon\Annotations\Adapter {

	/**
	 * Phalcon\Annotations\Adapter\Apc
	 *
	 * Stores the parsed annotations in APC. This adapter is suitable for production
	 *
	 *<code>
	 * $annotations = new \Phalcon\Annotations\Adapter\Apc();
	 *</code>
	 */
	
	class Apc extends \Phalcon\Annotations\Adapter implements \Phalcon\Annotations\AdapterInterface {

		protected $_prefix;

		protected $_ttl;

		/**
		 * \Phalcon\Annotations\Adapter\Apc constructor
		 *
		 * @param array options
		 */
		public function __construct($options=null){ }


		/**
		 * Reads parsed annotations from APC
		 *
		 * @param string key
		 * @return \Phalcon\Annotations\Reflection
		 */
		public function read($key){ }


		/**
		 * Writes parsed annotations to APC
		 */
		public function write($key, \Phalcon\Annotations\Reflection $data){ }

	}
}
