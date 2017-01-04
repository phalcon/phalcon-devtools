<?php

namespace Phalcon\Mvc\Model\Validator;

use Phalcon\Mvc\EntityInterface;
use Phalcon\Mvc\Model\Exception;
use Phalcon\Mvc\Model\Validator;
use Phalcon\Mvc\Model\ValidatorInterface;


class Inclusionin extends Validator implements ValidatorInterface
{

	/**
	 * Executes validator
	 * 
	 * @param EntityInterface $record
	 *
	 * @return boolean
	 */
	public function validate(EntityInterface $record) {}

}
