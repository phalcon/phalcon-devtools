<?php

namespace Phalcon\Session\Adapter;

class Memcache extends \Phalcon\Session\Adapter implements \Phalcon\Session\AdapterInterface
{

    protected $_memcache = null;


    protected $_lifetime = 8600;



	public function getMemcache() {}


	public function getLifetime() {}

    /**
     * Phalcon\Session\Adapter\Memcache constructor
     *
     * @param array $options 
     */
	public function __construct($options = null) {}


	public function open() {}


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
     */
	public function gc() {}

}
