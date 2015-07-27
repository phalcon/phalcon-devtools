<?php 

namespace Phalcon\Mvc\View\Engine {

	/**
	 * Phalcon\Mvc\View\Engine\Php
	 *
	 * Adapter to use PHP itself as templating engine
	 */
	
	class Php extends \Phalcon\Mvc\View\Engine implements \Phalcon\Di\InjectionAwareInterface, \Phalcon\Events\EventsAwareInterface, \Phalcon\Mvc\View\EngineInterface {

		/**
		 * Renders a view using the template engine
		 */
		public function render($path, $params, $mustClean=null){ }

	}
}
