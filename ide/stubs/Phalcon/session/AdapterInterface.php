<?php

namespace Phalcon\Session;

/**
 * Phalcon\Session\AdapterInterface
 * Interface for Phalcon\Session adapters
 */
interface AdapterInterface
{

    /**
     * Starts session, optionally using an adapter
     */
    public function start();

    /**
     * Sets session options
     *
     * @param array $options 
     */
    public function setOptions(array $options);

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
     * @param mixed $defaultValue 
     * @return mixed 
     */
    public function get($index, $defaultValue = null);

    /**
     * Sets a session variable in an application context
     *
     * @param string $index 
     * @param mixed $value 
     */
    public function set($index, $value);

    /**
     * Check whether a session variable is set in an application context
     *
     * @param string $index 
     * @return bool 
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
     * @return bool 
     */
    public function isStarted();

    /**
     * Destroys the active session
     *
     * @param bool $removeData 
     * @return bool 
     */
    public function destroy($removeData = false);

    /**
     * Regenerate session's id
     *
     * @param bool $deleteOldSession 
     * @return AdapterInterface 
     */
    public function regenerateId($deleteOldSession = true);

    /**
     * Set session name
     *
     * @param string $name 
     */
    public function setName($name);

    /**
     * Get session name
     *
     * @return string 
     */
    public function getName();

}
