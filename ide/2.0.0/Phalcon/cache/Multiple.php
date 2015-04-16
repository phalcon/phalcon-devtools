<?php

namespace Phalcon\Cache;

class Multiple
{

    protected $_backends;


    /**
     * Phalcon\Cache\Multiple constructor
     *
     * @param	Phalcon\Cache\BackendInterface[] backends
     * @param mixed $backends 
     */
	public function __construct($backends = null) {}

    /**
     * Adds a backend
     *
     * @param \Phalcon\Cache\BackendInterface $backend 
     * @return \Phalcon\Cache\Multiple 
     */
	public function push(\Phalcon\Cache\BackendInterface $backend) {}

    /**
     * Returns a cached content reading the internal backends
     *
     * @param mixed $keyName 
     * @param long $lifetime 
     * @param  $string|int keyName
     * @return mixed 
     */
	public function get($keyName, $lifetime = null) {}

    /**
     * Starts every backend
     *
     * @param string|int $keyName 
     * @param long $lifetime 
     */
	public function start($keyName, $lifetime = null) {}

    /**
     * Stores cached content into all backends and stops the frontend
     *
     * @param string $keyName 
     * @param string $content 
     * @param long $lifetime 
     * @param boolean $stopBuffer 
     */
	public function save($keyName = null, $content = null, $lifetime = null, $stopBuffer = null) {}

    /**
     * Deletes a value from each backend
     *
     * @param string|int $keyName 
     * @return boolean 
     */
	public function delete($keyName) {}

    /**
     * Checks if cache exists in at least one backend
     *
     * @param string|int $keyName 
     * @param long $lifetime 
     * @return boolean 
     */
	public function exists($keyName = null, $lifetime = null) {}

}
