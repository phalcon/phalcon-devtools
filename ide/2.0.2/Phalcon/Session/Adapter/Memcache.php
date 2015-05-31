<?php 

namespace Phalcon\Session\Adapter {

	/**
	 * Phalcon\Session\Adapter\Memcache
	 *
	 * This adapter store sessions in memcache
	 *
	 *<code>
	 * $session = new \Phalcon\Session\Adapter\Memcache(array(
	 *    'uniqueId' => 'my-private-app'
	 *    'host' => '127.0.0.1',
	 *    'port' => 11211,
	 *    'persistent' => TRUE,
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
	
	class Memcache extends \Phalcon\Session\Adapter implements \Phalcon\Session\AdapterInterface {

		const SESSION_ACTIVE = 2;

		const SESSION_NONE = 1;

		const SESSION_DISABLED = 0;

		protected $_memcache;

		protected $_lifetime;

		public function getMemcache(){ }


		public function getLifetime(){ }


		/**
		 * \Phalcon\Session\Adapter\Memcache constructor
		 *
		 * @param array options
		 */
		public function __construct($options=null){ }


		public function open(){ }


		public function close(){ }


		/**
		 * {@inheritdoc}
		 *
		 * @param string sessionId
		 * @return mixed
		 */
		public function read($sessionId){ }


		/**
		 * {@inheritdoc}
		 *
		 * @param string sessionId
		 * @param string data
		 */
		public function write($sessionId, $data){ }


		/**
		 * {@inheritdoc}
		 *
		 * @param  string  sessionId
		 * @return boolean
		 */
		public function destroy($session_id=null){ }


		/**
		 * {@inheritdoc}
		 */
		public function gc(){ }

	}
}
