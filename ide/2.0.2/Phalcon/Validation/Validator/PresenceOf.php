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
		 */
		public function validate(\Phalcon\Validation $validation, $field){ }

	}
}
