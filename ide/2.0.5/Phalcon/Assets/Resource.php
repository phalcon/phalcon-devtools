<?php

namespace Phalcon\Assets;

class Resource
{

	protected $_type;

	public function getType() {
		return $this->_type;
	}

	protected $_path;

	public function getPath() {
		return $this->_path;
	}

	protected $_local;

	public function getLocal() {
		return $this->_local;
	}

	protected $_filter;

	public function getFilter() {
		return $this->_filter;
	}

	protected $_attributes;

	public function getAttributes() {
		return $this->_attributes;
	}

	protected $_sourcePath;

	public function getSourcePath() {
		return $this->_sourcePath;
	}

	protected $_targetPath;

	public function getTargetPath() {
		return $this->_targetPath;
	}

	protected $_targetUri;

	public function getTargetUri() {
		return $this->_targetUri;
	}



	/**
	 * Phalcon\Assets\Resource constructor
	 * 
	 * @param string $type
	 * @param string $path
	 * @param boolean $local
	 * @param boolean $filter
	 * @param array $attributes
	 *
	 */
	public function __construct($type, $path, $local=true, $filter=true, $attributes=null) {}

	/**
	 * Sets the resource's type
	 * 
	 * @param string $type
	 *
	 * @return 
	 */
	public function setType($type) {}

	/**
	 * Sets the resource's path
	 * 
	 * @param string $path
	 *
	 * @return 
	 */
	public function setPath($path) {}

	/**
	 * Sets if the resource is local or external
	 * 
	 * @param boolean $local
	 *
	 * @return 
	 */
	public function setLocal($local) {}

	/**
	 * Sets if the resource must be filtered or not
	 * 
	 * @param boolean $filter
	 *
	 * @return 
	 */
	public function setFilter($filter) {}

	/**
	 * Sets extra HTML attributes
	 * 
	 * @param array $attributes
	 *
	 * @return 
	 */
	public function setAttributes(array $attributes) {}

	/**
	 * Sets a target uri for the generated HTML
	 * 
	 * @param string $targetUri
	 *
	 * @return 
	 */
	public function setTargetUri($targetUri) {}

	/**
	 * Sets the resource's source path
	 * 
	 * @param string $sourcePath
	 *
	 * @return 
	 */
	public function setSourcePath($sourcePath) {}

	/**
	 * Sets the resource's target path
	 * 
	 * @param string $targetPath
	 *
	 * @return 
	 */
	public function setTargetPath($targetPath) {}

	/**
	 * Returns the content of the resource as an string
	 * Optionally a base path where the resource is located can be set
	 * 
	 * @param string $basePath
	 *
	 * @return string
	 */
	public function getContent($basePath=null) {}

	/**
		 * A base path for resources can be set in the assets manager
		 *
	 * @return string
	 */
	public function getRealTargetUri() {}

	/**
	 * Returns the complete location where the resource is located
	 * 
	 * @param string $basePath
	 *
	 * @return string
	 */
	public function getRealSourcePath($basePath=null) {}

	/**
			 * Get the real template path
	 * 
	 * @param string $basePath
			 *
	 * @return string
	 */
	public function getRealTargetPath($basePath=null) {}

}
