<?php

namespace Phalcon\Validation;

use Phalcon\Validation\Exception;
use Phalcon\Validation\ValidatorInterface;


abstract class Validator implements ValidatorInterface
{

	protected $_options;



	/**
	 * Phalcon\Validation\Validator constructor
	 * 
	 * @param mixed $options
	 */
	public function __construct($options=null) {}

	/**
	 * Checks if an option is defined

	 * @deprecated since 2.1.0
	 * @see \Phalcon\Validation\Validator::hasOption()
	 * 
	 * @param string $key
	 *
	 * @return boolean
	 */
	public function isSetOption($key) {}

	/**
	 * Checks if an option is defined
	 * 
	 * @param string $key
	 *
	 * @return boolean
	 */
	public function hasOption($key) {}

	/**
	 * Returns an option in the validator's options
	 * Returns null if the option hasn't set
	 * 
	 * @param string $key
	 * @param mixed $defaultValue
	 *
	 * @return 
	 */
	public function getOption($key, $defaultValue=null) {}

	/**
	 * Sets an option in the validator
	 * 
	 * @param string $key
	 * @param $value
	 *
	 * @return void
	 */
	public function setOption($key, $value) {}

	/**
     * Executes the validation
	 * 
	 * @param \Phalcon\Validation $validation
	 * @param string $attribute
     *
	 * @return boolean
	 */
	abstract public function validate(\Phalcon\Validation $validation, $attribute);

}
