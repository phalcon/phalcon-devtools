<?php

namespace Phalcon\Cache\Backend;

use Phalcon\Cache\Backend;
use Phalcon\Cache\Exception;
use Phalcon\Cache\BackendInterface;
use Phalcon\Cache\FrontendInterface;


class Mongo extends Backend implements BackendInterface
{

	protected $_collection = null;



	/**
	* Phalcon\Cache\Backend\Mongo constructor
	 * 
	 * @param FrontendInterface $frontend
	 * @param array $options
	*
	*/
	public function __construct(FrontendInterface $frontend, $options=null) {}

	/**
	* Returns a MongoDb collection based on the backend parameters
	*
	* @return mixed
	 */
	protected final function _getCollection() {}

	/**
			 * If mongo is defined a valid Mongo object must be passed
	 * 
	 * @param $keyName
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
	 * Deletes a value from the cache by its key
	 *
	 * @param int|string $keyName
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
	 * Checks if cache exists and it isn't expired
	 *
	 * @param string $keyName
	 * @param $lifetime
	 * 
	 * @return boolean
	 */
	public function exists($keyName=null, $lifetime=null) {}

	/**
	 * gc
	 * @return mixed
	 ->remove(...)
	 */
	public function gc() {}

	/**
	 * Increment of a given key by $value
	 *
	 * @param int|string $keyName
	 * @param $value
	 * 
	 * @return mixed
	 */
	public function increment($keyName, $value=1) {}

	/**
		* The expiration is based on the column 'time'
	 * 
	 * @param $keyName
	 * @param $value
		*
	 * @return mixed
	 */
	public function decrement($keyName, $value=1) {}

	/**
		* The expiration is based on the column 'time'
		*
	 * @return boolean
	 */
	public function flush() {}

}
