<?php 

namespace Phalcon\Assets {

	/**
	 * Phalcon\Assets\Collection
	 *
	 * Represents a collection of resources // ArrayAccess,
	 */
	
	class Collection implements \Countable, \Iterator, \Traversable {

		protected $_prefix;

		protected $_local;

		protected $_resources;

		protected $_position;

		/**
		 * Adds a resource to the collection
		 *
		 * @param \Phalcon\Assets\Resource $resource
		 * @return \Phalcon\Assets\Collection
		 */
		public function add($resource){ }


		/**
		 * Adds a CSS resource to the collection
		 *
		 * @param string $path
		 * @param boolean $local
		 * @return \Phalcon\Assets\Collection
		 */
		public function addCss($path, $local=null){ }


		/**
		 * Adds a Js resource to the collection
		 *
		 * @param string $path
		 * @param boolean $local
		 * @return \Phalcon\Assets\Collection
		 */
		public function addJs($path, $local=null){ }


		/**
		 * Returns the resources as an array
		 *
		 * @return \Phalcon\Assets\Resource[]
		 */
		public function getResources(){ }


		/**
		 * Returns the number of elements in the form
		 *
		 * @return int
		 */
		public function count(){ }


		/**
		 * Rewinds the internal iterator
		 */
		public function rewind(){ }


		/**
		 * Returns the current resource in the iterator
		 *
		 * @return \Phalcon\Assets\Resource
		 */
		public function current(){ }


		/**
		 * Returns the current position/key in the iterator
		 *
		 * @return int
		 */
		public function key(){ }


		/**
		 * Moves the internal iteration pointer to the next position
		 *
		 */
		public function next(){ }


		/**
		 * Check if the current element in the iterator is valid
		 *
		 * @return boolean
		 */
		public function valid(){ }


		/**
		 * Sets a common prefix for all the resources
		 *
		 * @param string $prefix
		 * @return \Phalcon\Assets\Collection
		 */
		public function setPrefix($prefix){ }


		/**
		 * Returns the prefix
		 *
		 * @return string
		 */
		public function getPrefix(){ }


		/**
		 * Sets if the collection uses local resources by default
		 *
		 * @param boolean $local
		 * @return \Phalcon\Assets\Collection
		 */
		public function setLocal($local){ }


		/**
		 * Returns if the collection uses local resources by default
		 *
		 * @return boolean
		 */
		public function getLocal(){ }

	}
}
