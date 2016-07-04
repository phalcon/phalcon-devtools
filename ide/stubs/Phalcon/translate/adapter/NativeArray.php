<?php

namespace Phalcon\Translate\Adapter;

/**
 * Phalcon\Translate\Adapter\NativeArray
 * Allows to define translation lists using PHP arrays
 */
class NativeArray extends \Phalcon\Translate\Adapter implements \Phalcon\Translate\AdapterInterface, \ArrayAccess
{

    protected $_translate;


    /**
     * Phalcon\Translate\Adapter\NativeArray constructor
     *
     * @param array $options 
     */
    public function __construct(array $options) {}

    /**
     * Returns the translation related to the given key
     *
     * @param string $index 
     * @param mixed $placeholders 
     * @return string 
     */
    public function query($index, $placeholders = null) {}

    /**
     * Check whether is defined a translation key in the internal array
     *
     * @param string $index 
     * @return bool 
     */
    public function exists($index) {}

}
