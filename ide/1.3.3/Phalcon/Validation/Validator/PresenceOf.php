<?php 

namespace Phalcon\Validation\Validator {

	/**
	 * Phalcon\Validation\Validator\PresenceOf
	 *
	 * Validates that a value is not null or empty string
	 *
	 *<code>
	 *use Phalcon\Validation\Validator\PresenceOf;
	 *
	 *$validator->add('name', new PresenceOf(array(
	 *   'message' => 'The name is required'
	 *)));
	 *</code>
	 */
	
	class PresenceOf extends \Phalcon\Validation\Validator implements \Phalcon\Validation\ValidatorInterface {

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
