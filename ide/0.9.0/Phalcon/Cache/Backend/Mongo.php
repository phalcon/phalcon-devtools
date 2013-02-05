<?php 

namespace Phalcon\Cache\Backend {

	/**
	 * Phalcon\Cache\Backend\Mongo
	 *
	 * Allows to cache output fragments, PHP data or raw data to a MongoDb backend
	 *
	 *<code>
	 *
	 * // Cache data for 2 days
	 * $frontCache = new Phalcon\Cache\Frontend\Base64(array(
	 *    "lifetime" => 172800
	 * ));
	 *
	 * //Create a MongoDB cache
	 * $cache = new Phalcon\Cache\Backend\Mongo($frontCache, array(
	 *		'server' => "mongodb://localhost",
	 *      'db' => 'caches',
	 *		'collection' => 'images'
	 * ));
	 *
	 * //Cache arbitrary data
	 * $cache->store('my-data', file_get_contents('some-image.jpg'));
	 *
	 * //Get data
	 * $data = $cache->get('my-data');
	 *
	 *</code>
	 */
	
	class Mongo extends \Phalcon\Cache\Backend {

		protected $_collection;

		/**
		 * \Phalcon\Cache\Backend\Mongo constructor
		 *
		 * @param \Phalcon\Cache\FrontendInterface $frontend
		 * @param array $options
		 */
		public function __construct($frontend, $options=null){ }


		/**
		 * Returns a MongoDb collection based on the backend parameters
		 *
		 * @return MongoCollection
		 */
		protected function _getCollection(){ }


		/**
		 * Returns a cached content
		 *
		 * @param int|string $keyName
		 * @param   long $lifetime
		 * @return  mixed
		 */
		public function get($keyName, $lifetime=null){ }


		/**
		 * Stores cached content into the Mongo backend and stops the frontend
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
		 * Checks if cache exists and it hasn't expired
		 *
		 * @param  string $keyName
		 * @param  long $lifetime
		 * @return boolean
		 */
		public function exists($keyName=null, $lifetime=null){ }

	}
}
