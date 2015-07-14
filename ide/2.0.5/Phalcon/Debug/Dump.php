<?php

namespace Phalcon\Debug;

class Dump
{

	protected $_detailed = false;

	public function getDetailed() {
		return $this->_detailed;
	}

	public function setDetailed($value) {
		$this->_detailed = $value;
	}

	protected $_methods = null;

	protected $_styles;



	/**
	 * Phalcon\Debug\Dump constructor
	 * 
	 * @param array $styles
	 * @param boolean $detailed
	 * @param \boolean detailed debug $object
	 *
	 */
	public function __construct(array $styles=null, $detailed=false) {}

	/**
	 * Alias of variables() method
	 *
	 * @param mixed variable
	 * @param ...
	 *
	 * @return string
	 */
	public function all() {}

	/**
	 * Get style for type
	 * 
	 * @param string $type
	 *
	 * @return string
	 */
	protected function getStyle($type) {}

	/**
	 * Set styles for vars type
	 * 
	 * @param mixed $styles
	 *
	 * @return array
	 */
	public function setStyles($styles=null) {}

	/**
	 * Alias of variable() method
	 * 
	 * @param mixed $variable
	 * @param string $name
	 *
	 * @return string
	 */
	public function one($variable, $name=null) {}

	/**
	 * Prepare an HTML string of information about a single variable.
	 * 
	 * @param mixed $variable
	 * @param string $name
	 * @param int $tab
	 *
	 * @return string
	 */
	protected function output($variable, $name=null, $tab=1) {}

	/**
	 * Returns an HTML string of information about a single variable.
	 *
	 * <code>
	 *    echo (new \Phalcon\Debug\Dump())->variable($foo, "foo");
	 * </code>
	 * 
	 * @param mixed $variable
	 * @param string $name
	 *
	 * @return string
	 */
	public function variable($variable, $name=null) {}

	/**
	 * Returns an HTML string of debugging information about any number of
	 * variables, each wrapped in a "pre" tag.
	 *
	 * <code>
	 *    $foo = "string";
	 *    $bar = ["key" => "value"];
	 *    $baz = new stdClass();
	 *    echo (new \Phalcon\Debug\Dump())->variables($foo, $bar, $baz);
	 *</code>
	 *
	 * @param mixed variable
	 * @param ...
	 *
	 * @return string
	 */
	public function variables() {}

	/**
	 * Returns an JSON string of information about a single variable.
	 *
	 * <code>
	 *    $foo = ["key" => "value"];
	 *    echo (new \Phalcon\Debug\Dump())->toJson($foo);
	 *    $foo = new stdClass();
	 *    $foo->bar = 'buz';
	 *    echo (new \Phalcon\Debug\Dump())->toJson($foo);
	 * </code>
	 * 
	 * @param mixed $variable
	 *
	 *
	 * @return string
	 */
	public function toJson($variable) {}

}
