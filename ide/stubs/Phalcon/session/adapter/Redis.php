<?php

namespace Phalcon\Session\Adapter;

/**
 * Phalcon\Session\Adapter\Redis
 *
 * This adapter store sessions in Redis
 *
 * <code>
 * use Phalcon\Session\Adapter\Redis;
 *
 * $session = new Redis(
 *     [
 *         "uniqueId"   => "my-private-app",
 *         "host"       => "localhost",
 *         "port"       => 6379,
 *         "auth"       => "foobared",
 *         "persistent" => false,
 *         "lifetime"   => 3600,
 *         "prefix"     => "my",
 *         "index"      => 1,
 *     ]
 * );
 *
 * $session->start();
 *
 * $session->set("var", "some-value");
 *
 * echo $session->get("var");
 * </code>
 */
class Redis extends \Phalcon\Session\Adapter
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
    public function __construct(array $options = array()) {}

    /**
     * {@inheritdoc}
     *
     * @return bool
     */
    public function open() {}

    /**
     * {@inheritdoc}
     *
     * @return bool
     */
    public function close() {}

    /**
     * {@inheritdoc}
     *
     * @param mixed $sessionId
     * @return string
     */
    public function read($sessionId) {}

    /**
     * {@inheritdoc}
     *
     * @param string $sessionId
     * @param string $data
     * @return bool
     */
    public function write($sessionId, $data) {}

    /**
     * {@inheritdoc}
     *
     * @param string $sessionId
     * @return bool
     */
    public function destroy($sessionId = null) {}

    /**
     * {@inheritdoc}
     *
     * @return bool
     */
    public function gc() {}

}
