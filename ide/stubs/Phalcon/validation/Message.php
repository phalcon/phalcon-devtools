<?php

namespace Phalcon\Validation;

/**
 * Phalcon\Validation\Message
 * Encapsulates validation info generated in the validation process
 */
class Message implements \Phalcon\Validation\MessageInterface
{

    protected $_type;


    protected $_message;


    protected $_field;


    protected $_code;


    /**
     * Phalcon\Validation\Message constructor
     *
     * @param string $message 
     * @param mixed $field 
     * @param string $type 
     * @param int $code 
     */
    public function __construct($message, $field = null, $type = null, $code = null) {}

    /**
     * Sets message type
     *
     * @param string $type 
     * @return Message 
     */
    public function setType($type) {}

    /**
     * Returns message type
     *
     * @return string 
     */
    public function getType() {}

    /**
     * Sets verbose message
     *
     * @param string $message 
     * @return Message 
     */
    public function setMessage($message) {}

    /**
     * Returns verbose message
     *
     * @return string 
     */
    public function getMessage() {}

    /**
     * Sets field name related to message
     *
     * @param mixed $field 
     * @return Message 
     */
    public function setField($field) {}

    /**
     * Returns field name related to message
     *
     * @return mixed 
     */
    public function getField() {}

    /**
     * Sets code for the message
     *
     * @param int $code 
     * @return Message 
     */
    public function setCode($code) {}

    /**
     * Returns the message code
     *
     * @return int 
     */
    public function getCode() {}

    /**
     * Magic __toString method returns verbose message
     *
     * @return string 
     */
    public function __toString() {}

    /**
     * Magic __set_state helps to recover messsages from serialization
     *
     * @param array $message 
     * @return Message 
     */
    public static function __set_state(array $message) {}

}
