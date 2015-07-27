<?php

namespace Phalcon\Mvc\Model\Validator;

/**
 * Phalcon\Mvc\Model\Validator\InclusionIn
 * Check if a value is included into a list of values
 * <code>
 * use Phalcon\Mvc\Model\Validator\InclusionIn as InclusionInValidator;
 * class Subscriptors extends \Phalcon\Mvc\Model
 * {
 * public function validation()
 * {
 * $this->validate(new InclusionInValidator(array(
 * "field" => 'status',
 * 'domain' => array('A', 'I')
 * )));
 * if ($this->validationHasFailed() == true) {
 * return false;
 * }
 * }
 * }
 * </code>
 */
class Inclusionin extends \Phalcon\Mvc\Model\Validator implements \Phalcon\Mvc\Model\ValidatorInterface
{

    /**
     * Executes validator
     *
     * @param mixed $record 
     * @return bool 
     */
<<<<<<< HEAD
    public function validate(\Phalcon\Mvc\EntityInterface $record) {}


     function zephir_init_properties_Phalcon_Mvc_Model_Validator_Inclusionin() {}
=======
    public function validate(\Phalcon\Mvc\ModelInterface $record) {}
>>>>>>> 5cd73180ea748c3d5e180a24610161d9730cd146

}
