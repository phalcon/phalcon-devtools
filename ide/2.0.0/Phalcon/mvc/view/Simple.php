<?php

namespace Phalcon\Mvc\View;

class Simple extends \Phalcon\Di\Injectable
{

    protected $_options;


    protected $_viewsDir;


    protected $_partialsDir;


    protected $_viewParams;


    protected $_engines = false;


    protected $_registeredEngines;


    protected $_activeRenderPath;


    protected $_content;


    protected $_cache = false;


    protected $_cacheOptions;



	public function getRegisteredEngines() {}

    /**
     * Phalcon\Mvc\View\Simple constructor
     *
     * @param array $options 
     */
	public function __construct($options = null) {}

    /**
     * Sets views directory. Depending of your platform, always add a trailing slash or backslash
     *
     * @param string $viewsDir 
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
     * <code>
     * $this->view->registerEngines(array(
     * ".phtml" => "Phalcon\Mvc\View\Engine\Php",
     * ".volt" => "Phalcon\Mvc\View\Engine\Volt",
     * ".mhtml" => "MyCustomEngine"
     * ));
     * </code>
     *
     * @param array $engines 
     */
	public function registerEngines($engines) {}

    /**
     * Loads registered template engines, if none is registered it will use Phalcon\Mvc\View\Engine\Php
     *
     * @return array 
     */
	protected function _loadTemplateEngines() {}

    /**
     * Tries to render the view with every engine registered in the component
     *
     * @param string $path 
     * @param array $params 
     */
	protected final function _internalRender($path, $params) {}

    /**
     * Renders a view
     *
     * @param string $path 
     * @param array $params 
     * @return string 
     */
	public function render($path, $params = null) {}

    /**
     * Renders a partial view
     * <code>
     * //Show a partial inside another view
     * $this->partial('shared/footer');
     * </code>
     * <code>
     * //Show a partial inside another view with parameters
     * $this->partial('shared/footer', array('content' => $html));
     * </code>
     *
     * @param string $partialPath 
     * @param array $params 
     */
	public function partial($partialPath, $params = null) {}

    /**
     * Sets the cache options
     *
     * @param array $options 
     * @return \Phalcon\Mvc\View\Simple 
     */
	public function setCacheOptions($options) {}

    /**
     * Returns the cache options
     *
     * @return array 
     */
	public function getCacheOptions() {}

    /**
     * Create a Phalcon\Cache based on the internal cache options
     *
     * @return \Phalcon\Cache\BackendInterface 
     */
	protected function _createCache() {}

    /**
     * Returns the cache instance used to cache
     *
     * @return \Phalcon\Cache\BackendInterface 
     */
	public function getCache() {}

    /**
     * Cache the actual view render to certain level
     * <code>
     * $this->view->cache(array('key' => 'my-key', 'lifetime' => 86400));
     * </code>
     *
     * @param boolean|array $options 
     * @return \Phalcon\Mvc\View\Simple 
     */
	public function cache($options = true) {}

    /**
     * Adds parameters to views (alias of setVar)
     * <code>
     * $this->view->setParamToView('products', $products);
     * </code>
     *
     * @param string $key 
     * @param mixed $value 
     * @param string $$key 
     * @param mixed $$value 
     * @return \Phalcon\Mvc\View\Simple 
     */
	public function setParamToView($key, $value) {}

    /**
     * Set all the render params
     * <code>
     * $this->view->setVars(array('products' => $products));
     * </code>
     *
     * @param array $params 
     * @param boolean $merge 
     * @return \Phalcon\Mvc\View\Simple 
     */
	public function setVars($params, $merge = true) {}

    /**
     * Set a single view parameter
     * <code>
     * $this->view->setVar('products', $products);
     * </code>
     *
     * @param string $key 
     * @param mixed $value 
     * @return \Phalcon\Mvc\View\Simple 
     */
	public function setVar($key, $value) {}

    /**
     * Returns a parameter previously set in the view
     *
     * @param string $key 
     * @return mixed 
     */
	public function getVar($key) {}

    /**
     * Returns parameters to views
     *
     * @return array 
     */
	public function getParamsToView() {}

    /**
     * Externally sets the view content
     * <code>
     * $this->view->setContent("<h1>hello</h1>");
     * </code>
     *
     * @param string $content 
     * @return \Phalcon\Mvc\View\Simple 
     */
	public function setContent($content) {}

    /**
     * Returns cached ouput from another view stage
     *
     * @return string 
     */
	public function getContent() {}

    /**
     * Returns the path of the view that is currently rendered
     *
     * @return string 
     */
	public function getActiveRenderPath() {}

    /**
     * Magic method to pass variables to the views
     * <code>
     * $this->view->products = $products;
     * </code>
     *
     * @param string $key 
     * @param mixed $value 
     */
	public function __set($key, $value) {}

    /**
     * Magic method to retrieve a variable passed to the view
     * <code>
     * echo $this->view->products;
     * </code>
     *
     * @param string $key 
     * @return mixed 
     */
	public function __get($key) {}

}
