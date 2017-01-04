<?php

namespace Phalcon\Validation\Validator;

use Phalcon\Validation;
use Phalcon\Validation\Message;
use Phalcon\Validation\Exception;
use Phalcon\Validation\Validator;


class Confirmation extends Validator
{

	/**
	 * Executes the validation
	 * 
	 * @param Validation $validation
	 * @param string $field
	 *
	 * @return boolean
	 */
	public function validate(Validation $validation, $field) {}

	/**
	 * Compare strings
	 * 
	 * @param string $a
	 * @param string $b
	 *
	 * @return boolean
	 */
	protected final function compare($a, $b) {}

}
