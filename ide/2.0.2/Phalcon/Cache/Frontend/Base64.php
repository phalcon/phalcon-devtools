<?php 

namespace Phalcon\Cache\Frontend {

	/**
	 * Phalcon\Cache\Frontend\Base64
	 *
	 * Allows to cache data converting/deconverting them to base64.
	 *
	 * This adapter uses the base64_encode/base64_decode PHP's functions
	 *
	 *<code>
	 *<?php
	 *
	 * // Cache the files for 2 days using a Base64 frontend
	 * $frontCache = new \Phalcon\Cache\Frontend\Base64(array(
	 *    "lifetime" => 172800
	 * ));
	 *
	 * //Create a MongoDB cache
	 * $cache = new \Phalcon\Cache\Backend\Mongo($frontCache, array(
	 *		'server' => "mongodb://localhost",
	 *      'db' => 'caches',
	 *		'collection' => 'images'
	 * ));
	 *
	 * // Try to get cached image
	 * $cacheKey = 'some-image.jpg.cache';
	 * $image    = $cache->get($cacheKey);
	 * if ($image === null) {
	 *
	 *     // Store the image in the cache
	 *     $cache->save($cacheKey, file_get_contents('tmp-dir/some-image.jpg'));
	 * }
	 *
	 * header('Content-Type: image/jpeg');
	 * echo $image;
	 *</code>
	 */
	
	class Base64 implements \Phalcon\Cache\FrontendInterface {

		protected $_frontendOptions;

		/**
		 * \Phalcon\Cache\Frontend\Base64 constructor
		 *
		 * @param array frontendOptions
		 */
		public function __construct($frontendOptions=null){ }


		/**
		 * Returns the cache lifetime
		 */
		public function getLifetime(){ }


		/**
		 * Check whether if frontend is buffering output
		 */
		public function isBuffering(){ }


		/**
		 * Starts output frontend. Actually, does nothing
		 */
		public function start(){ }


		/**
		 * Returns output cached content
		 *
		 * @return string
		 */
		public function getContent(){ }


		/**
		 * Stops output frontend
		 */
		public function stop(){ }


		/**
		 * Serializes data before storing them
		 *
		 * @param mixed data
		 * @return string
		 */
		public function beforeStore($data){ }


		/**
		 * Unserializes data after retrieval
		 *
		 * @param mixed data
		 * @return mixed
		 */
		public function afterRetrieve($data){ }

	}
}
