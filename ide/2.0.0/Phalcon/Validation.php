<?php 

namespace Phalcon {

    /**
     * Phalcon\Validation
     *
     * Allows to validate data using validators
     */
    class Validation extends \Phalcon\DI\Injectable implements \Phalcon\Events\EventsAwareInterface, \Phalcon\DI\InjectionAwareInterface
    {

        protected $_data;

        protected $_entity;

        protected $_validators;

        protected $_filters;

        protected $_messages;

        protected $_values;

        protected $_defaultMessages;

        protected $_labels;

        /**
         * \Phalcon\Validation constructor
         *
         * @param array validators
         */
        public function __construct($validators=null)
        {
        }


        /**
         * Validate a set of data according to a set of rules
         *
         * @param array|object data
         * @param object entity
         * @return \Phalcon\Validation\Message\Group
         */
        public function validate($data=null, $entity=null)
        {
        }


        /**
         * Adds a validator to a field
         *
         * @param string field
         * @param \Phalcon\Validation\ValidatorInterface validator
         * @return \Phalcon\Validation
         */
        public function add($attribute, $validator)
        {
        }


        /**
         * Adds filters to the field
         *
         * @param string field
         * @param array|string field
         * @return \Phalcon\Validation
         */
        public function setFilters($attribute, $filters)
        {
        }


        /**
         * Returns all the filters or a specific one
         *
         * @param string field
         * @return mixed
         */
        public function getFilters($attribute=null)
        {
        }


        /**
         * Returns the validators added to the validation
         *
         * @return array
         */
        public function getValidators()
        {
        }


        /**
         * Returns the bound entity
         *
         * @return object
         */
        public function getEntity()
        {
        }


        /**
         * Returns the registered validators
         *
         * @return \Phalcon\Validation\Message\Group
         */
        public function getMessages()
        {
        }


        /**
         * Appends a message to the messages list
         *
         * @param \Phalcon\Validation\MessageInterface message
         * @return \Phalcon\Validation
         */
        public function appendMessage($message)
        {
        }


        /**
         * Assigns the data to an entity
         * The entity is used to obtain the validation values
         *
         * @param string entity
         * @param string data
         * @return \Phalcon\Validation
         */
        public function bind($entity, $data)
        {
        }


        /**
         * Gets the a value to validate in the array/object data source
         *
         * @param string field
         * @return mixed
         */
        public function getValue($attribute)
        {
        }


        /**
         * Adds default messages to validators
         *
         * @param array messages
         * @return array
         */
        public function setDefaultMessages($messages=null)
        {
        }


        /**
         * Get default message for validator type
         *
         * @param string type
         * @return string
         */
        public function getDefaultMessage($type)
        {
        }


        /**
         * Adds labels for fields
         *
         * @param array labels
         */
        public function setLabels($labels)
        {
        }


        /**
         * Get label for field
         *
         * @param string field
         * @return string
         */
        public function getLabel($field)
        {
        }

    }
}
