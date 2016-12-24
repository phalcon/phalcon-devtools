<?php

namespace Phalcon\Mvc\Model\MetaData;

/**
 * Phalcon\Mvc\Model\MetaData\Redis
 *
 * Stores model meta-data in the Redis.
 *
 * By default meta-data is stored for 48 hours (172800 seconds)
 *
 * <code>
 * use Phalcon\Mvc\Model\Metadata\Redis;
 *
 * $metaData = new Redis(
 *     [
 *         "host"       => "127.0.0.1",
 *         "port"       => 6379,
 *         "persistent" => 0,
 *         "statsKey"   => "_PHCM_MM",
 *         "lifetime"   => 172800,
 *         "index"      => 2,
 *     ]
 * );
 * </code>
 */
class Redis extends \Phalcon\Mvc\Model\MetaData
{

    protected $_ttl = 172800;


    protected $_redis = null;


    protected $_metaData = array();


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
