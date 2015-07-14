<?php

namespace Phalcon\Mvc\Model\Query;

use Phalcon\Mvc\ModelInterface;


interface StatusInterface
{

	/**
	 * Phalcon\Mvc\Model\Query\Status
	 * 
	 * @param boolean $success
	 * @param ModelInterface $model
	 */
	public function __construct($success, ModelInterface $model);

	/**
	 * Returns the model which executed the action
	 *
	 * @return ModelInterface
	 */
	public function getModel();

	/**
	 * Returns the messages produced by a operation failed
	 *
	 * @return \Phalcon\Mvc\Model\MessageInterface[]
	 */
	public function getMessages();

	/**
	 * Allows to check if the executed operation was successful
	 *
	 * @return boolean
	 */
	public function success();

}
