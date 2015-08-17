<?php

namespace Phalcon\Http;

/**
 * Phalcon\Http\CookieInterface
 * Interface for Phalcon\Http\Cookie
 */
interface CookieInterface
{

    /**
     * Sets the cookie's value
     *
     * @param string $value 
     * @return \Phalcon\Http\CookieInterface 
     */
    public function setValue($value);

    /**
     * Returns the cookie's value
     *
     * @param string|array $filters 
     * @param string $defaultValue 
     * @return mixed 
     */
    public function getValue($filters = null, $defaultValue = null);

    /**
     * Sends the cookie to the HTTP client
     *
     * @return CookieInterface 
     */
    public function send();

    /**
     * Deletes the cookie
     */
    public function delete();

    /**
     * Sets if the cookie must be encrypted/decrypted automatically
     *
     * @param bool $useEncryption 
     * @return CookieInterface 
     */
    public function useEncryption($useEncryption);

    /**
     * Check if the cookie is using implicit encryption
     *
     * @return bool 
     */
    public function isUsingEncryption();

    /**
     * Sets the cookie's expiration time
     *
     * @param int $expire 
     * @return CookieInterface 
     */
    public function setExpiration($expire);

    /**
     * Returns the current expiration time
     *
     * @return string 
     */
    public function getExpiration();

    /**
     * Sets the cookie's expiration time
     *
     * @param string $path 
     * @return CookieInterface 
     */
    public function setPath($path);

    /**
     * Returns the current cookie's name
     *
     * @return string 
     */
    public function getName();

    /**
     * Returns the current cookie's path
     *
     * @return string 
     */
    public function getPath();

    /**
     * Sets the domain that the cookie is available to
     *
     * @param string $domain 
     * @return CookieInterface 
     */
    public function setDomain($domain);

    /**
     * Returns the domain that the cookie is available to
     *
     * @return string 
     */
    public function getDomain();

    /**
     * Sets if the cookie must only be sent when the connection is secure (HTTPS)
     *
     * @param bool $secure 
     * @return CookieInterface 
     */
    public function setSecure($secure);

    /**
     * Returns whether the cookie must only be sent when the connection is secure (HTTPS)
     *
     * @return bool 
     */
    public function getSecure();

    /**
     * Sets if the cookie is accessible only through the HTTP protocol
     *
     * @param bool $httpOnly 
     * @return CookieInterface 
     */
    public function setHttpOnly($httpOnly);

    /**
     * Returns if the cookie is accessible only through the HTTP protocol
     *
     * @return bool 
     */
    public function getHttpOnly();

}
