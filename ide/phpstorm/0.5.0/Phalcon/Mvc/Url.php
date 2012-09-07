<?php 

namespace Phalcon\Mvc {

	/**
	 * Phalcon\Mvc\Url
	 *
	 * This components aids in the generation off: URIs, URLs and Paths
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
		 * Sets the DependencyInjector container
		 *
		 * @return \Phalcon\DI
		 */
		public function getDI(){ }


		/**
		 * Sets a prefix to all the urls generated
		 *
		 * @param string $baseUri
		 */
		public function setBaseUri($baseUri){ }


		/**
		 * Returns the prefix for all the generated urls. By default /
		 *
		 * @param string
		 */
		public function getBaseUri(){ }


		/**
		 * Sets a base paths for all the generated paths
		 *
		 * @return string $basePath
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
		 * @return string
		 */
		public function path($path){ }

	}
}
