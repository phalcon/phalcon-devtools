<?php

namespace Phalcon\Session\Adapter;

use Phalcon\Session\Adapter;
use Phalcon\Session\AdapterInterface;
use Phalcon\Cache\Frontend\Data as FrontendData;


class Memcache extends Adapter implements AdapterInterface
{

	protected $_memcache = null;

	public function getMemcache() {
		return $this->_memcache;
	}

	protected $_lifetime = 8600;

	public function getLifetime() {
		return $this->_lifetime;
	}



	/**
	 * Phalcon\Session\Adapter\Memcache constructor
	 * 
	 * @param array $options
	 */
	public function __construct(array $options=[]) {}

	/**
	 *
	 * @return mixed
	 */
	public function open() {}

	/**
	 *
	 * @return mixed
	 */
	public function close() {}

	/**
	 * {@inheritdoc}
	 *
	 * @param string $sessionId
	 * 
	 * @return mixed
	 */
	public function read($sessionId) {}

	/**
	 * {@inheritdoc}
	 * 
	 * @param string $sessionId
	 * @param string $data
	 *
	 *
	 * @return void
	 */
	public function write($sessionId, $data) {}

	/**
	 * {@inheritdoc}
	 *
	 * @param string $sessionId
	 * 
	 * @return boolean
	 */
	public function destroy($sessionId=null) {}

	/**
	 * {@inheritdoc}
	 *
	 * @return mixed
	 */
	public function gc() {}

}
