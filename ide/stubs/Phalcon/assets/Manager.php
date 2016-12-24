<?php

namespace Phalcon\Assets;

/**
 * Phalcon\Assets\Manager
 *
 * Manages collections of CSS/Javascript assets
 */
class Manager
{
    /**
     * Options configure
     *
     * @var array
     */
    protected $_options;


    protected $_collections;


    protected $_implicitOutput = true;


    /**
     * Phalcon\Assets\Manager
     *
     * @param array $options
     */
    public function __construct($options = null) {}

    /**
     * Sets the manager options
     *
     * @param array $options
     * @return Manager
     */
    public function setOptions(array $options) {}

    /**
     * Returns the manager options
     *
     * @return array
     */
    public function getOptions() {}

    /**
     * Sets if the HTML generated must be directly printed or returned
     *
     * @param bool $implicitOutput
     * @return Manager
     */
    public function useImplicitOutput($implicitOutput) {}

    /**
     * Adds a Css resource to the 'css' collection
     *
     * <code>
     * $assets->addCss("css/bootstrap.css");
     * $assets->addCss("http://bootstrap.my-cdn.com/style.css", false);
     * </code>
     *
     * @param string $path
     * @param mixed $local
     * @param mixed $filter
     * @param mixed $attributes
     * @return Manager
     */
    public function addCss($path, $local = true, $filter = true, $attributes = null) {}

    /**
     * Adds an inline Css to the 'css' collection
     *
     * @param string $content
     * @param mixed $filter
     * @param mixed $attributes
     * @return Manager
     */
    public function addInlineCss($content, $filter = true, $attributes = null) {}

    /**
     * Adds a javascript resource to the 'js' collection
     *
     * <code>
     * $assets->addJs("scripts/jquery.js");
     * $assets->addJs("http://jquery.my-cdn.com/jquery.js", false);
     * </code>
     *
     * @param string $path
     * @param mixed $local
     * @param mixed $filter
     * @param mixed $attributes
     * @return Manager
     */
    public function addJs($path, $local = true, $filter = true, $attributes = null) {}

    /**
     * Adds an inline javascript to the 'js' collection
     *
     * @param string $content
     * @param mixed $filter
     * @param mixed $attributes
     * @return Manager
     */
    public function addInlineJs($content, $filter = true, $attributes = null) {}

    /**
     * Adds a resource by its type
     *
     * <code>
     * $assets->addResourceByType("css",
     *     new \Phalcon\Assets\Resource\Css("css/style.css")
     * );
     * </code>
     *
     * @param string $type
     * @param \Phalcon\Assets\Resource $resource
     * @return Manager
     */
    public function addResourceByType($type, \Phalcon\Assets\Resource $resource) {}

    /**
     * Adds an inline code by its type
     *
     * @param string $type
     * @param Inline $code
     * @return Manager
     */
    public function addInlineCodeByType($type, Inline $code) {}

    /**
     * Adds a raw resource to the manager
     *
     * <code>
     * $assets->addResource(
     *     new Phalcon\Assets\Resource("css", "css/style.css")
     * );
     * </code>
     *
     * @param \Phalcon\Assets\Resource $resource
     * @return Manager
     */
    public function addResource(\Phalcon\Assets\Resource $resource) {}

    /**
     * Adds a raw inline code to the manager
     *
     * @param Inline $code
     * @return Manager
     */
    public function addInlineCode(Inline $code) {}

    /**
     * Sets a collection in the Assets Manager
     *
     * <code>
     * $assets->set("js", $collection);
     * </code>
     *
     * @param string $id
     * @param \Phalcon\Assets\Collection $collection
     * @return Manager
     */
    public function set($id, \Phalcon\Assets\Collection $collection) {}

    /**
     * Returns a collection by its id
     *
     * <code>
     * $scripts = $assets->get("js");
     * </code>
     *
     * @param string $id
     * @return \Phalcon\Assets\Collection
     */
    public function get($id) {}

    /**
     * Returns the CSS collection of assets
     *
     * @return \Phalcon\Assets\Collection
     */
    public function getCss() {}

    /**
     * Returns the CSS collection of assets
     *
     * @return \Phalcon\Assets\Collection
     */
    public function getJs() {}

    /**
     * Creates/Returns a collection of resources
     *
     * @param string $name
     * @return \Phalcon\Assets\Collection
     */
    public function collection($name) {}

    /**
     * Traverses a collection calling the callback to generate its HTML
     *
     * @param \Phalcon\Assets\Collection $collection
     * @param callback $callback
     * @param string $type
     * @return string|null
     */
    public function output(\Phalcon\Assets\Collection $collection, $callback, $type) {}

    /**
     * Traverses a collection and generate its HTML
     *
     * @param \Phalcon\Assets\Collection $collection
     * @param string $type
     * @return string
     */
    public function outputInline(\Phalcon\Assets\Collection $collection, $type) {}

    /**
     * Prints the HTML for CSS resources
     *
     * @param string $collectionName
     * @return string
     */
    public function outputCss($collectionName = null) {}

    /**
     * Prints the HTML for inline CSS
     *
     * @param string $collectionName
     * @return string
     */
    public function outputInlineCss($collectionName = null) {}

    /**
     * Prints the HTML for JS resources
     *
     * @param string $collectionName
     * @return string
     */
    public function outputJs($collectionName = null) {}

    /**
     * Prints the HTML for inline JS
     *
     * @param string $collectionName
     * @return string
     */
    public function outputInlineJs($collectionName = null) {}

    /**
     * Returns existing collections in the manager
     *
     * @return \Phalcon\Assets\Collection[]
     */
    public function getCollections() {}

    /**
     * Returns true or false if collection exists
     *
     * @param string $id
     * @return bool
     */
    public function exists($id) {}

}
