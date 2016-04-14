<?php

namespace Phalcon\Mvc\Model\Validator;

/**
 * Phalcon\Mvc\Model\Validator\Uniqueness
 * Validates that a field or a combination of a set of fields are not
 * present more than once in the existing records of the related table
 * <code>
 * use Phalcon\Mvc\Model;
 * use Phalcon\Mvc\Model\Validator\Uniqueness;
 * class Subscriptors extends Model
 * {
 * public function validation()
 * {
 * $this->validate(new Uniqueness(array(
 * "field"   => "email",
 * "message" => "Value of field 'email' is already present in another record"
 * )));
 * if ($this->validationHasFailed() == true) {
 * return false;
 * }
 * }
 * }
 * </code>
 */
class Uniqueness extends \Phalcon\Mvc\Model\Validator implements \Phalcon\Mvc\Model\ValidatorInterface
{

    /**
     * Executes the validator
     *
     * @param mixed $record 
     * @return bool 
     */
    public function validate(\Phalcon\Mvc\EntityInterface $record) {}

}
