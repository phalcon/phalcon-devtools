<?php

namespace Phalcon\Validation\Validator;

/**
 * Phalcon\Validation\Validator\CreditCard
 * Checks if a value has a valid credit card number
 * <code>
 * use Phalcon\Validation\Validator\CreditCard as CreditCardValidator;
 * $validator->add('creditcard', new CreditCardValidator([
 * 'message' => 'The credit card number is not valid'
 * ]));
 * $validator->add(['creditcard', 'secondCreditCard'], new CreditCardValidator([
 * 'message' => [
 * 'creditcard' => 'The credit card number is not valid',
 * 'secondCreditCard' => 'The second credit card number is not valid'
 * ]
 * ]));
 * </code>
 */
class CreditCard extends \Phalcon\Validation\Validator
{

    /**
     * Executes the validation
     *
     * @param mixed $validation 
     * @param string $field 
     * @return bool 
     */
    public function validate(\Phalcon\Validation $validation, $field) {}

    /**
     * is a simple checksum formula used to validate a variety of identification numbers
     *
     * @param string $number 
     * @return boolean 
     */
    private function verifyByLuhnAlgorithm($number) {}

}
