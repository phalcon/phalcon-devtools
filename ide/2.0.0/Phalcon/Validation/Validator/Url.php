<?php 

namespace Phalcon\Validation\Validator {

	/**
	 * Phalcon\Validation\Validator\Url
	 *
	 * Checks if a value has a url format
	 *
	 *<code>
	 *use Phalcon\Validation\Validator\Url as UrlValidator;
	 *
	 *$validator->add('url', new UrlValidator(array(
	 *   'message' => ':field must be a url'
	 *)));
	 *</code>
	 */
	
	class Url extends \Phalcon\Validation\Validator implements \Phalcon\Validation\ValidatorInterface {

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
