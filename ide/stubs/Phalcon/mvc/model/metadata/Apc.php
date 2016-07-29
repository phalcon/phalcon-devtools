<?php

namespace Phalcon\Mvc\Model\MetaData;

/**
 * Phalcon\Mvc\Model\MetaData\Apc
 * Stores model meta-data in the APC cache. Data will erased if the web server is restarted
 * By default meta-data is stored for 48 hours (172800 seconds)
 * You can query the meta-data by printing apc_fetch('$PMM$') or apc_fetch('$PMM$my-app-id')
 * <code>
 * $metaData = new \Phalcon\Mvc\Model\Metadata\Apc(array(
 * 'prefix' => 'my-app-id',
 * 'lifetime' => 86400
 * ));
 * </code>
 */
class Apc extends \Phalcon\Mvc\Model\MetaData
{

    protected $_prefix = "";


    protected $_ttl = 172800;


    protected $_metaData = array();


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
     * @return array|null 
     */
    public function read($key) {}

    /**
     * Writes the meta-data to APC
     *
     * @param string $key 
     * @param mixed $data 
     */
    public function write($key, $data) {}

}
