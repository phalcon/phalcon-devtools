<?php

namespace Phalcon\Mvc\Model\MetaData;

/**
 * Phalcon\Mvc\Model\MetaData\Libmemcached
 *
 * Stores model meta-data in the Memcache.
 *
 * By default meta-data is stored for 48 hours (172800 seconds)
 *
 * <code>
 * $metaData = new Phalcon\Mvc\Model\Metadata\Libmemcached(
 *     [
 *         "servers" => [
 *             [
 *                 "host"   => "localhost",
 *                 "port"   => 11211,
 *                 "weight" => 1,
 *             ],
 *         ],
 *         "client" => [
 *             Memcached::OPT_HASH       => Memcached::HASH_MD5,
 *             Memcached::OPT_PREFIX_KEY => "prefix.",
 *         ],
 *         "lifetime" => 3600,
 *         "prefix"   => "my_",
 *     ]
 * );
 * </code>
 */
class Libmemcached extends \Phalcon\Mvc\Model\MetaData
{

    protected $_ttl = 172800;


    protected $_memcache = null;


    protected $_metaData = array();


    /**
     * Phalcon\Mvc\Model\MetaData\Libmemcached constructor
     *
     * @param array $options
     */
    public function __construct($options = null) {}

    /**
     * Reads metadata from Memcache
     *
     * @param string $key
     * @return array|null
     */
    public function read($key) {}

    /**
     * Writes the metadata to Memcache
     *
     * @param string $key
     * @param mixed $data
     */
    public function write($key, $data) {}

    /**
     * Flush Memcache data and resets internal meta-data in order to regenerate it
     */
    public function reset() {}

}
