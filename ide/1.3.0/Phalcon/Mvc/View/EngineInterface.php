<?php 

namespace Phalcon\Mvc\View {

	/**
	 * Phalcon\Mvc\View\EngineInterface initializer
	 */
	
	interface EngineInterface {

		/**
		 * Returns cached ouput on another view stage
		 *
		 * @return array
		 */
		public function getContent();


		/**
		 * Renders a partial inside another view
		 *
		 * @param string $partialPath
		 * @return string
		 */
		public function partial($partialPath);


		/**
		 * Renders a view using the template engine
		 *
		 * @param string $path
		 * @param array $params
		 * @param boolean $mustClean
		 */
		public function render($path, $params, $mustClean=null);

	}
}
