<?php

namespace Phalcon\Mvc\Model\MetaData;

class Memory extends \Phalcon\Mvc\Model\MetaData implements \Phalcon\Mvc\Model\MetaDataInterface
{

    /**
     * Phalcon\Mvc\Model\MetaData\Memory constructor
     *
     * @param array $options 
     */
	public function __construct($options = null) {}

    /**
     * Reads the meta-data from temporal memory
     *
     * @param string $key 
     * @return array 
     */
	public function read($key) {}

    /**
     * Writes the meta-data to temporal memory
     *
     * @param string $key 
     * @param array $data 
     */
	public function write($key, $data) {}

}
