<?php

namespace Phalcon\Http\Response;

/**
 * Phalcon\Http\Response\Headers
 *
 * This class is a bag to manage the response headers
 */
class Headers implements \Phalcon\Http\Response\HeadersInterface
{

    protected $_headers = array();


    /**
     * Sets a header to be sent at the end of the request
     *
     * @param string $name
     * @param string $value
     */
    public function set($name, $value) {}

    /**
     * Gets a header value from the internal bag
     *
     * @param string $name
     * @return string|bool
     */
    public function get($name) {}

    /**
     * Sets a raw header to be sent at the end of the request
     *
     * @param string $header
     */
    public function setRaw($header) {}

    /**
     * Removes a header to be sent at the end of the request
     *
     * @param string $header
     */
    public function remove($header) {}

    /**
     * Sends the headers to the client
     *
     * @return bool
     */
    public function send() {}

    /**
     * Reset set headers
     */
    public function reset() {}

    /**
     * Returns the current headers as an array
     *
     * @return array
     */
    public function toArray() {}

    /**
     * Restore a \Phalcon\Http\Response\Headers object
     *
     * @param array $data
     * @return Headers
     */
    public static function __set_state(array $data) {}

}
