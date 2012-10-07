<?php 

namespace Phalcon\Http {

	/**
	 * Phalcon\Http\Response
	 *
	 * Encapsulates the HTTP response message.
	 *
	 *<code>
	 *	$response = new Phalcon\Http\Response();
	 *	$response->setStatusCode(200, "OK");
	 *	$response->setContent("<html><body>Hello</body></html>");
	 *	$response->send();
	 *</code>
	 */
	
	class Response {

		protected $_content;

		protected $_headers;

		protected $_dependencyInjector;

		/**
		 * Sets the dependency injector
		 *
		 * @param \Phalcon\DI $dependencyInjector
		 */
		public function setDI($dependencyInjector){ }


		/**
		 * Returns the internal dependency injector
		 *
		 * @return \Phalcon\DI
		 */
		public function getDI(){ }


		/**
		 * Sets the HTTP response code
		 *
		 *<code>
		 *$response->setStatusCode(404, "Not Found");
		 *</code>
		 *
		 * @param int $code
		 * @param string $message
		 * @return \Phalcon\Http\Response
		 */
		public function setStatusCode($code, $message){ }


		/**
		 * Returns headers set by the user
		 *
		 * @return \Phalcon\Http\Response\Headers
		 */
		public function getHeaders(){ }


		/**
		 * Overwrites a header in the response
		 *
		 *<code>
		 *	$response->setHeader("Content-Type", "text/plain");
		 *</code>
		 *
		 * @param string $name
		 * @param string $value
		 * @return \Phalcon\Http\Response
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
		 * @return \Phalcon\Http\Response
		 */
		public function setRawHeader($header){ }


		/**
		 * Resets all the stablished headers
		 *
		 * @return \Phalcon\Http\Response
		 */
		public function resetHeaders(){ }


		/**
		 * Sets output expire time header
		 *
		 * @param DateTime $datetime
		 * @return \Phalcon\Http\Response
		 */
		public function setExpires($datetime){ }


		/**
		 * Sends a Not-Modified response
		 *
		 * @return \Phalcon\Http\Response
		 */
		public function setNotModified(){ }


		/**
		 * Sets the response content-type mime, optionally the charset
		 *
		 *<code>
		 *	$response->setContentType('application/pdf');
		 *	$response->setContentType('text/plain', 'UTF-8');
		 *</code>
		 */
		public function setContentType($contentType, $charset){ }


		/**
		 * Redirect by HTTP to another action or URL
		 *
		 *<code>
		 *	$response->redirect("posts/index");
		 *	$response->redirect("http://en.wikipedia.org", true);
		 *	$response->redirect("http://www.example.com/new-location", true, 301);
		 *</code>
		 *
		 * @param string $location
		 * @param boolean $externalRedirect
		 * @param int $statusCode
		 * @return \Phalcon\Http\Response
		 */
		public function redirect($location, $externalRedirect, $statusCode){ }


		/**
		 * Sets HTTP response body
		 *
		 *<code>
		 *	$response->setContent("<h1>Hello!</h1>");
		 *</code>
		 *
		 * @param string $content
		 * @return \Phalcon\Http\Response
		 */
		public function setContent($content){ }


		/**
		 * Appends a string to the HTTP response body
		 *
		 * @param string $content
		 * @return \Phalcon\Http\Response
		 */
		public function appendContent($content){ }


		/**
		 * Gets HTTP response body
		 *
		 * @return string
		 */
		public function getContent(){ }


		/**
		 * Sends headers to the client
		 *
		 * @return \Phalcon\Http\Response
		 */
		public function sendHeaders(){ }


		/**
		 * Prints out HTTP response to the client
		 *
		 * @return \Phalcon\Http\Response
		 */
		public function send(){ }

	}
}
