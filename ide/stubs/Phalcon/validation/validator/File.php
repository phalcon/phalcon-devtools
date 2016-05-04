<?php

namespace Phalcon\Validation\Validator;

/**
 * Phalcon\Validation\Validator\File
 * Checks if a value has a correct file
 * <code>
 * use Phalcon\Validation\Validator\File as FileValidator;
 * $validator->add('file', new FileValidator(array(
 * 'maxSize' => '2M',
 * 'messageSize' => ':field exceeds the max filesize (:max)',
 * 'allowedTypes' => array('image/jpeg', 'image/png'),
 * 'messageType' => 'Allowed file types are :types',
 * 'maxResolution' => '800x600',
 * 'messageMaxResolution' => 'Max resolution of :field is :max'
 * )));
 * </code>
 */
class File extends \Phalcon\Validation\Validator
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
