<?php 

namespace Phalcon\Http {

	/**
	 * Phalcon\Http\Cookie
	 *
	 * Provide OO wrappers to manage a HTTP cookie
	 */
	
	class Cookie {

		protected $_readed;

		protected $_dependencyInjector;

		protected $_filter;

		protected $_name;

		protected $_value;

		protected $_expire;

		protected $_path;

		protected $_secure;

		/**
		 * \Phalcon\Http\Cookie constructor
		 *
		 * @param string $name
		 * @param mixed $value
		 * @param int $expire
		 * @param string $path
		 */
		public function __construct($name, $value=null, $expire=null, $path=null){ }


		/**
		 * Sets the dependency injector
		 *
		 * @param \Phalcon\DiInterface $dependencyInjector
		 */
		public function setDI($dependencyInjector){ }


		/**
		 * Returns the internal dependency injector
		 *
		 * @return \Phalcon\DiInterface
		 */
		public function getDI(){ }


		/**
		 * Sets the cookie's value
		 *
		 * @param string $value
		 * @return \Phalcon\Http\CookieInterface
		 */
		public function setValue($value){ }


		/**
		 * Returns the cookie's value
		 *
		 * @return mixed
		 */
		public function getValue($filters=null, $defaultValue=null){ }


		/**
		 * Sets the cookie's expiration time
		 *
		 * @param int $expire
		 * @return \Phalcon\Http\Cookie
		 */
		public function setExpiration($expire){ }


		/**
		 * Returns the current expiration time
		 *
		 * @return string
		 */
		public function getExpiration(){ }


		/**
		 * Sets the cookie's expiration time
		 *
		 * @param int $expire
		 * @return \Phalcon\Http\Cookie
		 */
		public function setPath($path){ }


		/**
		 * Returns the current cookie's path
		 *
		 * @return string
		 */
		public function getPath(){ }


		/**
		 * Sets if the cookie must only be sent when the connection is secure (HTTPS)
		 *
		 * @param boolean $secure
		 * @return \Phalcon\Http\Cookie
		 */
		public function setSecure($secure){ }


		/**
		 * Returns whether the cookie must only be sent when the connection is secure (HTTPS)
		 *
		 * @return boolean
		 */
		public function getSecure(){ }

	}
}
