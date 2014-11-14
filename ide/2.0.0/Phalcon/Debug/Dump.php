<?php 

namespace Phalcon\Debug {

	/**
	 * Phalcon\Debug\Dump
	 *
	 * Dumps information about a variable(s)
	 *
	 *<code>
	 *	$foo = 123;
	 *	echo (new \Phalcon\Debug\Dump())->var($foo, "foo");
	 *</code>
	 * 
	 *<code>
	 *	$foo = "string";
	 *	$bar = ["key" => "value"];
	 *	$baz = new stdClass();
	 *	echo (new \Phalcon\Debug\Dump())->vars($foo, $bar, $baz);
	 *</code>
	 */
	
	class Dump {

		protected $_detailed;

		protected $_methods;

		protected $_styles;

		public function getDetailed(){ }


		public function setDetailed($detailed){ }


		/**
		 * \Phalcon\Debug\Dump constructor
		 *
		 * @param array styles
		 * @param boolean detailed debug object's private and protected properties
		 */
		public function __construct($styles=null, $detailed=null){ }


		/**
		 * Alias of vars() method
		 *
		 * @param mixed variable
		 * @param ...
		 * @return string
		 */
		public function all(){ }


		/**
		 * Get style for type
		 *
		 * @param string type
		 * @return string
		 */
		protected function getStyle($type){ }


		/**
		 * Set styles for vars type
		 *
		 * @param array styles
		 * @return array
		 */
		public function setStyles($styles=null){ }


		/**
		 * Alias of var() method
		 *
		 * @param mixed variable
		 * @param string name
		 * @return string
		 */
		public function one($variable, $name=null){ }


		/**
		 * Prepare an HTML string of information about a single variable.
		 *
		 * @param mixed variable
		 * @param string name
		 * @param intiger tab
		 * @return  string
		 */
		protected function output($variable, $name=null, $tab=null){ }


		/**
		 * Returns an HTML string of information about a single variable.
		 *
		 *<code>
		 *	echo (new \Phalcon\Debug\Dump())->var($foo, "foo");
		 *</code>
		 *
		 * @param mixed variable
		 * @param string name
		 * @return string
		 */
		public function var($variable, $name=null){ }


		/**
		 * Returns an HTML string of debugging information about any number of
		 * variables, each wrapped in a "pre" tag.
		 *
		 *<code>
		 *	$foo = "string";
		 *	$bar = ["key" => "value"];
		 *	$baz = new stdClass();
		 *	echo (new \Phalcon\Debug\Dump())->vars($foo, $bar, $baz);
		 *</code>
		 *
		 * @param mixed variable
		 * @param ...
		 * @return string
		 */
		public function vars(){ }

	}
}
