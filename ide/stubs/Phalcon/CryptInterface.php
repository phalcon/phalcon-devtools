<?php

namespace Phalcon;

/**
 * Phalcon\CryptInterface
 *
 * Interface for Phalcon\Crypt
 */
interface CryptInterface
{

    /**
     * Sets the cipher algorithm
     *
     * @param string $cipher
     * @return CryptInterface
     */
    public function setCipher($cipher);

    /**
     * Returns the current cipher
     *
     * @return string
     */
    public function getCipher();

    /**
     * Sets the encryption key
     *
     * @param string $key
     * @return CryptInterface
     */
    public function setKey($key);

    /**
     * Returns the encryption key
     *
     * @return string
     */
    public function getKey();

    /**
     * Encrypts a text
     *
     * @param string $text
     * @param mixed $key
     * @return string
     */
    public function encrypt($text, $key = null);

    /**
     * Decrypts a text
     *
     * @param string $text
     * @param string $key
     * @return string
     */
    public function decrypt($text, $key = null);

    /**
     * Encrypts a text returning the result as a base64 string
     *
     * @param string $text
     * @param mixed $key
     * @return string
     */
    public function encryptBase64($text, $key = null);

    /**
     * Decrypt a text that is coded as a base64 string
     *
     * @param string $text
     * @param mixed $key
     * @return string
     */
    public function decryptBase64($text, $key = null);

    /**
     * Returns a list of available cyphers
     *
     * @return array
     */
    public function getAvailableCiphers();

}
