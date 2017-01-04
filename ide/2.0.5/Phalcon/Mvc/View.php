<?php

namespace Phalcon\Mvc;

use Phalcon\DiInterface;
use Phalcon\Di\Injectable;
use Phalcon\Mvc\View\Exception;
use Phalcon\Mvc\ViewInterface;
use Phalcon\Cache\BackendInterface;
use Phalcon\Events\ManagerInterface;
use Phalcon\Mvc\View\Engine\Php as PhpEngine;


class View extends Injectable implements ViewInterface
{

	const LEVEL_MAIN_LAYOUT = 5;

	const LEVEL_AFTER_TEMPLATE = 4;

	const LEVEL_LAYOUT = 3;

	const LEVEL_BEFORE_TEMPLATE = 2;

	const LEVEL_ACTION_VIEW = 1;

	const LEVEL_NO_RENDER = 0;

	const CACHE_MODE_NONE = 0;

	const CACHE_MODE_INVERSE = 1;



	protected $_options;

	protected $_basePath = '';

	protected $_content = '';

	protected $_renderLevel = 5;

	public function getRenderLevel() {
		return $this->_renderLevel;
	}

	protected $_currentRenderLevel;

	public function getCurrentRenderLevel() {
		return $this->_currentRenderLevel;
	}

	protected $_disabledLevels;

	protected $_viewParams;

	protected $_layout;

	protected $_layoutsDir = '';

	protected $_partialsDir = '';

	protected $_viewsDir;

	protected $_templatesBefore;

	protected $_templatesAfter;

	protected $_engines = false;

	/**
	 * @var array
	 */
	protected $_registeredEngines;

	public function getRegisteredEngines() {
		return $this->_registeredEngines;
	}

	protected $_mainView = 'index';

	protected $_controllerName;

	protected $_actionName;

	protected $_params;

	protected $_pickView;

	protected $_cache;

	protected $_cacheLevel;

	protected $_activeRenderPath;

	protected $_disabled = false;



	/**
	 * Phalcon\Mvc\View constructor
	 * 
	 * @param array $options
	 *
	 */
	public function __construct($options=null) {}

	/**
	 * Sets the views directory. Depending of your platform, always add a trailing slash or backslash
	 * 
	 * @param string $viewsDir
	 *
	 * @return View
	 */
	public function setViewsDir($viewsDir) {}

	/**
	 * Gets views directory
	 *
	 * @return string
	 */
	public function getViewsDir() {}

	/**
	 * Sets the layouts sub-directory. Must be a directory under the views directory. Depending of your platform, always add a trailing slash or backslash
	 *
	 *<code>
	 * $view->setLayoutsDir('../common/layouts/');
	 *</code>
	 * 
	 * @param string $layoutsDir
	 *
	 * @return View
	 */
	public function setLayoutsDir($layoutsDir) {}

	/**
	 * Gets the current layouts sub-directory
	 *
	 * @return string
	 */
	public function getLayoutsDir() {}

	/**
	 * Sets a partials sub-directory. Must be a directory under the views directory. Depending of your platform, always add a trailing slash or backslash
	 *
	 *<code>
	 * $view->setPartialsDir('../common/partials/');
	 *</code>
	 * 
	 * @param string $partialsDir
	 *
	 * @return View
	 */
	public function setPartialsDir($partialsDir) {}

	/**
	 * Gets the current partials sub-directory
	 *
	 * @return string
	 */
	public function getPartialsDir() {}

	/**
	 * Sets base path. Depending of your platform, always add a trailing slash or backslash
	 *
	 * <code>
	 * 	$view->setBasePath(__DIR__ . '/');
	 * </code>
	 * 
	 * @param string $basePath
	 *
	 * @return View
	 */
	public function setBasePath($basePath) {}

	/**
	 * Gets base path
	 *
	 * @return string
	 */
	public function getBasePath() {}

	/**
	 * Sets the render level for the view
	 *
	 * <code>
	 * 	//Render the view related to the controller only
	 * 	$this->view->setRenderLevel(View::LEVEL_VIEW);
	 * </code>
	 * 
	 * @param int $level
	 *
	 * @return View
	 */
	public function setRenderLevel($level) {}

	/**
	 * Disables a specific level of rendering
	 *
	 *<code>
	 * //Render all levels except ACTION level
	 * $this->view->disableLevel(View::LEVEL_ACTION_VIEW);
	 *</code>
	 *
	 * @param mixed $level
	 * 
	 * @return View
	 */
	public function disableLevel($level) {}

	/**
	 * Sets default view name. Must be a file without extension in the views directory
	 *
	 * <code>
	 * 	//Renders as main view views-dir/base.phtml
	 * 	$this->view->setMainView('base');
	 * </code>
	 * 
	 * @param string $viewPath
	 *
	 * @return View
	 */
	public function setMainView($viewPath) {}

	/**
	 * Returns the name of the main view
	 *
	 * @return string
	 */
	public function getMainView() {}

	/**
	 * Change the layout to be used instead of using the name of the latest controller name
	 *
	 * <code>
	 * 	$this->view->setLayout('main');
	 * </code>
	 * 
	 * @param string $layout
	 *
	 * @return View
	 */
	public function setLayout($layout) {}

	/**
	 * Returns the name of the main view
	 *
	 * @return string
	 */
	public function getLayout() {}

