<?php

namespace Phalcon\Assets;

/**
 * Phalcon\Assets\Inline
 * Represents an inline asset
 * <code>
 * $inline = new \Phalcon\Assets\Inline('js', 'alert("hello world");');
 * </code>
 */
class Inline
{

    protected $_type;


    protected $_content;


    protected $_filter;


    protected $_attributes;



    public function getType() {}


    public function getContent() {}


    public function getFilter() {}


    public function getAttributes() {}

    /**
     * Phalcon\Assets\Inline constructor
     *
     * @param string $type 
     * @param string $content 
     * @param boolean $filter 
     * @param array $attributes 
     */
    public function __construct($type, $content, $filter = true, $attributes = null) {}

    /**
     * Sets the inline's type
     *
     * @param string $type 
     * @return Inline 
     */
    public function setType($type) {}

    /**
     * Sets if the resource must be filtered or not
     *
     * @param bool $filter 
     * @return Inline 
     */
    public function setFilter($filter) {}

    /**
     * Sets extra HTML attributes
     *
     * @param array $attributes 
     * @return Inline 
     */
    public function setAttributes(array $attributes) {}

}
