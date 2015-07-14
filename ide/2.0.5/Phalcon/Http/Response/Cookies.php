<?php

namespace Phalcon\Http\Response;

use Phalcon\DiInterface;
use Phalcon\Http\Cookie;
use Phalcon\Http\Response\CookiesInterface;
use Phalcon\Di\InjectionAwareInterface;
use Phalcon\Http\Cookie\Exception;


class Cookies implements CookiesInterface, InjectionAwareInterface
{

	protected $_dependencyInjector;

	protected $_registered = false;

	protected $_useEncryption = true;

	protected $_cookies;



	/**
	 * Sets the dependency injector
	 * 
	 * @param DiInterface $dependencyInjector
	 *
	 * @return void
	 */
	public function setDI(DiInterface $dependencyInjector) {}

	/**
	 * Returns the internal dependency injector
	 *
	 * @return DiInterface
	 */
	public function getDI() {}

	/**
	 * Set if cookies in the bag must be automatically encrypted/decrypted
	 * 
	 * @param boolean $useEncryption
	 *
	 * @return Cookies
	 */
	public function useEncryption($useEncryption) {}

	/**
	 * Returns if the bag is automatically encrypting/decrypting cookies
	 *
	 * @return boolean
	 */
	public function isUsingEncryption() {}

	/**
	 * Sets a cookie to be sent at the end of the request
	 * This method overrides any cookie set before with the same name
	 *
	 * @param string $name
	 * @param mixed $value
	 * @param int $expire
	 * @param string $path
	 * @param boolean $secure
	 * @param string $domain
	 * @param boolean $httpOnly
	 * 
	 * @return Cookies
	 */
	public function set($name, $value=null, $expire, $path="/", $secure=null, $domain=null, $httpOnly=null) {}

	/**
		 * Check if the cookie needs to be updated or
	 * 
	 * @param string $name
		 *
	 * @return Cookie
	 */
	public function get($name) {}

	/**
         * Create the cookie if the it does not exist
	 * 
	 * @param string $name
         *
	 * @return boolean
	 */
	public function has($name) {}

	/**
		 * Check the internal bag
	 * 
	 * @param string $name
		 *
	 * @return boolean
	 */
	public function delete($name) {}

	/**
		 * Check the internal bag
		 *
	 * @return boolean
	 */
	public function send() {}

	/**
	 * Reset set cookies
	 *
	 * @return Cookies
	 */
	public function reset() {}

}
