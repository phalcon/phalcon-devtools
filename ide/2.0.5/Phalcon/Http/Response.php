<?php

namespace Phalcon\Http;

use Phalcon\DiInterface;
use Phalcon\Http\Response\Exception;
use Phalcon\Http\Response\HeadersInterface;
use Phalcon\Http\Response\CookiesInterface;
use Phalcon\Mvc\UrlInterface;
use Phalcon\Mvc\ViewInterface;
use Phalcon\Http\Response\Headers;
use Phalcon\Di\InjectionAwareInterface;


class Response implements ResponseInterface, InjectionAwareInterface
{

	protected $_sent = false;

	protected $_content;

	protected $_headers;

	protected $_cookies;

	protected $_file;

	protected $_dependencyInjector;

	protected $_statusCodes;



	/**
	 * Phalcon\Http\Response constructor
	 * 
	 * @param string $content
	 * @param int $code
	 * @param string $status
	 *
	 */
	public function __construct($content=null, $code=null, $status=null) {}

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
	 * Sets the HTTP response code
	 *
	 *<code>
	 *	$response->setStatusCode(404, "Not Found");
	 *</code>
	 * 
	 * @param int $code
	 * @param string $message
	 *
	 * @return Response
	 */
	public function setStatusCode($code, $message=null) {}

	/**
		 * We use HTTP/1.1 instead of HTTP/1.0
		 *
		 * Before that we would like to unset any existing HTTP/x.y headers
		 *
	 * @return array
	 */
	public function getStatusCode() {}

	/**
	 * Sets a headers bag for the response externally
	 * 
	 * @param HeadersInterface $headers
	 *
	 * @return Response
	 */
	public function setHeaders(HeadersInterface $headers) {}

	/**
	 * Returns headers set by the user
	 *
	 * @return HeadersInterface
	 */
	public function getHeaders() {}

	/**
			 * A Phalcon\Http\Response\Headers bag is temporary used to manage the headers before sent them to the client
	 * 
	 * @param CookiesInterface $cookies
			 *
	 * @return Response
	 */
	public function setCookies(CookiesInterface $cookies) {}

	/**
	 * Returns coookies set by the user
	 *
	 * @return CookiesInterface
	 */
	public function getCookies() {}

	/**
	 * Overwrites a header in the response
	 *
	 *<code>
	 *	$response->setHeader("Content-Type", "text/plain");
	 *</code>
	 *
	 * @param string $name
	 * @param string $value
	 * 
	 * @return Response
	 */
	public function setHeader($name, $value) {}

	/**
	 * Send a raw header to the response
	 *
	 *<code>
	 *	$response->setRawHeader("HTTP/1.1 404 Not Found");
	 *</code>
	 * 
	 * @param string $header
	 *
	 * @return Response
	 */
	public function setRawHeader($header) {}

	/**
	 * Resets all the stablished headers
	 *
	 * @return Response
	 */
	public function resetHeaders() {}

	/**
	 * Sets a Expires header to use HTTP cache
	 *
	 *<code>
	 *	$this->response->setExpires(new DateTime());
	 *</code>
	 * 
	 * @param \DateTime $datetime
	 *
	 * @return Response
	 */
	public function setExpires(\DateTime $datetime) {}

	/**
		 * All the expiration times are sent in UTC
		 * Change the timezone to utc
		 *
	 * @return Response
	 */
	public function setNotModified() {}

	/**
	 * Sets the response content-type mime, optionally the charset
	 *
	 *<code>
	 *	$response->setContentType('application/pdf');
	 *	$response->setContentType('text/plain', 'UTF-8');
	 *</code>
	 *
	 * @param string $contentType
	 * @param string $charset
	 * 
	 * @return Response
	 */
	public function setContentType($contentType, $charset=null) {}

	/**
	 * Set a custom ETag
	 *
	 *<code>
	 *	$response->setEtag(md5(time()));
	 *</code>
	 * 
	 * @param string $etag
	 *
	 * @return Response
	 */
	public function setEtag($etag) {}

	/**
	 * Redirect by HTTP to another action or URL
	 *
	 *<code>
	 *  //Using a string redirect (internal/external)
	 *	$response->redirect("posts/index");
	 *	$response->redirect("http://en.wikipedia.org", true);
	 *	$response->redirect("http://www.example.com/new-location", true, 301);
	 *
	 *	//Making a redirection based on a named route
	 *	$response->redirect(array(
	 *		"for" => "index-lang",
	 *		"lang" => "jp",
	 *		"controller" => "index"
	 *	));
	 *</code>
	 *
	 * @param string|array $location
	 * @param boolean $externalRedirect
	 * @param int $statusCode
	 * 
	 * @return Response
	 */
	public function redirect($location=null, $externalRedirect=false, $statusCode=302) {}

	/**
		 * The HTTP status is 302 by default, a temporary redirection
	 * 
	 * @param string $content
		 *
	 * @return Response
	 */
	public function setContent($content) {}

	/**
	 * Sets HTTP response body. The parameter is automatically converted to JSON
	 *
	 *<code>
	 *	$response->setJsonContent(array("status" => "OK"));
	 *</code>
	 *
	 * @param mixed $content
	 * @param int $jsonOptions
	 * @param $depth
	 * 
	 * @return Response
	 */
	public function setJsonContent($content, $jsonOptions, $depth=512) {}

	/**
	 * Appends a string to the HTTP response body
	 *
	 * @param string $content
	 * 
	 * @return Response
	 */
	public function appendContent($content) {}

	/**
	 * Gets the HTTP response body
	 *
	 * @return string
	 */
	public function getContent() {}

	/**
	 * Check if the response is already sent
	 *
	 * @return boolean
	 */
	public function isSent() {}

	/**
	 * Sends headers to the client
	 *
	 * @return Response
	 */
	public function sendHeaders() {}

	/**
	 * Sends cookies to the client
	 *
	 * @return Response
	 */
	public function sendCookies() {}

	/**
	 * Prints out HTTP response to the client
	 *
	 * @return Response
	 */
	public function send() {}

	/**
		 * Send headers
	 * 
	 * @param string $filePath
	 * @param $attachmentName
	 * @param $attachment
		 *
	 * @return Response
	 */
	public function setFileToSend($filePath, $attachmentName=null, $attachment=true) {}

}
