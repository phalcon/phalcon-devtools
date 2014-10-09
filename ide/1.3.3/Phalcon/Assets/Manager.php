<?php 

namespace Phalcon\Assets {

	/**
	 * Phalcon\Assets\Manager
	 *
	 * Manages collections of CSS/Javascript assets
	 */
	
	class Manager {

		protected $_options;

		protected $_collections;

		protected $_implicitOutput;

		/**
		 * \Phalcon\Assets\Manager constructor
		 *
		 * @param array $options
		 */
		public function __construct($options=null){ }


		/**
		 * Sets the manager's options
		 *
		 * @param array $options
		 * @return \Phalcon\Assets\Manager
		 */
		public function setOptions($options){ }


		/**
		 * Returns the manager's options
		 *
		 * @return array
		 */
		public function getOptions(){ }


		/**
		 * Sets if the HTML generated must be directly printed or returned
		 *
		 * @param boolean $implicitOutput
		 * @return \Phalcon\Assets\Manager
		 */
		public function useImplicitOutput($implicitOutput){ }


		/**
		 * Adds a Css resource to the 'css' collection
		 *
		 *<code>
		 *	$assets->addCss('css/bootstrap.css');
		 *	$assets->addCss('http://bootstrap.my-cdn.com/style.css', false);
		 *</code>
		 *
		 * @param string $path
		 * @param boolean $local
		 * @param boolean $filter
		 * @param array $attributes
		 * @return \Phalcon\Assets\Manager
		 */
		public function addCss($path, $local=null, $filter=null, $attributes=null){ }


		/**
		 * Adds a javascript resource to the 'js' collection
		 *
		 *<code>
		 *	$assets->addJs('scripts/jquery.js');
		 *	$assets->addJs('http://jquery.my-cdn.com/jquery.js', true);
		 *</code>
		 *
		 * @param string $path
		 * @param boolean $local
		 * @param boolean $filter
		 * @param array $attributes
		 * @return \Phalcon\Assets\Manager
		 */
		public function addJs($path, $local=null, $filter=null, $attributes=null){ }


		/**
		 * Adds a resource by its type
		 *
		 *<code>
		 *	$assets->addResourceByType('css', new \Phalcon\Assets\Resource\Css('css/style.css'));
		 *</code>
		 *
		 * @param string $type
		 * @param \Phalcon\Assets\Resource $resource
		 * @return \Phalcon\Assets\Manager
		 */
		public function addResourceByType($type, $resource){ }


		/**
		 * Adds a raw resource to the manager
		 *
		 *<code>
		 * $assets->addResource(new \Phalcon\Assets\Resource('css', 'css/style.css'));
		 *</code>
		 *
		 * @param \Phalcon\Assets\Resource $resource
		 * @return \Phalcon\Assets\Manager
		 */
		public function addResource($resource){ }


		/**
		 * Sets a collection in the Assets Manager
		 *
		 *<code>
		 * $assets->get('js', $collection);
		 *</code>
		 *
		 * @param string $id
		 * @param \Phalcon\Assets\Collection $collection
		 * @return \Phalcon\Assets\Manager
		 */
		public function set($id, $collection){ }


		/**
		 * Returns a collection by its id
		 *
		 *<code>
		 * $scripts = $assets->get('js');
		 *</code>
		 *
		 * @param string $id
		 * @return \Phalcon\Assets\Collection
		 */
		public function get($id){ }


		/**
		 * Returns the CSS collection of assets
		 *
		 * @return \Phalcon\Assets\Collection
		 */
		public function getCss(){ }


		/**
		 * Returns the CSS collection of assets
		 *
		 * @return \Phalcon\Assets\Collection
		 */
		public function getJs(){ }


		/**
		 * Creates/Returns a collection of resources
		 *
		 * @param string $name
		 * @return \Phalcon\Assets\Collection
		 */
		public function collection($name){ }


		/**
		 * Traverses a collection calling the callback to generate its HTML
		 *
		 * @param \Phalcon\Assets\Collection $collection
		 * @param callback $callback
		 * @param string $type
		 */
		public function output($collection, $callback, $type=null){ }


		/**
		 * Prints the HTML for CSS resources
		 *
		 * @param string $collectionName
		 */
		public function outputCss($collectionName=null){ }


		/**
		 * Prints the HTML for JS resources
		 *
		 * @param string $collectionName
		 */
		public function outputJs($collectionName=null){ }

	}
}
