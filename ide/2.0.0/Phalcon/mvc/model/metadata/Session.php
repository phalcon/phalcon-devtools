<?php

namespace Phalcon\Mvc\Model\MetaData;

class Session extends \Phalcon\Mvc\Model\MetaData implements \Phalcon\Mvc\Model\MetaDataInterface
{

    protected $_prefix = "";


    /**
     * Phalcon\Mvc\Model\MetaData\Session constructor
     *
     * @param array $options 
     */
	public function __construct($options = null) {}

    /**
     * Reads meta-data from $_SESSION
     *
     * @param string $key 
     * @return array 
     */
	public function read($key) {}

    /**
     * Writes the meta-data to $_SESSION
     *
     * @param string $key 
     * @param array $data 
     */
	public function write($key, $data) {}

}
