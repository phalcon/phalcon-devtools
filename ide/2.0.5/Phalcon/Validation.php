<?php

namespace Phalcon;

use Phalcon\Di\Injectable;
use Phalcon\Validation\Exception;
use Phalcon\Validation\MessageInterface;
use Phalcon\Validation\Message\Group;
use Phalcon\Validation\ValidatorInterface;


class Validation extends Injectable
{

	protected $_data;

	protected $_entity;

	protected $_validators;

	public function setValidators($value) {
		$this->_validators = $value;
	}

	protected $_filters;

	protected $_messages;

	protected $_defaultMessages;

	protected $_labels;

	protected $_values;



	/**
	 * Phalcon\Validation constructor
	 * 
	 * @param array $validators
	 */
	public function __construct(array $validators=null) {}

	/**
		 * Check for an 'initialize' method
	 * 
	 * @param mixed $data
	 * @param mixed $entity
		 *
	 * @return Group
	 */
	public function validate($data=null, $entity=null) {}

	/**
		 * Clear pre-calculated values
	 * 
	 * @param string $field
	 * @param ValidatorInterface $validator
		 *
	 * @return Validation
	 */
	public function add($field, ValidatorInterface $validator) {}

	/**
	 * Alias of `add` method
	 * 
	 * @param string $field
	 * @param ValidatorInterface $validator
	 *
	 * @return Validation
	 */
	public function rule($field, ValidatorInterface $validator) {}

	/**
	 * Adds the validators to a field
	 * 
	 * @param string $field
	 * @param array $validators
	 *
	 * @return Validation
	 */
	public function rules($field, array $validators) {}

	/**
	 * Adds filters to the field
	 *
	 * @param string $field
	 * @param array|string $filters
	 * 
	 * @return Validation
	 */
	public function setFilters($field, $filters) {}

	/**
	 * Returns all the filters or a specific one
	 *
	 * @param string $field
	 * 
	 * @return mixed
	 */
	public function getFilters($field=null) {}

	/**
	 * Returns the validators added to the validation
	 *
	 * @return array
	 */
	public function getValidators() {}

	/**
	 * Returns the bound entity
	 *
	 * @return mixed
	 */
	public function getEntity() {}

	/**
	 * Adds default messages to validators
	 * 
	 * @param array $messages
	 *
	 * @return array
	 */
	public function setDefaultMessages(array $messages=[]) {}

	/**
	 * Get default message for validator type
	 * 
	 * @param string $type
	 *
	 *
	 * @return string
	 */
	public function getDefaultMessage($type) {}

	/**
	 * Returns the registered validators
	 *
	 * @return Group
	 */
	public function getMessages() {}

	/**
	 * Adds labels for fields
	 * 
	 * @param array $labels
	 *
	 * @return void
	 */
	public function setLabels(array $labels) {}

	/**
	 * Get label for field
	 *
	 * @param string $field
	 * 
	 * @return mixed
	 */
	public function getLabel($field) {}

	/**
	 * Appends a message to the messages list
	 * 
	 * @param MessageInterface $message
	 *
	 * @return Validation
	 */
	public function appendMessage(MessageInterface $message) {}

	/**
	 * Assigns the data to an entity
	 * The entity is used to obtain the validation values
	 *
	 * @param object $entity
	 * @param array|object $data
	 * 
	 * @return Validation
	 */
	public function bind($entity, $data) {}

	/**
	 * Gets the a value to validate in the array/object data source
	 *
	 * @param string $field
	 * 
	 * @return mixed
	 */
	public function getValue($field) {}

}
