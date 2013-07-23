<?php 

namespace Phalcon\Validation\Validator {

	/**
	 * Phalcon\Validation\Validator\Regex
	 *
	 * Allows validate if the value of a field matches a regular expression
	 *
	 *<code>
	 *use Phalcon\Validation\Validator\Regex as RegexValidator;
	 *
	 *$validator->add('created_at', new RegexValidator(array(
	 *   'pattern' => '/^[0-9]{4}[-\/](0[1-9]|1[12])[-\/](0[1-9]|[12][0-9]|3[01])$/',
	 *   'message' => 'The creation date is invalid'
	 *)));
	 *</code>
	 */
	
	class Regex extends \Phalcon\Validation\Validator implements \Phalcon\Validation\ValidatorInterface {

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
