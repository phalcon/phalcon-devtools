<?php

namespace Phalcon\Mvc\Model\Query;

/**
 * Phalcon\Mvc\Model\Query\StatusInterface
 * Interface for Phalcon\Mvc\Model\Query\Status
 */
interface StatusInterface
{

    /**
     * Phalcon\Mvc\Model\Query\Status
     *
     * @param bool $success 
     * @param mixed $model 
     */
    public function __construct($success, \Phalcon\Mvc\ModelInterface $model);

    /**
     * Returns the model which executed the action
     *
     * @return \Phalcon\Mvc\ModelInterface 
     */
    public function getModel();

    /**
     * Returns the messages produced by a operation failed
     *
     * @return \Phalcon\Mvc\Model\MessageInterface 
     */
    public function getMessages();

    /**
     * Allows to check if the executed operation was successful
     *
     * @return bool 
     */
    public function success();

}
