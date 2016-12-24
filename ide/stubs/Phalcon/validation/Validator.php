<?php

namespace Phalcon\Validation;

/**
 * Phalcon\Validation\Validator
 *
 * This is a base class for validators
 */
abstract class Validator implements \Phalcon\Validation\ValidatorInterface
{

    protected $_options;


    /**
     * Phalcon\Validation\Validator constructor
     *
     * @param array $options
     */
    public function __construct(array $options = null) {}

    /**
     * Checks if an option has been defined
     *
     * @deprecated since 2.1.0
     * @see \Phalcon\Validation\Validator::hasOption()
     * @param string $key
     * @deprecated
     * @return bool
     */
    public function isSetOption($key) {}

    /**
     * Checks if an option is defined
     *
     * @param string $key
     * @return bool
     */
    public function hasOption($key) {}

    /**
     * Returns an option in the validator's options
     * Returns null if the option hasn't set
     *
     * @param string $key
     * @param mixed $defaultValue
     * @return mixed
     */
    public function getOption($key, $defaultValue = null) {}

    /**
     * Sets an option in the validator
     *
     * @param string $key
     * @param mixed $value
     */
    public function setOption($key, $value) {}

    /**
     * Executes the validation
     *
     * @param \Phalcon\Validation $validation
     * @param string $attribute
     * @return bool
     */
    abstract public function validate(\Phalcon\Validation $validation, $attribute);

}
