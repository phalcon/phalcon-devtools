<?php 

namespace Phalcon\Cache {

	/**
	 * Phalcon\Cache\BackendInterface initializer
	 */
	
	interface BackendInterface {

		/**
		 * Starts a cache. The $keyname allows to identify the created fragment
		 *
		 * @param int|string $keyName
		 * @param   long $lifetime
		 * @return  mixed
		 */
		public function start($keyName, $lifetime=null);


		/**
		 * Stops the frontend without store any cached content
		 *
		 * @param boolean $stopBuffer
		 */
		public function stop($stopBuffer=null);


		/**
		 * Returns front-end instance adapter related to the back-end
		 *
		 * @return mixed
		 */
		public function getFrontend();


		/**
		 * Returns the backend options
		 *
		 * @return array
		 */
		public function getOptions();


		/**
		 * Checks whether the last cache is fresh or cached
		 *
		 * @return boolean
		 */
		public function isFresh();


		/**
		 * Checks whether the cache has starting buffering or not
		 *
		 * @return boolean
		 */
		public function isStarted();


		/**
		 * Sets the last key used in the cache
		 *
		 * @param string $lastKey
		 */
		public function setLastKey($lastKey);


		/**
		 * Gets the last key stored by the cache
		 *
		 * @return string
		 */
		public function getLastKey();


		/**
		 * Returns a cached content
		 *
		 * @param int|string $keyName
		 * @param   long $lifetime
		 * @return  mixed
		 */
		public function get($keyName, $lifetime=null);


		/**
		 * Stores cached content into the file backend and stops the frontend
		 *
		 * @param int|string $keyName
		 * @param string $content
		 * @param long $lifetime
		 * @param boolean $stopBuffer
		 */
		public function save($keyName=null, $content=null, $lifetime=null, $stopBuffer=null);


		/**
		 * Deletes a value from the cache by its key
		 *
		 * @param int|string $keyName
		 * @return boolean
		 */
		public function delete($keyName);


		/**
		 * Query the existing cached keys
		 *
		 * @param string $prefix
		 * @return array
		 */
		public function queryKeys($prefix=null);


		/**
		 * Checks if cache exists and it hasn't expired
		 *
		 * @param  string $keyName
		 * @param  long $lifetime
		 * @return boolean
		 */
		public function exists($keyName=null, $lifetime=null);


		/**
		 * Immediately invalidates all existing items.
		 * 
		 * @return boolean
		 */
		public function flush();

	}
}
