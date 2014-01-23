<?php 

namespace Phalcon\Mvc\View\Engine {

	/**
	 * Phalcon\Mvc\View\Engine\Php
	 *
	 * Adapter to use PHP itself as templating engine
	 */
	
	class Php extends \Phalcon\Mvc\View\Engine implements \Phalcon\Mvc\View\EngineInterface, \Phalcon\DI\InjectionAwareInterface, \Phalcon\Events\EventsAwareInterface {

		/**
		 * Renders a view using the template engine
		 *
		 * @param string $path
		 * @param array $params
		 * @param boolean $mustClean
		 */
		public function render($path, $params, $mustClean=null){ }

	}
}
