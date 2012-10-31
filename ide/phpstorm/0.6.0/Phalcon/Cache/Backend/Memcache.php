<?php 

namespace Phalcon\Cache\Backend {

	/**
	 * Phalcon\Cache\Backend\Memcache
	 *
	 * Allows to cache output fragments, PHP data or raw data to a memcache backend
	 *
	 * This adapter uses the special memcached key "_PHCM" to store all the keys internally used by the adapter
	 *
	 *<code>
	 *
	 * // Cache data for 2 days
	 * $frontCache = new Phalcon\Cache\Frontend\Data(array(
	 *    "lifetime" => 172800
	 * ));
	 *
	 * //Create the Cache setting memcached connection options
	 * $cache = new Phalcon\Cache\Backend\File($frontCache, array(
	 *		'host' => 'localhost',
	 *		'port' => 11211,
	 *  	'persistent' => false
	 * ));
	 *
	 * //Cache arbitrary data
	 * $cache->store('my-data', array(1, 2, 3, 4, 5));
	 *
	 * //Get data
	 * $data = $cache->get('my-data');
	 *
	 *</code>
	 */
	
	class Memcache extends \Phalcon\Cache\Backend {

		protected $_memcache;

		/**
		 * \Phalcon\Backend\Adapter\Memcache constructor
		 *
		 * @param mixed $frontendObject
		 * @param array $backendOptions
		 */
		public function __construct($frontendObject, $backendOptions=null){ }


		/**
		 * Create internal connection to memcached
		 */
		protected function _connect(){ }


		/**
		 * Returns a cached content
		 *
		 * @param int|string $keyName
		 * @param   long $lifetime
		 * @return  mixed
		 */
		public function get($keyName, $lifetime=null){ }


		/**
		 * Stores cached content into the Memcached backend
		 *
		 * @param int|string $keyName
		 * @param string $content
		 * @param long $lifetime
		 * @param boolean $stopBuffer
		 */
		public function save($keyName=null, $content=null, $lifetime=null, $stopBuffer=null){ }


		/**
		 * Deletes a value from the cache by its key
		 *
		 * @param int|string $keyName
		 * @return boolean
		 */
		public function delete($keyName){ }


		/**
		 * Query the existing cached keys
		 *
		 * @param string $prefix
		 * @return array
		 */
		public function queryKeys($prefix=null){ }


		/**
		 * Checks if cache exists.
		 *
		 * @param string $keyName
		 * @return boolean
		 */
		public function exists($keyName=null){ }


		/**
		 * Destructs the backend closing the memcached connection
		 */
		public function __destruct(){ }

	}
}
