<?php

namespace Phalcon\Mvc\Model\Validator;

/**
 * Phalcon\Mvc\Model\Validator\StringLength
 * Simply validates specified string length constraints
 * <code>
 * use Phalcon\Mvc\Model\Validator\StringLength as StringLengthValidator;
 * class Subscriptors extends \Phalcon\Mvc\Model
 * {
 * public function validation()
 * {
 * $this->validate(new StringLengthValidator(array(
 * "field" => 'name_last',
 * 'max' => 50,
 * 'min' => 2,
 * 'messageMaximum' => 'We don\'t like really long names',
 * 'messageMinimum' => 'We want more than just their initials'
 * )));
 * if ($this->validationHasFailed() == true) {
 * return false;
 * }
 * }
 * }
 * </code>
 */
class StringLength extends \Phalcon\Mvc\Model\Validator implements \Phalcon\Mvc\Model\ValidatorInterface
{

    /**
     * Executes the validator
     *
     * @param mixed $record 
     * @return bool 
     */
    public function validate(\Phalcon\Mvc\EntityInterface $record) {}

}
