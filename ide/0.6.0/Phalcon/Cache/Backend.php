<?php 

namespace Phalcon\Cache {

	/**
	 * Phalcon\Cache\Backend
	 *
	 * This class implements common functionality for backend adapters. All the backend cache adapter must
	 * extend this class
	 */
	
	abstract class Backend {

		protected $_frontendObject;

		protected $_backendOptions;

		protected $_prefix;

		protected $_lastKey;

		protected $_fresh;

		protected $_started;

		/**
		 * \Phalcon\Cache\Backend constructor
		 *
		 * @param mixed $frontendObject
		 * @param array $backendOptions
		 */
		public function __construct($frontendObject, $backendOptions=null){ }


		/**
		 * Starts a cache. The $keyname allow to identify the created fragment
		 *
		 * @param int|string $keyName
		 * @return  mixed
		 */
		public function start($keyName){ }


		/**
		 * Returns front-end instance adapter related to the back-end
		 *
		 * @return mixed
		 */
		public function getFrontend(){ }


		/**
		 * Checks whether the last cache is fresh or cached
		 *
		 * @return boolean
		 */
		public function isFresh(){ }


		/**
		 * Checks whether the cache has started buffering or not
		 *
		 * @return boolean
		 */
		public function isStarted(){ }


		/**
		 * Gets the last key stored by the cache
		 *
		 * @return string
		 */
		public function getLastKey(){ }


		abstract public function get(){ }

	}
}
