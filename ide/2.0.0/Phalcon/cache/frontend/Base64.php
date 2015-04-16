<?php

namespace Phalcon\Cache\Frontend;

class Base64 implements \Phalcon\Cache\FrontendInterface
{

    protected $_frontendOptions;


    /**
     * Phalcon\Cache\Frontend\Base64 constructor
     *
     * @param array $frontendOptions 
     */
	public function __construct($frontendOptions = null) {}

    /**
     * Returns the cache lifetime
     *
     * @return integer 
     */
	public function getLifetime() {}

    /**
     * Check whether if frontend is buffering output
     *
     * @return boolean 
     */
	public function isBuffering() {}

    /**
     * Starts output frontend. Actually, does nothing
     */
	public function start() {}

    /**
     * Returns output cached content
     *
     * @return string 
     */
	public function getContent() {}

    /**
     * Stops output frontend
     */
	public function stop() {}

    /**
     * Serializes data before storing them
     *
     * @param mixed $data 
     * @return string 
     */
	public function beforeStore($data) {}

    /**
     * Unserializes data after retrieval
     *
     * @param mixed $data 
     * @return mixed 
     */
	public function afterRetrieve($data) {}

}
