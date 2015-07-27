<?php 

namespace Phalcon\Validation\Validator {

	/**
	 * Phalcon\Validation\Validator\StringLength
	 *
	 * Validates that a string has the specified maximum and minimum constraints
	 * The test is passed if for a string's length L, min<=L<=max, i.e. L must
	 * be at least min, and at most max.
	 *
	 *<code>
	 *use Phalcon\Validation\Validator\StringLength as StringLength;
	 *
	 *$validation->add('name_last', new StringLength(array(
	 *      'max' => 50,
	 *      'min' => 2,
	 *      'messageMaximum' => 'We don\'t like really long names',
	 *      'messageMinimum' => 'We want more than just their initials'
	 *)));
	 *</code>
	 *
	 */
	
	class StringLength extends \Phalcon\Validation\Validator implements \Phalcon\Validation\ValidatorInterface {

		/**
		 * Executes the validation
		 */
		public function validate(\Phalcon\Validation $validation, $field){ }

	}
}
