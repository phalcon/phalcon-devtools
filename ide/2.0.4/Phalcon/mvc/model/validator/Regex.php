<?php

namespace Phalcon\Mvc\Model\Validator;

/**
 * Phalcon\Mvc\Model\Validator\Regex
 * Allows validate if the value of a field matches a regular expression
 * <code>
 * use Phalcon\Mvc\Model\Validator\Regex as RegexValidator;
 * class Subscriptors extends \Phalcon\Mvc\Model
 * {
 * public function validation()
 * {
 * $this->validate(new RegexValidator(array(
 * "field" => 'created_at',
 * 'pattern' => '/^[0-9]{4}[-\/](0[1-9]|1[12])[-\/](0[1-9]|[12][0-9]|3[01])/'
 * )));
 * if ($this->validationHasFailed() == true) {
 * return false;
 * }
 * }
 * }
 * </code>
 */
class Regex extends \Phalcon\Mvc\Model\Validator implements \Phalcon\Mvc\Model\ValidatorInterface
{

    /**
     * Executes the validator
     *
     * @param mixed $record 
     * @return bool 
     */
<<<<<<< HEAD
    public function validate(\Phalcon\Mvc\EntityInterface $record) {}


     function zephir_init_properties_Phalcon_Mvc_Model_Validator_Regex() {}
=======
    public function validate(\Phalcon\Mvc\ModelInterface $record) {}
>>>>>>> 5cd73180ea748c3d5e180a24610161d9730cd146

}
