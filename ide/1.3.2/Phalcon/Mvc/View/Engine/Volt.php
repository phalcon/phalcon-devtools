<?php 

namespace Phalcon\Mvc\View\Engine {

	/**
	 * Phalcon\Mvc\View\Engine\Volt
	 *
	 * Designer friendly and fast template engine for PHP written in C
	 */
	
	class Volt extends \Phalcon\Mvc\View\Engine implements \Phalcon\Mvc\View\EngineInterface, \Phalcon\DI\InjectionAwareInterface, \Phalcon\Events\EventsAwareInterface {

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
		public function render($path, $params, $mustClean=null){ }


		/**
		 * Length filter. If an array/object is passed a count is performed otherwise a strlen/mb_strlen
		 *
		 * @param mixed $item
		 * @return int
		 */
		public function length($item){ }


		/**
		 * Checks if the needle is included in the haystack
		 *
		 * @param mixed $needle
		 * @param mixed $haystack
		 * @return boolean
		 */
		public function isIncluded($needle, $haystack){ }


		/**
		 * Performs a string conversion
		 *
		 * @param string $text
		 * @param string $from
		 * @param string $to
		 * @return string
		 */
		public function convertEncoding($text, $from, $to){ }


		/**
		 * Extracts a slice from a string/array/traversable object value
		 *
		 * @param mixed $value
		 */
		public function slice($value, $start, $end=null){ }


		/**
		 * Sorts an array
		 *
		 * @param array $value
		 * @return array
		 */
		public function sort($value){ }

	}
}
