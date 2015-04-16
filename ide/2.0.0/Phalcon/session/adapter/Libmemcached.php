<?php

namespace Phalcon\Session\Adapter;

class Libmemcached extends \Phalcon\Session\Adapter implements \Phalcon\Session\AdapterInterface
{

    protected $_libmemcached = null;


    protected $_lifetime = 8600;



	public function getLibmemcached() {}


	public function getLifetime() {}

    /**
     * Phalcon\Session\Adapter\Libmemcached constructor
     *
     * @param array $options 
     */
	public function __construct($options = null) {}

    /**
     * @return bool 
     */
	public function open() {}

    /**
     * @return bool 
     */
	public function close() {}

    /**
     * {@inheritdoc}
     *
     * @param string $sessionId 
     * @return mixed 
     */
	public function read($sessionId) {}

    /**
     * {@inheritdoc}
     *
     * @param string $sessionId 
     * @param string $data 
     */
	public function write($sessionId, $data) {}

    /**
     * {@inheritdoc}
     *
     * @param mixed $session_id 
     * @param string $sessionId 
     * @return boolean 
     */
	public function destroy($session_id = null) {}

    /**
     * {@inheritdoc}
     *
     * @return bool 
     */
	public function gc() {}

}
