<?php

namespace Phalcon\Validation;

/**
 * Phalcon\Validation\ValidatorInterface
 * Interface for Phalcon\Validation\Validator
 */
interface ValidatorInterface
{

    /**
     * Checks if an option is defined
     *
     * @param string $key 
     * @return bool 
     */
    public function hasOption($key);

    /**
     * Returns an option in the validator's options
     * Returns null if the option hasn't set
     *
     * @param string $key 
     * @param mixed $defaultValue 
     * @return mixed 
     */
    public function getOption($key, $defaultValue = null);

    /**
     * Executes the validation
     *
     * @param mixed $validation 
     * @param string $attribute 
     * @return bool 
     */
    public function validate(\Phalcon\Validation $validation, $attribute);

}
