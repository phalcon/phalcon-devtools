<?php

namespace Phalcon\Cache\Backend;

use Phalcon\Cache\Backend;
use Phalcon\Cache\Exception;
use Phalcon\Cache\BackendInterface;
use Phalcon\Cache\FrontendInterface;


class Xcache extends Backend implements BackendInterface
{

	/**
	 * Phalcon\Cache\Backend\Xcache constructor
	 * 
	 * @param FrontendInterface $frontend
	 * @param array $options
	 *
	 */
	public function __construct(FrontendInterface $frontend, $options=null) {}

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
	 * Stores cached content into the file backend and stops the frontend
	 * 
	 * @param int|string $keyName
	 * @param string $content
	 * @param $lifetime
	 * @param boolean $stopBuffer
	 *
	 *
	 * @return void
	 */
	public function save($keyName=null, $content=null, $lifetime=null, $stopBuffer=true) {}

	/**
		 * Take the lifetime from the frontend or read it from the set in start()
	 * 
	 * @param mixed $keyName
		 *
	 * @return void
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
		* Get the key from XCache (we cannot use xcache_list() as it is available only to
		* the administrator)
	 * 
	 * @param mixed $keyName
	 * @param $lifetime
		*
	 * @return boolean
	 */
	public function exists($keyName=null, $lifetime=null) {}

	/**
	* Atomic increment of a given key, by number $value
	*
	 * @param mixed $keyName
	 * @param int $value
	 * 
	* @return mixed
	 */
	public function increment($keyName, $value=1) {}

	/**
	 * Atomic decrement of a given key, by number $value
	 *
	 * @param string $keyName
	 * @param int $value
	 * 
	 * @return mixed
	 */
	public function decrement($keyName, $value=1) {}

	/**
	 * Immediately invalidates all existing items.
	 *
	 * @return boolean
	 */
	public function flush() {}

}
