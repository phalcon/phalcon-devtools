<?php

namespace Phalcon\Assets;

use Phalcon\Tag;
use Phalcon\Assets\Resource;
use Phalcon\Assets\Collection;
use Phalcon\Assets\Exception;
use Phalcon\Assets\Resource\Js as ResourceJs;
use Phalcon\Assets\Resource\Css as ResourceCss;
use Phalcon\Assets\Inline\Css as InlineCss;
use Phalcon\Assets\Inline\Js as InlineJs;


class Manager
{

	/**
	 * Options configure
	 * @var array
	 */
	protected $_options;

	protected $_collections;

	protected $_implicitOutput = true;



	/**
	 * Phalcon\Assets\Manager
	 * 
	 * @param array $options
	 *
	 */
	public function __construct($options=null) {}

	/**
	 * Sets the manager options
	 * 
	 * @param array $options
	 *
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
	 * @param boolean $implicitOutput
	 *
	 * @return Manager
	 */
	public function useImplicitOutput($implicitOutput) {}

	/**
	* Adds a Css resource to the 'css' collection
	*
	*<code>
	*	$assets->addCss('css/bootstrap.css');
	*	$assets->addCss('http://bootstrap.my-cdn.com/style.css', false);
	*</code>
	 * 
	 * @param string $path
	 * @param $local
	 * @param $filter
	 * @param mixed $attributes
	*
	 * @return Manager
	 */
	public function addCss($path, $local=true, $filter=true, $attributes=null) {}

	/**
	 * Adds a inline Css to the 'css' collection
	 * 
	 * @param string $content
	 * @param $filter
	 * @param mixed $attributes
	 *
	 * @return Manager
	 */
	public function addInlineCss($content, $filter=true, $attributes=null) {}

	/**
	 * Adds a javascript resource to the 'js' collection
	 *
	 *<code>
	 *	$assets->addJs('scripts/jquery.js');
	 *	$assets->addJs('http://jquery.my-cdn.com/jquery.js', false);
	 *</code>
	 * 
	 * @param string $path
	 * @param $local
	 * @param $filter
	 * @param $attributes
	 *
	 * @return Manager
	 */
	public function addJs($path, $local=true, $filter=true, $attributes=null) {}

	/**
	 * Adds a inline javascript to the 'js' collection
	 * 
	 * @param string $content
	 * @param $filter
	 * @param $attributes
	 *
	 * @return Manager
	 */
	public function addInlineJs($content, $filter=true, $attributes=null) {}

	/**
	 * Adds a resource by its type
	 *
	 *<code>
	 *	$assets->addResourceByType('css', new \Phalcon\Assets\Resource\Css('css/style.css'));
	 *</code>
	 * 
	 * @param string $type
	 *
	 * @return Manager
	 */
	public function addResourceByType($type) {}

	/**
		 * Add the resource to the collection
	 * 
	 * @param string $type
	 * @param \$Inline $code
		 *
	 * @return Manager
	 */
	public function addInlineCodeByType($type, Inline $code) {}

	/**
		 * Add the inline code to the collection
		 *
	 * @return Manager
	 */
	public function addResource() {}

	/**
		 * Adds the resource by its type
	 * 
	 * @param \$Inline $code
		 *
	 * @return Manager
	 */
	public function addInlineCode(Inline $code) {}

	/**
		 * Adds the inline code by its type
	 * 
	 * @param string $id
	 * @param Collection $collection
		 *
	 * @return Manager
	 */
	public function set($id, Collection $collection) {}

	/**
	* Returns a collection by its id
	*
	*<code>
	* $scripts = $assets->get('js');
	*</code>
	 * 
	 * @param string $id
	*
	 * @return Collection
	 */
	public function get($id) {}

	/**
	 * Returns the CSS collection of assets
	 *
	 * @return Collection
	 */
	public function getCss() {}

	/**
		 * Check if the collection does not exist and create an implicit collection
		 *
	 * @return Collection
	 */
	public function getJs() {}

	/**
		 * Check if the collection does not exist and create an implicit collection
	 * 
	 * @param string $name
		 *
	 * @return Collection
	 */
	public function collection($name) {}

	/**
	 * Traverses a collection calling the callback to generate its HTML
	 * 
	 * @param Collection $collection
	 * @param \callback $callback
	 * @param string $type
	 *
	 *
	 * @return mixed
	 */
	public function output(Collection $collection, $callback, $type) {}

	/**
		 * Get the resources as an array
	 * 
	 * @param Collection $collection
	 * @param $type
		 *
	 * @return mixed
	 */
	public function outputInline(Collection $collection, $type) {}

	/**
						 * Filters must be valid objects
	 * 
	 * @param $collectionName
						 *
	 * @return mixed
	 */
	public function outputCss($collectionName=null) {}

	/**
	 * Prints the HTML for inline CSS
	 * 
	 * @param string $collectionName
	 *
	 *
	 * @return mixed
	 */
	public function outputInlineCss($collectionName=null) {}

	/**
	 * Prints the HTML for JS resources
	 * 
	 * @param string $collectionName
	 *
	 *
	 * @return mixed
	 */
	public function outputJs($collectionName=null) {}

	/**
	 * Prints the HTML for inline JS
	 * 
	 * @param string $collectionName
	 *
	 *
	 * @return mixed
	 */
	public function outputInlineJs($collectionName=null) {}

	/**
	 * Returns existing collections in the manager
	 *
	 * @return Collection[]
	 */
	public function getCollections() {}

}
