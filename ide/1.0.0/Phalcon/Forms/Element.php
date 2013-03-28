<?php 

namespace Phalcon\Forms {

	/**
	 * Phalcon\Forms\Element
	 *
	 * This is a base class for form elements
	 */
	
	abstract class Element {

		protected $_form;

		protected $_name;

		protected $_label;

		protected $_attributes;

		protected $_validators;

		/**
		 * \Phalcon\Forms\Element constructor
		 *
		 * @param string $name
		 * @param array $attributes
		 */
		public function __construct($name, $attributes=null){ }


		/**
		 * Sets the parent form to the element
		 *
		 * @param \Phalcon\Forms\Form $form
		 * @return \Phalcon\Forms\ElementInterface
		 */
		public function setForm($form){ }


		/**
		 * Returns the parent form to the element
		 *
		 * @return \Phalcon\Forms\ElementInterface
		 */
		public function getForm(){ }


		/**
		 * Sets the element's name
		 *
		 * @param string $name
		 * @return \Phalcon\Forms\ElementInterface
		 */
		public function setName($name){ }


		/**
		 * Returns the element's name
		 *
		 * @return string
		 */
		public function getName(){ }


		/**
		 * Adds a group of validators
		 *
		 * @param \Phalcon\Validation\ValidatorInterface[]
		 * @return \Phalcon\Forms\ElementInterface
		 */
		public function addValidators($validators, $merge=null){ }


		/**
		 * Adds a validator to the element
		 *
		 * @param \Phalcon\Validation\ValidatorInterface
		 * @return \Phalcon\Forms\ElementInterface
		 */
		public function addValidator($validator){ }


		/**
		 * Returns the validators registered for the element
		 *
		 * @return \Phalcon\Validation\ValidatorInterface[]
		 */
		public function getValidators(){ }


		/**
		 * Returns an array of attributes for \Phalcon\Tag helpers prepared
		 * according to the element's parameters
		 *
		 * @param array $attributes
		 * @return array
		 */
		public function prepareAttributes($attributes){ }


		/**
		 * Sets a default attribute for the element
		 *
		 * @param string $attribute
		 * @param mixed $value
		 * @return \Phalcon\Forms\ElementInterface
		 */
		public function setAttribute($attribute, $value){ }


		/**
		 * Sets default attributes for the element
		 *
		 * @param array $attributes
		 * @return \Phalcon\Forms\ElementInterface
		 */
		public function setAttributes($attributes){ }


		/**
		 * Returns the default attributes for the element
		 *
		 * @return array
		 */
		public function getAttributes(){ }


		/**
		 * Sets the element label
		 *
		 * @param string $label
		 * @return \Phalcon\Forms\ElementInterface
		 */
		public function setLabel($label){ }


		/**
		 * Returns the element's label
		 *
		 * @return string
		 */
		public function getLabel(){ }


		/**
		 * Magic method __toString renders the widget without atttributes
		 *
		 * @return string
		 */
		public function __toString(){ }

	}
}
