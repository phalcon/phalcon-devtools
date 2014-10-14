<?php 

namespace Phalcon\Validation\Validator {

	/**
	 * Phalcon\Validation\Validator\Identical
	 *
	 * Checks if a value is identical to other
	 *
	 *<code>
	 *use Phalcon\Validation\Validator\Identical;
	 *
	 *$validator->add('terms', new Identical(array(
	 *   'value'   => 'yes',
	 *   'message' => 'Terms and conditions must be accepted'
	 *)));
	 *</code>
	 *
	 */
	
	class Identical extends \Phalcon\Validation\Validator implements \Phalcon\Validation\ValidatorInterface {

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
