<?php

namespace Phalcon\Session\Adapter;

/**
 * Phalcon\Session\Adapter\Redis
 * This adapter store sessions in Redis
 * <code>
 * $session = new \Phalcon\Session\Adapter\Redis(array(
 * 'uniqueId' => 'my-private-app',
 * 'host' => 'localhost',
 * 'port' => 6379,
 * 'auth' => 'foobared',
 * 'persistent' => false,
 * 'lifetime' => 3600,
 * 'prefix' => 'my_'
 * ));
 * $session->start();
 * $session->set('var', 'some-value');
 * echo $session->get('var');
 * </code>
 */
class Redis extends \Phalcon\Session\Adapter implements \Phalcon\Session\AdapterInterface
{

    protected $_redis = null;


    protected $_lifetime = 8600;



    public function getRedis() {}


    public function getLifetime() {}

    /**
     * Phalcon\Session\Adapter\Redis constructor
     *
     * @param array $options 
     */
    public function __construct($options = array()) {}


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
     * @param string $sessionId 
     * @return boolean 
     */
    public function destroy($sessionId = null) {}

    /**
     * {@inheritdoc}
     */
    public function gc() {}

}
