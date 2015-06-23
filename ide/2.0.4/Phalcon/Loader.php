<?php

namespace Phalcon;

/**
 * Phalcon\Loader
 * This component helps to load your project classes automatically based on some conventions
 * <code>
 * //Creates the autoloader
 * $loader = new Loader();
 * //Register some namespaces
 * $loader->registerNamespaces(array(
 * 'Example\Base' => 'vendor/example/base/',
 * 'Example\Adapter' => 'vendor/example/adapter/',
 * 'Example' => 'vendor/example/'
 * ));
 * //register autoloader
 * $loader->register();
 * //Requiring this class will automatically include file vendor/example/adapter/Some.php
 * $adapter = Example\Adapter\Some();
 * </code>
 */
class Loader implements \Phalcon\Events\EventsAwareInterface
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
     * @param mixed $eventsManager 
     */
    public function setEventsManager(\Phalcon\Events\ManagerInterface $eventsManager) {}

    /**
     * Returns the internal event manager
     *
     * @return \Phalcon\Events\ManagerInterface 
     */
    public function getEventsManager() {}

    /**
     * Sets an array of file extensions that the loader must try in each attempt to locate the file
     *
     * @param array $extensions 
     * @return Loader 
     */
    public function setExtensions($extensions) {}

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
     * @param bool $merge 
     * @return Loader 
     */
    public function registerNamespaces($namespaces, $merge = false) {}

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
     * @param bool $merge 
     * @return Loader 
     */
    public function registerPrefixes($prefixes, $merge = false) {}

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
     * @param bool $merge 
     * @return Loader 
     */
    public function registerDirs($directories, $merge = false) {}

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
     * @param bool $merge 
     * @return Loader 
     */
    public function registerClasses($classes, $merge = false) {}

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
     * @return bool 
     */
    public function autoLoad($className) {}

    /**
     * Get the path when a class was found
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
