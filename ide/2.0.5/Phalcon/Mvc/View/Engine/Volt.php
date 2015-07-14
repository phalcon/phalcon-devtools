<?php

namespace Phalcon\Mvc\View\Engine;

use Phalcon\DiInterface;
use Phalcon\Mvc\View\Engine;
use Phalcon\Mvc\View\EngineInterface;
use Phalcon\Mvc\View\Engine\Volt\Compiler;
use Phalcon\Mvc\View\Exception;


class Volt extends Engine implements EngineInterface
{

	protected $_options;

	protected $_compiler;

	protected $_macros;



	/**
	 * Set Volt's options
	 * 
	 * @param array $options
	 *
	 * @return void
	 */
	public function setOptions(array $options) {}

	/**
	 * Return Volt's options
	 *
	 * @return array
	 */
	public function getOptions() {}

	/**
	 * Returns the Volt's compiler
	 *
	 * @return Compiler
	 */
	public function getCompiler() {}

	/**
			 * Pass the IoC to the compiler only of it's an object
	 * 
	 * @param string $templatePath
	 * @param mixed $params
	 * @param boolean $mustClean
			 *
	 * @return void
	 */
	public function render($templatePath, $params, $mustClean=false) {}

	/**
		 * The compilation process is done by Phalcon\Mvc\View\Engine\Volt\Compiler
	 * 
	 * @param mixed $item
		 *
	 * @return int
	 */
	public function length($item) {}

	/**
	 * Checks if the needle is included in the haystack
	 * 
	 * @param mixed $needle
	 * @param mixed $haystack
	 *
	 * @return boolean
	 */
	public function isIncluded($needle, $haystack) {}

	/**
	 * Performs a string conversion
	 * 
	 * @param string $text
	 * @param string $from
	 * @param string $to
	 *
	 * @return string
	 */
	public function convertEncoding($text, $from, $to) {}

	/**
		 * Try to use utf8_encode if conversion is 'latin1' to 'utf8'
	 * 
	 * @param mixed $value
	 * @param int $start
	 * @param mixed $end
		 *
	 * @return mixed
	 */
	public function slice($value, $start, $end=null) {}

	/**
		 * Objects must implement a Traversable interface
	 * 
	 * @param array $value
		 *
	 * @return array
	 */
	public function sort(array $value) {}

	/**
	 * Checks if a macro is defined and calls it
	 * 
	 * @param string $name
	 * @param array $arguments
	 *
	 * @return mixed
	 */
	public function callMacro($name, array $arguments) {}

}
