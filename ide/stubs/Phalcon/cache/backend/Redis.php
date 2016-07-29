<?php

namespace Phalcon\Cache\Backend;

/**
 * Phalcon\Cache\Backend\Redis
 * Allows to cache output fragments, PHP data or raw data to a redis backend
 * This adapter uses the special redis key "_PHCR" to store all the keys internally used by the adapter
 * <code>
 * use Phalcon\Cache\Backend\Redis;
 * use Phalcon\Cache\Frontend\Data as FrontData;
 * // Cache data for 2 days
 * $frontCache = new FrontData([
 * 'lifetime' => 172800
 * ]);
 * // Create the Cache setting redis connection options
 * $cache = new Redis($frontCache, [
 * 'host' => 'localhost',
 * 'port' => 6379,
 * 'auth' => 'foobared',
 * 'persistent' => false
 * 'index' => 0,
 * ]);
 * // Cache arbitrary data
 * $cache->save('my-data', [1, 2, 3, 4, 5]);
 * // Get data
 * $data = $cache->get('my-data');
 * </code>
 */
class Redis extends \Phalcon\Cache\Backend implements \Phalcon\Cache\BackendInterface
{

    protected $_redis = null;


    /**
     * Phalcon\Cache\Backend\Redis constructor
     *
     * @param	Phalcon\Cache\FrontendInterface frontend
     * @param	array options
     * @param mixed $frontend 
     * @param mixed $options 
     */
    public function __construct(\Phalcon\Cache\FrontendInterface $frontend, $options = null) {}

    /**
     * Create internal connection to redis
     */
    public function _connect() {}

    /**
     * Returns a cached content
     *
     * @param string $keyName 
     * @param int $lifetime 
     * @return mixed|null 
     */
    public function get($keyName, $lifetime = null) {}

    /**
     * Stores cached content into the file backend and stops the frontend
     *
     * @param int|string $keyName 
     * @param string $content 
     * @param long $lifetime 
     * @param boolean $stopBuffer 
     * @return bool 
     */
    public function save($keyName = null, $content = null, $lifetime = null, $stopBuffer = true) {}

    /**
     * Deletes a value from the cache by its key
     *
     * @param int|string $keyName 
     * @return bool 
     */
    public function delete($keyName) {}

    /**
     * Query the existing cached keys
     *
     * @param string $prefix 
     * @return array 
     */
    public function queryKeys($prefix = null) {}

    /**
     * Checks if cache exists and it isn't expired
     *
     * @param string $keyName 
     * @param long $lifetime 
     * @return boolean 
     */
    public function exists($keyName = null, $lifetime = null) {}

    /**
     * Increment of given $keyName by $value
     *
     * @param string $keyName 
     * @param long $value 
     * @return int 
     */
    public function increment($keyName = null, $value = null) {}

    /**
     * Decrement of $keyName by given $value
     *
     * @param string $keyName 
     * @param long $value 
     * @return int 
     */
    public function decrement($keyName = null, $value = null) {}

    /**
     * Immediately invalidates all existing items.
     *
     * @return bool 
     */
    public function flush() {}

}
