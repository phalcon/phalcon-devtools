<?php

namespace Phalcon\Validation\Validator;

/**
 * Phalcon\Validation\Validator\Email
 * Checks if a value has a correct e-mail format
 * <code>
 * use Phalcon\Validation\Validator\Email as EmailValidator;
 * $validator->add('email', new EmailValidator([
 * 'message' => 'The e-mail is not valid'
 * ]));
 * $validator->add(['email', 'anotherEmail'], new EmailValidator([
 * 'message' => [
 * 'email' => 'The e-mail is not valid',
 * 'anotherEmail' => 'The another e-mail is not valid'
 * ]
 * ]));
 * </code>
 */
class Email extends \Phalcon\Validation\Validator
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
