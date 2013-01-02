<?php 

namespace Phalcon\Cache\Backend {

	/**
	 * Phalcon\Cache\Backend\Apc
	 *
	 * Allows to cache output fragments, PHP data and raw data using a memcache backend
	 *
	 *<code>
	 *
	 *	//Cache data for 2 days
	 *	$frontendOptions = array(
	 *		'lifetime' => 172800
	 *	);
	 *
	 *	//Cache data for 2 days
	 *	$frontCache = new Phalcon\Cache\Frontend\Data(array(
	 *		'lifetime' => 172800
	 *	));
	 *
	 *  $cache = new Phalcon\Cache\Backend\Apc($frontCache);
	 *
	 *	//Cache arbitrary data
	 *	$cache->store('my-data', array(1, 2, 3, 4, 5));
	 *
	 *	//Get data
	 *	$data = $cache->get('my-data');
	 *
	 *</code>
	 */
	
	class Apc extends \Phalcon\Cache\Backend {

		protected $_frontendObject;

		protected $_backendOptions;

		protected $_prefix;

		protected $_lastKey;

		protected $_fresh;

		protected $_started;

		/**
		 * Returns a cached content
		 *
		 * @param 	string $keyName
		 * @param   long $lifetime
		 * @return  mixed
		 */
		public function get($keyName, $lifetime){ }


		/**
		 * Stores cached content into the file backend
		 *
		 * @param string $keyName
		 * @param string $content
		 * @param long $lifetime
		 * @param boolean $stopBuffer
		 */
		public function save($keyName, $content, $lifetime, $stopBuffer){ }


		/**
		 * Deletes a value from the cache by its key
		 *
		 * @param string $keyName
		 * @return boolean
		 */
		public function delete($keyName){ }


		/**
		 * Query the existing cached keys
		 *
		 * @param string $prefix
		 * @return array
		 */
		public function queryKeys($prefix){ }

	}
}
