<?php 

namespace Phalcon\Validation\Validator {

	/**
	 * Phalcon\Validation\Validator\Between
	 *
	 * Validates that a value is between a range of two values
	 *
	 *<code>
	 *use Phalcon\Validation\Validator\Between;
	 *
	 *$validator->add('name', new Between(array(
	 *   'minimum' => 0,
	 *   'maximum' => 100,
	 *   'message' => 'The price must be between 0 and 100'
	 *)));
	 *</code>
	 */
	
	class Between extends \Phalcon\Validation\Validator implements \Phalcon\Validation\ValidatorInterface {

		/**
		 * Executes the validation
		 *
		 * @param \Phalcon\Validation $validator
		 * @param string $attribute
		 * @return boolean
		 */
		public function validate($validator, $attribute){ }

	}
}
