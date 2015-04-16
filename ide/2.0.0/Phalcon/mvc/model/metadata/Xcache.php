<?php

namespace Phalcon\Mvc\Model\MetaData;

class Xcache extends \Phalcon\Mvc\Model\MetaData implements \Phalcon\Mvc\Model\MetaDataInterface
{

    protected $_prefix = "";


    protected $_ttl = 172800;


    /**
     * Phalcon\Mvc\Model\MetaData\Xcache constructor
     *
     * @param array $options 
     */
	public function __construct($options = null) {}

    /**
     * Reads metadata from XCache
     *
     * @param string $key 
     * @return array 
     */
	public function read($key) {}

    /**
     * Writes the metadata to XCache
     *
     * @param string $key 
     * @param array $data 
     */
	public function write($key, $data) {}

}
