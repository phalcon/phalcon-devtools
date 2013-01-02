<?php 

namespace Phalcon\Http\Response {

	/**
	 * Phalcon\Http\Response\Cookies
	 *
	 * This class is a bag to manage the cookies
	 *
	 */
	
	class Cookies {

		protected $_dependencyInjector;

		protected $_registered;

		protected $_cookies;

		/**
		 * \Phalcon\Http\Response\Cookies constructor
		 */
		public function __construct(){ }


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
		 * Sets a header to be sent at the end of the request
		 *
		 * @param string $name
		 * @param mixed $value
		 * @param int $expire
		 * @param string $path
		 */
		public function set($name, $value=null, $expire=null, $path=null){ }


		/**
		 * Gets a cookie from the bag
		 *
		 * @param string $name
		 * @return \Phalcon\Http\Cookie
		 */
		public function get($name){ }


		/**
		 * Reset set cookies
		 *
		 */
		public function reset(){ }

	}
}
