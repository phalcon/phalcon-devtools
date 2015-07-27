<?php 

namespace Phalcon\Cache\Backend {

	/**
	 * Phalcon\Cache\Backend\Apc
	 *
	 * Allows to cache output fragments, PHP data and raw data using an APC backend
	 *
	 *<code>
	 *	//Cache data for 2 days
	 *	$frontCache = new \Phalcon\Cache\Frontend\Data(array(
	 *		'lifetime' => 172800
	 *	));
	 *
	 *  $cache = new \Phalcon\Cache\Backend\Apc($frontCache, array(
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
	
	class Apc extends \Phalcon\Cache\Backend implements \Phalcon\Cache\BackendInterface {

		/**
		 * Returns a cached content
		 *
		 * @param 	string|long keyName
		 * @param   long lifetime
		 * @return  mixed
		 */
		public function get($keyName, $lifetime=null){ }


		/**
		 * Stores cached content into the APC backend and stops the frontend
		 *
		 * @param string|long keyName
		 * @param string content
		 * @param long lifetime
		 * @param boolean stopBuffer
		 */
		public function save($keyName=null, $content=null, $lifetime=null, $stopBuffer=null){ }


		/**
		 * Increment of a given key, by number $value
		 *
		 * @param  string keyName
		 * @param  long value
		 * @return mixed
		 */
		public function increment($keyName=null, $value=null){ }


		/**
		 * Decrement of a given key, by number $value
		 *
		 * @param  string keyName
		 * @param  long value
		 * @return mixed
		 */
		public function decrement($keyName=null, $value=null){ }


		/**
		 * Deletes a value from the cache by its key
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
		 * Checks if cache exists and it hasn't expired
		 *
		 * @param  string|long keyName
		 * @param  long lifetime
		 * @return boolean
		 */
		public function exists($keyName=null, $lifetime=null){ }


		/**
		 * Immediately invalidates all existing items.
		 */
		public function flush(){ }

	}
}
