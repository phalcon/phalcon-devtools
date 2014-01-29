<?php 

namespace Phalcon\Mvc {

	/**
	 * Phalcon\Mvc\View
	 *
	 * Phalcon\Mvc\View is a class for working with the "view" portion of the model-view-controller pattern.
	 * That is, it exists to help keep the view script separate from the model and controller scripts.
	 * It provides a system of helpers, output filters, and variable escaping.
	 *
	 * <code>
	 * //Setting views directory
	 * $view = new Phalcon\Mvc\View();
	 * $view->setViewsDir('app/views/');
	 *
	 * $view->start();
	 * //Shows recent posts view (app/views/posts/recent.phtml)
	 * $view->render('posts', 'recent');
	 * $view->finish();
	 *
	 * //Printing views output
	 * echo $view->getContent();
	 * </code>
	 */
	
	class View extends \Phalcon\DI\Injectable implements \Phalcon\Events\EventsAwareInterface, \Phalcon\DI\InjectionAwareInterface, \Phalcon\Mvc\ViewInterface {

		const LEVEL_MAIN_LAYOUT = 5;

		const LEVEL_AFTER_TEMPLATE = 4;

		const LEVEL_LAYOUT = 3;

		const LEVEL_BEFORE_TEMPLATE = 2;

		const LEVEL_ACTION_VIEW = 1;

		const LEVEL_NO_RENDER = 0;

		protected $_options;

		protected $_basePath;

		protected $_content;

		protected $_renderLevel;

		protected $_disabledLevels;

		protected $_viewParams;

		protected $_layout;

		protected $_layoutsDir;

		protected $_partialsDir;

		protected $_viewsDir;

		protected $_templatesBefore;

		protected $_templatesAfter;

		protected $_engines;

		protected $_registeredEngines;

		protected $_mainView;

		protected $_controllerName;

		protected $_actionName;

		protected $_params;

		protected $_pickView;

		protected $_cache;

		protected $_cacheLevel;

		protected $_activeRenderPath;

		protected $_disabled;

		/**
		 * \Phalcon\Mvc\View constructor
		 *
		 * @param array $options
		 */
		public function __construct($options=null){ }


		/**
		 * Sets views directory. Depending of your platform, always add a trailing slash or backslash
		 *
		 * @param string $viewsDir
		 * @return \Phalcon\Mvc\View
		 */
		public function setViewsDir($viewsDir){ }


		/**
		 * Gets views directory
		 *
		 * @return string
		 */
		public function getViewsDir(){ }


		/**
		 * Sets the layouts sub-directory. Must be a directory under the views directory. Depending of your platform, always add a trailing slash or backslash
		 *
		 *<code>
		 * $view->setLayoutsDir('../common/layouts/');
		 *</code>
		 *
		 * @param string $layoutsDir
		 * @return \Phalcon\Mvc\View
		 */
		public function setLayoutsDir($layoutsDir){ }


		/**
		 * Gets the current layouts sub-directory
		 *
		 * @return string
		 */
		public function getLayoutsDir(){ }


		/**
		 * Sets a partials sub-directory. Must be a directory under the views directory. Depending of your platform, always add a trailing slash or backslash
		 *
		 *<code>
		 * $view->setPartialsDir('../common/partials/');
		 *</code>
		 *
		 * @param string $partialsDir
		 * @return \Phalcon\Mvc\View
		 */
		public function setPartialsDir($partialsDir){ }


		/**
		 * Gets the current partials sub-directory
		 *
		 * @return string
		 */
		public function getPartialsDir(){ }


		/**
		 * Sets base path. Depending of your platform, always add a trailing slash or backslash
		 *
		 * <code>
		 * 	$view->setBasePath(__DIR__ . '/');
		 * </code>
		 *
		 * @param string $basePath
		 * @return \Phalcon\Mvc\View
		 */
		public function setBasePath($basePath){ }


