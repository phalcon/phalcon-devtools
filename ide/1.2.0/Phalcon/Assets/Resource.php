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

		protected $_filter;

		protected $_attributes;

		/**
		 * \Phalcon\Assets\Resource constructor
		 *
		 * @param string $type
		 * @param string $path
		 * @param boolean $local
		 * @param boolean $filter
		 * @param array $attributes
		 */
		public function __construct($type, $path, $local=null, $filter=null, $attributes=null){ }


		/**
		 * Sets the resource's type
		 *
		 * @param string $type
		 * @return \Phalcon\Assets\Resource
		 */
		public function setType($type){ }


		/**
		 * Returns the type of resource
		 *
		 * @return string
		 */
		public function getType(){ }


		/**
		 * Sets the resource's path
		 *
		 * @param string $path
		 * @return \Phalcon\Assets\Resource
		 */
		public function setPath($path){ }


		/**
		 * Returns the URI/URL path to the resource
		 *
		 * @return string
		 */
		public function getPath(){ }


		/**
		 * Sets if the resource is local or external
		 *
		 * @param boolean $local
		 * @return \Phalcon\Assets\Resource
		 */
		public function setLocal($local){ }


		/**
		 * Returns whether the resource is local or external
		 *
		 * @return boolean
		 */
		public function getLocal(){ }


		/**
		 * Sets if the resource must be filtered or not
		 *
		 * @param boolean $filter
		 * @return \Phalcon\Assets\Resource
		 */
		public function setFilter($filter){ }


		/**
		 * Returns whether the resource must be filtered or not
		 *
		 * @return boolean
		 */
		public function getFilter(){ }


		/**
		 * Sets extra HTML attributes
		 *
		 * @param array $attributes
		 * @return \Phalcon\Assets\Resource
		 */
		public function setAttributes($attributes){ }


		/**
		 * Returns extra HTML attributes set in the resource
		 *
		 * @return array
		 */
		public function getAttributes(){ }


		/**
		 * Returns the content of the resource as an string
		 * Optionally a path where the resource is located can be set
		 *
		 * @param string $path
		 * @return string
		 */
		public function getContent(){ }

	}
}
