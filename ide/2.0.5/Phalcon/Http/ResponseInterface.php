<?php

namespace Phalcon\Http;

use Phalcon\Http\Response\HeadersInterface;


interface ResponseInterface
{

	/**
	 * Sets the HTTP response code
	 * 
	 * @param int $code
	 * @param string $message
	 *
	 * @return ResponseInterface
	 */
	public function setStatusCode($code, $message=null);

	/**
	 * Returns headers set by the user
	 *
	 * @return HeadersInterface
	 */
	public function getHeaders();

	/**
	 * Overwrites a header in the response
	 *
	 * @param string $name
	 * @param string $value
	 * 
	 * @return ResponseInterface
	 */
	public function setHeader($name, $value);

	/**
	 * Send a raw header to the response
	 * 
	 * @param string $header
	 *
	 * @return ResponseInterface
	 */
	public function setRawHeader($header);

	/**
	 * Resets all the stablished headers
	 *
	 * @return ResponseInterface
	 */
	public function resetHeaders();

	/**
	 * Sets output expire time header
	 * 
	 * @param \DateTime $datetime
	 *
	 * @return ResponseInterface
	 */
	public function setExpires(\DateTime $datetime);

	/**
	 * Sends a Not-Modified response
	 *
	 * @return ResponseInterface
	 */
	public function setNotModified();

	/**
	 * Sets the response content-type mime, optionally the charset
	 *
	 * @param string $contentType
	 * @param string $charset
	 * 
	 * @return ResponseInterface
	 */
	public function setContentType($contentType, $charset=null);

	/**
	 * Redirect by HTTP to another action or URL
	 *
	 * @param string $location
	 * @param boolean $externalRedirect
	 * @param int $statusCode
	 * 
	 * @return ResponseInterface
	 */
	public function redirect($location=null, $externalRedirect=false, $statusCode=302);

	/**
	 * Sets HTTP response body
	 * 
	 * @param string $content
	 *
	 * @return ResponseInterface
	 */
	public function setContent($content);

	/**
	 * Sets HTTP response body. The parameter is automatically converted to JSON
	 *
	 *<code>
	 *	response->setJsonContent(array("status" => "OK"));
	 *</code>
	 *
	 * @param string $content
	 * 
	 * @return ResponseInterface
	 */
	public function setJsonContent($content);

	/**
	 * Appends a string to the HTTP response body
	 *
	 * @param string $content
	 * 
	 * @return ResponseInterface
	 */
	public function appendContent($content);

	/**
	 * Gets the HTTP response body
	 *
	 * @return string
	 */
	public function getContent();

	/**
	 * Sends headers to the client
	 *
	 * @return ResponseInterface
	 */
	public function sendHeaders();

	/**
	 * Sends cookies to the client
	 *
	 * @return ResponseInterface
	 */
	public function sendCookies();

	/**
	 * Prints out HTTP response to the client
	 *
	 * @return ResponseInterface
	 */
	public function send();

	/**
	 * Sets an attached file to be sent at the end of the request
	 * 
	 * @param string $filePath
	 * @param string $attachmentName
	 *
	 *
	 * @return ResponseInterface
	 */
	public function setFileToSend($filePath, $attachmentName=null);

}
