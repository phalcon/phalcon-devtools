<?php

namespace Phalcon\Mvc\Model\Resultset;

/**
 * Phalcon\Mvc\Model\Resultset\Complex
 * Complex resultsets may include complete objects and scalar values.
 * This class builds every complex row as it is required
 */
class Complex extends \Phalcon\Mvc\Model\Resultset implements \Phalcon\Mvc\Model\ResultsetInterface
{

    protected $_columnTypes;

    /**
     * Unserialised result-set hydrated all rows already. unserialise() sets _disableHydration to true
     */
    protected $_disableHydration = false;


    /**
     * Phalcon\Mvc\Model\Resultset\Complex constructor
     *
     * @param array $columnTypes 
     * @param \Phalcon\Db\ResultInterface $result 
     * @param \Phalcon\Cache\BackendInterface $cache 
     */
    public function __construct($columnTypes, \Phalcon\Db\ResultInterface $result = null, \Phalcon\Cache\BackendInterface $cache = null) {}

    /**
     * Returns current row in the resultset
     *
     * @return bool|ModelInterface 
     */
    public final function current() {}

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
