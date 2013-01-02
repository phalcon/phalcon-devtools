<?php 

namespace Phalcon\Mvc\View\Engine\Volt {

	/**
	 * Phalcon\Mvc\View\Engine\Volt\Compiler
	 *
	 * This class reads and compiles volt templates into PHP plain code
	 */
	
	class Compiler {

		protected $_dependencyInjector;

		protected $_arrayHelpers;

		protected $_filters;

		protected $_extendsMode;

		protected $_extendsNode;

		protected $_currentBlock;

		protected $_blocks;

		/**
		 * Sets the dependency injector
		 *
		 * @param \Phalcon\DiInterface $dependencyInjector
		 */
		public function setDI($dependencyInjector){ }


		/**
		 * Returns the internal dependency injector
		 *
		 * @return \Phalcon\DiInterface
		 */
		public function getDI(){ }


		/**
		 * Resolves function intermediate code into PHP function calls
		 *
		 * @param array $expr
		 * @param boolean $extendsMode
		 * @return string
		 */
		protected function _functionCall(){ }


		/**
		 * Resolves filter intermediate code into PHP function calls
		 *
		 * @param array $filter
		 * @param array $expr
		 * @return string
		 */
		protected function _filter(){ }


		/**
		 * Resolves an expression node in an AST volt tree
		 *
		 * @param array $expr
		 * @param bool $extendsMode
		 * @param bool $prependDollar
		 * @return string
		 */
		public function _expression($expr, $extendsMode, $prependDollar=null){ }


		/**
		 * Traverses a statement list compiling each of its nodes
		 *
		 * @param array $statement
		 * @return string
		 */
		protected function _statementList(){ }


		/**
		 * Compiles a Volt source code returning a PHP plain version
		 *
		 * @param string $viewCode
		 * @param boolean $extendsMode
		 * @return string
		 */
		protected function _compileSource(){ }


		/**
		 * Compiles a template in a string
		 *
		 * @param string $viewCode
		 * @param boolean $extendsMode
		 * @return string
		 */
		public function compileString($viewCode, $extendsMode=null){ }


		/**
		 * Compiles a template into a file
		 *
		 * @param string $path
		 * @param string $compiledPath
		 */
		public function compile($path, $compiledPath){ }


		/**
		 * Parses a Volt template returning its intermediate representation
		 *
		 * @param string $viewCode
		 * @return array
		 */
		public function parse($viewCode){ }

	}
}
