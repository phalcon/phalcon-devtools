<?php 

namespace Phalcon\Cache {

	/**
	 * Phalcon\Cache\Multiple
	 *
	 * Allows to read to chained backends writing to multiple backends
	 */
	
	class Multiple {

		protected $_backends;

		/**
		 * \Phalcon\Cache\Multiple constructor
		 *
		 * @param \Phalcon\Cache\BackendInterface[] $backends
		 */
		public function __construct($backends=null){ }


		/**
		 * Adds a backend
		 *
		 * @param \Phalcon\Cache\BackendInterface $backend
		 * @return \Phalcon\Cache\Multiple
		 */
		public function push($backend){ }


		/**
		 * Returns a cached content reading the internal backends
		 *
		 * @param 	string $keyName
		 * @param   long $lifetime
		 * @return  mixed
		 */
		public function get($keyName, $lifetime=null){ }


		/**
		 * Starts every backend
		 *
		 * @param int|string $keyName
		 * @param   long $lifetime
		 * @return  mixed
		 */
		public function start($keyName, $lifetime=null){ }


		/**
		 * Stores cached content into the APC backend and stops the frontend
		 *
		 * @param string $keyName
		 * @param string $content
		 * @param long $lifetime
		 * @param boolean $stopBuffer
		 */
		public function save($keyName=null, $content=null, $lifetime=null, $stopBuffer=null){ }


		/**
		 * Deletes a value from each backend
		 *
		 * @param int|string $keyName
		 * @return boolean
		 */
		public function delete($keyName){ }


		/**
		 * Checks if cache exists in at least one backend
		 *
		 * @param  string $keyName
		 * @param  long $lifetime
		 * @return boolean
		 */
		public function exists($keyName=null, $lifetime=null){ }

	}
}
