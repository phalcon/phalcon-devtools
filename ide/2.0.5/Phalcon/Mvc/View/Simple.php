<?php

namespace Phalcon\Mvc\View;

use Phalcon\Di\Injectable;
use Phalcon\Mvc\View\Exception;
use Phalcon\Mvc\ViewBaseInterface;
use Phalcon\Cache\BackendInterface;
use Phalcon\Mvc\View\Engine\Php as PhpEngine;


class Simple extends Injectable implements ViewBaseInterface
{

	protected $_options;

	protected $_viewsDir;

	protected $_partialsDir;

	protected $_viewParams;

	protected $_engines = false;

	protected $_registeredEngines;

	public function getRegisteredEngines() {
		return $this->_registeredEngines;
	}

	protected $_activeRenderPath;

	protected $_content;

	protected $_cache = false;

	protected $_cacheOptions;



	/**
	 * Phalcon\Mvc\View\Simple constructor
	 * 
	 * @param array $options
	 *
	 */
	public function __construct($options=null) {}

	/**
	 * Sets views directory. Depending of your platform, always add a trailing slash or backslash
	 * 
	 * @param string $viewsDir
	 *
	 * @return void
	 */
	public function setViewsDir($viewsDir) {}

	/**
	 * Gets views directory
	 *
	 * @return string
	 */
	public function getViewsDir() {}

	/**
	 * Register templating engines
	 *
	 *<code>
	 *$this->view->registerEngines(array(
	 *  ".phtml" => "Phalcon\Mvc\View\Engine\Php",
	 *  ".volt" => "Phalcon\Mvc\View\Engine\Volt",
	 *  ".mhtml" => "MyCustomEngine"
	 *));
	 *</code>
	 * 
	 * @param array $engines
	 *
	 * @return void
	 */
	public function registerEngines(array $engines) {}

	/**
	 * Loads registered template engines, if none is registered it will use Phalcon\Mvc\View\Engine\Php
	 *
	 * @return mixed
	 */
	protected function _loadTemplateEngines() {}

	/**
		 * If the engines aren't initialized 'engines' is false
	 * 
	 * @param string $path
	 * @param $params
		 *
	 * @return mixed
	 */
	protected final function _internalRender($path, $params) {}

	/**
		 * Call beforeRender if there is an events manager
	 * 
	 * @param string $path
	 * @param $params
		 *
	 * @return mixed
	 */
	public function render($path, $params=null) {}

	/**
		 * Create/Get a cache
	 * 
	 * @param string $partialPath
	 * @param mixed $params
		 *
	 * @return void
	 */
	public function partial($partialPath, $params=null) {}

	/**
		 * Start output buffering
	 * 
	 * @param $options
		 *
	 * @return Simple
	 */
	public function setCacheOptions($options) {}

	/**
	 * Returns the cache options
	 *
	 * @return mixed
	 */
	public function getCacheOptions() {}

	/**
	 * Create a Phalcon\Cache based on the internal cache options
	 *
	 * @return BackendInterface
	 */
	protected function _createCache() {}

	/**
		 * The injected service must be an object
		 *
	 * @return BackendInterface
	 */
	public function getCache() {}

	/**
	 * Cache the actual view render to certain level
	 *
	 *<code>
	 *  $this->view->cache(array('key' => 'my-key', 'lifetime' => 86400));
	 *</code>
	 * 
	 * @param mixed $options
	 *
	 * @return Simple
	 */
	public function cache($options=true) {}

	/**
	 * Adds parameters to views (alias of setVar)
	 *
	 *<code>
	 *	$this->view->setParamToView('products', $products);
	 *</code>
	 * 
	 * @param string $key
	 * @param mixed $value
	 *
	 * @return Simple
	 */
	public function setParamToView($key, $value) {}

	/**
	 * Set all the render params
	 *
	 *<code>
	 *	$this->view->setVars(array('products' => $products));
	 *</code>
	 * 
	 * @param array $params
	 * @param boolean $merge
	 *
	 * @return Simple
	 */
	public function setVars(array $params, $merge=true) {}

	/**
	 * Set a single view parameter
	 *
	 *<code>
	 *	$this->view->setVar('products', $products);
	 *</code>
	 * 
	 * @param string $key
	 * @param $value
	 *
	 * @return Simple
	 */
	public function setVar($key, $value) {}

	/**
	 * Returns a parameter previously set in the view
	 *
	 * @param string $key
	 * 
	 * @return mixed
	 */
	public function getVar($key) {}

	/**
	 * Returns parameters to views
	 *
	 * @return mixed
	 */
	public function getParamsToView() {}

	/**
	 * Externally sets the view content
	 *
	 *<code>
	 *	$this->view->setContent("<h1>hello</h1>");
	 *</code>
	 * 
	 * @param string $content
	 *
	 * @return Simple
	 */
	public function setContent($content) {}

	/**
	 * Returns cached output from another view stage
	 *
	 * @return string
	 */
	public function getContent() {}

	/**
	 * Returns the path of the view that is currently rendered
	 *
	 * @return mixed
	 */
	public function getActiveRenderPath() {}

	/**
	 * Magic method to pass variables to the views
	 *
	 *<code>
	 *	$this->view->products = $products;
	 *</code>
	 * 
	 * @param string $key
	 * @param mixed $value
	 *
	 * @return void
	 */
	public function __set($key, $value) {}

	/**
	 * Magic method to retrieve a variable passed to the view
	 *
	 *<code>
	 *	echo $this->view->products;
	 *</code>
	 *
	 * @param string $key
	 * 
	 * @return mixed
	 */
	public function __get($key) {}

}
