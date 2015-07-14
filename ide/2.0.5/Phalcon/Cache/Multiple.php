<?php

namespace Phalcon\Cache;

use Phalcon\Cache\Exception;
use Phalcon\Cache\BackendInterface;


class Multiple
{

	protected $_backends;



	/**
	 * Phalcon\Cache\Multiple constructor
	 * 
	 * @param \Phalcon\Cache\BackendInterface[] $backends
	 *
	 */
	public function __construct($backends=null) {}

	/**
	 * Adds a backend
	 * 
	 * @param BackendInterface $backend
	 *
	 * @return Multiple
	 */
	public function push(BackendInterface $backend) {}

	/**
	 * Returns a cached content reading the internal backends
	 *
	 * @param mixed $keyName
	 * @param $lifetime
	 * 
	 * @return mixed
	 */
	public function get($keyName, $lifetime=null) {}

	/**
	 * Starts every backend
	 * 
	 * @param mixed $keyName
	 * @param $lifetime
	 *
	 *
	 * @return void
	 */
	public function start($keyName, $lifetime=null) {}

	/**
	* Stores cached content into all backends and stops the frontend
	 * 
	 * @param mixed $keyName
	 * @param string $content
	 * @param $lifetime
	 * @param boolean $stopBuffer
	*
	*
	 * @return void
	 */
	public function save($keyName=null, $content=null, $lifetime=null, $stopBuffer=null) {}

	/**
	 * Deletes a value from each backend
	 *
	 * @param mixed $keyName
	 * 
	 * @return boolean
	 */
	public function delete($keyName) {}

	/**
	 * Checks if cache exists in at least one backend
	 *
	 * @param mixed $keyName
	 * @param $lifetime
	 * 
	 * @return boolean
	 */
	public function exists($keyName=null, $lifetime=null) {}

}
