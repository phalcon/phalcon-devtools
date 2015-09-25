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
    public function validate(\Phalcon\Mvc\EntityInterface $record) {}

}
