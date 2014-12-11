<?php 

namespace Phalcon\Mvc\Model\Validator {

	/**
	 * Phalcon\Mvc\Model\Validator\Email
	 *
	 * Allows to validate if email fields has correct values
	 *
	 *<code>
	 *	use Phalcon\Mvc\Model\Validator\Email as EmailValidator;
	 *
	 *	class Subscriptors extends Phalcon\Mvc\Model
	 *	{
	 *
	 *		public function validation()
	 *		{
	 *			$this->validate(new EmailValidator(array(
	 *				'field' => 'electronic_mail'
	 *      	)));
	 *      	if ($this->validationHasFailed() == true) {
	 *				return false;
	 *      	}
	 *  	}
	 *
	 *	}
	 *</code>
	 *
	 */
	
	class Email extends \Phalcon\Mvc\Model\Validator implements \Phalcon\Mvc\Model\ValidatorInterface {

		/**
		 * Executes the validator
		 *
		 * @param \Phalcon\Mvc\ModelInterface $record
		 * @return boolean
		 */
		public function validate($record){ }

	}
}
