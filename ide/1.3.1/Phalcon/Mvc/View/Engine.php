<?php 

namespace Phalcon\Mvc\View {

	/**
	 * Phalcon\Mvc\View\Engine
	 *
	 * All the template engine adapters must inherit this class. This provides
	 * basic interfacing between the engine and the Phalcon\Mvc\View component.
	 */
	
	abstract class Engine extends \Phalcon\DI\Injectable implements \Phalcon\Events\EventsAwareInterface, \Phalcon\DI\InjectionAwareInterface, \Phalcon\Mvc\View\EngineInterface {

		protected $_view;

		/**
		 * \Phalcon\Mvc\View\Engine constructor
		 *
		 * @param \Phalcon\Mvc\ViewInterface $view
		 * @param \Phalcon\DiInterface $dependencyInjector
		 */
		public function __construct($view, $dependencyInjector=null){ }


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
		 * @param array $params
		 * @return string
		 */
		public function partial($partialPath){ }


		/**
		 * Returns the view component related to the adapter
		 *
		 * @return \Phalcon\Mvc\ViewInterface
		 */
		public function getView(){ }

	}
}
