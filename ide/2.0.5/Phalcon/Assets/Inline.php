<?php

namespace Phalcon\Assets;

class Inline
{

	protected $_type;

	public function getType() {
		return $this->_type;
	}

	protected $_content;

	public function getContent() {
		return $this->_content;
	}

	protected $_filter;

	public function getFilter() {
		return $this->_filter;
	}

	protected $_attributes;

	public function getAttributes() {
		return $this->_attributes;
	}



	/**
	 * Phalcon\Assets\Inline constructor
	 * 
	 * @param string $type
	 * @param string $content
	 * @param boolean $filter
	 * @param array $attributes
	 *
	 */
	public function __construct($type, $content, $filter=true, $attributes=null) {}

	/**
	 * Sets the inline's type
	 * 
	 * @param string $type
	 *
	 * @return 
	 */
	public function setType($type) {}

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

}
