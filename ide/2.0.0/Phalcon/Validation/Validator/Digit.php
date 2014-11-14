<?php 

namespace Phalcon\Validation\Validator {

	/**
	 * Phalcon\Validation\Validator\Digit
	 *
	 * Check for numeric character(s)
	 *
	 *<code>
	 *use Phalcon\Validation\Validator\Digit as DigitValidator;
	 *
	 *$validator->add('height', new DigitValidator(array(
	 *   'message' => ':field must be numeric'
	 *)));
	 *</code>
	 */
	
	class Digit extends \Phalcon\Validation\Validator implements \Phalcon\Validation\ValidatorInterface {

		/**
		 * Executes the validation
		 *
		 * @param  \Phalcon\Validation validation
		 * @param  string             field
		 * @return boolean
		 */
		public function validate(\Phalcon\Validation $validation, $field){ }

	}
}
