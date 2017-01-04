<?php

namespace Phalcon\Forms;

use Phalcon\Tag;
use Phalcon\Forms\Exception;
use Phalcon\Validation\Message;
use Phalcon\Validation\MessageInterface;
use Phalcon\Validation\Message\Group;
use Phalcon\Validation\ValidatorInterface;


abstract class Element implements ElementInterface
{

	protected $_form;

	protected $_name;

	protected $_value;

	protected $_label;

	protected $_attributes;

	protected $_validators;

	protected $_filters;

	protected $_options;

	protected $_messages;



	/**
	 * Phalcon\Forms\Element constructor
	 * 
	 * @param string $name
	 * @param mixed $attributes
	 *
	 */
	public function __construct($name, $attributes=null) {}

	/**
	 * Sets the parent form to the element
	 * 
	 * @param Form $form
	 *
	 * @return ElementInterface
	 */
	public function setForm(Form $form) {}

	/**
	 * Returns the parent form to the element
	 *
	 * @return ElementInterface
	 */
	public function getForm() {}

	/**
	 * Sets the element name
	 * 
	 * @param string $name
	 *
	 * @return ElementInterface
	 */
	public function setName($name) {}

	/**
	 * Returns the element name
	 *
	 * @return string
	 */
	public function getName() {}

	/**
	 * Sets the element filters
	 *
	 * @param mixed $filters
	 * 
	 * @return ElementInterface
	 */
	public function setFilters($filters) {}

	/**
	 * Adds a filter to current list of filters
	 * 
	 * @param string $filter
	 *
	 * @return ElementInterface
	 */
	public function addFilter($filter) {}

	/**
	 * Returns the element filters
	 *
	 * @return mixed
	 */
	public function getFilters() {}

	/**
	 * Adds a group of validators
	 *
	 * @param array $validators
	 * @param boolean $merge
	 * 
	 * @return ElementInterface
	 */
	public function addValidators(array $validators, $merge=true) {}

	/**
	 * Adds a validator to the element
	 * 
	 * @param ValidatorInterface $validator
	 *
	 * @return ElementInterface
	 */
	public function addValidator(ValidatorInterface $validator) {}

	/**
	 * Returns the validators registered for the element
	 *
	 * @return ValidatorInterface[]
	 */
	public function getValidators() {}

	/**
	 * Returns an array of prepared attributes for Phalcon\Tag helpers
	 * according to the element parameters
	 *
	 * @param array $attributes
	 * @param boolean $useChecked
	 * 
	 * @return mixed
	 */
	public function prepareAttributes($attributes=null, $useChecked=false) {}

	/**
		 * Create an array of parameters
	 * 
	 * @param string $attribute
	 * @param $value
		 *
	 * @return ElementInterface
	 */
	public function setAttribute($attribute, $value) {}

	/**
	 * Returns the value of an attribute if present
	 *
	 * @param string $attribute
	 * @param mixed $defaultValue
	 * 
	 * @return mixed
	 */
	public function getAttribute($attribute, $defaultValue=null) {}

	/**
	 * Sets default attributes for the element
	 * 
	 * @param array $attributes
	 *
	 * @return ElementInterface
	 */
	public function setAttributes(array $attributes) {}

	/**
	 * Returns the default attributes for the element
	 *
	 * @return array
	 */
	public function getAttributes() {}

	/**
	 * Sets an option for the element
	 *
	 * @param string $option
	 * @param mixed $value
	 * 
	 * @return ElementInterface
	 */
	public function setUserOption($option, $value) {}

	/**
	 * Returns the value of an option if present
	 *
	 * @param string $option
	 * @param mixed $defaultValue
	 * 
	 * @return mixed
	 */
	public function getUserOption($option, $defaultValue=null) {}

	/**
	 * Sets options for the element
	 *
	 * @param array $options
	 * 
	 * @return ElementInterface
	 */
	public function setUserOptions($options) {}

	/**
	 * Returns the options for the element
	 *
	 * @return mixed
	 */
	public function getUserOptions() {}

	/**
	 * Sets the element label
	 * 
	 * @param string $label
	 *
	 * @return ElementInterface
	 */
	public function setLabel($label) {}

	/**
	 * Returns the element label
	 *
	 * @return string
	 */
	public function getLabel() {}

	/**
	 * Generate the HTML to label the element
	 *
	 * @param mixed $attributes
	 * 
	 * @return string
	 */
	public function label($attributes=null) {}

	/**
		 * Check if there is an "id" attribute defined
	 * 
	 * @param $value
		 *
	 * @return ElementInterface
	 */
	public function setDefault($value) {}

	/**
	 * Returns the default value assigned to the element
	 *
	 * @return mixed
	 */
	public function getDefault() {}

	/**
	 * Returns the element value
	 *
	 * @return mixed
	 */
	public function getValue() {}

	/**
		 * Get the related form
		 *
	 * @return Group
	 */
	public function getMessages() {}

	/**
	 * Checks whether there are messages attached to the element
	 *
	 * @return boolean
	 */
	public function hasMessages() {}

	/**
		 * Get the related form
	 * 
	 * @param Group $group
		 *
	 * @return ElementInterface
	 */
	public function setMessages(Group $group) {}

	/**
	 * Appends a message to the internal message list
	 * 
	 * @param MessageInterface $message
	 *
	 * @return ElementInterface
	 */
	public function appendMessage(MessageInterface $message) {}

	/**
	 * Clears every element in the form to its default value
	 *
	 * @return Element
	 */
	public function clear() {}

	/**
	 * Magic method __toString renders the widget without atttributes
	 *
	 * @return string
	 */
	public function __toString() {}

}
