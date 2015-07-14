<?php

namespace Phalcon\Http\Response;

use Phalcon\Http\Response\HeadersInterface;


class Headers implements HeadersInterface
{

	protected $_headers = [];



	/**
	 * Sets a header to be sent at the end of the request
	 * 
	 * @param string $name
	 * @param string $value
	 *
	 *
	 * @return void
	 */
	public function set($name, $value) {}

	/**
	 * Gets a header value from the internal bag
	 *
	 * @param string $name
	 * 
	 * @return mixed
	 */
	public function get($name) {}

	/**
	 * Sets a raw header to be sent at the end of the request
	 * 
	 * @param mixed $header
	 *
	 *
	 * @return void
	 */
	public function setRaw($header) {}

	/**
	 * Removes a header to be sent at the end of the request
	 * 
	 * @param string $header
	 * @param \string header Header $name
	 *
	 *
	 * @return void
	 */
	public function remove($header) {}

	/**
	 * Sends the headers to the client
	 *
	 * @return boolean
	 */
	public function send() {}

	/**
	 * Reset set headers
	 *
	 * @return void
	 */
	public function reset() {}

	/**
	 * Returns the current headers as an array
	 *
	 * @return array
	 */
	public function toArray() {}

	/**
	 * Restore a Phalcon\Http\Response\Headers object
	 * 
	 * @param array $data
	 *
	 * @return Headers
	 */
	public static function __set_state(array $data) {}

}
