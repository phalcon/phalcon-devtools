<?php

namespace Phalcon\Mvc\Model\MetaData;

use Phalcon\Mvc\Model\MetaData;
use Phalcon\Mvc\Model\MetaDataInterface;
use Phalcon\Cache\Frontend\Data as FrontendData;
use Phalcon\Mvc\Model\Exception;


class Libmemcached extends MetaData implements MetaDataInterface
{

	protected $_ttl = 172800;

	protected $_memcache = null;



	/**
	 * Phalcon\Mvc\Model\MetaData\Libmemcached constructor
	 * 
	 * @param array $options
	 *
	 */
	public function __construct($options=null) {}

	/**
	 * Reads metadata from Memcache
	 * 
	 * @param string $key
	 *
	 * @return array|null
	 */
	public function read($key) {}

	/**
	 * Writes the metadata to Memcache
	 * 
	 * @param string $key
	 * @param mixed $data
	 *
	 * @return void
	 */
	public function write($key, $data) {}

	/**
	 * Flush Memcache data and resets internal meta-data in order to regenerate it
	 *
	 * @return void
	 */
	public function reset() {}

}
