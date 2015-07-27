<?php 

namespace Phalcon\Validation\Validator {

	/**
	 * Phalcon\Validation\Validator\InclusionIn
	 *
	 * Check if a value is included into a list of values
	 *
	 *<code>
	 *use Phalcon\Validation\Validator\InclusionIn;
	 *
	 *$validator->add('status', new InclusionIn(array(
	 *   'message' => 'The status must be A or B',
	 *   'domain' => array('A', 'B')
	 *)));
	 *</code>
	 */
	
	class InclusionIn extends \Phalcon\Validation\Validator implements \Phalcon\Validation\ValidatorInterface {

		/**
		 * Executes the validation
		 */
		public function validate(\Phalcon\Validation $validation, $field){ }

	}
}
