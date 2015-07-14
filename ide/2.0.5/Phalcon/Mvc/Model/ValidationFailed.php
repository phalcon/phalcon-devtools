<?php

namespace Phalcon\Mvc\Model;

use Phalcon\Mvc\Model;


class ValidationFailed extends \Phalcon\Mvc\Model\Exception
{

	protected $_model;

	protected $_messages;



	/**
	 * Phalcon\Mvc\Model\ValidationFailed constructor
	 * 
	 * @param Model $model
	 * @param array $validationMessages
	 *
	 */
	public function __construct(Model $model, array $validationMessages) {}

	/**
			 * Get the first message in the array
			 *
	 * @return Model
	 */
	public function getModel() {}

	/**
	 * Returns the complete group of messages produced in the validation
	 *
	 * @return Message[]
	 */
	public function getMessages() {}

}
