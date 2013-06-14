<?php 

namespace Phalcon\Mvc\View {

	/**
	 * Phalcon\Mvc\View\Simple
	 *
	 * This component provides a simpler view component
	 */
	
	class Simple extends \Phalcon\DI\Injectable implements \Phalcon\Events\EventsAwareInterface, \Phalcon\DI\InjectionAwareInterface {

		protected $_options;

		protected $_viewsDir;

		protected $_partialsDir;

		protected $_viewParams;

		protected $_engines;

		protected $_registeredEngines;

		protected $_activeRenderPath;

		protected $_content;

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
		 * Loads registered template engines, if none is registered it will use \Phalcon\Mvc\View\Engine\Php
		 *
		 * @return array
		 */
		protected function _loadTemplateEngines(){ }


		/**
		 * Renders a view
		 *
		 * @param string $path
		 * @param array $params
		 * @return string
		 */
		public function render($path, $params=null){ }


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
		 * 	$this->partial('shared/footer', array('conent' => $html));
		 * </code>
		 *
		 * @param string $partialPath
		 * @param array $params
		 */
		public function partial($partialPath, $params=null){ }


		/**
		 * Adds parameters to views (alias of setVar)
		 *
		 *<code>
		 *	$this->view->setParamToView('products', $products);
		 *</code>
		 *
		 * @param string $key
		 * @param mixed $value
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
		 * Externally sets the view content
		 *
		 *<code>
		 *	$this->view->setContent("<h1>hello</h1>");
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
