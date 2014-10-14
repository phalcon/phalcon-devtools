<?php 

namespace Phalcon\Mvc\Model\Validator {

	/**
	 * Phalcon\Mvc\Model\Validator\Url
	 *
	 * Allows to validate if a field has a url format
	 *
	 *<code>
	 *use Phalcon\Mvc\Model\Validator\Url as UrlValidator;
	 *
	 *class Posts extends Phalcon\Mvc\Model
	 *{
	 *
	 *  public function validation()
	 *  {
	 *      $this->validate(new UrlValidator(array(
	 *          'field' => 'source_url'
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
	
	class Url extends \Phalcon\Mvc\Model\Validator implements \Phalcon\Mvc\Model\ValidatorInterface {

		/**
		 * Executes the validator
		 *
		 * @param \Phalcon\Mvc\ModelInterface $record
		 * @return boolean
		 */
		public function validate($record){ }

	}
}
