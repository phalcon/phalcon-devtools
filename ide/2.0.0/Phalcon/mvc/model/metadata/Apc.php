<?php

namespace Phalcon\Mvc\Model\MetaData;

class Apc extends \Phalcon\Mvc\Model\MetaData implements \Phalcon\Mvc\Model\MetaDataInterface
{

    protected $_prefix = "";


    protected $_ttl = 172800;


    /**
     * Phalcon\Mvc\Model\MetaData\Apc constructor
     *
     * @param array $options 
     */
	public function __construct($options = null) {}

    /**
     * Reads meta-data from APC
     *
     * @param string $key 
     * @return array 
     */
	public function read($key) {}

    /**
     * Writes the meta-data to APC
     *
     * @param string $key 
     * @param array $data 
     */
	public function write($key, $data) {}

}
