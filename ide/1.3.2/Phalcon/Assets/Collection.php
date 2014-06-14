<?php 

namespace Phalcon\Assets {

	/**
	 * Phalcon\Assets\Collection
	 *
	 * Represents a collection of resources
	 */
	
	class Collection implements \Countable, \Iterator, \Traversable {

		protected $_prefix;

		protected $_local;

		protected $_resources;

		protected $_position;

		protected $_filters;

		protected $_attributes;

		protected $_join;

		protected $_targetUri;

		protected $_targetPath;

		protected $_sourcePath;

		protected $_targetLocal;

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
		 * @param boolean $filter
		 * @param array $attributes
		 * @return \Phalcon\Assets\Collection
		 */
		public function addCss($path, $local=null, $filter=null, $attributes=null){ }


		/**
		 * Adds a javascript resource to the collection
		 *
		 * @param string $path
		 * @param boolean $local
		 * @param boolean $filter
		 * @param array $attributes
		 * @return \Phalcon\Assets\Collection
		 */
		public function addJs($path, $local=null, $filter=null, $attributes=null){ }


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
		 * Sets the target path of the file for the filtered/join output
		 *
		 * @param string $targetPath
		 * @return \Phalcon\Assets\Collection
		 */
		public function setTargetPath($targetPath){ }


		/**
		 * Returns the target path of the file for the filtered/join output
		 *
		 * @return string
		 */
		public function getTargetPath(){ }


		/**
		 * Sets a base source path for all the resources in this collection
		 *
		 * @param string $sourcePath
		 * @return \Phalcon\Assets\Collection
		 */
		public function setSourcePath($sourcePath){ }


		/**
		 * Returns the base source path for all the resources in this collection
		 *
		 * @return string
		 */
		public function getSourcePath(){ }


		/**
		 * Sets a target uri for the generated HTML
		 *
		 * @param string $targetUri
		 * @return \Phalcon\Assets\Collection
		 */
		public function setTargetUri($targetUri){ }


		/**
		 * Returns the target uri for the generated HTML
		 *
		 * @return string
		 */
		public function getTargetUri(){ }


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


		/**
		 * Sets extra HTML attributes
		 *
		 * @param array $attributes
		 * @return $this
		 */
		public function setAttributes($attributes){ }


		/**
		 * Returns extra HTML attributes
		 *
		 * @return array
		 */
		public function getAttributes(){ }


		/**
		 * Adds a filter to the collection
		 *
		 * @param \Phalcon\Assets\FilterInterface $filter
		 * @return \Phalcon\Assets\Collection
		 */
		public function addFilter($filter){ }


		/**
		 * Sets an array of filters in the collection
		 *
		 * @param array $filters
		 * @return \Phalcon\Assets\Collection
		 */
		public function setFilters($filters){ }


		/**
		 * Returns the filters set in the collection
		 *
		 * @return array
		 */
		public function getFilters(){ }


		/**
		 * Sets if all filtered resources in the collection must be joined in a single result file
		 *
		 * @param boolean $join
		 * @return \Phalcon\Assets\Collection
		 */
		public function join($join){ }


		/**
		 * Returns if all the filtered resources must be joined
		 *
		 * @return boolean
		 */
		public function getJoin(){ }


		/**
		 * Returns the complete location where the joined/filtered collection must be written
		 *
		 * @param string $basePath
		 * @return string
		 */
		public function getRealTargetPath($basePath=null){ }


		/**
		 * Sets the target local
		 *
		 * @param boolean $targetLocal
		 * @return \Phalcon\Assets\Collection
		 */
		public function setTargetLocal($targetLocal){ }


		/**
		 * Returns the target local
		 *
		 * @return boolean
		 */
		public function getTargetLocal(){ }

	}
}
