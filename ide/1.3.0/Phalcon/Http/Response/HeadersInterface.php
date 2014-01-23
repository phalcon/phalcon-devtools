<?php 

namespace Phalcon\Http\Response {

	/**
	 * Phalcon\Http\Response\HeadersInterface initializer
	 */
	
	interface HeadersInterface {

		/**
		 * Sets a header to be sent at the end of the request
		 *
		 * @param string $name
		 * @param string $value
		 */
		public function set($name, $value);


		/**
		 * Gets a header value from the internal bag
		 *
		 * @param string $name
		 * @return string
		 */
		public function get($name);


		/**
		 * Sets a raw header to be sent at the end of the request
		 *
		 * @param string $header
		 */
		public function setRaw($header);


		/**
		 * Sends the headers to the client
		 *
		 * @return boolean
		 */
		public function send();


		/**
		 * Reset set headers
		 *
		 */
		public function reset();


		/**
		 * Returns the current headers as an array
		 *
		 * @return array
		 */
		public function toArray();

	}
}
