<?php

namespace Phalcon\Forms;

use Phalcon\DiInterface;
use Phalcon\FilterInterface;
use Phalcon\Di\Injectable;
use Phalcon\Forms\Exception;
use Phalcon\Forms\ElementInterface;
use Phalcon\Validation\Message\Group;


class Form extends Injectable implements \Countable, \Iterator
{

	protected $_position;

	protected $_entity;

	protected $_options;

	protected $_data;

	protected $_elements;

	protected $_elementsIndexed;

	protected $_messages;

	protected $_action;

	protected $_validation;

	public function setValidation($value) {
		$this->_validation = $value;
	}

	public function getValidation() {
		return $this->_validation;
	}



	/**
	 * Phalcon\Forms\Form constructor
	 * 
	 * @param mixed $entity
	 * @param mixed $userOptions
	 *
	 */
	public function __construct($entity=null, $userOptions=null) {}

	/**
		 * Update the user options
	 * 
	 * @param mixed $action
		 *
	 * @return Form
	 */
	public function setAction($action) {}

	/**
	 * Returns the form's action
	 *
	 * @return string
	 */
	public function getAction() {}

	/**
	 * Sets an option for the form
	 *
	 * @param mixed $option
	 * @param mixed $value
	 * 
	 * @return Form
	 */
	public function setUserOption($option, $value) {}

	/**
	 * Returns the value of an option if present
	 *
	 * @param mixed $option
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
	 * @return Form
	 */
	public function setUserOptions(array $options) {}

	/**
	 * Returns the options for the element
	 *
	 * @return mixed
	 */
	public function getUserOptions() {}

	/**
	 * Sets the entity related to the model
	 *
	 * @param mixed $entity
	 * 
	 * @return Form
	 */
	public function setEntity($entity) {}

	/**
	 * Returns the entity related to the model
	 *
	 * @return mixed
	 */
	public function getEntity() {}

	/**
	 * Returns the form elements added to the form
	 *
	 * @return ElementInterface[]
	 */
	public function getElements() {}

	/**
	 * Binds data to the entity
	 *
	 * @param array $data
	 * @param mixed $entity
	 * @param mixed $whitelist
	 * 
	 * @return Form
	 */
	public function bind(array $data, $entity, $whitelist=null) {}

	/**
			 * Get the element
	 * 
	 * @param mixed $data
	 * @param mixed $entity
			 *
	 * @return boolean
	 */
	public function isValid($data=null, $entity=null) {}

	/**
		 * If the data is not an array use the one passed previously
	 * 
	 * @param boolean $byItemName
		 *
	 * @return Group
	 */
	public function getMessages($byItemName=false) {}

	/**
	 * Returns the messages generated for a specific element
	 *
	 * @param mixed $name
	 * 
	 * @return Group
	 */
	public function getMessagesFor($name) {}

	/**
	 * Check if messages were generated for a specific element
	 *
	 * @param mixed $name
	 * 
	 * @return boolean
	 */
	public function hasMessagesFor($name) {}

	/**
	 * Adds an element to the form
	 *
	 * @param ElementInterface $element
	 * @param string $postion
	 * @param boolean $type
	 * 
	 * @return Form
	 */
	public function add(ElementInterface $element, $postion=null, $type=null) {}

	/**
		 * Gets the element's name
	 * 
	 * @param string $name
	 * @param mixed $attributes
		 *
	 * @return string
	 */
	public function render($name, $attributes=null) {}

	/**
	 * Returns an element added to the form by its name
	 * 
	 * @param string $name
	 *
	 * @return ElementInterface
	 */
	public function get($name) {}

	/**
	 * Generate the label of a element added to the form including HTML
	 * 
	 * @param string $name
	 * @param array $attributes
	 *
	 * @return string
	 */
	public function label($name, array $attributes=null) {}

	/**
	 * Returns a label for an element
	 * 
	 * @param string $name
	 *
	 * @return string
	 */
	public function getLabel($name) {}

	/**
		 * Use the element's name as label if the label is not available
	 * 
	 * @param string $name
		 *
	 * @return mixed
	 */
	public function getValue($name) {}

	/**
		 * Check if form has a getter
	 * 
	 * @param string $name
		 *
	 * @return boolean
	 */
	public function has($name) {}

	/**
		 * Checks if the element is in the form
	 * 
	 * @param string $name
		 *
	 * @return boolean
	 */
	public function remove($name) {}

	/**
		 * Checks if the element is in the form
	 * 
	 * @param mixed $fields
		 *
	 * @return Form
	 */
	public function clear($fields=null) {}

	/**
	 * Returns the number of elements in the form
	 *
	 * @return int
	 */
	public function count() {}

	/**
	 * Rewinds the internal iterator
	 *
	 * @return void
	 */
	public function rewind() {}

	/**
	 * Returns the current element in the iterator
	 *
	 * @return ElementInterface|boolean
	 */
	public function current() {}

	/**
	 * Returns the current position/key in the iterator
	 *
	 * @return int
	 */
	public function key() {}

	/**
	 * Moves the internal iteration pointer to the next position
	 *
	 * @return void
	 */
	public function next() {}

	/**
	 * Check if the current element in the iterator is valid
	 *
	 * @return boolean
	 */
	public function valid() {}

}
