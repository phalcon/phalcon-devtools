<?php 

namespace Phalcon\Cache {

	/**
	 * Phalcon\Cache\Backend
	 *
	 * This class implements common functionality for backend adapters. A backend cache adapter may extend this class
	 */
	
	abstract class Backend {

		protected $_frontend;

		protected $_options;

		protected $_prefix;

		protected $_lastKey;

		protected $_lastLifetime;

		protected $_fresh;

		protected $_started;

		/**
		 * \Phalcon\Cache\Backend constructor
		 *
		 * @param \Phalcon\Cache\FrontendInterface $frontend
		 * @param array $options
		 */
		public function __construct($frontend, $options=null){ }


		/**
		 * Starts a cache. The $keyname allows to identify the created fragment
		 *
		 * @param int|string $keyName
		 * @param   long $lifetime
		 * @return  mixed
		 */
		public function start($keyName, $lifetime=null){ }


		/**
		 * Stops the frontend without store any cached content
		 *
		 * @param boolean $stopBuffer
		 */
		public function stop($stopBuffer=null){ }


		/**
		 * Returns front-end instance adapter related to the back-end
		 *
		 * @return mixed
		 */
		public function getFrontend(){ }


		/**
		 * Returns the backend options
		 *
		 * @return array
		 */
		public function getOptions(){ }


		/**
		 * Checks whether the last cache is fresh or cached
		 *
		 * @return boolean
		 */
		public function isFresh(){ }


		/**
		 * Checks whether the cache has starting buffering or not
		 *
		 * @return boolean
		 */
		public function isStarted(){ }


		/**
		 * Sets the last key used in the cache
		 *
		 * @param string $lastKey
		 */
		public function setLastKey($lastKey){ }


		/**
		 * Gets the last key stored by the cache
		 *
		 * @return string
		 */
		public function getLastKey(){ }


		/**
		 * Gets the last lifetime set
		 *
		 * @return int
		 */
		public function getLifetime(){ }

	}
}
