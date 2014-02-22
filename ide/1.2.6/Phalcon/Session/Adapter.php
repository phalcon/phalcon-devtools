<?php 

namespace Phalcon\Session {

	/**
	 * Phalcon\Session\Adapter
	 *
	 * Base class for Phalcon\Session adapters
	 */
	
	abstract class Adapter {

		protected $_uniqueId;

		protected $_started;

		protected $_options;

		/**
		 * \Phalcon\Session\Adapter constructor
		 *
		 * @param array $options
		 */
		public function __construct($options=null){ }


		public function __destruct(){ }


		/**
		 * Starts the session (if headers are already sent the session will not be started)
		 *
		 * @return boolean
		 */
		public function start(){ }


		/**
		 * Sets session's options
		 *
		 *<code>
		 *	$session->setOptions(array(
		 *		'uniqueId' => 'my-private-app'
		 *	));
		 *</code>
		 *
		 * @param array $options
		 */
		public function setOptions($options){ }


		/**
		 * Get internal options
		 *
		 * @return array
		 */
		public function getOptions(){ }


		/**
		 * Gets a session variable from an application context
		 *
		 * @param string $index
		 * @param mixed $defaultValue
		 * @return mixed
		 */
		public function get($index, $defaultValue=null){ }


		/**
		 * Sets a session variable in an application context
		 *
		 *<code>
		 *	$session->set('auth', 'yes');
		 *</code>
		 *
		 * @param string $index
		 * @param string $value
		 */
		public function set($index, $value){ }


		/**
		 * Check whether a session variable is set in an application context
		 *
		 *<code>
		 *	var_dump($session->has('auth'));
		 *</code>
		 *
		 * @param string $index
		 * @return boolean
		 */
		public function has($index){ }


		/**
		 * Removes a session variable from an application context
		 *
		 *<code>
		 *	$session->remove('auth');
		 *</code>
		 *
		 * @param string $index
		 */
		public function remove($index){ }


		/**
		 * Returns active session id
		 *
		 *<code>
		 *	echo $session->getId();
		 *</code>
		 *
		 * @return string
		 */
		public function getId(){ }


		/**
		 * Check whether the session has been started
		 *
		 *<code>
		 *	var_dump($session->isStarted());
		 *</code>
		 *
		 * @return boolean
		 */
		public function isStarted(){ }


		/**
		 * Destroys the active session
		 *
		 *<code>
		 *	var_dump($session->destroy());
		 *</code>
		 *
		 * @return boolean
		 */
		public function destroy(){ }

	}
}
