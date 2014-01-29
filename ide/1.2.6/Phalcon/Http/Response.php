<?php 

namespace Phalcon\Http {

	/**
	 * Phalcon\Http\Response
	 *
	 * Part of the HTTP cycle is return responses to the clients.
	 * Phalcon\HTTP\Response is the Phalcon component responsible to achieve this task.
	 * HTTP responses are usually composed by headers and body.
	 *
	 *<code>
	 *	$response = new Phalcon\Http\Response();
	 *	$response->setStatusCode(200, "OK");
	 *	$response->setContent("<html><body>Hello</body></html>");
	 *	$response->send();
	 *</code>
	 */
	
	class Response implements \Phalcon\Http\ResponseInterface, \Phalcon\DI\InjectionAwareInterface {

		protected $_sent;

		protected $_content;

		protected $_headers;

		protected $_cookies;

		protected $_file;

		protected $_dependencyInjector;

		/**
		 * \Phalcon\Http\Response constructor
		 *
		 * @param string $content
		 * @param int $code
		 * @param string $status
		 */
		public function __construct($content=null, $code=null, $status=null){ }


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
		 * Sets the HTTP response code
		 *
		 *<code>
		 *	$response->setStatusCode(404, "Not Found");
		 *</code>
		 *
		 * @param int $code
		 * @param string $message
		 * @return \Phalcon\Http\ResponseInterface
		 */
		public function setStatusCode($code, $message){ }


		/**
		 * Sets a headers bag for the response externally
		 *
		 * @param \Phalcon\Http\Response\HeadersInterface $headers
		 * @return \Phalcon\Http\ResponseInterface
		 */
		public function setHeaders($headers){ }


		/**
		 * Returns headers set by the user
		 *
		 * @return \Phalcon\Http\Response\HeadersInterface
		 */
		public function getHeaders(){ }


		/**
		 * Sets a cookies bag for the response externally
		 *
		 * @param \Phalcon\Http\Response\CookiesInterface $cookies
		 * @return \Phalcon\Http\ResponseInterface
		 */
		public function setCookies($cookies){ }


		/**
		 * Returns coookies set by the user
		 *
		 * @return \Phalcon\Http\Response\CookiesInterface
		 */
		public function getCookies(){ }


		/**
		 * Overwrites a header in the response
		 *
		 *<code>
		 *	$response->setHeader("Content-Type", "text/plain");
		 *</code>
		 *
		 * @param string $name
		 * @param string $value
		 * @return \Phalcon\Http\ResponseInterface
		 */
		public function setHeader($name, $value){ }


		/**
		 * Send a raw header to the response
		 *
		 *<code>
		 *	$response->setRawHeader("HTTP/1.1 404 Not Found");
		 *</code>
		 *
		 * @param string $header
		 * @return \Phalcon\Http\ResponseInterface
		 */
		public function setRawHeader($header){ }


		/**
		 * Resets all the stablished headers
		 *
		 * @return \Phalcon\Http\ResponseInterface
		 */
		public function resetHeaders(){ }


		/**
		 * Sets a Expires header to use HTTP cache
		 *
		 *<code>
		 *	$this->response->setExpires(new DateTime());
		 *</code>
		 *
		 * @param DateTime $datetime
		 * @return \Phalcon\Http\ResponseInterface
		 */
		public function setExpires($datetime){ }


		/**
		 * Sends a Not-Modified response
		 *
		 * @return \Phalcon\Http\ResponseInterface
		 */
		public function setNotModified(){ }


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
		 * @return \Phalcon\Http\ResponseInterface
		 */
		public function setContentType($contentType, $charset=null){ }


		/**
		 * Set a custom ETag
		 *
		 *<code>
		 *	$response->setEtag(md5(time()));
		 *</code>
		 *
		 * @param string $etag
		 */
		public function setEtag($etag){ }


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
		 * @param string $location
		 * @param boolean $externalRedirect
		 * @param int $statusCode
		 * @return \Phalcon\Http\ResponseInterface
		 */
		public function redirect($location=null, $externalRedirect=null, $statusCode=null){ }


		/**
		 * Sets HTTP response body
		 *
		 *<code>
		 *	$response->setContent("<h1>Hello!</h1>");
		 *</code>
		 *
		 * @param string $content
		 * @return \Phalcon\Http\ResponseInterface
		 */
		public function setContent($content){ }


		/**
		 * Sets HTTP response body. The parameter is automatically converted to JSON
		 *
		 *<code>
		 *	$response->setJsonContent(array("status" => "OK"));
		 *</code>
		 *
		 * @param string $content
		 * @param int $jsonOptions
		 * @return \Phalcon\Http\ResponseInterface
		 */
		public function setJsonContent($content, $jsonOptions=null){ }


		/**
		 * Appends a string to the HTTP response body
		 *
		 * @param string $content
		 * @return \Phalcon\Http\ResponseInterface
		 */
		public function appendContent($content){ }


		/**
		 * Gets the HTTP response body
		 *
		 * @return string
		 */
		public function getContent(){ }


		/**
		 * Check if the response is already sent
		 *
		 * @return boolean
		 */
		public function isSent(){ }


		/**
		 * Sends headers to the client
		 *
		 * @return \Phalcon\Http\ResponseInterface
		 */
		public function sendHeaders(){ }


		/**
		 * Sends cookies to the client
		 *
		 * @return \Phalcon\Http\ResponseInterface
		 */
		public function sendCookies(){ }


		/**
		 * Prints out HTTP response to the client
		 *
		 * @return \Phalcon\Http\ResponseInterface
		 */
		public function send(){ }


		/**
		 * Sets an attached file to be sent at the end of the request
		 *
		 * @param string $filePath
		 * @param string $attachmentName
		 */
		public function setFileToSend($filePath, $attachmentName=null, $attachment=null){ }

	}
}
