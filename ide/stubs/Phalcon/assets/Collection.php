<?php

namespace Phalcon\Assets;

/**
 * Phalcon\Assets\Collection
 *
 * Represents a collection of resources
 */
class Collection implements \Countable, \Iterator
{

    protected $_prefix;


    protected $_local = true;


    protected $_resources = array();


    protected $_codes = array();


    protected $_position;


    protected $_filters = array();


    protected $_attributes = array();


    protected $_join = true;


    protected $_targetUri;


    protected $_targetPath;


    protected $_targetLocal = true;


    protected $_sourcePath;



    public function getPrefix() {}


    public function getLocal() {}


    public function getResources() {}


    public function getCodes() {}


    public function getPosition() {}


    public function getFilters() {}


    public function getAttributes() {}


    public function getJoin() {}


    public function getTargetUri() {}


    public function getTargetPath() {}


    public function getTargetLocal() {}


    public function getSourcePath() {}

    /**
     * Adds a resource to the collection
     *
     * @param \Phalcon\Assets\Resource $resource
     * @return Collection
     */
    public function add(\Phalcon\Assets\Resource $resource) {}

    /**
     * Adds an inline code to the collection
     *
     * @param \Phalcon\Assets\Inline $code
     * @return Collection
     */
    public function addInline(\Phalcon\Assets\Inline $code) {}

    /**
     * Adds a CSS resource to the collection
     *
     * @param string $path
     * @param mixed $local
     * @param bool $filter
     * @param mixed $attributes
     * @return Collection
     */
    public function addCss($path, $local = null, $filter = true, $attributes = null) {}

    /**
     * Adds an inline CSS to the collection
     *
     * @param string $content
     * @param bool $filter
     * @param mixed $attributes
     * @return Collection
     */
    public function addInlineCss($content, $filter = true, $attributes = null) {}

    /**
     * Adds a javascript resource to the collection
     *
     * @param string $path
     * @param boolean $local
     * @param boolean $filter
     * @param array $attributes
     * @return Collection
     */
    public function addJs($path, $local = null, $filter = true, $attributes = null) {}

    /**
     * Adds an inline javascript to the collection
     *
     * @param string $content
     * @param bool $filter
     * @param mixed $attributes
     * @return Collection
     */
    public function addInlineJs($content, $filter = true, $attributes = null) {}

    /**
     * Returns the number of elements in the form
     *
     * @return int
     */
    public function count() {}

    /**
     * Rewinds the internal iterator
     */
    public function rewind() {}

    /**
     * Returns the current resource in the iterator
     *
     * @return \Phalcon\Assets\Resource
     */
    public function current() {}

    /**
     * Returns the current position/key in the iterator
     *
     * @return int
     */
    public function key() {}

    /**
     * Moves the internal iteration pointer to the next position
     */
    public function next() {}

    /**
     * Check if the current element in the iterator is valid
     *
     * @return bool
     */
    public function valid() {}

    /**
     * Sets the target path of the file for the filtered/join output
     *
     * @param string $targetPath
     * @return Collection
     */
    public function setTargetPath($targetPath) {}

    /**
     * Sets a base source path for all the resources in this collection
     *
     * @param string $sourcePath
     * @return Collection
     */
    public function setSourcePath($sourcePath) {}

    /**
     * Sets a target uri for the generated HTML
     *
     * @param string $targetUri
     * @return Collection
     */
    public function setTargetUri($targetUri) {}

    /**
     * Sets a common prefix for all the resources
     *
     * @param string $prefix
     * @return Collection
     */
    public function setPrefix($prefix) {}

    /**
     * Sets if the collection uses local resources by default
     *
     * @param bool $local
     * @return Collection
     */
    public function setLocal($local) {}

    /**
     * Sets extra HTML attributes
     *
     * @param array $attributes
     * @return Collection
     */
    public function setAttributes(array $attributes) {}

    /**
     * Sets an array of filters in the collection
     *
     * @param array $filters
     * @return Collection
     */
    public function setFilters(array $filters) {}

    /**
     * Sets the target local
     *
     * @param bool $targetLocal
     * @return Collection
     */
    public function setTargetLocal($targetLocal) {}

    /**
     * Sets if all filtered resources in the collection must be joined in a single result file
     *
     * @param bool $join
     * @return Collection
     */
    public function join($join) {}

    /**
     * Returns the complete location where the joined/filtered collection must be written
     *
     * @param string $basePath
     * @return string
     */
    public function getRealTargetPath($basePath) {}

    /**
     * Adds a filter to the collection
     *
     * @param \Phalcon\Assets\FilterInterface $filter
     * @return Collection
     */
    public function addFilter(\Phalcon\Assets\FilterInterface $filter) {}

}
