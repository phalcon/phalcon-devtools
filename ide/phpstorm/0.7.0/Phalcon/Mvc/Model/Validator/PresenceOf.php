<?php 

namespace Phalcon\Mvc\Model\Validator {

	/**
	 * Phalcon\Mvc\Model\Validator\PresenceOf
	 *
	 * Allows to validate if a filed have a value different of null and empty string ("")
	 *
	 *<code>
	 *use Phalcon\Mvc\Model\Validator\PresenceOf;
	 *
	 *class Subscriptors extends Phalcon\Mvc\Model
	 *{
	 *
	 *  public function validation()
	 *  {
	 *      $this->validate(new PresenceOf(array(
	 *          'field' => 'name',
	 *          'message' => 'The name is required'
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
	
	class PresenceOf extends \Phalcon\Mvc\Model\Validator {

		/**
		 * Executes the validator
		 *
		 * @param \Phalcon\Mvc\ModelInterface $record
		 * @return boolean
		 */
		public function validate($record){ }

	}
}
