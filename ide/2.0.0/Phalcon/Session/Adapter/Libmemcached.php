<?php 

namespace Phalcon\Session\Adapter {

    /**
     * Phalcon\Session\Adapter\Libmemcached
     *
     * This adapter store sessions in libmemcached
     *
     *<code>
     * $session = new Phalcon\Session\Adapter\Libmemcached(array(
     *     'servers' => array(
     *         array('host' => 'localhost', 'port' => 11211, 'weight' => 1),
     *     ),
     *     'client' => array(
     *         Memcached::OPT_HASH => Memcached::HASH_MD5,
     *         Memcached::OPT_PREFIX_KEY => 'prefix.',
     *     ),
     *    'lifetime' => 3600,
     *    'prefix' => 'my_'
     * ));
     *
     * $session->start();
     *
     * $session->set('var', 'some-value');
     *
     * echo $session->get('var');
     *</code>
     */
    class Libmemcached extends \Phalcon\Session\Adapter implements \ArrayAccess, \Traversable, \IteratorAggregate, \Countable, \Phalcon\Session\AdapterInterface
    {

        protected $_lifetime;

        protected $_libmemcached;

        /**
         * \Phalcon\Session\Adapter\Libmemcached constructor
         *
         * @param array options
         */
        public function __construct($options)
        {
        }


        public function open()
        {
        }


        public function close()
        {
        }


        /**
         * {@inheritdoc}
         *
         * @param string sessionId
         * @return mixed
         */
        public function read($sessionId)
        {
        }


        /**
         * {@inheritdoc}
         *
         * @param string sessionId
         * @param string data
         */
        public function write($sessionId, $data)
        {
        }


        /**
         * {@inheritdoc}
         *
         * @param  string  sessionId
         * @return boolean
         */
        public function destroy($sessionId=null)
        {
        }


        /**
         * {@inheritdoc}
         */
        public function gc()
        {
        }

    }
}
