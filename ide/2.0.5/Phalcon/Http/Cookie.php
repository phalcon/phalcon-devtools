<?php

namespace Phalcon\Http;

use Phalcon\DiInterface;
use Phalcon\CryptInterface;
use Phalcon\Di\InjectionAwareInterface;
use Phalcon\Http\Response\Exception;
use Phalcon\Session\AdapterInterface as SessionInterface;


class Cookie implements InjectionAwareInterface
{

	protected $_readed = false;

	protected $_restored = false;

	protected $_useEncryption = false;

	protected $_dependencyInjector;

	protected $_filter;

	protected $_name;

	protected $_value;

	protected $_expire;

	protected $_path = '/';

	protected $_domain;

	protected $_secure;

	protected $_httpOnly = true;



	/**
	 * Phalcon\Http\Cookie constructor
	 * 
	 * @param string $name
	 * @param mixed $value
	 * @param int $expire
	 * @param string $path
	 * @param boolean $secure
	 * @param string $domain
	 * @param boolean $httpOnly
	 *
	 */
	public function __construct($name, $value=null, $expire, $path="/", $secure=null, $domain=null, $httpOnly=null) {}

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
	 * Sets the cookie's value
	 *
	 * @param string $value
	 * 
	 * @return Cookie
	 */
	public function setValue($value) {}

	/**
	 * Returns the cookie's value
	 *
	 * @param string|array $filters
	 * @param string $defaultValue
	 * 
	 * @return mixed
	 */
	public function getValue($filters=null, $defaultValue=null) {}

	/**
					 * Decrypt the value also decoding it with base64
					 *
	 * @return Cookie
	 */
	public function send() {}

	/**
		 * The definition is stored in session
		 *
	 * @return Cookie
	 */
	public function restore() {}

	/**
	 * Deletes the cookie by setting an expire time in the past
	 *
	 * @return void
	 */
	public function delete() {}

	/**
	 * Sets if the cookie must be encrypted/decrypted automatically
	 * 
	 * @param boolean $useEncryption
	 *
	 * @return Cookie
	 */
	public function useEncryption($useEncryption) {}

	/**
	 * Check if the cookie is using implicit encryption
	 *
	 * @return boolean
	 */
	public function isUsingEncryption() {}

	/**
	 * Sets the cookie's expiration time
	 * 
	 * @param int $expire
	 *
	 * @return Cookie
	 */
	public function setExpiration($expire) {}

	/**
	 * Returns the current expiration time
	 *
	 * @return string
	 */
	public function getExpiration() {}

	/**
	 * Sets the cookie's expiration time
	 * 
	 * @param string $path
	 *
	 * @return Cookie
	 */
	public function setPath($path) {}

	/**
	 * Returns the current cookie's name
	 *
	 * @return string
	 */
	public function getName() {}

	/**
	 * Returns the current cookie's path
	 *
	 * @return string
	 */
	public function getPath() {}

	/**
	 * Sets the domain that the cookie is available to
	 * 
	 * @param string $domain
	 *
	 * @return Cookie
	 */
	public function setDomain($domain) {}

	/**
	 * Returns the domain that the cookie is available to
	 *
	 * @return string
	 */
	public function getDomain() {}

	/**
	 * Sets if the cookie must only be sent when the connection is secure (HTTPS)
	 * 
	 * @param boolean $secure
	 *
	 * @return Cookie
	 */
	public function setSecure($secure) {}

	/**
	 * Returns whether the cookie must only be sent when the connection is secure (HTTPS)
	 *
	 * @return boolean
	 */
	public function getSecure() {}

	/**
	 * Sets if the cookie is accessible only through the HTTP protocol
	 * 
	 * @param boolean $httpOnly
	 *
	 * @return Cookie
	 */
	public function setHttpOnly($httpOnly) {}

	/**
	 * Returns if the cookie is accessible only through the HTTP protocol
	 *
	 * @return boolean
	 */
	public function getHttpOnly() {}

	/**
	 * Magic __toString method converts the cookie's value to string
	 *
	 * @return string
	 */
	public function __toString() {}

}