	/**
	 * Sets a template before the controller layout
	 *
	 * @param mixed $templateBefore
	 * 
	 * @return View
	 */
	public function setTemplateBefore($templateBefore) {}

	/**
	 * Resets any "template before" layouts
	 *
	 * @return View
	 */
	public function cleanTemplateBefore() {}

	/**
	 * Sets a "template after" controller layout
	 *
	 * @param mixed $templateAfter
	 * 
	 * @return View
	 */
	public function setTemplateAfter($templateAfter) {}

	/**
	 * Resets any template before layouts
	 *
	 * @return View
	 */
	public function cleanTemplateAfter() {}

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
	 * @return View
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
	 * @return View
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
	 * @param mixed $value
	 * 
	 * @return View
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
	 * Gets the name of the controller rendered
	 *
	 * @return mixed
	 */
	public function getControllerName() {}

	/**
	 * Gets the name of the action rendered
	 *
	 * @return mixed
	 */
	public function getActionName() {}

	/**
	 * Gets extra parameters of the action rendered
	 *
	 * @return mixed
	 */
	public function getParams() {}

	/**
	 * Starts rendering process enabling the output buffering
	 *
	 * @return View
	 */
	public function start() {}

	/**
	 * Loads registered template engines, if none is registered it will use Phalcon\Mvc\View\Engine\Php
	 *
	 * @return array
	 */
	protected function _loadTemplateEngines() {}

	/**
		 * If the engines aren't initialized 'engines' is false
	 * 
	 * @param $engines
	 * @param string $viewPath
	 * @param boolean $silence
	 * @param boolean $mustClean
	 * @param BackendInterface $cache
		 *
	 * @return mixed
	 */
	protected function _engineRender($engines, $viewPath, $silence, $mustClean, BackendInterface $cache=null) {}

	/**
				 * Check if the cache is started, the first time a cache is started we start the
				 * cache
	 * 
	 * @param array $engines
				 *
	 * @return View
	 */
	public function registerEngines(array $engines) {}

	/**
	 * Checks whether view exists
	 * 
	 * @param string $view
	 *
	 * @return boolean
	 */
	public function exists($view) {}

	/**
	 * Executes render process from dispatching data
	 *
	 *<code>
	 * //Shows recent posts view (app/views/posts/recent.phtml)
	 * $view->start()->render('posts', 'recent')->finish();
	 *</code>
	 * 
	 * @param string $controllerName
	 * @param string $actionName
	 * @param array $params
	 *
	 *
	 * @return View|boolean
	 */
	public function render($controllerName, $actionName, $params=null) {}

	/**
		 * If the view is disabled we simply update the buffer from any output produced in the controller
	 * 
	 * @param mixed $renderView
		 *
	 * @return View
	 */
	public function pick($renderView) {}

	/**
	 * Renders a partial view
	 *
	 * <code>
	 * 	//Retrieve the contents of a partial
	 * 	echo $this->getPartial('shared/footer');
	 * </code>
	 *
	 * <code>
	 * 	//Retrieve the contents of a partial with arguments
	 * 	echo $this->getPartial('shared/footer', array('content' => $html));
	 * </code>
	 *
	 * @param string $partialPath
	 * @param array $params
	 * 
	 * @return string
	 */
	public function getPartial($partialPath, $params=null) {}

	/**
	 * Renders a partial view
	 *
	 * <code>
	 * 	//Show a partial inside another view
	 * 	$this->partial('shared/footer');
	 * </code>
	 *
	 * <code>
	 * 	//Show a partial inside another view with parameters
	 * 	$this->partial('shared/footer', array('content' => $html));
	 * </code>
	 * 
	 * @param string $partialPath
	 * @param mixed $params
	 *
	 *
	 * @return void
	 */
	public function partial($partialPath, $params=null) {}

	/**
		 * If the developer pass an array of variables we create a new virtual symbol table
	 * 
	 * @param string $controllerName
	 * @param string $actionName
	 * @param $params
	 * @param $configCallback
		 *
	 * @return string
	 */
	public function getRender($controllerName, $actionName, $params=null, $configCallback=null) {}

	/**
		 * We must to clone the current view to keep the old state
		 *
	 * @return View
	 */
	public function finish() {}

	/**
	 * Create a Phalcon\Cache based on the internal cache options
	 *
	 * @return BackendInterface
	 */
	protected function _createCache() {}

	/**
		 * The injected service must be an object
		 *
	 * @return boolean
	 */
	public function isCaching() {}

	/**
	 * Returns the cache instance used to cache
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
	 * @return View
	 */
	public function cache($options=true) {}

	/**
			 * Get the default cache options
	 * 
	 * @param string $content
			 *
	 * @return View
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
	 * @return string
	 */
	public function getActiveRenderPath() {}

	/**
	 * Disables the auto-rendering process
	 *
	 * @return View
	 */
	public function disable() {}

	/**
	 * Enables the auto-rendering process
	 *
	 * @return View
	 */
	public function enable() {}

	/**
	 * Resets the view component to its factory default values
	 *
	 * @return View
	 */
	public function reset() {}

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

	/**
	 * Whether automatic rendering is enabled
	 *
	 * @return boolean
	 */
	public function isDisabled() {}

	/**
	 * Magic method to retrieve if a variable is set in the view
	 *
	 *<code>
	 *  echo isset($this->view->products);
	 *</code>
	 *
	 * @param string $key
	 * 
	 * @return boolean
	 */
	public function __isset($key) {}

}
