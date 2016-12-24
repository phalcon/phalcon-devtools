<?php

namespace Phalcon\Cache\Backend;

/**
 * Phalcon\Cache\Backend\Apc
 *
 * Allows to cache output fragments, PHP data and raw data using an APC backend
 *
 * <code>
 * use Phalcon\Cache\Backend\Apc;
 * use Phalcon\Cache\Frontend\Data as FrontData;
 *
 * // Cache data for 2 days
 * $frontCache = new FrontData(
 *     [
 *         "lifetime" => 172800,
 *     ]
 * );
 *
 * $cache = new Apc(
 *     $frontCache,
 *     [
 *         "prefix" => "app-data",
 *     ]
 * );
 *
 * // Cache arbitrary data
 * $cache->save("my-data", [1, 2, 3, 4, 5]);
 *
 * // Get data
 * $data = $cache->get("my-data");
 * </code>
 */
class Apc extends \Phalcon\Cache\Backend
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
     * @param string|int $keyName
     * @param string $content
     * @param int $lifetime
     * @param boolean $stopBuffer
     * @return bool
     */
    public function save($keyName = null, $content = null, $lifetime = null, $stopBuffer = true) {}

    /**
     * Increment of a given key, by number $value
     *
     * @param string $keyName
     * @param int $value
     * @return int|bool
     */
    public function increment($keyName = null, $value = 1) {}

    /**
     * Decrement of a given key, by number $value
     *
     * @param string $keyName
     * @param int $value
     * @return int|bool
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
     * Query the existing cached keys.
     *
     * <code>
     * $cache->save("users-ids", [1, 2, 3]);
     * $cache->save("projects-ids", [4, 5, 6]);
     *
     * var_dump($cache->queryKeys("users")); // ["users-ids"]
     * </code>
     *
     * @param string $prefix
     * @return array
     */
    public function queryKeys($prefix = null) {}

    /**
     * Checks if cache exists and it hasn't expired
     *
     * @param string|int $keyName
     * @param int $lifetime
     * @return bool
     */
    public function exists($keyName = null, $lifetime = null) {}

    /**
     * Immediately invalidates all existing items.
     *
     * <code>
     * use Phalcon\Cache\Backend\Apc;
     *
     * $cache = new Apc($frontCache, ["prefix" => "app-data"]);
     *
     * $cache->save("my-data", [1, 2, 3, 4, 5]);
     *
     * // 'my-data' and all other used keys are deleted
     * $cache->flush();
     * </code>
     *
     * @return bool
     */
    public function flush() {}

}
