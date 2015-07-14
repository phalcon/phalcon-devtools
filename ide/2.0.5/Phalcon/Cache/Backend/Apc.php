<?php

namespace Phalcon\Cache\Backend;

use Phalcon\Cache\Exception;
use Phalcon\Cache\Backend;
use Phalcon\Cache\BackendInterface;


class Apc extends Backend implements BackendInterface
{

	/**
	 * Returns a cached content
	 *
	 * @param string $keyName
	 * @param mixed $lifetime
	 * 
	 * @return mixed
	 */
	public function get($keyName, $lifetime=null) {}

	/**
	 * Stores cached content into the APC backend and stops the frontend
	 * 
	 * @param mixed $keyName
	 * @param mixed $content
	 * @param mixed $lifetime
	 * @param boolean $stopBuffer
	 *
	 *
	 * @return void
	 */
	public function save($keyName=null, $content=null, $lifetime=null, $stopBuffer=true) {}

	/**
		 * Take the lifetime from the frontend or read it from the set in start()
	 * 
	 * @param $keyName
	 * @param int $value
		 *
	 * @return mixed
	 */
	public function increment($keyName=null, $value=1) {}

	/**
	 * Decrement of a given key, by number $value
	 *
	 * @param string $keyName
	 * @param int $value
	 * 
	 * @return mixed
	 */
	public function decrement($keyName=null, $value=1) {}

	/**
	 * Deletes a value from the cache by its key
	 * 
	 * @param string $keyName
	 *
	 * @return boolean
	 */
	public function delete($keyName) {}

	/**
	 * Query the existing cached keys
	 *
	 * @param string $prefix
	 * 
	 * @return array
	 */
	public function queryKeys($prefix=null) {}

	/**
	 * Checks if cache exists and it hasn't expired
	 *
	 * @param string $keyName
	 * @param $lifetime
	 * 
	 * @return boolean
	 */
	public function exists($keyName=null, $lifetime=null) {}

	/**
 	 * Immediately invalidates all existing items.
	 *
	 * @return boolean
	 */
	public function flush() {}

}
