<?php 

namespace Phalcon\Http\Response {

	/**
	 * Phalcon\Http\Response\CookiesInterface initializer
	 */
	
	interface CookiesInterface {

		/**
		 * Set if cookies in the bag must be automatically encrypted/decrypted
		 *
		 * @param boolean $useEncryption
		 * @return \Phalcon\Http\Response\CookiesInterface
		 */
		public function useEncryption($useEncryption);


		/**
		 * Returns if the bag is automatically encrypting/decrypting cookies
		 *
		 * @return boolean
		 */
		public function isUsingEncryption();


		/**
		 * Sets a cookie to be sent at the end of the request
		 *
		 * @param string $name
		 * @param mixed $value
		 * @param int $expire
		 * @param string $path
		 * @param boolean $secure
		 * @param boolean $httpOnly
		 * @return \Phalcon\Http\Response\CookiesInterface
		 */
		public function set($name, $value=null, $expire=null, $path=null, $secure=null, $httpOnly=null);


		/**
		 * Gets a cookie from the bag
		 *
		 * @param string $name
		 * @return \Phalcon\Http\Cookie
		 */
		public function get($name);


		/**
		 * Sends the cookies to the client
		 *
		 * @return boolean
		 */
		public function send();


		/**
		 * Reset set cookies
		 *
		 * @return \Phalcon\Http\Response\CookiesInterface
		 */
		public function reset();

	}
}
