<?php

namespace Phalcon;

use Phalcon\Events\ManagerInterface;
use Phalcon\Events\EventsAwareInterface;


class Loader implements EventsAwareInterface
{

	protected $_eventsManager = null;

	protected $_foundPath = null;

	protected $_checkedPath = null;

	protected $_prefixes = null;

	protected $_classes = null;

	protected $_extensions;

	protected $_namespaces = null;

	protected $_directories = null;

	protected $_registered = false;



	/**
	 * Phalcon\Loader constructor
	 */
	public function __construct() {}

	/**
	 * Sets the events manager
	 * 
	 * @param ManagerInterface $eventsManager
	 *
	 * @return void
	 */
	public function setEventsManager(ManagerInterface $eventsManager) {}

	/**
	 * Returns the internal event manager
	 *
	 * @return ManagerInterface
	 */
	public function getEventsManager() {}

	/**
	 * Sets an array of file extensions that the loader must try in each attempt to locate the file
	 * 
	 * @param array $extensions
	 *
	 * @return Loader
	 */
	public function setExtensions(array $extensions) {}

	/**
	 * Returns the file extensions registered in the loader
	 *
	 * @return array
	 */
	public function getExtensions() {}

	/**
	 * Register namespaces and their related directories
	 * 
	 * @param array $namespaces
	 * @param boolean $merge
	 *
	 * @return Loader
	 */
	public function registerNamespaces(array $namespaces, $merge=false) {}

	/**
	 * Returns the namespaces currently registered in the autoloader
	 *
	 * @return array
	 */
	public function getNamespaces() {}

	/**
	 * Register directories in which "not found" classes could be found
	 * 
	 * @param array $prefixes
	 * @param boolean $merge
	 *
	 * @return Loader
	 */
	public function registerPrefixes(array $prefixes, $merge=false) {}

	/**
	 * Returns the prefixes currently registered in the autoloader
	 *
	 * @return array
	 */
	public function getPrefixes() {}

	/**
	 * Register directories in which "not found" classes could be found
	 * 
	 * @param array $directories
	 * @param boolean $merge
	 *
	 * @return Loader
	 */
	public function registerDirs(array $directories, $merge=false) {}

	/**
	 * Returns the directories currently registered in the autoloader
	 *
	 * @return array
	 */
	public function getDirs() {}

	/**
	 * Register classes and their locations
	 * 
	 * @param array $classes
	 * @param boolean $merge
	 *
	 * @return Loader
	 */
	public function registerClasses(array $classes, $merge=false) {}

	/**
	 * Returns the class-map currently registered in the autoloader
	 *
	 * @return array
	 */
	public function getClasses() {}

	/**
	 * Register the autoload method
	 *
	 * @return Loader
	 */
	public function register() {}

	/**
	 * Unregister the autoload method
	 *
	 * @return Loader
	 */
	public function unregister() {}

	/**
	 * Autoloads the registered classes
	 * 
	 * @param string $className
	 *
	 * @return boolean
	 */
	public function autoLoad($className) {}

	/**
		 * First we check for static paths for classes
		 *
	 * @return string
	 */
	public function getFoundPath() {}

	/**
	 * Get the path the loader is checking for a path
	 *
	 * @return string
	 */
	public function getCheckedPath() {}

}
