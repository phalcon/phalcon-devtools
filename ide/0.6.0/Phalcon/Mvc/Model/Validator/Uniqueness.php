<?php 

namespace Phalcon\Mvc\Model\Validator {

	/**
	 * Phalcon\Mvc\Model\Validator\Uniqueness
	 *
	 * Validates that a field or a combination of a set of fields are not
	 * present more than once in the existing records of the related table
	 *
	 *<code>
	 *use Phalcon\Mvc\Model\Validator\Uniqueness as UniquenessValidator;
	 *
	 *class Subscriptors extends Phalcon\Mvc\Model
	 *{
	 *
	 *  public function validation()
	 *  {
	 *      $this->validate(new UniquenessValidator(array(
	 *          'field' => 'email'
	 *      )));
	 *      if ($this->validationHasFailed() == true) {
	 *          return false;
	 *      }
	 *  }
	 *
	 *}
	 *</code>
	 *
	 */
	
	class Uniqueness extends \Phalcon\Mvc\Model\Validator {

		/**
		 * Executes the validator
		 *
		 * @param \Phalcon\Mvc\Model $record
		 * @return boolean
		 */
		public function validate($record){ }

	}
}
