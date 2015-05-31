<?php 

namespace Phalcon\Cache\Backend {

	/**
	 * Phalcon\Cache\Backend\Xcache
	 *
	 * Allows to cache output fragments, PHP data and raw data using an XCache backend
	 *
	 *<code>
	 *	//Cache data for 2 days
	 *	$frontCache = new \Phalcon\Cache\Frontend\Data(array(
	 *		'lifetime' => 172800
	 *	));
	 *
	 *  $cache = new \Phalcon\Cache\Backend\Xcache($frontCache, array(
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
		 * @param \Phalcon\Cache\FrontendInterface frontend
		 * @param array options
		 */
		public function __construct(\Phalcon\Cache\FrontendInterface $frontend, $options=null){ }


		/**
		 * Returns a cached content
		 *
		 * @param int|string keyName
		 * @param   long lifetime
		 * @return  mixed
		 */
		public function get($keyName, $lifetime=null){ }


		/**
		 * Stores cached content into the file backend and stops the frontend
		 *
		 * @param int|string keyName
		 * @param string content
		 * @param long lifetime
		 * @param boolean stopBuffer
		 */
		public function save($keyName=null, $content=null, $lifetime=null, $stopBuffer=null){ }


		/**
		 * Deletes a value from the cache by its key
		 *
		 * @param int|string keyName
		 * @return boolean
		 */
		public function delete($keyName){ }


		/**
		 * Query the existing cached keys
		 *
		 * @param string prefix
		 * @return array
		 */
		public function queryKeys($prefix=null){ }


		/**
		 * Checks if cache exists and it isn't expired
		 *
		 * @param string keyName
		 * @param   long lifetime
		 * @return boolean
		 */
		public function exists($keyName=null, $lifetime=null){ }


		/**
		 * Atomic increment of a given key, by number $value
		 *
		 * @param  string keyName
		 * @param  long value
		 * @return mixed
		 */
		public function increment($keyName, $value=null){ }


		/**
		 * Atomic decrement of a given key, by number $value
		 *
		 * @param  string keyName
		 * @param  long value
		 * @return mixed
		 */
		public function decrement($keyName, $value=null){ }


		/**
		 * Immediately invalidates all existing items.
		 */
		public function flush(){ }

	}
}
