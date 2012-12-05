<?php 

namespace Phalcon\Session {

	/**
	 * Phalcon\Session\AdapterInterface initializer
	 */
	
	interface AdapterInterface {

		/**
		 * \Phalcon\Session construtor
		 *
		 * @param array $options
		 */
		public function __construct($options=null);


		/**
		 * Starts session, optionally using an adapter
		 *
		 * @param array $options
		 */
		public function start();


		/**
		 * Sets session options
		 *
		 * @param array $options
		 */
		public function setOptions($options);


		/**
		 * Get internal options
		 *
		 * @return array
		 */
		public function getOptions();


		/**
		 * Gets a session variable from an application context
		 *
		 * @param string $index
		 */
		public function get($index);


		/**
		 * Sets a session variable in an application context
		 *
		 * @param string $index
		 * @param string $value
		 */
		public function set($index, $value);


		/**
		 * Check whether a session variable is set in an application context
		 *
		 * @param string $index
		 */
		public function has($index);


		/**
		 * Removes a session variable from an application context
		 *
		 * @param string $index
		 */
		public function remove($index);


		/**
		 * Returns active session id
		 *
		 * @return string
		 */
		public function getId();


		/**
		 * Check whether the session has been started
		 *
		 * @return boolean
		 */
		public function isStarted();


		/**
		 * Destroys the active session
		 *
		 * @return boolean
		 */
		public function destroy();

	}
}
