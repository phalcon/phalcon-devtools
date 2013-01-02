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
	
	class View extends \Phalcon\DI\Injectable {

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

		protected $_viewParams;

		protected $_layoutsDir;

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
		 */
		public function setViewsDir($viewsDir){ }


		/**
		 * Gets views directory
		 *
		 * @return string
		 */
		public function getViewsDir(){ }


		/**
		 * Sets base path. Depending of your platform, always add a trailing slash or backslash
		 *
		 * <code>
		 * $view->setBasePath(__DIR__.'/');
		 * </code>
		 *
		 * @param string $basePath
		 */
		public function setBasePath($basePath){ }


		/**
		 * Sets the render level for the view
		 *
		 * <code>
		 * //Render the view related to the controller only
		 * $this->view->setRenderLevel(Phalcon\Mvc\View::LEVEL_VIEW);
		 * </code>
		 *
		 * @param string $level
		 */
		public function setRenderLevel($level){ }


		/**
		 * Sets default view name. Must be a file without extension in the views directory
		 *
		 * <code>
		 * //Renders as main view views-dir/inicio.phtml
		 * $this->view->setMainView('inicio');
		 * </code>
		 *
		 * @param string $name
		 */
		public function setMainView($viewPath){ }


		/**
		 * Appends template before controller layout
		 *
		 * @param string|array $templateBefore
		 */
		public function setTemplateBefore($templateBefore){ }


		/**
		 * Resets any template before layouts
		 *
		 */
		public function cleanTemplateBefore(){ }


		/**
		 * Appends template after controller layout
		 *
		 * @param string|array $templateAfter
		 */
		public function setTemplateAfter($templateAfter){ }


		/**
		 * Resets any template before layouts
		 *
		 */
		public function cleanTemplateAfter(){ }


		/**
		 * Adds parameters to views (alias of setVar)
		 *
		 * @param string $key
		 * @param mixed $value
		 */
		public function setParamToView($key, $value){ }


		/**
		 * Adds parameters to views
		 *
		 * @param string $key
		 * @param mixed $value
		 */
		public function setVar($key, $value){ }


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
		 * @param \Phalcon\Cache\Backend $cache
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
		 */
		public function registerEngines($engines){ }


		/**
		 * Executes render process from dispatching data
		 *
		 *<code>
		 * $view->start();
		 * //Shows recent posts view (app/views/posts/recent.phtml)
		 * $view->render('posts', 'recent');
		 * $view->finish();
		 *</code>
		 *
		 * @param string $controllerName
		 * @param string $actionName
		 * @param array $params
		 */
		public function render($controllerName, $actionName, $params=null){ }


		/**
		 * Choose a view different to render than last-controller/last-action
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
		 * @param string $renderView
		 */
		public function pick($renderView){ }


		/**
		 * Renders a partial view
		 *
		 * <code>
		 * //Show a partial inside another view
		 * $this->partial('shared/footer');
		 * </code>
		 *
		 * @param string $partialPath
		 * @return string
		 */
		public function partial($partialPath){ }


		/**
		 * Finishes the render process by stopping the output buffering
		 */
		public function finish(){ }


		/**
		 * Create a \Phalcon\Cache based on the internal cache options
		 *
		 * @return \Phalcon\Cache\Backend
		 */
		protected function _createCache(){ }


		/**
		 * Returns the cache instance used to cache
		 *
		 * @return \Phalcon\Cache\Backend
		 */
		public function getCache(){ }


		/**
		 * Cache the actual view render to certain level
		 *
		 * @param boolean|array $options
		 */
		public function cache($options=null){ }


		/**
		 * Externally sets the view content
		 *
		 *<code>
		 *$this->view->setContent("<h1>hello</h1>");
		 *</code>
		 *
		 * @param string $content
		 */
		public function setContent($content){ }


		/**
		 * Returns cached ouput from another view stage
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
		 * Disable view. Don't show any view or template
		 *
		 */
		public function disable(){ }

	}
}
