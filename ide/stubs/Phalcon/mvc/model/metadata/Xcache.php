<?php

namespace Phalcon\Mvc\Model\MetaData;

/**
 * Phalcon\Mvc\Model\MetaData\Xcache
 * Stores model meta-data in the XCache cache. Data will erased if the web server is restarted
 * By default meta-data is stored for 48 hours (172800 seconds)
 * You can query the meta-data by printing xcache_get('$PMM$') or xcache_get('$PMM$my-app-id')
 * <code>
 * $metaData = new Phalcon\Mvc\Model\Metadata\Xcache(array(
 * 'prefix' => 'my-app-id',
 * 'lifetime' => 86400
 * ));
 * </code>
 */
class Xcache extends \Phalcon\Mvc\Model\MetaData
{

    protected $_prefix = "";


    protected $_ttl = 172800;


    protected $_metaData = array();


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
