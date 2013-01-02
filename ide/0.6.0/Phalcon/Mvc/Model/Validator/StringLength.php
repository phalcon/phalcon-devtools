<?php 

namespace Phalcon\Mvc\Model\Validator {

	/**
	 * Phalcon\Mvc\Model\Validator\StringLength
	 *
	 * Simply validates specified string length constraints
	 *
	 *<code>
	 *use Phalcon\Mvc\Model\Validator\StringLength as StringLengthValidator;
	 *
	 *class Subscriptors extends Phalcon\Mvc\Model
	 *{
	 *
	 *	public function validation()
	 *	{
	 *		$this->validate(new StringLengthValidator(array(
	 *			'field' => 'name_last',
	 *			'max' => 50, //we don't like really long names
	 *			'min' => 2, //we want more than just their initials
	 *		)));
	 *		if ($this->validationHasFailed() == true) {
	 *			return false;
	 *		}
	 *	}
	 *
	 *}
	 *</code>
	 *
	 */
	
	class StringLength extends \Phalcon\Mvc\Model\Validator {

		/**
		 * Executes the validator
		 *
		 * @return boolean
		 */
		public function validate($record){ }

	}
}
