<?php

namespace Phalcon\Session {

	/**
	 * Phalcon\Session\Adapter
	 *
	 * Base class for Phalcon\Session adapters
	 */

	class Adapter implements AdapterInterface{

		protected $_uniqueId;

		protected $_started;

		protected $_options;

		/**
		 * \Phalcon\Session\Adapter constructor
		 *
		 * @param array $options
		 */
		public function __construct($options=null){ }


		/**
		 * Starts the session (if headers are already sent the session will not started)
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
		 *<comment>
		 *	$session->set('auth', 'yes');
		 *</comment>
		 *
		 * @param string $index
		 * @param string $value
		 */
		public function set($index, $value){ }


		/**
		 * Check whether a session variable is set in an application context
		 *
		 *<comment>
		 *	var_dump($session->has('auth'));
		 *</comment>
		 *
		 * @param string $index
		 */
		public function has($index){ }


		/**
		 * Removes a session variable from an application context
		 *
		 *<comment>
		 *	$session->remove('auth');
		 *</comment>
		 *
		 * @param string $index
		 */
		public function remove($index){ }


		/**
		 * Returns active session id
		 *
		 *<comment>
		 *	echo $session->getId();
		 *</comment>
		 *
		 * @return string
		 */
		public function getId(){ }


		/**
		 * Check whether the session has been started
		 *
		 *<comment>
		 *	var_dump($session->isStarted());
		 *</comment>
		 *
		 * @return boolean
		 */
		public function isStarted(){ }


		/**
		 * Destroys the active session
		 *
		 *<comment>
		 *	var_dump($session->destroy());
		 *</comment>
		 *
		 * @return boolean
		 */
		public function destroy(){ }

	}
}
