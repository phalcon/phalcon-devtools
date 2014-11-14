<?php 

namespace Phalcon\Validation\Validator {

	/**
	 * Phalcon\Validation\Validator\Alpha
	 *
	 * Check for alphabetic character(s)
	 *
	 *<code>
	 *use Phalcon\Validation\Validator\Alpha as AlphaValidator;
	 *
	 *$validator->add('username', new AlphaValidator(array(
	 *   'message' => ':field must contain only letters'
	 *)));
	 *</code>
	 */
	
	class Alpha extends \Phalcon\Validation\Validator implements \Phalcon\Validation\ValidatorInterface {

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
