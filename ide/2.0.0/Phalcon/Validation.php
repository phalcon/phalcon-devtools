<?php

namespace Phalcon;

class Validation extends \Phalcon\Di\Injectable
{

    protected $_data;


    protected $_entity;


    protected $_validators;


    protected $_filters;


    protected $_messages;


    protected $_defaultMessages;


    protected $_labels;


    protected $_values;


    /**
     * @param mixed $validators 
     */
	public function setValidators($validators) {}

    /**
     * Phalcon\Validation constructor
     *
     * @param array $validators 
     */
	public function __construct($validators = null) {}

    /**
     * Validate a set of data according to a set of rules
     *
     * @param array|object $data 
     * @param object $entity 
     * @return \Phalcon\Validation\Message\Group 
     */
	public function validate($data = null, $entity = null) {}

    /**
     * Adds a validator to a field
     *
     * @param string $field 
     * @param \Phalcon\Validation\ValidatorInterface $validator 
     * @return \Phalcon\Validation 
     */
	public function add($field, \Phalcon\Validation\ValidatorInterface $validator) {}

    /**
     * Alias of `add` method
     *
     * @param string $field 
     * @param \Phalcon\Validation\ValidatorInterface $validator 
     * @return \Phalcon\Validation 
     */
	public function rule($field, \Phalcon\Validation\ValidatorInterface $validator) {}

    /**
     * Adds the validators to a field
     *
     * @param string $field 
     * @param array $validators 
     * @return \Phalcon\Validation 
     */
	public function rules($field, $validators) {}

    /**
     * Adds filters to the field
     *
     * @param array|string $field 
     * @param mixed $filters 
     * @return \Phalcon\Validation 
     */
	public function setFilters($field, $filters) {}

    /**
     * Returns all the filters or a specific one
     *
     * @param string $field 
     * @return mixed 
     */
	public function getFilters($field = null) {}

    /**
     * Returns the validators added to the validation
     *
     * @return array 
     */
	public function getValidators() {}

    /**
     * Returns the bound entity
     *
     * @return object 
     */
	public function getEntity() {}

    /**
     * Adds default messages to validators
     *
     * @param array $messages 
     * @return array 
     */
	public function setDefaultMessages($messages = null) {}

    /**
     * Get default message for validator type
     *
     * @param string $type 
     * @return string 
     */
	public function getDefaultMessage($type) {}

    /**
     * Returns the registered validators
     *
     * @return \Phalcon\Validation\Message\Group 
     */
	public function getMessages() {}

    /**
     * Adds labels for fields
     *
     * @param array $labels 
     */
	public function setLabels($labels) {}

    /**
     * Get label for field
     *
     * @param string $field 
     * @return string 
     */
	public function getLabel($field) {}

    /**
     * Appends a message to the messages list
     *
     * @param \Phalcon\Validation\MessageInterface $message 
     * @return \Phalcon\Validation 
     */
	public function appendMessage(\Phalcon\Validation\MessageInterface $message) {}

    /**
     * Assigns the data to an entity
     * The entity is used to obtain the validation values
     *
     * @param string $entity 
     * @param string $data 
     * @return \Phalcon\Validation 
     */
	public function bind($entity, $data) {}

    /**
     * Gets the a value to validate in the array/object data source
     *
     * @param string $field 
     * @return mixed 
     */
	public function getValue($field) {}

}
