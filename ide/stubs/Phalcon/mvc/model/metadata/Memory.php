<?php

namespace Phalcon\Mvc\Model\MetaData;

/**
 * Phalcon\Mvc\Model\MetaData\Memory
 * Stores model meta-data in memory. Data will be erased when the request finishes
 */
class Memory extends \Phalcon\Mvc\Model\MetaData
{

    protected $_metaData = array();


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
