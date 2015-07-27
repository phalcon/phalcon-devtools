<?php 

namespace Phalcon\Assets {

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
		 */
		public function add(\Phalcon\Assets\Resource $resource){ }


		/**
		 * Adds a inline code to the collection
		 */
		public function addInline(\Phalcon\Assets\Inline $code){ }


		/**
		 * Adds a CSS resource to the collection
		 */
		public function addCss($path, $local=null, $filter=null, $attributes=null){ }


		/**
		 * Adds a inline CSS to the collection
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
		 */
		public function count(){ }


		/**
		 * Rewinds the internal iterator
		 */
		public function rewind(){ }


		/**
		 * Returns the current resource in the iterator
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
		 */
		public function next(){ }


		/**
		 * Check if the current element in the iterator is valid
		 */
		public function valid(){ }


		/**
		 * Sets the target path of the file for the filtered/join output
		 */
		public function setTargetPath($targetPath){ }


		/**
		 * Sets a base source path for all the resources in this collection
		 */
		public function setSourcePath($sourcePath){ }


		/**
		 * Sets a target uri for the generated HTML
		 */
		public function setTargetUri($targetUri){ }


		/**
		 * Sets a common prefix for all the resources
		 */
		public function setPrefix($prefix){ }


		/**
		 * Sets if the collection uses local resources by default
		 */
		public function setLocal($local){ }


		/**
		 * Sets extra HTML attributes
		 */
		public function setAttributes($attributes){ }


		/**
		 * Sets an array of filters in the collection
		 */
		public function setFilters($filters){ }


		/**
		 * Sets the target local
		 */
		public function setTargetLocal($targetLocal){ }


		/**
		 * Sets if all filtered resources in the collection must be joined in a single result file
		 */
		public function join($join){ }


		/**
		 * Returns the complete location where the joined/filtered collection must be written
		 */
		public function getRealTargetPath($basePath){ }


		/**
		 * Adds a filter to the collection
		 */
		public function addFilter(\Phalcon\Assets\FilterInterface $filter){ }


		public function __construct(){ }

	}
}
