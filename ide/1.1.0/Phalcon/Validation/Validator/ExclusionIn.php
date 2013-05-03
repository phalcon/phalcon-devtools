<?php 

namespace Phalcon\Validation\Validator {

	/**
	 * Phalcon\Validation\Validator\ExclusionIn
	 *
	 * Check if a value is not included into a list of values
	 *
	 *<code>
	 *use Phalcon\Validation\Validator\ExclusionIn;
	 *
	 *$validator->add('status', new ExclusionIn(array(
	 *   'message' => 'The status must not be A or B',
	 *   'domain' => array('A', 'B')
	 *)));
	 *</code>
	 */
	
	class ExclusionIn extends \Phalcon\Validation\Validator implements \Phalcon\Validation\ValidatorInterface {

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
