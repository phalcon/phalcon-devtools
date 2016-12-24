<?php

namespace Phalcon\Mvc\Model;

/**
 * Phalcon\Mvc\Model\ValidationFailed
 *
 * This exception is generated when a model fails to save a record
 * Phalcon\Mvc\Model must be set up to have this behavior
 */
class ValidationFailed extends \Phalcon\Mvc\Model\Exception
{

    protected $_model;


    protected $_messages;


    /**
     * Phalcon\Mvc\Model\ValidationFailed constructor
     *
     * @param Model $model
     * @param Message[] $validationMessages
     */
    public function __construct(\Phalcon\Mvc\Model $model, array $validationMessages) {}

    /**
     * Returns the model that generated the messages
     *
     * @return \Phalcon\Mvc\Model
     */
    public function getModel() {}

    /**
     * Returns the complete group of messages produced in the validation
     *
     * @return Message[]
     */
    public function getMessages() {}

}
