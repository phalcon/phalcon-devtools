<?php

namespace Phalcon\Validation\Validator;

/**
 * Phalcon\Validation\Validator\Uniqueness
 * Check that a field is unique in the related table
 * <code>
 * use Phalcon\Validation\Validator\Uniqueness as UniquenessValidator;
 * $validator->add('username', new UniquenessValidator([
 * 'model' => new Users(),
 * 'message' => ':field must be unique'
 * ]));
 * </code>
 * Different attribute from the field:
 * <code>
 * $validator->add('username', new UniquenessValidator([
 * 'model' => new Users(),
 * 'attribute' => 'nick'
 * ]));
 * </code>
 * In model:
 * <code>
 * $validator->add('username', new UniquenessValidator());
 * </code>
 * Combination of fields in model:
 * <code>
 * $validator->add(['firstName', 'lastName'], new UniquenessValidator());
 * </code>
 */
class Uniqueness extends \Phalcon\Validation\Validator
{

    private $columnMap = null;


    /**
     * Executes the validation
     *
     * @param mixed $validation 
     * @param mixed $field 
     * @return bool 
     */
    public function validate(\Phalcon\Validation $validation, $field) {}

    /**
     * @param mixed $validation 
     * @param mixed $field 
     * @return bool 
     */
    protected function isUniqueness(\Phalcon\Validation $validation, $field) {}

    /**
     * The column map is used in the case to get real column name
     *
     * @param mixed $record 
     * @param string $field 
     * @return string 
     */
    protected function getColumnNameReal($record, $field) {}

}
