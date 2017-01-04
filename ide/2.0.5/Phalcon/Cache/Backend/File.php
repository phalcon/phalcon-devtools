<?php

namespace Phalcon\Cache\Backend;

use Phalcon\Cache\Exception;
use Phalcon\Cache\Backend;
use Phalcon\Cache\FrontendInterface;
use Phalcon\Cache\BackendInterface;


class File extends Backend implements BackendInterface
{

	/**
	 * Default to false for backwards compatibility
	 *
	 * @var boolean
	 */
	private $_useSafeKey = false;



	/**
	 * Phalcon\Cache\Backend\File constructor
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
	 * @param int $lifetime
	 * 
	 * @return mixed
	 */
	public function get($keyName, $lifetime=null) {}

	/**
			 * Take the lifetime from the frontend or read it from the set in start()
	 * 
	 * @param mixed $keyName
	 * @param mixed $content
	 * @param $lifetime
	 * @param boolean $stopBuffer
			 *
	 * @return void
	 */
	public function save($keyName=null, $content=null, $lifetime=null, $stopBuffer=true) {}

	/**
		 * We use file_put_contents to respect open-base-dir directive
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
		 * We use a directory iterator to traverse the cache dir directory
	 * 
	 * @param mixed $keyName
	 * @param int $lifetime
		 *
	 * @return boolean
	 */
	public function exists($keyName=null, $lifetime=null) {}

	/**
				 * Check if the file has expired
	 * 
	 * @param mixed $keyName
	 * @param int $value
				 *
	 * @return mixed
	 */
	public function increment($keyName=null, $value=1) {}

	/**
			 * Check if the file has expired
	 * 
	 * @param mixed $keyName
	 * @param int $value
			 *
	 * @return mixed
	 */
	public function decrement($keyName=null, $value=1) {}

	/**
			 * Check if the file has expired
			 *
	 * @return boolean
	 */
	public function flush() {}

	/**
	 * Return a file-system safe identifier for a given key
	 * 
	 * @param $key
	 *
	 * @return string
	 */
	public function getKey($key) {}

	/**
	 * Set whether to use the safekey or not
	 *
	 * @param bool $useSafeKey
	 * 
	 * @return mixed
	 */
	public function useSafeKey($useSafeKey) {}

}
