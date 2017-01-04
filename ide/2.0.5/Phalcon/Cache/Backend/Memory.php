<?php

namespace Phalcon\Cache\Backend;

use Phalcon\Cache\Backend;
use Phalcon\Cache\BackendInterface;
use Phalcon\Cache\Exception;


class Memory extends Backend implements BackendInterface, \Serializable
{

	protected $_data;



	/**
	 * Returns a cached content
	 *
	 * @param mixed $keyName
	 * @param $lifetime
	 * 
	 * @return mixed
	 */
	public function get($keyName, $lifetime=null) {}

	/**
	 * Stores cached content into the backend and stops the frontend
	 * 
	 * @param mixed $keyName
	 * @param mixed $content
	 * @param $lifetime
	 * @param boolean $stopBuffer
	 *
	 *
	 * @return void
	 */
	public function save($keyName=null, $content=null, $lifetime=null, $stopBuffer=true) {}

	/**
	 * Deletes a value from the cache by its key
	 *
	 * @param mixed $keyName
	 * 
	 * @return boolean
	 */
	public function delete($keyName) {}

	/**
	 * Query the existing cached keys
	 *
	 * @param mixed $prefix
	 * 
	 * @return array
	 */
	public function queryKeys($prefix=null) {}

	/**
	 * Checks if cache exists and it hasn't expired
	 *
	 * @param mixed $keyName
	 * @param $lifetime
	 * 
	 * @return boolean
	 */
	public function exists($keyName=null, $lifetime=null) {}

	/**
	 * Increment of given $keyName by $value
	 *
	 * @param string $keyName
	 * @param $value
	 * @param $lifetime
	 * 
	 * @return mixed
	 */
	public function increment($keyName=null, $value=null) {}

	/**
	 * Decrement of $keyName by given $value
	 *
	 * @param string $keyName
	 * @param $value
	 * 
	 * @return mixed
	 */
	public function decrement($keyName=null, $value=null) {}

	/**
	 * Immediately invalidates all existing items.
	 *
	 * @return boolean
	 */
	public function flush() {}

	/**
	 * Required for interface \Serializable
	 *
	 * @return string
	 */
	public function serialize() {}

	/**
	 * Required for interface \Serializable
	 * 
	 * @param mixed $data
	 *
	 * @return void
	 */
	public function unserialize($data) {}

}
