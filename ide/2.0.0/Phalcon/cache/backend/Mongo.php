<?php

namespace Phalcon\Cache\Backend;

class Mongo extends \Phalcon\Cache\Backend implements \Phalcon\Cache\BackendInterface
{

    protected $_collection = null;


    /**
     * Phalcon\Cache\Backend\Mongo constructor
     *
     * @param \Phalcon\Cache\FrontendInterface $frontend 
     * @param array $options 
     */
	public function __construct(\Phalcon\Cache\FrontendInterface $frontend, $options = null) {}

    /**
     * Returns a MongoDb collection based on the backend parameters
     *
     * @return MongoCollection 
     */
	protected final function _getCollection() {}

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
     * gc
     *
     * @return collection->remove(...) 
     */
	public function gc() {}

    /**
     * Increment of a given key by $value
     *
     * @param int|string $keyName 
     * @param long $value 
     * @return mixed 
     */
	public function increment($keyName, $value = 1) {}

    /**
     * Decrement of a given key by $value
     *
     * @param mixed $keyName 
     * @param mixed $value 
     * @param int|string $$keyName 
     * @param long $$value 
     * @return mixed 
     */
	public function decrement($keyName, $value = 1) {}

    /**
     * Immediately invalidates all existing items.
     *
     * @return bool 
     */
	public function flush() {}

}
