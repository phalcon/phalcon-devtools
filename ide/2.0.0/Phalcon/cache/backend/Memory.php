<?php

namespace Phalcon\Cache\Backend;

class Memory extends \Phalcon\Cache\Backend implements \Phalcon\Cache\BackendInterface
{

    protected $_data;


    /**
     * Returns a cached content
     *
     * @param mixed $keyName 
     * @param long $lifetime 
     * @param  $string keyName
     * @return mixed 
     */
	public function get($keyName, $lifetime = null) {}

    /**
     * Stores cached content into the backend and stops the frontend
     *
     * @param string $keyName 
     * @param string $content 
     * @param long $lifetime 
     * @param boolean $stopBuffer 
     */
	public function save($keyName = null, $content = null, $lifetime = null, $stopBuffer = true) {}

    /**
     * Deletes a value from the cache by its key
     *
     * @param string $keyName 
     * @return boolean 
     */
	public function delete($keyName) {}

    /**
     * Query the existing cached keys
     *
     * @param string|int $prefix 
     * @return array 
     */
	public function queryKeys($prefix = null) {}

    /**
     * Checks if cache exists and it hasn't expired
     *
     * @param string|int $keyName 
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
