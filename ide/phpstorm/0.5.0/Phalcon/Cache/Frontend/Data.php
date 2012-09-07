<?php 

namespace Phalcon\Cache\Frontend {

	/**
	 * Phalcon\Cache\Frontend\Data
	 *
	 * Allows to cache native PHP data in a serialized form
	 *
	 */
	
	class Data {

		protected $_frontendOptions;

		/**
		 * \Phalcon\Cache\Frontend\Data constructor
		 *
		 * @param array $frontendOptions
		 */
		public function __construct($frontendOptions){ }


		/**
		 * Returns cache lifetime
		 *
		 * @return integer
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
		 * Serializes data before storing it
		 *
		 * @param mixed $data
		 */
		public function beforeStore($data){ }


		/**
		 * Unserializes data after retrieving it
		 *
		 * @param mixed $data
		 */
		public function afterRetrieve($data){ }

	}
}
