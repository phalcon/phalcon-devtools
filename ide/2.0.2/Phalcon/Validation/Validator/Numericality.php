<?php 

namespace Phalcon\Validation\Validator {

	/**
	 * Phalcon\Validation\Validator\Numericality
	 *
	 * Check for a valid numeric value
	 *
	 *<code>
	 *use Phalcon\Validation\Validator\Numericality;
	 *
	 *$validator->add('price', new Numericality(array(
	 *   'message' => ':field is not numeric'
	 *)));
	 *</code>
	 */
	
	class Numericality extends \Phalcon\Validation\Validator implements \Phalcon\Validation\ValidatorInterface {

		/**
		 * Executes the validation
		 */
		public function validate(\Phalcon\Validation $validation, $field){ }

	}
}
