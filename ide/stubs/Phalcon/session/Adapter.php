<?php

namespace Phalcon\Session;

/**
 * Phalcon\Session\Adapter
 * Base class for Phalcon\Session adapters
 */
abstract class Adapter implements \Phalcon\Session\AdapterInterface
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
     */
    public function __construct($options = null) {}

    /**
     * Starts the session (if headers are already sent the session will not be started)
     *
     * @return bool 
     */
    public function start() {}

    /**
     * Sets session's options
     * <code>
     * $session->setOptions(['uniqueId' => 'my-private-app']);
     * </code>
     *
     * @param array $options 
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
     */
    public function setName($name) {}

    /**
     * Get session name
     *
     * @return string 
     */
    public function getName() {}

    /**
     * {@inheritdoc}
     *
     * @param bool $deleteOldSession 
     * @return Adapter 
     */
    public function regenerateId($deleteOldSession = true) {}

    /**
     * Gets a session variable from an application context
     * <code>
     * $session->get('auth', 'yes');
     * </code>
     *
     * @param string $index 
     * @param mixed $defaultValue 
     * @param bool $remove 
     * @return mixed 
     */
    public function get($index, $defaultValue = null, $remove = false) {}

    /**
     * Sets a session variable in an application context
     * <code>
     * $session->set('auth', 'yes');
     * </code>
     *
     * @param string $index 
     * @param mixed $value 
     */
    public function set($index, $value) {}

    /**
     * Check whether a session variable is set in an application context
     * <code>
     * var_dump($session->has('auth'));
     * </code>
     *
     * @param string $index 
     * @return bool 
     */
    public function has($index) {}

    /**
     * Removes a session variable from an application context
     * <code>
     * $session->remove('auth');
     * </code>
     *
     * @param string $index 
     */
    public function remove($index) {}

    /**
     * Returns active session id
     * <code>
     * echo $session->getId();
     * </code>
     *
     * @return string 
     */
    public function getId() {}

    /**
     * Set the current session id
     * <code>
     * $session->setId($id);
     * </code>
     *
     * @param string $id 
     */
    public function setId($id) {}

    /**
     * Check whether the session has been started
     * <code>
     * var_dump($session->isStarted());
     * </code>
     *
     * @return bool 
     */
    public function isStarted() {}

    /**
     * Destroys the active session
     * <code>
     * var_dump($session->destroy());
     * var_dump($session->destroy(true));
     * </code>
     *
     * @param bool $removeData 
     * @return bool 
     */
    public function destroy($removeData = false) {}

    /**
     * Returns the status of the current session.
     * <code>
     * var_dump($session->status());
     * if ($session->status() !== $session::SESSION_ACTIVE) {
     * $session->start();
     * }
     * </code>
     *
     * @return int 
     */
    public function status() {}

    /**
     * Alias: Gets a session variable from an application context
     *
     * @param string $index 
     * @return mixed 
     */
    public function __get($index) {}

    /**
     * Alias: Sets a session variable in an application context
     *
     * @param string $index 
     * @param mixed $value 
     */
    public function __set($index, $value) {}

    /**
     * Alias: Check whether a session variable is set in an application context
     *
     * @param string $index 
     * @return bool 
     */
    public function __isset($index) {}

    /**
     * Alias: Removes a session variable from an application context
     *
     * @param string $index 
     */
    public function __unset($index) {}


    public function __destruct() {}

}
