<?php 

namespace Phalcon\Cache\Frontend {

	/**
	 * Phalcon\Cache\Frontend\Output
	 *
	 * Allows to cache output fragments captured with ob_* functions
	 *
	 */
	
	class Output {

		protected $_buffering;

		protected $_frontendOptions;

		/**
		 * \Phalcon\Cache\Frontend\Output constructor
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
