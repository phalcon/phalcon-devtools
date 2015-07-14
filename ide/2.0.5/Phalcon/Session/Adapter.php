<?php

namespace Phalcon\Session;

abstract class Adapter
{

	const SESSION_ACTIVE = 2;

	const SESSION_NONE = 1;

	const SESSION_DISABLED = 0;



	protected $_uniqueId;

	protected $_started = false;

	protected $_options;



	/**
	 * Phalcon\Session\Adapter constructor
	 * 
	 * @param array $options
	 *
	 */
	public function __construct($options=null) {}

	/**
	 * Starts the session (if headers are already sent the session will not be started)
	 *
	 * @return boolean
	 */
	public function start() {}

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
	 *
	 * @return void
	 */
	public function setOptions(array $options) {}

	/**
	 * Get internal options
	 *
	 * @return array
	 */
	public function getOptions() {}

	/**
	 * Set session name
	 * 
	 * @param string $name
	 *
	 * @return void
	 */
	public function setName($name) {}

	/**
	 * Get session name
	 *
	 * @return mixed
	 */
	public function getName() {}

	/**
	 * Gets a session variable from an application context
	 *
	 * @param string $index
	 * @param mixed $defaultValue
	 * @param boolean $remove
	 * 
	 * @return mixed
	 */
	public function get($index, $defaultValue=null, $remove=false) {}

	/**
	 * Sets a session variable in an application context
	 *
	 *<code>
	 *	$session->set('auth', 'yes');
	 *</code>
	 * 
	 * @param string $index
	 * @param string $value
	 *
	 *
	 * @return void
	 */
	public function set($index, $value) {}

	/**
	 * Check whether a session variable is set in an application context
	 *
	 *<code>
	 *	var_dump($session->has('auth'));
	 *</code>
	 * 
	 * @param string $index
	 *
	 * @return boolean
	 */
	public function has($index) {}

	/**
	 * Removes a session variable from an application context
	 *
	 *<code>
	 *	$session->remove('auth');
	 *</code>
	 * 
	 * @param string $index
	 *
	 * @return void
	 */
	public function remove($index) {}

	/**
	 * Returns active session id
	 *
	 *<code>
	 *	echo $session->getId();
	 *</code>
	 *
	 * @return string
	 */
	public function getId() {}

	/**
	 * Set the current session id
	 *
	 *<code>
	 *	$session->setId($id);
	 *</code>
	 * 
	 * @param string $id
	 *
	 * @return void
	 */
	public function setId($id) {}

	/**
	 * Check whether the session has been started
	 *
	 *<code>
	 *	var_dump($session->isStarted());
	 *</code>
	 *
	 * @return boolean
	 */
	public function isStarted() {}

	/**
	 * Destroys the active session
	 *
	 *<code>
	 *	var_dump($session->destroy());
	 *</code>
	 *
	 * @return boolean
	 */
	public function destroy() {}

	/**
	 * Returns the status of the current session. For PHP 5.3 this function will always return SESSION_NONE
	 *
	 *<code>
	 *	var_dump($session->status());
	 *
	 *  // PHP 5.4 and above will give meaningful messages, 5.3 gets SESSION_NONE always
	 *  if ($session->status() !== $session::SESSION_ACTIVE) {
	 *      $session->start();
	 *  }
	 *</code>
	 *
	 * @return int
	 */
	public function status() {}

	/**
	 * Alias: Gets a session variable from an application context
	 *
	 * @param string $index
	 * 
	 * @return mixed
	 */
	public function __get($index) {}

	/**
	 * Alias: Sets a session variable in an application context
	 * 
	 * @param string $index
	 * @param string $value
	 *
	 *
	 * @return mixed
	 */
	public function __set($index, $value) {}

	/**
	 * Alias: Check whether a session variable is set in an application context
	 * 
	 * @param string $index
	 *
	 * @return boolean
	 */
	public function __isset($index) {}

	/**
	 * Alias: Removes a session variable from an application context
	 * 
	 * @param string $index
	 *
	 * @return mixed
	 */
	public function __unset($index) {}

}
