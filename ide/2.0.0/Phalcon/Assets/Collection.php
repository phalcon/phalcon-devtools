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

		protected $_codes;

		protected $_position;

		protected $_filters;

		protected $_attributes;

		protected $_join;

		protected $_targetUri;

		protected $_targetPath;

		protected $_targetLocal;

		protected $_sourcePath;

		public function getPrefix(){ }


		public function getLocal(){ }


		public function getResources(){ }


		public function getCodes(){ }


		public function getPosition(){ }


		public function getFilters(){ }


		public function getAttributes(){ }


		public function getJoin(){ }


		public function getTargetUri(){ }


		public function getTargetPath(){ }


		public function getTargetLocal(){ }


		public function getSourcePath(){ }


		/**
		 * Adds a resource to the collection
		 *
		 * @param \Phalcon\Assets\Resource resource
		 * @return \Phalcon\Assets\Collection
		 */
		public function add(\Phalcon\Assets\Resource $resource){ }


		/**
		 * Adds a inline code to the collection
		 *
		 * @param \Phalcon\Assets\Inline code
		 * @return \Phalcon\Assets\Collection
		 */
		public function addInline(\Phalcon\Assets\Inline $code){ }


		/**
		 * Adds a CSS resource to the collection
		 *
		 * @param string path
		 * @param boolean local
		 * @param boolean filter
		 * @param array attributes
		 * @return \Phalcon\Assets\Collection
		 */
		public function addCss($path, $local=null, $filter=null, $attributes=null){ }


		/**
		 * Adds a inline CSS to the collection
		 *
		 * @param string content
		 * @param boolean filter
		 * @param array attributes
		 * @return \Phalcon\Assets\Collection
		 */
		public function addInlineCss($content, $filter=null, $attributes=null){ }


		/**
		 * Adds a javascript resource to the collection
		 *
		 * @param string path
		 * @param boolean local
		 * @param boolean filter
		 * @param array attributes
		 * @return \Phalcon\Assets\Collection
		 */
		public function addJs($path, $local=null, $filter=null, $attributes=null){ }


		/**
		 * Adds a inline javascript to the collection
		 *
		 * @param string content
		 * @param boolean filter
		 * @param array attributes
		 * @return \Phalcon\Assets\Collection
		 */
		public function addInlineJs($content, $filter=null, $attributes=null){ }


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
		 * Sets a base source path for all the resources in this collection
		 *
		 * @param string $sourcePath
		 * @return \Phalcon\Assets\Collection
		 */
		public function setSourcePath($sourcePath){ }


		/**
		 * Sets a target uri for the generated HTML
		 *
		 * @param string $targetUri
		 * @return \Phalcon\Assets\Collection
		 */
		public function setTargetUri($targetUri){ }


		/**
		 * Sets a common prefix for all the resources
		 *
		 * @param string $prefix
		 * @return \Phalcon\Assets\Collection
		 */
		public function setPrefix($prefix){ }


		/**
		 * Sets if the collection uses local resources by default
		 *
		 * @param boolean $local
		 * @return \Phalcon\Assets\Collection
		 */
		public function setLocal($local){ }


		/**
		 * Sets extra HTML attributes
		 *
		 * @param array $attributes
		 * @return $this
		 */
		public function setAttributes($attributes){ }


		/**
		 * Sets an array of filters in the collection
		 *
		 * @param array $filters
		 * @return \Phalcon\Assets\Collection
		 */
		public function setFilters($filters){ }


		/**
		 * Sets the target local
		 *
		 * @param boolean $targetLocal
		 * @return \Phalcon\Assets\Collection
		 */
		public function setTargetLocal($targetLocal){ }


		/**
		 * Sets if all filtered resources in the collection must be joined in a single result file
		 *
		 * @param boolean join
		 * @return \Phalcon\Assets\Collection
		 */
		public function join($join){ }


		/**
		 * Returns the complete location where the joined/filtered collection must be written
		 *
		 * @param string basePath
		 * @return string
		 */
		public function getRealTargetPath($basePath){ }


		/**
		 * Adds a filter to the collection
		 *
		 * @param \Phalcon\Assets\FilterInterface $filter
		 * @return \Phalcon\Assets\Collection
		 */
		public function addFilter(\Phalcon\Assets\FilterInterface $filter){ }

	}
}
