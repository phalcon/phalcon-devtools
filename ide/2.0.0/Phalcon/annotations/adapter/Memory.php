<?php

namespace Phalcon\Annotations\Adapter;

class Memory extends \Phalcon\Annotations\Adapter implements \Phalcon\Annotations\AdapterInterface
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
     * @return \Phalcon\Annotations\Reflection 
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
