<?php

namespace Phalcon\Session\Adapter;

use Phalcon\Session\Adapter;
use Phalcon\Session\Exception;
use Phalcon\Session\AdapterInterface;
use Phalcon\Cache\Frontend\Data as FrontendData;


class Libmemcached extends Adapter implements AdapterInterface
{

	protected $_libmemcached = NULL;

	public function getLibmemcached() {
		return $this->_libmemcached;
	}

	protected $_lifetime = 8600;

	public function getLifetime() {
		return $this->_lifetime;
	}



	/**
	 * Phalcon\Session\Adapter\Libmemcached constructor
	 * 
	 * @param array $options
	 */
	public function __construct(array $options) {}

	/**
	 *
	 * @return boolean
	 */
	public function open() {}

	/**
	 *
	 * @return boolean
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
	 * @return mixed
	 */
	public function destroy($sessionId=null) {}

	/**
	 * {@inheritdoc}
	 *
	 * @return boolean
	 */
	public function gc() {}

}
