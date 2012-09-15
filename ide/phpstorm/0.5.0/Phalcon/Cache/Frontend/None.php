<?php 

namespace Phalcon\Cache\Frontend {

	/**
	 * Phalcon\Cache\Frontend\None
	 *
	 * Discards any kind of frontend data input. This frontend does not have expiration time or any other options
	 *
	 */
	
	class None {

		/**
		 * \Phalcon\Cache\Frontend\None constructor
		 */
		public function __construct($frontendOptions){ }


		/**
		 * Returns cache lifetime, always one second expiring content
		 */
		public function getLifetime(){ }


		/**
		 * Check whether if frontend is buffering output, always false
		 */
		public function isBuffering(){ }


		/**
		 * Starts output frontend
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
		 * Prepare data to be stored
		 *
		 * @param mixed $data
		 */
		public function beforeStore($data){ }


		/**
		 * Prepares data to be retrieved to user
		 *
		 * @param mixed $data
		 */
		public function afterRetrieve($data){ }

	}
}
