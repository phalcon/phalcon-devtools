<?php 

namespace Phalcon\Mvc\View\Engine {

	/**
	 * Phalcon\Mvc\View\Engine\Volt
	 *
	 * Designer friendly and fast template engine for PHP written in C
	 */
	
	class Volt extends \Phalcon\Mvc\View\Engine {

		protected $_options;

		/**
		 * Set Volt's options
		 *
		 * @param array $options
		 */
		public function setOptions($options){ }


		/**
		 * Return Volt's options
		 *
		 * @return array
		 */
		public function getOptions(){ }


		/**
		 * Renders a view using the template engine
		 *
		 * @param string $templatePath
		 * @param array $params
		 * @param bool $mustClean
		 */
		public function render($templatePath, $params, $mustClean){ }


		/**
		 * Length filter
		 *
		 * @param mixed $item
		 * @return int
		 */
		public function length($item){ }

	}
}
