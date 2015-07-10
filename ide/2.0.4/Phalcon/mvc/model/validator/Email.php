<?php

namespace Phalcon\Mvc\Model\Validator;

/**
 * Phalcon\Mvc\Model\Validator\Email
 * Allows to validate if email fields has correct values
 * <code>
 * use Phalcon\Mvc\Model\Validator\Email as EmailValidator;
 * class Subscriptors extends \Phalcon\Mvc\Model
 * {
 * public function validation()
 * {
 * $this->validate(new EmailValidator(array(
 * 'field' => 'electronic_mail'
 * )));
 * if ($this->validationHasFailed() == true) {
 * return false;
 * }
 * }
 * }
 * </code>
 */
class Email extends \Phalcon\Mvc\Model\Validator implements \Phalcon\Mvc\Model\ValidatorInterface
{

    /**
     * Executes the validator
     *
     * @param mixed $record 
     * @return bool 
     */
<<<<<<< HEAD
    public function validate(\Phalcon\Mvc\EntityInterface $record) {}


     function zephir_init_properties_Phalcon_Mvc_Model_Validator_Email() {}
=======
    public function validate(\Phalcon\Mvc\ModelInterface $record) {}
>>>>>>> 5cd73180ea748c3d5e180a24610161d9730cd146

}
