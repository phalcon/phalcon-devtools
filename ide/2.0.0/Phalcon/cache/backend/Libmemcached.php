<?php

namespace Phalcon\Cache\Backend;

class Libmemcached extends \Phalcon\Cache\Backend implements \Phalcon\Cache\BackendInterface
{

    protected $_memcache = null;


    /**
     * Phalcon\Cache\Backend\Memcache constructor
     *
     * @param	Phalcon\Cache\FrontendInterface frontend
     * @param	array options
     * @param mixed $frontend 
     * @param mixed $options 
     */
	public function __construct(\Phalcon\Cache\FrontendInterface $frontend, $options = null) {}

    /**
     * Create internal connection to memcached
     */
	public function _connect() {}

    /**
     * Returns a cached content
     *
     * @param int|string $keyName 
     * @param long $lifetime 
     * @return mixed 
     */
	public function get($keyName, $lifetime = null) {}

    /**
     * Stores cached content into the file backend and stops the frontend
     *
     * @param int|string $keyName 
     * @param string $content 
     * @param long $lifetime 
     * @param boolean $stopBuffer 
     */
	public function save($keyName = null, $content = null, $lifetime = null, $stopBuffer = true) {}

    /**
     * Deletes a value from the cache by its key
     *
     * @param int|string $keyName 
     * @return boolean 
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
     * @param mixed $value 
     * @param long $lifetime 
     * @return long 
     */
	public function increment($keyName = null, $value = null) {}

    /**
     * Decrement of $keyName by given $value
     *
     * @param string $keyName 
     * @param long $value 
     * @return long 
     */
	public function decrement($keyName = null, $value = null) {}

    /**
     * Immediately invalidates all existing items.
     *
     * @return boolean 
     */
	public function flush() {}

}
