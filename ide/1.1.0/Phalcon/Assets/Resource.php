<?php 

namespace Phalcon\Assets {

	/**
	 * Phalcon\Assets\Resource
	 *
	 * Represents an asset resource
	 */
	
	class Resource {

		protected $_type;

		protected $_path;

		protected $_local;

		/**
		 * \Phalcon\Assets\Resource
		 *
		 * @param string $type
		 * @param string $path
		 * @param boolean $local
		 */
		public function __construct($type, $path, $local=null){ }


		/**
		 * Returns the type of resource
		 *
		 * @return string
		 */
		public function getType(){ }


		/**
		 * Returns the URI/URL path to the resource
		 *
		 * @return string
		 */
		public function getPath(){ }


		/**
		 * Returns whether the resource is local or external
		 *
		 * @return boolean
		 */
		public function getLocal(){ }

	}
}
