<?php

namespace Phalcon\Annotations\Adapter;

class Files extends \Phalcon\Annotations\Adapter implements \Phalcon\Annotations\AdapterInterface
{

    protected $_annotationsDir = "./";


    /**
     * Phalcon\Annotations\Adapter\Files constructor
     *
     * @param array $options 
     */
	public function __construct($options = null) {}

    /**
     * Reads parsed annotations from files
     *
     * @param string $key 
     * @return \Phalcon\Annotations\Reflection 
     */
	public function read($key) {}

    /**
     * Writes parsed annotations to files
     *
     * @param string $key 
     * @param \Phalcon\Annotations\Reflection $data 
     */
	public function write($key, \Phalcon\Annotations\Reflection $data) {}

}
