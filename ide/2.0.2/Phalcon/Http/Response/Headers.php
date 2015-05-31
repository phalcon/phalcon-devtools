<?php 

namespace Phalcon\Http\Response {

	class Headers implements \Phalcon\Http\Response\HeadersInterface {

		protected $_headers;

		/**
		 * Sets a header to be sent at the end of the request
		 *
		 * @param string name
		 * @param string value
		 */
		public function set($name, $value){ }


		/**
		 * Gets a header value from the internal bag
		 *
		 * @param string name
		 * @return string
		 */
		public function get($name){ }


		/**
		 * Sets a raw header to be sent at the end of the request
		 *
		 * @param string header
		 */
		public function setRaw($header){ }


		/**
		 * Removes a header to be sent at the end of the request
		 *
		 * @param string header Header name
		 */
		public function remove($header){ }


		/**
		 * Sends the headers to the client
		 */
		public function send(){ }


		/**
		 * Reset set headers
		 */
		public function reset(){ }


		/**
		 * Returns the current headers as an array
		 */
		public function toArray(){ }


		/**
		 * Restore a \Phalcon\Http\Response\Headers object
		 */
		public static function __set_state($data){ }


		public function __construct(){ }

	}
}
