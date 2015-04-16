<?php

namespace Phalcon\Validation;

class Validator
{

    protected $_options;


    /**
     * Phalcon\Validation\Validator constructor
     *
     * @param mixed $options 
     */
	public function __construct($options = null) {}

    /**
     * Checks if an option is defined
     *
     * @param string $key 
     * @return boolean 
     */
	public function isSetOption($key) {}

    /**
     * Returns an option in the validator's options
     * Returns null if the option hasn't set
     *
     * @param string $key 
     * @return mixed 
     */
	public function getOption($key) {}

    /**
     * Sets an option in the validator
     *
     * @param string $key 
     * @param mixed $value 
     */
	public function setOption($key, $value) {}

}
