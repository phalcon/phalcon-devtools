<?php 

namespace Phalcon\Mvc\View {

	/**
	 * Phalcon\Mvc\View\Engine
	 *
	 * All the template engine adapters must inherit this class. This provides
	 * basic interfacing between the engine and the Phalcon\Mvc\View component.
	 */
	
	abstract class Engine extends \Phalcon\Mvc\User {

		protected $_dependencyInjector;

		protected $_eventsManager;

		protected $_view;

		/**
		 * \Phalcon\Mvc\View\Engine constructor
		 *
		 * @param \Phalcon\Mvc\View $view
		 * @param array $params
		 */
		public function __construct($view, $dependencyInjector){ }


		/**
		 * Returns cached ouput on another view stage
		 *
		 * @return array
		 */
		public function getContent(){ }


		/**
		 * Renders a partial inside another view
		 *
		 * @param string $partialPath
		 */
		public function partial($partialPath){ }

	}
}
