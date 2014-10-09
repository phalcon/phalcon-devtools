<?php 

namespace Phalcon\Annotations {

	/**
	 * Phalcon\Annotations\Annotation
	 *
	 * Represents a single annotation in an annotations collection
	 */
	
	class Annotation {

		protected $_name;

		protected $_arguments;

		protected $_exprArguments;

		/**
		 * \Phalcon\Annotations\Annotation constructor
		 *
		 * @param array $reflectionData
		 */
		public function __construct($reflectionData){ }


		/**
		 * Returns the annotation's name
		 *
		 * @return string
		 */
		public function getName(){ }


		/**
		 * Resolves an annotation expression
		 *
		 * @param array $expr
		 * @return mixed
		 */
		public function getExpression($expr){ }


		/**
		 * Returns the expression arguments without resolving
		 *
		 * @return array
		 */
		public function getExprArguments(){ }


		/**
		 * Returns the expression arguments
		 *
		 * @return array
		 */
		public function getArguments(){ }


		/**
		 * Returns the number of arguments that the annotation has
		 *
		 * @return int
		 */
		public function numberArguments(){ }


		/**
		 * Returns an argument in a specific position
		 *
		 * @return mixed
		 */
		public function getArgument($position){ }


		/**
		 * Checks if the annotation has a specific argument
		 *
		 * @return bool
		 */
		public function hasArgument($position){ }


		/**
		 * Returns a named argument
		 *
		 * @param string $name
		 * @return mixed
		 */
		public function getNamedArgument($position){ }


		/**
		 * Returns a named argument (deprecated)
		 *
		 * @deprecated
		 * @param string $name
		 * @return mixed
		 */
		public function getNamedParameter($position){ }


		/**
		 * Checks if the annotation has a specific named argument
		 *
		 * @return boolean
		 */
		public function hasNamedArgument($position){ }

	}
}
