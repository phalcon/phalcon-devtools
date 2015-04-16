<?php

namespace Phalcon\Cache\Frontend;

class None implements \Phalcon\Cache\FrontendInterface
{

    /**
     * Returns cache lifetime, always one second expiring content
     *
     * @return int 
     */
	public function getLifetime() {}

    /**
     * Check whether if frontend is buffering output, always false
     *
     * @return boolean 
     */
	public function isBuffering() {}

    /**
     * Starts output frontend
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
     * Prepare data to be stored
     *
     * @param mixed $data 
     * @param mixed $$data 
     */
	public function beforeStore($data) {}

    /**
     * Prepares data to be retrieved to user
     *
     * @param mixed $data 
     * @param mixed $$data 
     */
	public function afterRetrieve($data) {}

}
