<?php

namespace Phalcon;

/**
 * Phalcon\Validation
 *
 * Allows to validate data using custom or built-in validators
 */
class Validation extends \Phalcon\Di\Injectable implements \Phalcon\ValidationInterface
{

    protected $_data;


    protected $_entity;


    protected $_validators = array();


    protected $_combinedFieldsValidators = array();


    protected $_filters = array();


    protected $_messages;


    protected $_defaultMessages;


    protected $_labels = array();


    protected $_values;



    public function getData() {}

    /**
     * @param mixed $validators
     */
    public function setValidators($validators) {}

    /**
     * Phalcon\Validation constructor
     *
     * @param array $validators
     */
    public function __construct(array $validators = null) {}

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
     * @param mixed $field
     * @param \Phalcon\Validation\ValidatorInterface $validator
     * @return Validation
     */
    public function add($field, \Phalcon\Validation\ValidatorInterface $validator) {}

    /**
     * Alias of `add` method
     *
     * @param mixed $field
     * @param \Phalcon\Validation\ValidatorInterface $validator
     * @return Validation
     */
    public function rule($field, \Phalcon\Validation\ValidatorInterface $validator) {}

    /**
     * Adds the validators to a field
     *
     * @param mixed $field
     * @param array $validators
     * @return Validation
     */
    public function rules($field, array $validators) {}

    /**
     * Adds filters to the field
     *
     * @param string $field
     * @param array|string $filters
     * @return Validation
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
     * Sets the bound entity
     *
     * @param object $entity
     */
    public function setEntity($entity) {}

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
    public function setDefaultMessages(array $messages = array()) {}

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
    public function setLabels(array $labels) {}

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
     * @return Validation
     */
    public function appendMessage(\Phalcon\Validation\MessageInterface $message) {}

    /**
     * Assigns the data to an entity
     * The entity is used to obtain the validation values
     *
     * @param object $entity
     * @param array|object $data
     * @return Validation
     */
    public function bind($entity, $data) {}

    /**
     * Gets the a value to validate in the array/object data source
     *
     * @param string $field
     * @return mixed
     */
    public function getValue($field) {}

    /**
     * Internal validations, if it returns true, then skip the current validator
     *
     * @param mixed $field
     * @param \Phalcon\Validation\ValidatorInterface $validator
     * @return bool
     */
    protected function preChecking($field, \Phalcon\Validation\ValidatorInterface $validator) {}

}
