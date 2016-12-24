<?php

namespace Phalcon\Annotations\Adapter;

/**
 * Phalcon\Annotations\Adapter\Memory
 *
 * Stores the parsed annotations in memory. This adapter is the suitable development/testing
 */
class Memory extends \Phalcon\Annotations\Adapter
{
    /**
     * Data
     *
     * @var mixed
     */
    protected $_data;


    /**
     * Reads parsed annotations from memory
     *
     * @param string $key
     * @return bool|\Phalcon\Annotations\Reflection
     */
    public function read($key) {}

    /**
     * Writes parsed annotations to memory
     *
     * @param string $key
     * @param \Phalcon\Annotations\Reflection $data
     */
    public function write($key, \Phalcon\Annotations\Reflection $data) {}

}
