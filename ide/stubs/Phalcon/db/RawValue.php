<?php

namespace Phalcon\Db;

/**
 * Phalcon\Db\RawValue
 *
 * This class allows to insert/update raw data without quoting or formatting.
 *
 * The next example shows how to use the MySQL now() function as a field value.
 *
 * <code>
 * $subscriber = new Subscribers();
 *
 * $subscriber->email     = "andres@phalconphp.com";
 * $subscriber->createdAt = new \Phalcon\Db\RawValue("now()");
 *
 * $subscriber->save();
 * </code>
 */
class RawValue
{
    /**
     * Raw value without quoting or formatting
     *
     * @var string
     */
    protected $_value;


    /**
     * Raw value without quoting or formatting
     *
     * @return string
     */
    public function getValue() {}

    /**
     * Raw value without quoting or formatting
     *
     * @return string
     */
    public function __toString() {}

    /**
     * Phalcon\Db\RawValue constructor
     *
     * @param mixed $value
     */
    public function __construct($value) {}

}
