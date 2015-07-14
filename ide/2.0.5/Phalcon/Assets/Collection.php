<?php

namespace Phalcon\Assets;

use Phalcon\Assets\Resource;
use Phalcon\Assets\FilterInterface;
use Phalcon\Assets\Inline;
use Phalcon\Assets\Resource\Css as ResourceCss;
use Phalcon\Assets\Resource\Js as ResourceJs;
use Phalcon\Assets\Inline\Js as InlineJs;
use Phalcon\Assets\Inline\Css as InlineCss;


class Collection implements \Countable, \Iterator
{

	protected $_prefix;

	public function getPrefix() {
		return $this->_prefix;
	}

	protected $_local = true;

	public function getLocal() {
		return $this->_local;
	}

	protected $_resources = [];

	public function getResources() {
		return $this->_resources;
	}

	protected $_codes = [];

	public function getCodes() {
		return $this->_codes;
	}

	protected $_position;

	public function getPosition() {
		return $this->_position;
	}

	protected $_filters = [];

	public function getFilters() {
		return $this->_filters;
	}

	protected $_attributes = [];

	public function getAttributes() {
		return $this->_attributes;
	}

	protected $_join = true;

	public function getJoin() {
		return $this->_join;
	}

	protected $_targetUri;

	public function getTargetUri() {
		return $this->_targetUri;
	}

	protected $_targetPath;

	public function getTargetPath() {
		return $this->_targetPath;
	}

	protected $_targetLocal = true;

	public function getTargetLocal() {
		return $this->_targetLocal;
	}

	protected $_sourcePath;

	public function getSourcePath() {
		return $this->_sourcePath;
	}



	/**
	 * Adds a resource to the collection
	 *
	 * @return Collection
	 */
	public function add() {}

	/**
	 * Adds a inline code to the collection
	 * 
	 * @param \$Inline $code
	 *
	 * @return Collection
	 */
	public function addInline(Inline $code) {}

	/**
	 * Adds a CSS resource to the collection
	 * 
	 * @param string $path
	 * @param mixed $local
	 * @param boolean $filter
	 * @param $attributes
	 *
	 * @return Collection
	 */
	public function addCss($path, $local=null, $filter=false, $attributes=null) {}

	/**
	 * Adds a inline CSS to the collection
	 * 
	 * @param string $content
	 * @param boolean $filter
	 * @param $attributes
	 *
	 * @return Collection
	 */
	public function addInlineCss($content, $filter=false, $attributes=null) {}

	/**
	 * Adds a javascript resource to the collection
	 *
	 * @param string $path
	 * @param mixed $local
	 * @param boolean $filter
	 * @param array $attributes
	 * 
	 * @return Collection
	 */
	public function addJs($path, $local=null, $filter=false, $attributes=null) {}

	/**
	 * Adds a inline javascript to the collection
	 * 
	 * @param string $content
	 * @param boolean $filter
	 * @param $attributes
	 *
	 * @return Collection
	 */
	public function addInlineJs($content, $filter=false, $attributes=null) {}

	/**
	 * Returns the number of elements in the form
	 *
	 * @return int
	 */
	public function count() {}

	/**
	 * Rewinds the internal iterator
	 *
	 * @return void
	 */
	public function rewind() {}

	/**
	 * Returns the current resource in the iterator
	 *
	 * @return 
	 */
	public function current() {}

	/**
	 * Returns the current position/key in the iterator
	 *
	 * @return mixed
	 */
	public function key() {}

	/**
	 * Moves the internal iteration pointer to the next position
	 *
	 * @return void
	 */
	public function next() {}

	/**
	 * Check if the current element in the iterator is valid
	 *
	 * @return boolean
	 */
	public function valid() {}

	/**
	 * Sets the target path of the file for the filtered/join output
	 * 
	 * @param string $targetPath
	 *
	 * @return Collection
	 */
	public function setTargetPath($targetPath) {}

	/**
	 * Sets a base source path for all the resources in this collection
	 * 
	 * @param string $sourcePath
	 *
	 * @return Collection
	 */
	public function setSourcePath($sourcePath) {}

	/**
	 * Sets a target uri for the generated HTML
	 * 
	 * @param string $targetUri
	 *
	 * @return Collection
	 */
	public function setTargetUri($targetUri) {}

	/**
	 * Sets a common prefix for all the resources
	 * 
	 * @param string $prefix
	 *
	 * @return Collection
	 */
	public function setPrefix($prefix) {}

	/**
	 * Sets if the collection uses local resources by default
	 * 
	 * @param boolean $local
	 *
	 * @return Collection
	 */
	public function setLocal($local) {}

	/**
	 * Sets extra HTML attributes
	 * 
	 * @param array $attributes
	 *
	 * @return Collection
	 */
	public function setAttributes(array $attributes) {}

	/**
	 * Sets an array of filters in the collection
	 * 
	 * @param array $filters
	 *
	 * @return Collection
	 */
	public function setFilters(array $filters) {}

	/**
	 * Sets the target local
	 * 
	 * @param boolean $targetLocal
	 *
	 * @return Collection
	 */
	public function setTargetLocal($targetLocal) {}

	/**
	 * Sets if all filtered resources in the collection must be joined in a single result file
	 * 
	 * @param boolean $join
	 *
	 * @return Collection
	 */
	public function join($join) {}

	/**
	 * Returns the complete location where the joined/filtered collection must be written
	 * 
	 * @param string $basePath
	 *
	 * @return string
	 */
	public function getRealTargetPath($basePath) {}

	/**
		 * A base path for resources can be set in the assets manager
	 * 
	 * @param FilterInterface $filter
		 *
	 * @return Collection
	 */
	public function addFilter(FilterInterface $filter) {}

}
