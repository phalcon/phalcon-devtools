<?php

namespace Phalcon\Http\Response;

/**
 * Phalcon\Http\Response\CookiesInterface
 * Interface for Phalcon\Http\Response\Cookies
 */
interface CookiesInterface
{

    /**
     * Set if cookies in the bag must be automatically encrypted/decrypted
     *
     * @param bool $useEncryption 
     * @return CookiesInterface 
     */
    public function useEncryption($useEncryption);

    /**
     * Returns if the bag is automatically encrypting/decrypting cookies
     *
     * @return bool 
     */
    public function isUsingEncryption();

    /**
     * Sets a cookie to be sent at the end of the request
     *
     * @param string $name 
     * @param mixed $value 
     * @param int $expire 
     * @param string $path 
     * @param bool $secure 
     * @param string $domain 
     * @param bool $httpOnly 
     * @return CookiesInterface 
     */
    public function set($name, $value = null, $expire = 0, $path = "/", $secure = null, $domain = null, $httpOnly = null);

    /**
     * Gets a cookie from the bag
     *
     * @param string $name 
     * @return \Phalcon\Http\Cookie 
     */
    public function get($name);

    /**
     * Check if a cookie is defined in the bag or exists in the _COOKIE superglobal
     *
     * @param string $name 
     * @return bool 
     */
    public function has($name);

    /**
     * Deletes a cookie by its name
     * This method does not removes cookies from the _COOKIE superglobal
     *
     * @param string $name 
     * @return bool 
     */
    public function delete($name);

    /**
     * Sends the cookies to the client
     *
     * @return bool 
     */
    public function send();

    /**
     * Reset set cookies
     *
     * @return CookiesInterface 
     */
    public function reset();

}
