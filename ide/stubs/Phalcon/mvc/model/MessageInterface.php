<?php

namespace Phalcon\Mvc\Model;

/**
 * Phalcon\Mvc\Model\Message
 * Interface for Phalcon\Mvc\Model\Message
 */
interface MessageInterface
{

    /**
     * Sets message type
     *
     * @param string $type 
     */
    public function setType($type);

    /**
     * Returns message type
     *
     * @return string 
     */
    public function getType();

    /**
     * Sets verbose message
     *
     * @param string $message 
     */
    public function setMessage($message);

    /**
     * Returns verbose message
     *
     * @return string 
     */
    public function getMessage();

    /**
     * Sets field name related to message
     *
     * @param string $field 
     */
    public function setField($field);

    /**
     * Returns field name related to message
     *
     * @return string 
     */
    public function getField();

    /**
     * Magic __toString method returns verbose message
     *
     * @return string 
     */
    public function __toString();

    /**
     * Magic __set_state helps to recover messages from serialization
     *
     * @param array $message 
     * @return MessageInterface 
     */
    public static function __set_state(array $message);

}
