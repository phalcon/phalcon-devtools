<?php 

namespace Phalcon\Mvc\View\Engine {

	/**
	 *
	 * Phalcon\Mvc\View\Engine\Php
	 *
	 * Adapter to use PHP itself as templating engine
	 */
	
	class Php extends \Phalcon\Mvc\View\Engine {

		protected $_dependencyInjector;

		protected $_eventsManager;

		protected $_view;

		/**
		 * Renders a view using the template engine
		 *
		 * @param string $path
		 * @param array $params
		 * @param bool $mustClean
		 */
		public function render($path, $params, $mustClean){ }

	}
}
