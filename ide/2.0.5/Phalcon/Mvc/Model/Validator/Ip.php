<?php

namespace Phalcon\Mvc\Model\Validator;

use Phalcon\Mvc\EntityInterface;
use Phalcon\Mvc\Model\Exception;
use Phalcon\Mvc\Model\Validator;
use Phalcon\Mvc\Model\ValidatorInterface;


class Ip extends Validator implements ValidatorInterface
{

	const VERSION_4  = FILTER_FLAG_IPV4;

	const VERSION_6  = FILTER_FLAG_IPV6;



	/**
	 * Executes the validator
	 * 
	 * @param EntityInterface $record
	 *
	 * @return boolean
	 */
	public function validate(EntityInterface $record) {}

}
