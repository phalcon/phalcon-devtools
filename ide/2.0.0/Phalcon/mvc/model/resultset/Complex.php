<?php

namespace Phalcon\Mvc\Model\Resultset;

class Complex extends \Phalcon\Mvc\Model\Resultset implements \Phalcon\Mvc\Model\ResultsetInterface
{

    protected $_columnTypes;


    /**
     * Phalcon\Mvc\Model\Resultset\Complex constructor
     *
     * @param array $columnTypes 
     * @param \Phalcon\Db\ResultInterface $result 
     * @param \Phalcon\Cache\BackendInterface $cache 
     */
	public function __construct($columnTypes, $result, \Phalcon\Cache\BackendInterface $cache = null) {}

    /**
     * Check whether internal resource has rows to fetch
     *
     * @return boolean 
     */
	public function valid() {}

    /**
     * Returns a complete resultset as an array, if the resultset has a big number of rows
     * it could consume more memory than currently it does.
     *
     * @return array 
     */
	public function toArray() {}

    /**
     * Serializing a resultset will dump all related rows into a big array
     *
     * @return string 
     */
	public function serialize() {}

    /**
     * Unserializing a resultset will allow to only works on the rows present in the saved state
     *
     * @param string $data 
     */
	public function unserialize($data) {}

}
