<?php 

namespace Phalcon\Validation\Validator {

	/**
	 * Phalcon\Validation\Validator\Url
	 *
	 * Checks if a value has a correct URL format
	 *
	 *<code>
	 *use Phalcon\Validation\Validator\Url as UrlValidator;
	 *
	 *$validator->add('url', new UrlValidator(array(
	 *   'message' => 'The url is not valid'
	 *)));
	 *</code>
	 */
	
	class Url extends \Phalcon\Validation\Validator implements \Phalcon\Validation\ValidatorInterface {

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
