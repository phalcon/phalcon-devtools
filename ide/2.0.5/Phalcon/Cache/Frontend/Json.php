<?php

namespace Phalcon\Cache\Frontend;

use Phalcon\Cache\FrontendInterface;


class Json implements FrontendInterface
{

	protected $_frontendOptions;



	/**
	 * Phalcon\Cache\Frontend\Base64 constructor
	 * 
	 * @param array $frontendOptions
	 *
	 */
	public function __construct($frontendOptions=null) {}

	/**
	 * Returns the cache lifetime
	 *
	 * @return int
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
	 *
	 * @return void
	 */
	public function start() {}

	/**
	 * Returns output cached content
	 *
	 * @return mixed
	 */
	public function getContent() {}

	/**
	 * Stops output frontend
	 *
	 * @return void
	 */
	public function stop() {}

	/**
	 * Serializes data before storing them
	 *
	 * @param mixed $data
	 * 
	 * @return string
	 */
	public function beforeStore($data) {}

	/**
	 * Unserializes data after retrieval
	 *
	 * @param mixed $data
	 * 
	 * @return mixed
	 */
	public function afterRetrieve($data) {}

}
