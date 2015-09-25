<?php

namespace Phalcon\Mvc\Model\MetaData;

/**
 * Phalcon\Mvc\Model\MetaData\Redis
 * Stores model meta-data in the Redis.
 * By default meta-data is stored for 48 hours (172800 seconds)
 * <code>
 * $metaData = new Phalcon\Mvc\Model\Metadata\Redis(array(
 * 'prefix' => 'my-app-id',
 * 'lifetime' => 86400,
 * 'host' => 'localhost',
 * 'port' => 6379,
 * 'persistent' => false
 * ));
 * </code>
 */
class Redis extends \Phalcon\Mvc\Model\MetaData implements \Phalcon\Mvc\Model\MetaDataInterface
{

    protected $_ttl = 172800;


    protected $_redis = null;


    /**
     * Phalcon\Mvc\Model\MetaData\Redis constructor
     *
     * @param array $options 
     */
    public function __construct($options = null) {}

    /**
     * Reads metadata from Redis
     *
     * @param string $key 
     * @return array|null 
     */
    public function read($key) {}

    /**
     * Writes the metadata to Redis
     *
     * @param string $key 
     * @param mixed $data 
     */
    public function write($key, $data) {}

    /**
     * Flush Redis data and resets internal meta-data in order to regenerate it
     */
    public function reset() {}

}
