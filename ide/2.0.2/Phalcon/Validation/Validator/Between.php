<?php 

namespace Phalcon\Validation\Validator {

	/**
	 * Phalcon\Validation\Validator\Between
	 *
	 * Validates that a value is between an inclusive range of two values.
	 * For a value x, the test is passed if minimum<=x<=maximum.
	 *
	 *<code>
	 *use Phalcon\Validation\Validator\Between;
	 *
	 *validator->add('name', new Between(array(
	 *   'minimum' => 0,
	 *   'maximum' => 100,
	 *   'message' => 'The price must be between 0 and 100'
	 *)));
	 *</code>
	 */
	
	class Between extends \Phalcon\Validation\Validator implements \Phalcon\Validation\ValidatorInterface {

		/**
		 * Executes the validation
		 */
		public function validate(\Phalcon\Validation $validation, $field){ }

	}
}
