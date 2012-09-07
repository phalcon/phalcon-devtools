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
	 *	//Set the cache directory
	 *	$backendOptions = array(
	 *		'cacheDir' => '../app/cache/'
	 *	);
	 *
	 *	$cache = Phalcon_Cache::factory('Output', 'File', $frontendOptions, $backendOptions);
	 *
	 *	$content = $cache->start('my-cache');
	 *	if($content===null){
	 *  	echo '<h1>', time(), '</h1>';
	 *  	$cache->save();
	 *	} else {
	 *		echo $content;
	 *	}
	 *</code>
	 */
	
	class File extends \Phalcon\Cache\Backend {

		protected $_frontendObject;

		protected $_backendOptions;

		protected $_prefix;

		protected $_lastKey;

		protected $_fresh;

		protected $_started;

		/**
		 * \Phalcon\Backend\Adapter\File constructor
		 *
		 * @param mixed $frontendObject
		 * @param array $backendOptions
		 */
		public function __construct($frontendObject, $backendOptions){ }


		/**
		 * Returns a cached content
		 *
		 * @param int|string $keyName
		 * @param   long $lifetime
		 * @return  mixed
		 */
		public function get($keyName, $lifetime){ }


		/**
		 * Stores cached content into the file backend
		 *
		 * @param int|string $keyName
		 * @param string $content
		 * @param long $lifetime
		 * @param boolean $stopBuffer
		 */
		public function save($keyName, $content, $lifetime, $stopBuffer){ }


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
		public function queryKeys($prefix){ }

	}
}
