<?php 

namespace Phalcon {

	/**
	 * Phalcon\Loader
	 *
	 * This component helps to load your project classes automatically based on some conventions
	 *
	 *<code>
	 * //Creates the autoloader
	 * $loader = new Loader();
	 *
	 * //Register some namespaces
	 * $loader->registerNamespaces(array(
	 *   'Example\Base' => 'vendor/example/base/',
	 *   'Example\Adapter' => 'vendor/example/adapter/',
	 *   'Example' => 'vendor/example/'
	 * ));
	 *
	 * //register autoloader
	 * $loader->register();
	 *
	 * //Requiring this class will automatically include file vendor/example/adapter/Some.php
	 * $adapter = Example\Adapter\Some();
	 *</code>
	 */
	
	class Loader implements \Phalcon\Events\EventsAwareInterface {

		protected $_eventsManager;

		protected $_foundPath;

		protected $_checkedPath;

		protected $_prefixes;

		protected $_classes;

		protected $_extensions;

		protected $_namespaces;

		protected $_directories;

		protected $_registered;

		/**
		 * \Phalcon\Loader constructor
		 */
		public function __construct(){ }


		/**
		 * Sets the events manager
		 */
		public function setEventsManager(\Phalcon\Events\ManagerInterface $eventsManager){ }


		/**
		 * Returns the internal event manager
		 */
		public function getEventsManager(){ }


		/**
		 * Sets an array of file extensions that the loader must try in each attempt to locate the file
		 */
		public function setExtensions($extensions){ }


		/**
		 * Returns the file extensions registered in the loader
		 */
		public function getExtensions(){ }


		/**
		 * Register namespaces and their related directories
		 */
		public function registerNamespaces($namespaces, $merge=null){ }


		/**
		 * Returns the namespaces currently registered in the autoloader
		 */
		public function getNamespaces(){ }


		/**
		 * Register directories in which "not found" classes could be found
		 */
		public function registerPrefixes($prefixes, $merge=null){ }


		/**
		 * Returns the prefixes currently registered in the autoloader
		 */
		public function getPrefixes(){ }


		/**
		 * Register directories in which "not found" classes could be found
		 */
		public function registerDirs($directories, $merge=null){ }


		/**
		 * Returns the directories currently registered in the autoloader
		 */
		public function getDirs(){ }


		/**
		 * Register classes and their locations
		 */
		public function registerClasses($classes, $merge=null){ }


		/**
		 * Returns the class-map currently registered in the autoloader
		 */
		public function getClasses(){ }


		/**
		 * Register the autoload method
		 */
		public function register(){ }


		/**
		 * Unregister the autoload method
		 */
		public function unregister(){ }


		/**
		 * Autoloads the registered classes
		 */
		public function autoLoad($className){ }


		/**
		 * Get the path when a class was found	 
		 */
		public function getFoundPath(){ }


		/**
		 * Get the path the loader is checking for a path
		 */
		public function getCheckedPath(){ }

	}
}
