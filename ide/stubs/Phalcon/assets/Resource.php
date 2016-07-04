<?php

namespace Phalcon\Assets;

/**
 * Phalcon\Assets\Resource
 * Represents an asset resource
 * <code>
 * $resource = new \Phalcon\Assets\Resource('js', 'javascripts/jquery.js');
 * </code>
 */
class Resource
{
    /**
     * @var string
     */
    protected $_type;

    /**
     * @var string
     */
    protected $_path;

    /**
     * @var boolean
     */
    protected $_local;

    /**
     * @var boolean
     */
    protected $_filter;

    /**
     * @var array | null
     */
    protected $_attributes;


    protected $_sourcePath;


    protected $_targetPath;


    protected $_targetUri;


    /**
     * @return string 
     */
    public function getType() {}

    /**
     * @return string 
     */
    public function getPath() {}

    /**
     * @return boolean 
     */
    public function getLocal() {}

    /**
     * @return boolean 
     */
    public function getFilter() {}

    /**
     * @return array|null 
     */
    public function getAttributes() {}


    public function getSourcePath() {}


    public function getTargetPath() {}


    public function getTargetUri() {}

    /**
     * Phalcon\Assets\Resource constructor
     *
     * @param string $type 
     * @param string $path 
     * @param boolean $local 
     * @param boolean $filter 
     * @param array $attributes 
     */
    public function __construct($type, $path, $local = true, $filter = true, $attributes = null) {}

    /**
     * Sets the resource's type
     *
     * @param string $type 
     * @return Resource 
     */
    public function setType($type) {}

    /**
     * Sets the resource's path
     *
     * @param string $path 
     * @return Resource 
     */
    public function setPath($path) {}

    /**
     * Sets if the resource is local or external
     *
     * @param bool $local 
     * @return Resource 
     */
    public function setLocal($local) {}

    /**
     * Sets if the resource must be filtered or not
     *
     * @param bool $filter 
     * @return Resource 
     */
    public function setFilter($filter) {}

    /**
     * Sets extra HTML attributes
     *
     * @param array $attributes 
     * @return Resource 
     */
    public function setAttributes(array $attributes) {}

    /**
     * Sets a target uri for the generated HTML
     *
     * @param string $targetUri 
     * @return Resource 
     */
    public function setTargetUri($targetUri) {}

    /**
     * Sets the resource's source path
     *
     * @param string $sourcePath 
     * @return Resource 
     */
    public function setSourcePath($sourcePath) {}

    /**
     * Sets the resource's target path
     *
     * @param string $targetPath 
     * @return Resource 
     */
    public function setTargetPath($targetPath) {}

    /**
     * Returns the content of the resource as an string
     * Optionally a base path where the resource is located can be set
     *
     * @param string $basePath 
     * @return string 
     */
    public function getContent($basePath = null) {}

    /**
     * Returns the real target uri for the generated HTML
     *
     * @return string 
     */
    public function getRealTargetUri() {}

    /**
     * Returns the complete location where the resource is located
     *
     * @param string $basePath 
     * @return string 
     */
    public function getRealSourcePath($basePath = null) {}

    /**
     * Returns the complete location where the resource must be written
     *
     * @param string $basePath 
     * @return string 
     */
    public function getRealTargetPath($basePath = null) {}

}
