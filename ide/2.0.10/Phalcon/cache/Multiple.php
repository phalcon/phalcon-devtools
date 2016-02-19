<?php

namespace Phalcon\Cache;

/**
 * Phalcon\Cache\Multiple
 * Allows to read to chained backend adapters writing to multiple backends
 * <code>
 * use Phalcon\Cache\Frontend\Data as DataFrontend,
 * Phalcon\Cache\Multiple,
 * Phalcon\Cache\Backend\Apc as ApcCache,
 * Phalcon\Cache\Backend\Memcache as MemcacheCache,
 * Phalcon\Cache\Backend\File as FileCache;
 * $ultraFastFrontend = new DataFrontend(array(
 * "lifetime" => 3600
 * ));
 * $fastFrontend = new DataFrontend(array(
 * "lifetime" => 86400
 * ));
 * $slowFrontend = new DataFrontend(array(
 * "lifetime" => 604800
 * ));
 * //Backends are registered from the fastest to the slower
 * $cache = new Multiple(array(
 * new ApcCache($ultraFastFrontend, array(
 * "prefix" => 'cache',
 * )),
 * new MemcacheCache($fastFrontend, array(
 * "prefix" => 'cache',
 * "host" => "localhost",
 * "port" => "11211"
 * )),
 * new FileCache($slowFrontend, array(
 * "prefix" => 'cache',
 * "cacheDir" => "../app/cache/"
 * ))
 * ));
 * //Save, saves in every backend
 * $cache->save('my-key', $data);
 * </code>
 */
class Multiple
{

    protected $_backends;


    /**
     * Phalcon\Cache\Multiple constructor
     *
     * @param	Phalcon\Cache\BackendInterface[] backends
     * @param mixed $backends 
     */
    public function __construct($backends = null) {}

    /**
     * Adds a backend
     *
     * @param mixed $backend 
     * @return Multiple 
     */
    public function push(\Phalcon\Cache\BackendInterface $backend) {}

    /**
     * Returns a cached content reading the internal backends
     *
     * @param mixed $keyName 
     * @param long $lifetime 
     * @param  $string|int keyName
     * @return mixed 
     */
    public function get($keyName, $lifetime = null) {}

    /**
     * Starts every backend
     *
     * @param string|int $keyName 
     * @param long $lifetime 
     */
    public function start($keyName, $lifetime = null) {}

    /**
     * Stores cached content into all backends and stops the frontend
     *
     * @param string $keyName 
     * @param string $content 
     * @param long $lifetime 
     * @param boolean $stopBuffer 
     */
    public function save($keyName = null, $content = null, $lifetime = null, $stopBuffer = null) {}

    /**
     * Deletes a value from each backend
     *
     * @param string|int $keyName 
     * @return boolean 
     */
    public function delete($keyName) {}

    /**
     * Checks if cache exists in at least one backend
     *
     * @param string|int $keyName 
     * @param long $lifetime 
     * @return boolean 
     */
    public function exists($keyName = null, $lifetime = null) {}

    /**
     * Flush all backend(s)
     *
     * @return bool 
     */
    public function flush() {}

}