		/**
		 * Sets the render level for the view
		 *
		 * <code>
		 * 	//Render the view related to the controller only
		 * 	$this->view->setRenderLevel(View::LEVEL_LAYOUT);
		 * </code>
		 *
		 * @param string $level
		 * @return \Phalcon\Mvc\View
		 */
		public function setRenderLevel($level){ }


		/**
		 * Disables a specific level of rendering
		 *
		 *<code>
		 * //Render all levels except ACTION level
		 * $this->view->disableLevel(View::LEVEL_ACTION_VIEW);
		 *</code>
		 *
		 * @param int|array $level
		 * @return \Phalcon\Mvc\View
		 */
		public function disableLevel($level){ }


		/**
		 * Sets default view name. Must be a file without extension in the views directory
		 *
		 * <code>
		 * 	//Renders as main view views-dir/base.phtml
		 * 	$this->view->setMainView('base');
		 * </code>
		 *
		 * @param string $viewPath
		 * @return \Phalcon\Mvc\View
		 */
		public function setMainView($viewPath){ }


		/**
		 * Returns the name of the main view
		 *
		 * @return string
		 */
		public function getMainView(){ }


		/**
		 * Change the layout to be used instead of using the name of the latest controller name
		 *
		 * <code>
		 * 	$this->view->setLayout('main');
		 * </code>
		 *
		 * @param string $layout
		 * @return \Phalcon\Mvc\View
		 */
		public function setLayout($layout){ }


		/**
		 * Returns the name of the main view
		 *
		 * @return string
		 */
		public function getLayout(){ }


		/**
		 * Appends template before controller layout
		 *
		 * @param string|array $templateBefore
		 * @return \Phalcon\Mvc\View
		 */
		public function setTemplateBefore($templateBefore){ }


		/**
		 * Resets any template before layouts
		 *
		 * @return \Phalcon\Mvc\View
		 */
		public function cleanTemplateBefore(){ }


		/**
		 * Appends template after controller layout
		 *
		 * @param string|array $templateAfter
		 * @return \Phalcon\Mvc\View
		 */
		public function setTemplateAfter($templateAfter){ }


		/**
		 * Resets any template before layouts
		 *
		 * @return \Phalcon\Mvc\View
		 */
		public function cleanTemplateAfter(){ }


		/**
		 * Adds parameters to views (alias of setVar)
		 *
		 *<code>
		 *	$this->view->setParamToView('products', $products);
		 *</code>
		 *
		 * @param string $key
		 * @param mixed $value
		 * @return \Phalcon\Mvc\View
		 */
		public function setParamToView($key, $value){ }


		/**
		 * Set all the render params
		 *
		 *<code>
		 *	$this->view->setVars(array('products' => $products));
		 *</code>
		 *
		 * @param array $params
		 * @param boolean $merge
		 * @return \Phalcon\Mvc\View
		 */
		public function setVars($params, $merge=null){ }


		/**
		 * Set a single view parameter
		 *
		 *<code>
		 *	$this->view->setVar('products', $products);
		 *</code>
		 *
		 * @param string $key
		 * @param mixed $value
		 * @return \Phalcon\Mvc\View
		 */
		public function setVar($key, $value){ }


		/**
		 * Returns a parameter previously set in the view
		 *
		 * @param string $key
		 * @return mixed
		 */
		public function getVar($key){ }


		/**
		 * Returns parameters to views
		 *
		 * @return array
		 */
		public function getParamsToView(){ }


		/**
		 * Gets the name of the controller rendered
		 *
		 * @return string
		 */
		public function getControllerName(){ }


		/**
		 * Gets the name of the action rendered
		 *
		 * @return string
		 */
		public function getActionName(){ }


		/**
		 * Gets extra parameters of the action rendered
		 *
		 * @return array
		 */
		public function getParams(){ }


		/**
		 * Starts rendering process enabling the output buffering
		 *
		 * @return \Phalcon\Mvc\View
		 */
		public function start(){ }


		/**
		 * Loads registered template engines, if none is registered it will use \Phalcon\Mvc\View\Engine\Php
		 *
		 * @return array
		 */
		protected function _loadTemplateEngines(){ }


