<?php 

namespace Phalcon\Cache\Backend {

	/**
	 * Phalcon\Cache\Backend\File
	 *
	 * Allows to cache output fragments using a file backend
	 *
	 *<code>
	 *	//Cache the file for 2 days
	 *	$frontendOptions = array(
	 *		'lifetime' => 172800
	 *	);
	 *
	 *  //Create a output cache
	 *  $frontCache = \Phalcon\Cache\Frontend\Output($frontOptions);
	 *
	 *	//Set the cache directory
	 *	$backendOptions = array(
	 *		'cacheDir' => '../app/cache/'
	 *	);
	 *
	 *  //Create the File backend
	 *  $cache = new \Phalcon\Cache\Backend\File($frontCache, $backendOptions);
	 *
	 *	$content = $cache->start('my-cache');
	 *	if ($content === null) {
	 *  	echo '<h1>', time(), '</h1>';
	 *  	$cache->save();
	 *	} else {
	 *		echo $content;
	 *	}
	 *</code>
	 */
	
	class File extends \Phalcon\Cache\Backend implements \Phalcon\Cache\BackendInterface {

		private $_useSafeKey;

		/**
		 * \Phalcon\Cache\Backend\File constructor
		 *
		 * @param	Phalcon\Cache\FrontendInterface frontend
		 * @param	array options
		 */
		public function __construct(\Phalcon\Cache\FrontendInterface $frontend, $options=null){ }


		/**
		 * Returns a cached content
		 *
		 * @param int|string keyName
		 * @param   int lifetime
		 * @return  mixed
		 */
		public function get($keyName, $lifetime=null){ }


		/**
		 * Stores cached content into the file backend and stops the frontend
		 *
		 * @param int|string keyName
		 * @param string content
		 * @param int lifetime
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
		 * @param string|int prefix
		 * @return array
		 */
		public function queryKeys($prefix=null){ }


		/**
		 * Checks if cache exists and it isn't expired
		 *
		 * @param string|int keyName
		 * @param   int lifetime
		 * @return boolean
		 */
		public function exists($keyName=null, $lifetime=null){ }


		/**
		 * Increment of a given key, by number $value
		 *
		 * @param  string|int keyName
		 * @param  int value
		 * @return mixed
		 */
		public function increment($keyName=null, $value=null){ }


		/**
		 * Decrement of a given key, by number $value
		 *
		 * @param  string|int keyName
		 * @param  int value
		 * @return mixed
		 */
		public function decrement($keyName=null, $value=null){ }


		/**
		 * Immediately invalidates all existing items.
		 */
		public function flush(){ }


		/**
		 * Return a file-system safe identifier for a given key
		 */
		public function getKey($key){ }


		/**
		 * Set whether to use the safekey or not
		 *
		 * @return this
		 */
		public function useSafeKey($useSafeKey){ }

	}
}
