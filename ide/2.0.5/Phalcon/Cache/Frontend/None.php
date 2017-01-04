<?php

namespace Phalcon\Cache\Frontend;

use Phalcon\Cache\FrontendInterface;


class None implements FrontendInterface
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
	 *
	 * @return void
	 */
	public function start() {}

	/**
	 * Returns output cached content
	 *
	 * @return void
	 */
	public function getContent() {}

	/**
	 * Stops output frontend
	 *
	 * @return void
	 */
	public function stop() {}

	/**
	 * Prepare data to be stored
	 * 
	 * @param mixed $data
	 *
	 *
	 * @return mixed
	 */
	public function beforeStore($data) {}

	/**
	 * Prepares data to be retrieved to user
	 * 
	 * @param mixed $data
	 *
	 *
	 * @return mixed
	 */
	public function afterRetrieve($data) {}

}
