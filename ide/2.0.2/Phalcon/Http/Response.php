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
	 *	$response = new \Phalcon\Http\Response();
	 *	$response->setStatusCode(200, "OK");
	 *	$response->setContent("<html><body>Hello</body></html>");
	 *	$response->send();
	 *</code>
	 */
	
	class Response implements \Phalcon\Http\ResponseInterface, \Phalcon\Di\InjectionAwareInterface {

		protected $_sent;

		protected $_content;

		protected $_headers;

		protected $_cookies;

		protected $_file;

		protected $_dependencyInjector;

		protected $_statusCodes;

		/**
		 * \Phalcon\Http\Response constructor
		 *
		 * @param string content
		 * @param int code
		 * @param string status
		 */
		public function __construct($content=null, $code=null, $status=null){ }


		/**
		 * Sets the dependency injector
		 */
		public function setDI(\Phalcon\DiInterface $dependencyInjector){ }


		/**
		 * Returns the internal dependency injector
		 */
		public function getDI(){ }


		/**
		 * Sets the HTTP response code
		 *
		 *<code>
		 *	$response->setStatusCode(404, "Not Found");
		 *</code>
		 */
		public function setStatusCode($code, $message=null){ }


		/**
		 * Returns the status code
		 *
		 *<code>
		 *	print_r($response->getStatusCode());
		 *</code>
		 */
		public function getStatusCode(){ }


		/**
		 * Sets a headers bag for the response externally
		 */
		public function setHeaders(\Phalcon\Http\Response\HeadersInterface $headers){ }


		/**
		 * Returns headers set by the user
		 */
		public function getHeaders(){ }


		/**
		 * Sets a cookies bag for the response externally
		 */
		public function setCookies(\Phalcon\Http\Response\CookiesInterface $cookies){ }


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
		 * @param string name
		 * @param string value
		 * @return \Phalcon\Http\Response
		 */
		public function setHeader($name, $value){ }


		/**
		 * Send a raw header to the response
		 *
		 *<code>
		 *	$response->setRawHeader("HTTP/1.1 404 Not Found");
		 *</code>
		 */
		public function setRawHeader($header){ }


		/**
		 * Resets all the stablished headers
		 */
		public function resetHeaders(){ }


		/**
		 * Sets a Expires header to use HTTP cache
		 *
		 *<code>
		 *	$this->response->setExpires(new DateTime());
		 *</code>
		 */
		public function setExpires(\DateTime $datetime){ }


		/**
		 * Sends a Not-Modified response
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
		 * @param string contentType
		 * @param string charset
		 * @return \Phalcon\Http\Response
		 */
		public function setContentType($contentType, $charset=null){ }


		/**
		 * Set a custom ETag
		 *
		 *<code>
		 *	$response->setEtag(md5(time()));
		 *</code>
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
		 * @param string|array location
		 * @param boolean externalRedirect
		 * @param int statusCode
		 * @return \Phalcon\Http\Response
		 */
		public function redirect($location=null, $externalRedirect=null, $statusCode=null){ }


		/**
		 * Sets HTTP response body
		 *
		 *<code>
		 *	response->setContent("<h1>Hello!</h1>");
		 *</code>
		 */
		public function setContent($content){ }


		/**
		 * Sets HTTP response body. The parameter is automatically converted to JSON
		 *
		 *<code>
		 *	$response->setJsonContent(array("status" => "OK"));
		 *</code>
		 *
		 * @param mixed content
		 * @param int jsonOptions
		 * @return \Phalcon\Http\Response
		 */
		public function setJsonContent($content, $jsonOptions=null){ }


		/**
		 * Appends a string to the HTTP response body
		 *
		 * @param string content
		 * @return \Phalcon\Http\Response
		 */
		public function appendContent($content){ }


		/**
		 * Gets the HTTP response body
		 */
		public function getContent(){ }


		/**
		 * Check if the response is already sent
		 */
		public function isSent(){ }


		/**
		 * Sends headers to the client
		 */
		public function sendHeaders(){ }


		/**
		 * Sends cookies to the client
		 */
		public function sendCookies(){ }


		/**
		 * Prints out HTTP response to the client
		 */
		public function send(){ }


		/**
		 * Sets an attached file to be sent at the end of the request
		 *
		 * @param string filePath
		 * @param string attachmentName
		 * @return \Phalcon\Http\Response
		 */
		public function setFileToSend($filePath, $attachmentName=null, $attachment=null){ }

	}
}