		/**
		 * Checks whether view exists on registered extensions and render it
		 *
		 * @param array $engines
		 * @param string $viewPath
		 * @param boolean $silence
		 * @param boolean $mustClean
		 * @param \Phalcon\Cache\BackendInterface $cache
		 */
		protected function _engineRender(){ }


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
		 * @return \Phalcon\Mvc\View
		 */
		public function registerEngines($engines){ }


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
		 * @return \Phalcon\Mvc\View
		 */
		public function render($controllerName, $actionName, $params=null){ }


		/**
		 * Choose a different view to render instead of last-controller/last-action
		 *
		 * <code>
		 * class ProductsController extends \Phalcon\Mvc\Controller
		 * {
		 *
		 *    public function saveAction()
		 *    {
		 *
		 *         //Do some save stuff...
		 *
		 *         //Then show the list view
		 *         $this->view->pick("products/list");
		 *    }
		 * }
		 * </code>
		 *
		 * @param string|array $renderView
		 * @return \Phalcon\Mvc\View
		 */
		public function pick($renderView){ }


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
		 * @param array $params
		 */
		public function partial($partialPath, $params=null){ }


		/**
		 * Perform the automatic rendering returning the output as a string
		 *
		 * <code>
		 * 	$template = $this->view->getRender('products', 'show', array('products' => $products));
		 * </code>
		 *
		 * @param string $controllerName
		 * @param string $actionName
		 * @param array $params
		 * @param mixed $configCallback
		 * @return string
		 */
		public function getRender($controllerName, $actionName, $params=null, $configCallback=null){ }


		/**
		 * Finishes the render process by stopping the output buffering
		 *
		 * @return \Phalcon\Mvc\View
		 */
		public function finish(){ }


		/**
		 * Create a \Phalcon\Cache based on the internal cache options
		 *
		 * @return \Phalcon\Cache\BackendInterface
		 */
		protected function _createCache(){ }


		/**
		 * Check if the component is currently caching the output content
		 *
		 * @return boolean
		 */
		public function isCaching(){ }


		/**
		 * Returns the cache instance used to cache
		 *
		 * @return \Phalcon\Cache\BackendInterface
		 */
		public function getCache(){ }


		/**
		 * Cache the actual view render to certain level
		 *
		 *<code>
		 *  $this->view->cache(array('key' => 'my-key', 'lifetime' => 86400));
		 *</code>
		 *
		 * @param boolean|array $options
		 * @return \Phalcon\Mvc\View
		 */
		public function cache($options=null){ }


		/**
		 * Externally sets the view content
		 *
		 *<code>
		 *	$this->view->setContent("<h1>hello</h1>");
		 *</code>
		 *
		 * @param string $content
		 * @return \Phalcon\Mvc\View
		 */
		public function setContent($content){ }


		/**
		 * Returns cached output from another view stage
		 *
		 * @return string
		 */
		public function getContent(){ }


		/**
		 * Returns the path of the view that is currently rendered
		 *
		 * @return string
		 */
		public function getActiveRenderPath(){ }


		/**
		 * Disables the auto-rendering process
		 *
		 * @return \Phalcon\Mvc\View
		 */
		public function disable(){ }


		/**
		 * Enables the auto-rendering process
		 *
		 * @return \Phalcon\Mvc\View
		 */
		public function enable(){ }


		/**
		 * Resets the view component to its factory default values
		 *
		 * @return \Phalcon\Mvc\View
		 */
		public function reset(){ }


		/**
		 * Magic method to pass variables to the views
		 *
		 *<code>
		 *	$this->view->products = $products;
		 *</code>
		 *
		 * @param string $key
		 * @param mixed $value
		 */
		public function __set($key, $value){ }


		/**
		 * Magic method to retrieve a variable passed to the view
		 *
		 *<code>
		 *	echo $this->view->products;
		 *</code>
		 *
		 * @param string $key
		 * @return mixed
		 */
		public function __get($key){ }

	}
}
