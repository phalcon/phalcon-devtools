<?php

namespace Phalcon\Http;

/**
 * Phalcon\Http\Cookie
 * Provide OO wrappers to manage a HTTP cookie
 */
class Cookie implements \Phalcon\Http\CookieInterface, \Phalcon\Di\InjectionAwareInterface
{

    protected $_readed = false;


    protected $_restored = false;


    protected $_useEncryption = false;


    protected $_dependencyInjector;


    protected $_filter;


    protected $_name;


    protected $_value;


    protected $_expire;


    protected $_path = "/";


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
     */
    public function __construct($name, $value = null, $expire = 0, $path = "/", $secure = null, $domain = null, $httpOnly = null) {}

    /**
     * Sets the dependency injector
     *
     * @param mixed $dependencyInjector 
     */
    public function setDI(\Phalcon\DiInterface $dependencyInjector) {}

    /**
     * Returns the internal dependency injector
     *
     * @return \Phalcon\DiInterface 
     */
    public function getDI() {}

    /**
     * Sets the cookie's value
     *
     * @param string $value 
     * @return \Phalcon\Http\Cookie 
     */
    public function setValue($value) {}

    /**
     * Returns the cookie's value
     *
     * @param string|array $filters 
     * @param string $defaultValue 
     * @return mixed 
     */
    public function getValue($filters = null, $defaultValue = null) {}

    /**
     * Sends the cookie to the HTTP client
     * Stores the cookie definition in session
     *
     * @return CookieInterface 
     */
    public function send() {}

    /**
     * Reads the cookie-related info from the SESSION to restore the cookie as it was set
     * This method is automatically called internally so normally you don't need to call it
     *
     * @return CookieInterface 
     */
    public function restore() {}

    /**
     * Deletes the cookie by setting an expire time in the past
     */
    public function delete() {}

    /**
     * Sets if the cookie must be encrypted/decrypted automatically
     *
     * @param bool $useEncryption 
     * @return CookieInterface 
     */
    public function useEncryption($useEncryption) {}

    /**
     * Check if the cookie is using implicit encryption
     *
     * @return bool 
     */
    public function isUsingEncryption() {}

    /**
     * Sets the cookie's expiration time
     *
     * @param int $expire 
     * @return CookieInterface 
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
     * @return CookieInterface 
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
     * @return CookieInterface 
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
     * @param bool $secure 
     * @return CookieInterface 
     */
    public function setSecure($secure) {}

    /**
     * Returns whether the cookie must only be sent when the connection is secure (HTTPS)
     *
     * @return bool 
     */
    public function getSecure() {}

    /**
     * Sets if the cookie is accessible only through the HTTP protocol
     *
     * @param bool $httpOnly 
     * @return CookieInterface 
     */
    public function setHttpOnly($httpOnly) {}

    /**
     * Returns if the cookie is accessible only through the HTTP protocol
     *
     * @return bool 
     */
    public function getHttpOnly() {}

    /**
     * Magic __toString method converts the cookie's value to string
     *
     * @return string 
     */
    public function __toString() {}

}
