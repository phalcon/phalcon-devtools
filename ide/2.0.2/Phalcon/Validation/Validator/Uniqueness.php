<?php 

namespace Phalcon\Validation\Validator {

	/**
	 * Phalcon\Validation\Validator\Uniqueness
	 *
	 * Check that a field is unique in the related table
	 *
	 *<code>
	 *use Phalcon\Validation\Validator\Uniqueness as UniquenessValidator;
	 *
	 *$validator->add('username', new UniquenessValidator(array(
	 *    'model' => 'Users',
	 *    'message' => ':field must be unique'
	 *)));
	 *</code>
	 * 
	 * Different attribute from the field
	 *<code>
	 *$validator->add('username', new UniquenessValidator(array(
	 *    'model' => 'Users',
	 *    'attribute' => 'nick'
	 *)));
	 *</code>
	 */
	
	class Uniqueness extends \Phalcon\Validation\Validator implements \Phalcon\Validation\ValidatorInterface {

		/**
		 * Executes the validation
		 */
		public function validate(\Phalcon\Validation $validation, $field){ }

	}
}
