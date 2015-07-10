<?php

namespace Phalcon\Mvc\Model\Validator;

/**
 * Phalcon\Mvc\Model\Validator\Numericality
 * Allows to validate if a field has a valid numeric format
 * <code>
 * use Phalcon\Mvc\Model\Validator\Numericality as NumericalityValidator;
 * class Products extends \Phalcon\Mvc\Model
 * {
 * public function validation()
 * {
 * $this->validate(new NumericalityValidator(array(
 * "field" => 'price'
 * )));
 * if ($this->validationHasFailed() == true) {
 * return false;
 * }
 * }
 * }
 * </code>
 */
class Numericality extends \Phalcon\Mvc\Model\Validator implements \Phalcon\Mvc\Model\ValidatorInterface
{

    /**
     * Executes the validator
     *
     * @param mixed $record 
     * @return bool 
     */
<<<<<<< HEAD
    public function validate(\Phalcon\Mvc\EntityInterface $record) {}


     function zephir_init_properties_Phalcon_Mvc_Model_Validator_Numericality() {}
=======
    public function validate(\Phalcon\Mvc\ModelInterface $record) {}
>>>>>>> 5cd73180ea748c3d5e180a24610161d9730cd146

}
