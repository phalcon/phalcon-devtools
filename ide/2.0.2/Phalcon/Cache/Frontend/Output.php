<?php 

namespace Phalcon\Cache\Frontend {

	/**
	 * Phalcon\Cache\Frontend\Output
	 *
	 * Allows to cache output fragments captured with ob_* functions
	 *
	 *<code>
	 * <?php
	 *
	 * //Create an Output frontend. Cache the files for 2 days
	 * $frontCache = new \Phalcon\Cache\Frontend\Output(array(
	 *   "lifetime" => 172800
	 * ));
	 *
	 * // Create the component that will cache from the "Output" to a "File" backend
	 * // Set the cache file directory - it's important to keep the "/" at the end of
	 * // the value for the folder
	 * $cache = new \Phalcon\Cache\Backend\File($frontCache, array(
	 *     "cacheDir" => "../app/cache/"
	 * ));
	 *
	 * // Get/Set the cache file to ../app/cache/my-cache.html
	 * $content = $cache->start("my-cache.html");
	 *
	 * // If $content is null then the content will be generated for the cache
	 * if ($content === null) {
	 *
	 *     //Print date and time
	 *     echo date("r");
	 *
	 *     //Generate a link to the sign-up action
	 *     echo Phalcon\Tag::linkTo(
	 *         array(
	 *             "user/signup",
	 *             "Sign Up",
	 *             "class" => "signup-button"
	 *         )
	 *     );
	 *
	 *     // Store the output into the cache file
	 *     $cache->save();
	 *
	 * } else {
	 *
	 *     // Echo the cached output
	 *     echo $content;
	 * }
	 *</code>
	 */
	
	class Output implements \Phalcon\Cache\FrontendInterface {

		protected $_buffering;

		protected $_frontendOptions;

		/**
		 * \Phalcon\Cache\Frontend\Output constructor
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
		 * Starts output frontend. Currently, does nothing
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
