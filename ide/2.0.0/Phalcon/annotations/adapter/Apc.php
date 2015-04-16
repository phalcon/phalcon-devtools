<?php

namespace Phalcon\Annotations\Adapter;

class Apc extends \Phalcon\Annotations\Adapter implements \Phalcon\Annotations\AdapterInterface
{

    protected $_prefix = "";


    protected $_ttl = 172800;


    /**
     * Phalcon\Annotations\Adapter\Apc constructor
     *
     * @param array $options 
     */
	public function __construct($options = null) {}

    /**
     * Reads parsed annotations from APC
     *
     * @param string $key 
     * @return \Phalcon\Annotations\Reflection 
     */
	public function read($key) {}

    /**
     * Writes parsed annotations to APC
     *
     * @param string $key 
     * @param \Phalcon\Annotations\Reflection $data 
     */
	public function write($key, \Phalcon\Annotations\Reflection $data) {}

}
