<?php

namespace Phalcon\Validation\Validator;

/**
 * Phalcon\Validation\Validator\Digit
 * Check for numeric character(s)
 * <code>
 * use Phalcon\Validation\Validator\Digit as DigitValidator;
 * $validator->add('height', new DigitValidator([
 * 'message' => ':field must be numeric'
 * ]));
 * $validator->add(['height', 'width'], new DigitValidator([
 * 'message' => [
 * 'height' => 'height must be numeric',
 * 'width' => 'width must be numeric'
 * ]
 * ]));
 * </code>
 */
class Digit extends \Phalcon\Validation\Validator
{

    /**
     * Executes the validation
     *
     * @param mixed $validation 
     * @param string $field 
     * @return bool 
     */
    public function validate(\Phalcon\Validation $validation, $field) {}

}
