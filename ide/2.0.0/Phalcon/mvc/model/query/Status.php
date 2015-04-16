<?php

namespace Phalcon\Mvc\Model\Query;

class Status implements \Phalcon\Mvc\Model\Query\StatusInterface
{

    protected $_success;


    protected $_model;


    /**
     * Phalcon\Mvc\Model\Query\Status
     *
     * @param boolean $success 
     * @param \Phalcon\Mvc\ModelInterface $model 
     */
	public function __construct($success, \Phalcon\Mvc\ModelInterface $model = null) {}

    /**
     * Returns the model that executed the action
     *
     * @return \Phalcon\Mvc\ModelInterface 
     */
	public function getModel() {}

    /**
     * Returns the messages produced because of a failed operation
     *
     * @return \Phalcon\Mvc\Model\MessageInterface[] 
     */
	public function getMessages() {}

    /**
     * Allows to check if the executed operation was successful
     *
     * @return boolean 
     */
	public function success() {}

}
