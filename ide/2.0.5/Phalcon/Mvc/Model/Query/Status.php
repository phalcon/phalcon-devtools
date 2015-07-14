<?php

namespace Phalcon\Mvc\Model\Query;

use Phalcon\Mvc\ModelInterface;
use Phalcon\Mvc\Model\Query\StatusInterface;


class Status implements StatusInterface
{

	protected $_success;

	protected $_model;



	/**
	 * Phalcon\Mvc\Model\Query\Status
	 * 
	 * @param boolean $success
	 * @param ModelInterface $model
	 */
	public function __construct($success, ModelInterface $model=null) {}

	/**
	 * Returns the model that executed the action
	 *
	 * @return ModelInterface
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
