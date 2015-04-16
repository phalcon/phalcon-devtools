<?php

namespace Phalcon\Validation;

interface ValidatorInterface
{

    /**
     * Checks if an option is defined
     *
     * @param string $key 
     * @return mixed 
     */
	public function isSetOption($key);

    /**
     * Returns an option in the validator's options
     * Returns null if the option hasn't been set
     *
     * @param string $key 
     * @return mixed 
     */
	public function getOption($key);

    /**
     * Executes the validation
     *
     * @param mixed $validation 
     * @param string $attribute 
     * @param \Phalcon\Validation $validator 
     * @return boolean 
     */
	public function validate(\Phalcon\Validation $validation, $attribute);

}
