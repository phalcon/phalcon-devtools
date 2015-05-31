<?php 

namespace Phalcon\Validation\Validator {

	/**
	 * Phalcon\Validation\Validator\Email
	 *
	 * Checks if a value has a correct e-mail format
	 *
	 *<code>
	 *use Phalcon\Validation\Validator\Email as EmailValidator;
	 *
	 *$validator->add('email', new EmailValidator(array(
	 *   'message' => 'The e-mail is not valid'
	 *)));
	 *</code>
	 */
	
	class Email extends \Phalcon\Validation\Validator implements \Phalcon\Validation\ValidatorInterface {

		/**
		 * Executes the validation
		 */
		public function validate(\Phalcon\Validation $validation, $field){ }

	}
}
