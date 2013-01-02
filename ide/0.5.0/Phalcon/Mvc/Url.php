<?php 

namespace Phalcon\Mvc {

	/**
	 * Phalcon\Mvc\Url
	 *
	 * This components aids in the generation of: URIs, URLs and Paths
	 *
	 *<code>
	 *
	 * //Generate a url appending a uri to the base Uri
	 * echo $url->get('products/edit/1');
	 *
	 * //Generate a url for a predefined route
	 * echo $url->get(array('for' => 'blog-post', 'title' => 'some-cool-stuff', 'year' => '2012'));
	 *
	 *</code>
	 */
	
	class Url {

		protected $_dependencyInjector;

		protected $_baseUri;

		protected $_basePath;

		/**
		 * Sets the DependencyInjector container
		 *
		 * @param \Phalcon\DI $dependencyInjector
		 */
		public function setDI($dependencyInjector){ }


		/**
		 * Returns the DependencyInjector container
		 *
		 * @return \Phalcon\DI
		 */
		public function getDI(){ }


		/**
		 * Sets a prefix to all the urls generated
		 *
		 *<code>
		 *$url->setBasePath('/invo/');
		 *</code>
		 *
		 * @param string $baseUri
		 */
		public function setBaseUri($baseUri){ }


		/**
		 * Returns the prefix for all the generated urls. By default /
		 *
		 * @return string
		 */
		public function getBaseUri(){ }


		/**
		 * Sets a base paths for all the generated paths
		 *
		 *<code>
		 *$url->setBasePath('/var/www/');
		 *</code>
		 *
		 * @param string $basePath
		 */
		public function setBasePath($basePath){ }


		/**
		 * Returns a base path
		 *
		 * @return string
		 */
		public function getBasePath(){ }


		/**
		 * Generates a URL
		 *
		 * @param string|array $uri
		 * @return string
		 */
		public function get($uri){ }


		/**
		 * Generates a local path
		 *
		 * @param string $path
		 * @return string
		 */
		public function path($path){ }

	}
}
