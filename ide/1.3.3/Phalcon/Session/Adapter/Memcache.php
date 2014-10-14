<?php 

namespace Phalcon\Session\Adapter {

	/**
	 * Phalcon\Session\Adapter\Memcache
	 *
	 * This adapter store sessions in memcache
	 *
	 *<code>
	 * $session = new Phalcon\Session\Adapter\Memcache(array(
	 *    'host' => '127.0.0.1',
	 *    'port' => 11211,
	 *    'lifetime' => 3600,
	 *    'persistent' => TRUE,
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
	
	class Memcache extends \Phalcon\Session\Adapter implements \ArrayAccess, \Traversable, \IteratorAggregate, \Countable, \Phalcon\Session\AdapterInterface {

		protected $_lifetime;

		protected $_memcache;

		/**
		 * Constructor for \Phalcon\Session\Adapter\Memcache
		 *
		 * @param array $options
		 */
		public function __construct($options){ }


		/**
		 *
		 * @return boolean
		 */
		public function open(){ }


		/**
		 *
		 * @return boolean
		 */
		public function close(){ }


		/**
		 *
		 * @param string $sessionId
		 * @return mixed
		 */
		public function read($sessionId){ }


		/**
		 *
		 * @param string $sessionId
		 * @param string $data
		 * @return boolean
		 */
		public function write($sessionId, $data){ }


		/**
		 *
		 * @param string $session_id optional, session id
		 *
		 * @return boolean
		 */
		public function destroy($sessionId=null){ }


		/**
		 *
		 * @return boolean
		 */
		public function gc(){ }

	}
}
