<?php

namespace Phalcon\Db;

/**
 * Phalcon\Db\RawValue
 * This class allows to insert/update raw data without quoting or formating.
 * The next example shows how to use the MySQL now() function as a field value.
 * <code>
 * $subscriber = new Subscribers();
 * $subscriber->email = 'andres@phalconphp.com';
 * $subscriber->createdAt = new \Phalcon\Db\RawValue('now()');
 * $subscriber->save();
 * </code>
 */
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
