<?php 

namespace Phalcon\Mvc\View\Engine {

	/**
	 * Phalcon\Mvc\View\Engine\Volt
	 *
	 * Designer friendly and fast template engine for PHP written in C
	 */
	
	class Volt extends \Phalcon\Mvc\View\Engine {

		protected $_options;

		protected $_compiler;

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
		 * Returns the Volt's compiler
		 *
		 * @return \Phalcon\Mvc\View\Engine\Volt\Compiler
		 */
		public function getCompiler(){ }


		/**
		 * Renders a view using the template engine
		 *
		 * @param string $templatePath
		 * @param array $params
		 * @param boolean $mustClean
		 */
		public function render($templatePath, $params, $mustClean=null){ }


		/**
		 * Length filter. If an array/object is passed a count is performed otherwise a strlen/mb_strlen
		 *
		 * @param mixed $item
		 * @return int
		 */
		public function length($item){ }


		/**
		 * Performs a string conversion
		 *
		 * @param string $text
		 * @param string $from
		 * @param string $to
		 * @return string
		 */
		public function converEncoding($text, $from, $to){ }


		/**
		 * Extracts a slice from an string/array/traversable object value
		 *
		 * @param mixed $value
		 */
		public function slice($value, $start, $end=null){ }

	}
}
