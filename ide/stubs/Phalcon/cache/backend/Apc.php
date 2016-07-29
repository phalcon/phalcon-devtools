<?php

namespace Phalcon\Cache\Backend;

/**
 * Phalcon\Cache\Backend\Apc
 * Allows to cache output fragments, PHP data and raw data using an APC backend
 * <code>
 * use Phalcon\Cache\Backend\Apc;
 * use Phalcon\Cache\Frontend\Data as FrontData;
 * // Cache data for 2 days
 * $frontCache = new FrontData([
 * 'lifetime' => 172800
 * ]);
 * $cache = new Apc($frontCache, [
 * 'prefix' => 'app-data'
 * ]);
 * // Cache arbitrary data
 * $cache->save('my-data', [1, 2, 3, 4, 5]);
 * // Get data
 * $data = $cache->get('my-data');
 * </code>
 */
class Apc extends \Phalcon\Cache\Backend implements \Phalcon\Cache\BackendInterface
{

    /**
     * Returns a cached content
     *
     * @param string $keyName 
     * @param int $lifetime 
     * @return mixed|null 
     */
    public function get($keyName, $lifetime = null) {}

    /**
     * Stores cached content into the APC backend and stops the frontend
     *
     * @param string|long $keyName 
     * @param string $content 
     * @param long $lifetime 
     * @param boolean $stopBuffer 
     * @return bool 
     */
    public function save($keyName = null, $content = null, $lifetime = null, $stopBuffer = true) {}

    /**
     * Increment of a given key, by number $value
     *
     * @param string $keyName 
     * @param long $value 
     * @return mixed 
     */
    public function increment($keyName = null, $value = 1) {}

    /**
     * Decrement of a given key, by number $value
     *
     * @param string $keyName 
     * @param long $value 
     * @return mixed 
     */
    public function decrement($keyName = null, $value = 1) {}

    /**
     * Deletes a value from the cache by its key
     *
     * @param string $keyName 
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
     * Checks if cache exists and it hasn't expired
     *
     * @param string|long $keyName 
     * @param long $lifetime 
     * @return boolean 
     */
    public function exists($keyName = null, $lifetime = null) {}

    /**
     * Immediately invalidates all existing items.
     *
     * @return bool 
     */
    public function flush() {}

}
