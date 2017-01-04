<?php

namespace Phalcon\Forms;

use Phalcon\Validation\MessageInterface;
use Phalcon\Validation\ValidatorInterface;
use Phalcon\Validation\Message\Group;


interface ElementInterface
{

	/**
	 * Sets the parent form to the element
	 *
	 * @param \Phalcon\Forms\Form $form
	 * 
	 * @return Phalcon\Forms\ElementInterface
	 */
	public function setForm(\Phalcon\Forms\Form $form);

	/**
	 * Returns the parent form to the element
	 *
	 * @return Phalcon\Forms\ElementInterface
	 */
	public function getForm();

	/**
	 * Sets the element's name
	 *
	 * @param string $name
	 * 
	 * @return Phalcon\Forms\ElementInterface
	 */
	public function setName($name);

	/**
	 * Returns the element's name
	 *
	 * @return string
	 */
	public function getName();

	/**
	 * Sets the element's filters
	 *
	 * @param array|string $filters
	 * 
	 * @return Phalcon\Forms\ElementInterface
	 */
	public function setFilters($filters);

	/**
	 * Adds a filter to current list of filters
	 *
	 * @param string $filter
	 * 
	 * @return Phalcon\Forms\ElementInterface
	 */
	public function addFilter($filter);

	/**
	 * Returns the element's filters
	 *
	 * @return mixed
	 */
	public function getFilters();

	/**
	 * Adds a group of validators
	 *
	 * @param array $validators
	 * @param boolean $merge
	 * 
	 * @return Phalcon\Forms\ElementInterface
	 */
	public function addValidators(array $validators, $merge=true);

	/**
	 * Adds a validator to the element
	 *
	 * @param ValidatorInterface $validator
	 * 
	 * @return Phalcon\Forms\ElementInterface
	 */
	public function addValidator(ValidatorInterface $validator);

	/**
	 * Returns the validators registered for the element
	 *
	 * @return Phalcon\Validation\ValidatorInterface[]
	 */
	public function getValidators();

	/**
	 * Returns an array of prepared attributes for Phalcon\Tag helpers
	 * according to the element's parameters
	 *
	 * @param array $attributes
	 * @param boolean $useChecked
	 * 
	 * @return array
	 */
	public function prepareAttributes($attributes=null, $useChecked=false);

	/**
	 * Sets a default attribute for the element
	 *
	 * @param string $attribute
	 * @param mixed $value
	 * 
	 * @return Phalcon\Forms\ElementInterface
	 */
	public function setAttribute($attribute, $value);

	/**
	 * Returns the value of an attribute if present
	 *
	 * @param string $attribute
	 * @param mixed $defaultValue
	 * 
	 * @return mixed
	 */
	public function getAttribute($attribute, $defaultValue=null);

	/**
	 * Sets default attributes for the element
	 *
	 * @param array $attributes
	 * 
	 * @return Phalcon\Forms\ElementInterface
	 */
	public function setAttributes(array $attributes);

	/**
	 * Returns the default attributes for the element
	 *
	 * @return array
	 */
	public function getAttributes();

	/**
	 * Sets an option for the element
	 *
	 * @param string $option
	 * @param mixed $value
	 * 
	 * @return Phalcon\Forms\ElementInterface
	 */
	public function setUserOption($option, $value);

	/**
	 * Returns the value of an option if present
	 *
	 * @param string $option
	 * @param mixed $defaultValue
	 * 
	 * @return mixed
	 */
	public function getUserOption($option, $defaultValue=null);

	/**
	 * Sets options for the element
	 *
	 * @param array $options
	 * 
	 * @return Phalcon\Forms\ElementInterface
	 */
	public function setUserOptions($options);

	/**
	 * Returns the options for the element
	 *
	 * @return array
	 */
	public function getUserOptions();

	/**
	 * Sets the element label
	 *
	 * @param string $label
	 * 
	 * @return Phalcon\Forms\ElementInterface
	 */
	public function setLabel($label);

	/**
	 * Returns the element's label
	 *
	 * @return string
	 */
	public function getLabel();

	/**
	 * Generate the HTML to label the element
	 *
	 * @return string
	 */
	public function label();

	/**
	 * Sets a default value in case the form does not use an entity
	 * or there is no value available for the element in _POST
	 *
	 * @param mixed $value
	 * 
	 * @return Phalcon\Forms\ElementInterface
	 */
	public function setDefault($value);

	/**
	 * Returns the default value assigned to the element
	 *
	 * @return mixed
	 */
	public function getDefault();

	/**
	 * Returns the element's value
	 *
	 * @return mixed
	 */
	public function getValue();

	/**
	 * Returns the messages that belongs to the element
	 * The element needs to be attached to a form
	 *
	 * @return Phalcon\Validation\Message\Group
	 */
	public function getMessages();

	/**
	 * Checks whether there are messages attached to the element
	 *
	 * @return boolean
	 */
	public function hasMessages();

	/**
	 * Sets the validation messages related to the element
	 *
	 * @param Group $group
	 * 
	 * @return Phalcon\Forms\ElementInterface
	 */
	public function setMessages(Group $group);

	/**
	 * Appends a message to the internal message list
	 *
	 * @param MessageInterface $message
	 * 
	 * @return Phalcon\Forms\ElementInterface
	 */
	public function appendMessage(MessageInterface $message);

	/**
	 * Clears every element in the form to its default value
	 *
	 * @return Phalcon\Forms\Element
	 */
	public function clear();

	/**
	 * Renders the element widget
	 *
	 * @param array $attributes
	 * 
	 * @return string
	 */
	public function render($attributes=null);

}
