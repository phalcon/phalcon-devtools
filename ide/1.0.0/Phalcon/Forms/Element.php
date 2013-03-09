<?php 

namespace Phalcon\Forms {

	/**
	 * Phalcon\Forms\Element
	 *
	 * This is a base class for form elements
	 */
	
	abstract class Element {

		protected $_name;

		protected $_validators;

		/**
		 * \Phalcon\Forms\Element constructor
		 *
		 * @param string $name
		 */
		public function __construct($name){ }


		public function setName($name){ }


		public function getName(){ }


		/**
		 * Adds a group of validators
		 *
		 * @param \Phalcon\Validation\ValidatorInterface[]
		 */
		public function addValidators($validators){ }


		/**
		 * Adds a validator to the element
		 *
		 * @param \Phalcon\Validation\ValidatorInterface
		 */
		public function addValidator($validator){ }


		/**
		 * Returns the validators registered for the element
		 *
		 * @return \Phalcon\Validation\ValidatorInterface[]
		 */
		public function getValidators(){ }


		/**
		 * Magic method __toString renders the widget without atttributes
		 *
		 * @return string
		 */
		public function __toString(){ }

	}
}
