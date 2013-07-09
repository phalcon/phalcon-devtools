<?php 

namespace Phalcon\Cache\Backend {

	/**
	 * Phalcon\Cache\Backend\Xcache
	 *
	 * Allows to cache output fragments, PHP data and raw data using an XCache backend
	 *
	 *<code>
	 *	//Cache data for 2 days
	 *	$frontCache = new Phalcon\Cache\Frontend\Data(array(
	 *		'lifetime' => 172800
	 *	));
	 *
	 *  $cache = new Phalcon\Cache\Backend\Xcache($frontCache, array(
	 *      'prefix' => 'app-data'
	 *  ));
	 *
	 *	//Cache arbitrary data
	 *	$cache->save('my-data', array(1, 2, 3, 4, 5));
	 *
	 *	//Get data
	 *	$data = $cache->get('my-data');
	 *
	 *</code>
	 */
	
	class Xcache extends \Phalcon\Cache\Backend implements \Phalcon\Cache\BackendInterface {

		/**
		 * \Phalcon\Cache\Backend\Xcache constructor
		 *
		 * @param \Phalcon\Cache\FrontendInterface $frontend
		 * @param array $options
		 */
		public function __construct($frontend, $options=null){ }


		/**
		 * Returns cached content
		 *
		 * @param string $keyName
		 * @param long $lifetime
		 * @return mixed
		 */
		public function get($keyName, $lifetime=null){ }


		/**
		 * Stores cached content into the XCache backend and stops the frontend
		 *
		 * @param string $keyName
		 * @param string $content
		 * @param long $lifetime
		 * @param boolean $stopBuffer
		 */
		public function save($keyName=null, $content=null, $lifetime=null, $stopBuffer=null){ }


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
		public function queryKeys($prefix=null){ }


		/**
		 * Checks if the cache entry exists and has not expired
		 *
		 * @param string $keyName
		 * @param long $lifetime
		 * @return boolean
		 */
		public function exists($keyName=null, $lifetime=null){ }

	}
}
