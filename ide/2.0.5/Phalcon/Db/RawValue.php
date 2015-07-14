<?php

namespace Phalcon\Db;

class RawValue
{

	/**
	 * Raw value without quoting or formating
	 *
	 * @var string
	 */
	protected $_value;

	public function getValue() {
		return $this->_value;
	}

	public function __toString() {
		return $this->_value;
	}



	/**
	 * Phalcon\Db\RawValue constructor
	 * 
	 * @param mixed $value
	 */
	public function __construct($value) {}

}
