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


    /**
     * Raw value without quoting or formating
     *
     * @return string 
     */
	public function getValue() {}

    /**
     * Raw value without quoting or formating
     */
	public function __toString() {}

    /**
     * Phalcon\Db\RawValue constructor
     *
     * @param string $value 
     */
	public function __construct($value) {}

}
