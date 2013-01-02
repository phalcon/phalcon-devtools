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
	
	class Email extends \Phalcon\Mvc\Model\Validator {

		protected $_options;

		protected $_messages;

		/**
		 * Executes the validator
		 *
		 * @return boolean
		 */
		public function validate($record){ }

	}
}
