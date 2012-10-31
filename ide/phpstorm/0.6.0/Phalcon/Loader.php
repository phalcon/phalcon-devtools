<?php 

namespace Phalcon {

	/**
	 * Phalcon\Loader
	 *
	 * This component helps to load your project classes automatically based on some conventions
	 *
	 *<code>
	 * //Creates the autoloader
	 * $loader = new Phalcon\Loader();
	 *
	 * //Register some namespaces
	 * $loader->registerNamespaces(array(
	 *   'Example\\Base' => 'vendor/example/base/',
	 *   'Example\\Adapter' => 'vendor/example/adapter/',
	 *   'Example' => 'vendor/example/'
	 * ));
	 *
	 * //register autoloader
	 * $loader->register();
	 *
	 * //Requiring class will automatically include file vendor/example/adapter/Some.php
	 * $adapter = Example\Adapter\Some();
	 *</code>
	 */
	
	class Loader {

		protected $_eventsManager;

		protected $_foundPath;

		protected $_checkedPath;

		protected $_prefixes;

		protected $_classes;

		protected $_extensions;

		protected $_namespaces;

		protected $_directories;

		protected $_registered;

		public function __construct(){ }


		/**
		 * Sets the events manager
		 *
		 * @param \Phalcon\Events\Manager $eventsManager
		 */
		public function setEventsManager($eventsManager){ }


		/**
		 * Returns the internal event manager
		 *
		 * @return \Phalcon\Events\Manager
		 */
		public function getEventsManager(){ }


		/**
		 * Sets an array of extensions that the Loader must check together with the path
		 *
		 * @param array $extensions
		 * @return \Phalcon\Loader
		 */
		public function setExtensions($extensions){ }


		/**
		 * Register namespaces and their related directories
		 *
		 * @param array $namespaces
		 * @return \Phalcon\Loader
		 */
		public function registerNamespaces($namespaces){ }


		/**
		 * Register directories on which "not found" classes could be found
		 *
		 * @param array $directories
		 * @return \Phalcon\Loader
		 */
		public function registerPrefixes($prefixes){ }


		/**
		 * Register directories on which "not found" classes could be found
		 *
		 * @param array $directories
		 * @return \Phalcon\Loader
		 */
		public function registerDirs($directories){ }


		/**
		 * Register classes and their locations
		 *
		 * @param array $directories
		 * @return \Phalcon\Loader
		 */
		public function registerClasses($classes){ }


		/**
		 * Register the autoload method
		 *
		 * @return \Phalcon\Loader
		 */
		public function register(){ }


		/**
		 * Unregister the autoload method
		 */
		public function unregister(){ }


		/**
		 * Makes the work of autoload registered classes
		 *
		 * @param string $className
		 * @return boolean
		 */
		public function autoLoad($className){ }


		/**
		 * Get the path when a class was found
		 *
		 * @return string
		 */
		public function getFoundPath(){ }


		/**
		 * Get the path the loader is checking for a path
		 *
		 * @return string
		 */
		public function getCheckedPath(){ }

	}
}
