<?php

namespace Phalcon\Validation\Validator;

/**
 * Phalcon\Validation\Validator\ExclusionIn
 * Check if a value is not included into a list of values
 * <code>
 * use Phalcon\Validation\Validator\ExclusionIn;
 * $validator->add('status', new ExclusionIn([
 * 'message' => 'The status must not be A or B',
 * 'domain' => ['A', 'B']
 * ]));
 * $validator->add(['status', 'type'], new ExclusionIn([
 * 'message' => [
 * 'status' => 'The status must not be A or B',
 * 'type' => 'The type must not be 1 or 2'
 * ],
 * 'domain' => [
 * 'status' => ['A', 'B'],
 * 'type' => [1, 2]
 * ]
 * ]));
 * </code>
 */
class ExclusionIn extends \Phalcon\Validation\Validator
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
